<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Validator;
use Illuminate\Http\Request;

class AdminBannersController extends Controller
{
    public function showBanners()
    {
        $data['banners'] = Banner::orderBy('id', 'desc')->paginate(15);
        return view('admin.banners.view')->with('data', $data);
    }

    public function saveBanner(Request $request)
    {
        if ($request->ajax()) {
            $validationRules = [
                'banner' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
                'type' => 'required'
            ];

            $validation = Validator::make($request->all(), $validationRules);

            if ($validation->fails()) {
                $data['success'] = false;
                $data['errors'] = $validation->errors();
                return response()->json($data);
            }
        } else {
            $this->validate($request, [
                'banner' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
                'type' => 'required'
            ]);
        }

        if ($request->hasFile('banner')) {
            $imageName = $request->file('banner')->getClientOriginalName() . '.' . $request->file('banner')->getClientOriginalExtension();
            try {
                $request->file('banner')->move(public_path().'/uploads/banners', $imageName);
                
                $banner = new Banner();
                $banner->banner = $imageName;
                $banner->type = $request->get('type');
                $banner->active_flag = 0;
                $banner->save();
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        }

        if ($request->ajax()) {
            $data['success'] = true;
            $data['redirect'] = route('Banners');
            return response()->json($data);
        } else {
            return back()->with('success', ['Banner saved successfully']);
        }
    }

    public function activateBanner($banner)
    {
        if ($banner != null) {
            try {
                $banner = Banner::find($banner);
                $success = ['Activated banner : '.$banner->id];
                $banner->active_flag = 1;
                $banner->save();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No banner specified']);
        }
    }

    public function deactivateBanner($banner)
    {
        if ($banner != null) {
            try {
                $banner = Banner::find($banner);
                $success = ['Deactivated banner : '.$banner->id];
                $banner->active_flag = 0;
                $banner->save();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No banner specified']);
        }
    }

    public function deleteBanner($banner)
    {
        if ($banner != null) {
            try {
                $banner = Banner::find($banner);
                $success = ['Deleted banner : '.$banner->id];
                $banner->delete();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No banner specified']);
        }
    }
}
