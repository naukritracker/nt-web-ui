<h1 class="l-title white-title txtc">Search Jobs</h1>
<div class="primary-box clearfix">
    {!! Form::open(array('route'=>'SearchForJobs','class'=>'row hpad20 hmar mar-t15')) !!}
    <div class="form-group col-sm-6 col-xs-12 hpad5">
        {!! Form::text('search_value', null, ['class'=>'form-control','placeholder'=>'Skills, Designation, Companies']) !!}
    </div>
    <div class="form-group col-sm-2 col-xs-6 hpad5">
        {!! Form::select('visa_type', ['Residence','Tourist','Not Required'], null, ['placeholder'=>'Visa','class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-2 col-xs-6 hpad5">
        {!! Form::select('experience',['0-1 year','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'], null, ['placeholder'=>'Experience','class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-2 col-xs-12 hpad5">
        {!! Form::select('state_id', $selectstate, null, ['placeholder'=>'Location','class'=>'form-control']) !!}
    </div>
    <div class="form-group  col-sm-3 col-xs-push-3 hpad5">
        {!! Form::select(
            'functional_area',
            $selectfunctionalarea,
            null,
            ['placeholder'=>'Functional Area','class'=>'form-control']
        ) !!}
    </div>
    <div class="form-group  col-sm-1 col-xs-push-3 hpad5">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
    {!!Form::token()!!}
    {!!Form::close()!!}
</div>
<h3 class="m-title white-title txtc pad-t20">Browse jobs by category</h3>
<ul class="b-jobs row hmar10 pad-t10" style="padding-left:15%;">
   <!-- <li class="col-md-2 col-sm-3 col-sm-offset-1 col-md-offset-3 col-xs-6 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-user"></span> Location</a></li> -->
    <li class="col-md-2 col-sm-3 col-xs-push-4 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-category"></span> Category</a></li>
</ul>