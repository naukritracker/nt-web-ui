<h1 class="l-title white-title txtc">Search Jobs</h1>
<div class="primary-box clearfix">
    {!! Form::open(array('route'=>'SearchForJobs','class'=>'row hpad20 hmar mar-t15', 'id'=>'searchForm')) !!}
    <div class="form-group col-sm-6 col-xs-12 hpad5">
        {!! Form::text('search_value', null, ['class'=>'form-control','placeholder'=>'Skills, Designation, Companies']) !!}
    </div>
    <div class="form-group col-sm-2 col-xs-12 hpad5" >
        <select  class='form-control'name="select1" id="select1">
            <option value="0" selected>Locations</option>
            <option value="1">Dubai(United Arab Emirites)</option>
            <option value="1">Ajman(United Arab Emirites)</option>
            <option value="1">Abu Dhabi(United Arab Emirites)</option>
            <option value="4">Al Manamah(Al Asimah)(Bahrain)</option>
            <option value="1">Sharjah(United Arab Emirites)</option>
            <option value="6">Al madinah al munawarah(Saudi Arabia)</option>
            <option value="1">Ras al Khaimah(United Arab Emirites)</option>
            <option value="8">Masqut(Oman)</option>
            <option value="6">Ar Riyad(Saudi Arabia)</option>
            <option value="10">Ar Dawhaw(Qatar)</option>
            <option value="1">Fujairah(Al Asimah)(United Arab Emirites)</option>
            <option value="12">Al Kuwayt(Al Asimah)(Kuwait)</option>
        </select>

    </div>
    <div class="form-group col-sm-2 col-xs-6 hpad5">

        <select class='form-control' name="select2" id="select2">
            <option value="0" selected>Visa</option>

            <option value="8">Employment</option>
            <option value="8">Employment Contracting</option>
            <option value="8">Family Joining / Residence</option>
            <option value="8">Student Resident</option>
            <option value="8">Investor Resident</option>
            <option value="8">Express</option>
            <option value="8">Multiple Entry</option>
            <option value="8">Relative / Friend Visit</option>
            <option value="8">Official Visit</option>
            <option value="8">Troupe (Artist)</option>
            <option value="8">Truck Drivers</option>
            <option value="8">Transit</option>
            <option value="8">Road Transit</option>
            <option value="8">Seamen's Transit</option>
            <option value="8">Scientific Research</option>
            <option value="8">Tourist</option>
            <option value="8">Visa Facility with Dubai</option>
            <option value="8">Common Visa with Qatar</option>
            <option value="8">Ship Passengers & Crew</option>
            <option value="8">Residents of AGCC States</option>
            <option value="8">Companions of GCC Nationals</option>

            <option value="6">Business</option>
            <option value="6">Commercial</option>
            <option value="6">Diplomatic and Official</option>
            <option value="6">Employment</option>
            <option value="6">Escort</option>
            <option value="6">Extension of exit / Re-Entry</option>
            <option value="6">Family Visit</option>
            <option value="6">Government Visit</option>
            <option value="6">Personal Visit</option>
            <option value="6">Residence Visit</option>
            <option value="6">Student Visit</option>
            <option value="6">Work Visit</option>
            <option value="6">Hajj</option>
            <option value="6">Umrah</option>

            <option value="1">AGCC Citizens</option>
            <option value="1">Western Europe and Pacific Rim Citizens</option>
            <option value="1">Entry Service Permit</option>
            <option value="1">Visit</option>
            <option value="1">Tourist</option>
            <option value="1">Multiple Entry</option>
            <option value="1">Residence</option>

            <option value="4">Residence</option>
            <option value="10">Residence</option>
            <option value="12">Residence</option>
        </select>

    </div>
    <div class="form-group col-sm-2 col-xs-6 hpad5">
        {!! Form::select('experience',$selectexp, null, ['placeholder'=>'Experience','class'=>'form-control']) !!}
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
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    $("#select1").change(function() {
        if ($(this).data('options') === undefined) {
            /*Taking an array of all options-2 and kind of embedding it on the select1*/
            $(this).data('options', $('#select2 option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#select2').html(options);
    });
</script>
-->
