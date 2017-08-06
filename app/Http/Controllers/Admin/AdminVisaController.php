<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Visa;

class AdminVisaController extends Controller
{
    public function showVisa()
    {
        $data['countries'] = Country::orderBy('country')->paginate(15);
        return view('admin.visa.view')->with('data', $data);
    }

    public function bulkVisaDelete($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $visa = Visa::find($l);
            $visa->delete();
        }

        return back();
    }

    public function deleteVisa($visa = null)
    {
        if ($visa != null) {
            try {
                $visa = Visa::find($visa);
                $success = ['Deleted visa : '.$visa->visa];
                $visa->delete();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        }
    }
}
