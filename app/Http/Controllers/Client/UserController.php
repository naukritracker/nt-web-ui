<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new flight instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        // Validate the request...

        $user = new User;

        $user->email = $request->email;

        $user->save();
    }
}
