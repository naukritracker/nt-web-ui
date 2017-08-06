<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Validator;
use Illuminate\Http\Request;

class AdminTestimonialsController extends Controller
{
    public function showTestimonials()
    {
        $data['testimonials'] = Testimonial::orderBy('id', 'desc')->paginate(15);
        return view('admin.testimonials.view')->with('data', $data);
    }

    public function saveTestimonial(Request $request)
    {
        if ($request->ajax()) {
            $validationRules = [
                'content' => 'required|max:2048',
                'author' => 'required'
            ];

            $validation = Validator::make($request->all(), $validationRules);

            if ($validation->fails()) {
                $data['success'] = false;
                $data['errors'] = $validation->errors();
                return response()->json($data);
            }
        } else {
            $this->validate($request, [
                'content' => 'required|max:2048',
                'author' => 'required'
            ]);
        }

        $testimonial = new Testimonial();
        $testimonial->content = $request->get('content');
        $testimonial->author = $request->get('author');
        $testimonial->active_flag = 0;
        if ($testimonial->save()) {
            if ($request->ajax()) {
                $data['success'] = true;
                $data['redirect'] = route('Testimonials');
                return response()->json($data);
            } else {
                return back()->with('success', ['Testimonial saved successfully']);
            }
        } else {
            return back()->withErrors(['Unable to save testimonial']);
        }
    }

    public function activateTestimonial($testimonial)
    {
        if ($testimonial != null) {
            try {
                $testimonial = Testimonial::find($testimonial);
                $success = ['Activated testimonial by '.$testimonial->author.' ( ID : '.$testimonial->id.')'];
                $testimonial->active_flag = 1;
                $testimonial->save();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No testimonial specified']);
        }
    }

    public function deactivateTestimonial($testimonial)
    {
        if ($testimonial != null) {
            try {
                $testimonial = Testimonial::find($testimonial);
                $success = ['Deactivated testimonial by '.$testimonial->author.' ( ID : '.$testimonial->id.')'];
                $testimonial->active_flag = 0;
                $testimonial->save();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No testimonial specified']);
        }
    }

    public function deleteTestimonial($testimonial)
    {
        if ($testimonial != null) {
            try {
                $testimonial = Testimonial::find($testimonial);
                $success = ['Deleted testimonial by '.$testimonial->author.' ( ID : '.$testimonial->id.')'];
                $testimonial->delete();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        } else {
            return back()->withErrors(['No testimonial specified']);
        }
    }
}
