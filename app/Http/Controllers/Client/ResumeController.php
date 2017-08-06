<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\UserDetail;
use App\Models\Industry;
use App\Models\FunctionalArea;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Contracts\FormBuilderContract as FormBuilder;

class ResumeController extends Controller
{

    /**
     * Show job search.
     *
     * @return \Illuminate\View\View
     */
    public function showResumeSearch()
    {
        $candidates = User::where('active_flag', 1)->orderBy('updated_at', 'desc')->paginate(10);
        return view('client.resumesearch')->with('candidates', $candidates);
    }

    /**
     * Load search jobs filter data.
     *
     * @param object $request     Request object
     * @param object $formbuilder Form Builder object
     *
     * @return array
     */
    public function loadSearchFilterData(Request $request, FormBuilder $formbuilder)
    {
        if ($request->ajax()) {
            $data = [];

            $data['locations'] = $formbuilder->build('AvailableResumeLocationsListing');
            $data['industry'] = $formbuilder->build('AvailableResumeIndustryListing');
            $data['functionalarea'] = $formbuilder->build('AvailableResumeFunctionalAreaListing');

            return $data;
        } else {
            return [];
        }
    }
    /**
     * Search resumes result.
     *
     * @param object $request Request object
     *
     * @return \Illuminate\View\View
     */
    public function searchResumes(Request $request)
    {
        $searchKeywords = [];
        $order = $request->input('order');
        if ($order == '') {
            $order = 'updated_at';
        }
        $locationArr = $request->input('location');
        $locationArr[] = $request->input('preferred_location');
        $locationArr = array_filter($locationArr);
        $userDetailsFromLocation = UserDetail::whereIn('current_location', $locationArr)
            ->orWhereIn('preferred_location', $locationArr)
            ->distinct();
        $userDetailIdLocations = $userDetailsFromLocation->get()->toArray();
        foreach ($userDetailsFromLocation->get() as $ud) {
            if ($request->has('location') and $ud->currentlocation) {
                $searchKeywords[] = $ud->currentlocation->state . '(' . $ud->currentlocation->country->country . ')';
            }
            if ($request->has('preferred_location') and $ud->preferredlocation) {
                $searchKeywords[] = $ud->preferredlocation->state . '(' . $ud->preferredlocation->country->country . ')';
            }
        }
        $industriesArr = $request->has('industry') ? array_filter($request->input('industry')) : [];
        $userDetailsFromIndustries = UserDetail::whereIn('industry', $industriesArr);
        $userDetailIdIndustries = $userDetailsFromIndustries->get()->toArray();
        foreach ($userDetailsFromIndustries->get() as $ud) {
            if ($ud->industries) {
                $searchKeywords[] = $ud->industries->industry;
            }
        }

        $functionalAreasArr = $request->has('functional_area') ? array_filter($request->input('functional_area')) : [];
        $userDetailsFromFunctionalArea = UserDetail::whereIn('functional_area', $functionalAreasArr);
        $userDetailIdFunctionalArea = $userDetailsFromFunctionalArea->get()->toArray();
        foreach ($userDetailsFromFunctionalArea->get() as $ud) {
            if ($ud->functionalareas) {
                $searchKeywords[] = $ud->functionalareas->functional_area;
            }
        }
        $singleTerm = $request->has('type') ? $request->input('type') : 0;
        if ($singleTerm) {
            $searchBoxArr = $request->has('search') ? [$request->input('search')] : [];
        } else {
            $searchBoxArr = $request->has('search') ? array_filter(explode(' ', $request->input('search'))) : [];
        }
        $userDetailIdResumeSearch = $this->scanAllResumesForKeywords($searchBoxArr);
        $userDetailsFromSearch = UserDetail::whereIn('profile_headline', $searchBoxArr)
            ->where(
                function ($query) use ($searchBoxArr) {
                    foreach ($searchBoxArr as $search) {
                        $query->orWhere('role', 'LIKE', '%'.$search.'%');
                        $query->orWhere('city', 'LIKE', '%'.$search.'%');
                        $query->orWhere('marital_status', 'LIKE', '%'.$search.'%');
                        $query->orWhere('sse_institution', 'LIKE', '%'.$search.'%');
                        $query->orWhere('hsse_institution', 'LIKE', '%'.$search.'%');
                        $query->orWhere('ug_institution', 'LIKE', '%'.$search.'%');
                        $query->orWhere('pg_institution', 'LIKE', '%'.$search.'%');
                        $query->orWhere('other_institution', 'LIKE', '%'.$search.'%');
                    }
                }
            )
            ->orWhere(
                function ($query) use ($searchBoxArr) {
                    $industries = Industry::where(
                        function ($innerQuery) use ($searchBoxArr) {
                            foreach ($searchBoxArr as $search) {
                                $innerQuery->orWhere('industry', 'LIKE', '%'.$search.'%');
                            }
                        }
                    )->select('id')->get()->toArray();
                    $functionalareas = FunctionalArea::where(
                        function ($innerQuery) use ($searchBoxArr) {
                            foreach ($searchBoxArr as $search) {
                                $innerQuery->orWhere('functional_area', 'LIKE', '%'.$search.'%');
                            }
                        }
                    )->select('id')->get()->toArray();
                    $areas = State::where(
                        function ($innerQuery) use ($searchBoxArr) {
                            foreach ($searchBoxArr as $search) {
                                $innerQuery->orWhere('state', 'LIKE', '%'.$search.'%');
                            }
                        }
                    )->select('id')->get()->toArray();

                    $query->orWhereIn('state_id', $areas)
                        ->orWhereIn('current_location', $areas)
                        ->orWhereIn('preferred_location', $areas)
                        ->orWhereIn('industry', $industries)
                        ->orWhereIn('functional_area', $functionalareas);
                }
            );
        foreach ($searchBoxArr as $search) {
            $searchKeywords[] = $search;
        }
        $userDetailIdSearchDb = $userDetailsFromSearch->get()->toArray();
        $userDetailIdSearch = array_merge($userDetailIdResumeSearch, $userDetailIdSearchDb);
        $finalMergedDetailIds = array_merge(
            array_merge($userDetailIdLocations, $userDetailIdIndustries),
            array_merge($userDetailIdFunctionalArea, $userDetailIdSearch)
        );
        $finalUniqueDetailIds = array_unique($finalMergedDetailIds, SORT_REGULAR);;
        $query = User::where('active_flag', '=', 1)
            ->where(
                function ($query) use ($finalUniqueDetailIds) {
                    if (!empty($finalUniqueDetailIds)) {
                        foreach ($finalUniqueDetailIds as $detail) {
                            $query->where('id', '=', $detail['user_id']);
                        }
                    }
                }
            );
        if (!$query->count()) {
            $candidateCount = $query->count();
            $query = User::where('active_flag', '=', 1);
        } else {
            $candidateCount = $query->count();
        }
        $candidates = $query->orderBy($order, 'desc')
            ->paginate(10);

        return view('client.resumesearch')
            ->with('candidates', $candidates)
            ->with('candidateCount', $candidateCount)
            ->with('location', $request->get('location'))
            ->with('search', $request->get('search'))
            ->with('type', $singleTerm)
            ->with('preferred_location', $request->get('preferred_location'))
            ->with('industry', $request->get('industry'))
            ->with('functional_area', $request->get('functional_area'))
            ->with('search_keywords', $searchKeywords)
            ->with('order', $order);
    }
    /**
     * Scan user resume PDFs for keywords
     *
     * @param array $search Search criteria
     *
     * @return array
     */
    public function scanAllResumesForKeywords(array $search)
    {
        $result = [];
        $users = UserDetail::all();
        foreach ($search as $word) {
            foreach ($users as $user) {
                if ($user->media and $user->media->content != '' and isset($user->media->raw)) {
                    if (preg_match("/\b" . $word . "\b/i", $user->media->raw)) {
                        $result[] = $user->toArray();
                    }
                }
            }
        }
        return $result;
    }
    /**
     * Show resume details.
     *
     * @param Request $request Request object
     * @param integer $id      User Id
     *
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResumeDetails(Request $request, $id)
    {
        if ($request->ajax()) {
            return false;
        } else {
            $search = "";
            $user = User::find($id);
            if ($request->has('search')) {
                $search = trim($request->get('search'));
            }
            return view('client.resumedetails')->with('user', $user)->with('search_value', $search);
        }
    }
}
