<div class="col-sm-3">
<h3 class="m-title b-title mar-t0">Recommended Jobs</h3>
<ul class="l-jobs r-jobs mar-t20">
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

            @if($job->updated_at)
                <span>{{$job->updated_at->diffForHumans()}}</span>                    
            @endif
        </p>
    </li>
    @endforeach
</ul>
<p class="txtc pad-t20"><a href="{{URL::route('SearchJobs')}}">View All &raquo;</a></p>
<!--<div class="mar-t30">{!!Html::image('assets/img/ad1.png',null,['class'=>'img-responsive'])!!}</div>
<div class="mar-t30">{!!Html::image('assets/img/ad2.png',null,['class'=>'img-responsive'])!!}</div>-->
</div>