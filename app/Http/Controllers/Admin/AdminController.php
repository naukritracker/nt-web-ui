<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show homepage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showHome(Request $request)
    {
        return view('admin.home');
    }
}
