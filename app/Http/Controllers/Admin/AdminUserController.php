<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class AdminUserController extends Controller
{
    public function showUsers()
    {
        $data['users'] = User::orderBy('id', 'DESC')->paginate(15);
        return view('admin.users.view')->with('data', $data);
    }

    public function setRole($type, $id)
    {
        try {
            if ($type == 'candidate') {
                $user = User::find($id);
                $user->detachRoles($user->roles);

                $role = Role::where('name', 'candidate')->first();
                $user->roles()->attach($role->id);
                $message = $user->name.' has been set as a candidate successfully';
            }

            if ($type == 'moderator') {
                $user = User::find($id);
                $user->detachRoles($user->roles);

                $role = Role::where('name', 'moderator')->first();
                $user->roles()->attach($role->id);
                $message = $user->name.' has been set as a moderator successfully';
            }

            return back()->with('success', [$message]);
        } catch (Exception $e) {
            return back()->withErrors([$e]);
        }
    }

    public function bulkJobActivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 1;
            $job->save();
        }

        return back();
    }

    public function bulkJobDeactivate($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 0;
            $job->save();
        }

        return back();
    }

    public function bulkJobReview($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->active_flag = 2;
            $job->save();
        }

        return back();
    }

    public function bulkJobDelete($list)
    {
        $listArr = explode('||', $list);
        foreach ($listArr as $l) {
            $job = JobPosting::find($l);
            $job->delete();
        }

        return back();
    }



    public function deleteJobPosting($job = null)
    {
        if ($job != null) {
            try {
                $job = JobPosting::find($job);
                $success = ['Deleted job posting : '.$job->title];
                $job->delete();
                return back()->with('success', $success);
            } catch (Exception $e) {
                return back()->withErrors([$e]);
            }
        }
    }
}
