@extends('templates.client.master')

<section class="pad-t85  mar-b20 animated fadeInDown">
    <div class="container">
        <div class="row os-h-search hmar5 mar-t20">
            {!!Form::open(array('route'=>'SearchForJobs','id'=>'search_jobs_form'))!!}
            <div class="col-sm-10">
                <h3 class="m-title b-title mar-t0">Applied Jobs</h3>
                <ul class="l-jobs r-jobs mar-t50">
                    @foreach($jobs as $job)
                        <li>
                            <p class="tc-text"><a href="{{URL::route('JobDetails',[$job->id])}}" class="sm-title">{{$job->title}} </a></p>
                            <p class="xs-title lj-icons">
                                @if($job->industry)
                                    <span>{{$job->industry}}</span>
                                @endif

                                @if($job->state_id!=0)
                                    <span>{{$job->state->state}}</span>
                                @endif

                                @if($job->created_at)
                                    <span>{{$job->created_at->diffForHumans()}}</span>
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>


</div>
            {!!Form::token()!!}
            {!!Form::close()!!}
        </div>
    </div>
</section>