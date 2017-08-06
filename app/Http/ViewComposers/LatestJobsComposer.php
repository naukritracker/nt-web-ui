<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use App\Models\JobPosting;

class LatestJobsComposer
{
    /**
    * The Guard implementation.
    *
    * @var Guard
    */
    protected $auth;

    /**
    * Create a new filter instance.
    *
    * @param  Guard  $auth
    * @return void
    */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if ($this->auth->user()) {
            $jobs  = JobPosting::skip(0)->take(10)->orderBy('created_at', 'desc')->get();
        } else {
            $jobs  = JobPosting::skip(0)->take(10)->orderBy('created_at', 'desc')->get();
        }

        $view->with('jobs', $jobs);
    }
}
