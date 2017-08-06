<!-- Latest Jobs Starts Here -->
    <div class="col-sm-8 mar-b20">
        <h3 class="m-title b-title">Latest Jobs</h3> 
        <ul class="l-jobs mar-t20">
            @foreach($jobs as $job)
            <li>
                <p><a href="{{URL::route('JobDetails',[$job->id])}}" class="sm-title">{{$job->title}} </a></p>
                <p class="xs-title lj-icons">
                    @if($job->industry)
                        <span>{{$job->industry}}</span>
                    @endif

                    @if($job->state_id!=0)
                        <span>{{$job->state->state}} / {{$job->country->country}}</span>
                    @endif

                    @if($job->updated_at)
                        <span>{{$job->updated_at->diffForHumans()}}</span>                            
                    @endif
                </p>
                <p class="lj-description">{{$job->short_description}}</p>
            </li>
            @endforeach
                                                                                                                                        
        </ul>
        <p class="txtc pad-t20"><a href="{{URL::route('SearchJobs')}}">View All &raquo;</a></p>
    </div>
    <!-- Latest Jobs Ends Here -->