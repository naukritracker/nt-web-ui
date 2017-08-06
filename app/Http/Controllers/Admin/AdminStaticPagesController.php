<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class AdminStaticPagesController extends Controller
{
    public function showStaticPages()
    {
        $data['staticpages'] = StaticPage::orderBy('title', 'DESC')->paginate(15);
        return view('admin.staticpages.view')->with('data', $data);
    }

    public function viewStaticPage($page)
    {
        $page = StaticPage::find($page);
        $data['title'] = $page->title;
        
        $html = '';
        if ($page->keywords != '') {
            $html .= '<h3>Keywords</h3><p>'.$page->keywords.'</p>';
        }
        if ($page->description != '') {
            $html .= '<h3>Description</h3><p>'.$page->description.'</p>';
        }
        if ($page->content != '') {
            $html .= '<h3>Content</h3><p>'.$page->content.'</p>';
        }

        $data['body'] = $html;
        return $data;
    }

    public function newStaticPage()
    {
        return view('admin.staticpages.add');
    }

    public function editStaticPage($id)
    {
        $data['staticpage'] = StaticPage::find($id);
        return view('admin.staticpages.edit')->with('data', $data);
    }

    public function saveStaticPage(Request $request, $id = null)
    {
        if ($id != null) {
            $this->validate($request, [
                'title' => 'required|unique:static_pages,title,'.$id,
                'keywords' => 'required',
                'description' => 'required',
                'content' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'title' => 'required|unique:static_pages,title',
                'keywords' => 'required',
                'description' => 'required',
                'content' => 'required'
            ]);
        }

        try {
            if ($id != null) {
                $page = StaticPage::find($id);
            } else {
                $page = new StaticPage;
            }

            $page->title = $request->get('title');

            
            $arrayLowerTitle = array();
            $arrayTitle = explode(" ", $request->get('title'));
            foreach ($arrayTitle as $value) {
                $arrayLowerTitle[] = strtolower($value);
            }
            $lowerTitle = implode("-", $arrayLowerTitle);

            $page->slug = $lowerTitle;
            $page->keywords = $request->get('keywords');
            $page->description = $request->get('description');
            $page->content = $request->get('content');

            $page->save();

            if ($id != null) {
                return back()->with('success', ['Page edited']);
            } else {
                return redirect()->route('StaticPages')->with('success', ['Page created']);
            }
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }

    public function updateStaticPage($page)
    {
        try {
            $page = StaticPage::find($page);
            if ($page->active_flag == 0) {
                $page->active_flag = 1;
                $page->save();
                $success = [$page->title.' activated'];
                return back()->with('success', $success);
            } elseif ($page->active_flag == 1) {
                $page->active_flag = 0;
                $page->save();
                $success = [$page->title.' deactivated'];
                return back()->with('success', $success);
            } else {
                return back()->withErrors(['Status configuration unknown. Irrecoverable error']);
            }
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }

    public function bulkPageActivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = StaticPage::find($l);
            $job->active_flag = 1;
            $job->save();
        }

        return back();
    }

    public function bulkPageDeactivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = StaticPage::find($l);
            $job->active_flag = 0;
            $job->save();
        }

        return back();
    }

    public function bulkPageDelete($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = StaticPage::find($l);
            $job->delete();
        }

        return back();
    }



    public function deleteStaticPage($id)
    {
        try {
            $page = StaticPage::find($id);
            $success = ['Deleted page : '.$page->title];
            $page->delete();
            return back()->with('success', $success);
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }
}
