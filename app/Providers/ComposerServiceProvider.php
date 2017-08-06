<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            ['client.partials.resumesearchfilters'],
            'App\Http\ViewComposers\EmployerResumeSearchFilterComposer'
        );

        view()->composer(
            ['client.partials.latestjobs','client.partials.latestjobsinner'],
            'App\Http\ViewComposers\LatestJobsComposer'
        );

        view()->composer(
            'client.partials.employerslider',
            'App\Http\ViewComposers\EmployerSliderComposer'
        );

        view()->composer(
            'client.partials.employertestimonials',
            'App\Http\ViewComposers\EmployerTestimonialComposer'
        );

        view()->composer(
            'client.partials.companyslider',
            'App\Http\ViewComposers\CompanySliderComposer'
        );

        view()->composer(
            'templates.client.master',
            'App\Http\ViewComposers\MasterComposer'
        );



        // Using Closure based composers...
        // view()->composer('dashboard', function ($view) {

        // });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
