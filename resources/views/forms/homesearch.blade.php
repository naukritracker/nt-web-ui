<div id="shake">
<h1 class="l-title white-title txtc">Search Jobs</h1>
<div class="primary-box clearfix">
    {!! Form::open(array('route'=>'SearchForJobs','class'=>'row hpad20 hmar mar-t15', 'id'=>'searchForm', 'name'=>'searchForm','onsubmit'=>'shakeForm();')) !!}
    <div class="form-group col-sm-3 col-xs-12 hpad5">
        <input type="text"  name="search_value" class="form-control" placeholder="Skills, Designation" id=tags onclick="ch1(); " >

    </div>
    <div class="form-group col-sm-2 col-xs-12 hpad5" >
        {!! Form::select('state_id', $selectstate, null, ['placeholder'=>'Location','class'=>'form-control','id'=>'select1']) !!}
    </div>
    <div class="form-group col-sm-2 col-xs-6 hpad5">
        {!! Form::select('visa_type', $selectvisa, null, ['placeholder'=>'Visa','id'=>'select2','class'=>'form-control']) !!}
    </div>
    <div class="form-group col-sm-1 col-xs-6 hpad5">
        {!! Form::select('experience', $selectexp, null, ['placeholder'=>'Exp','class'=>'form-control','id'=>'exp']) !!}    </div>
    <div class="form-group  col-sm-3 col-xs-12 hpad5">
        {!! Form::select(
            'functional_area',
            $selectfunctionalarea,
            null,
            ['placeholder'=>'Functional Area','class'=>'form-control','id'=>'fun_area']
        ) !!}
    </div>
    <div class="form-group  col-sm-1 col-xs-12 hpad5">
        <button type="submit" id="gh" class="btn btn-primary">Search</button>
    </div>

    {!!Form::token()!!}
    {!!Form::close()!!}
</div>

</div>
<h3 class="m-title white-title txtc pad-t20">Browse jobs by </h3>
<ul class="b-jobs row hmar10 pad-t10" style="padding-left:15%;">
<li class="col-md-2 col-sm-3 col-sm-offset-1 col-md-offset-3 col-xs-6 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-location"></span> Location</a></li><li class="col-md-2 col-sm-3 col-xs-6 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-category"></span> Category</a></li>
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


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#tags" ).autocomplete({
            source: availableTags
        });
    } );


    , 'onclick'=>'ch();'
</script>
-->