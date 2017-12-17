<div id="shake">
    <h1 class="l-title white-title txtc">Search Jobs</h1>
	<p id="demo">
    <div class="primary-box clearfix">
        {!! Form::open(array('route'=>'SearchForJobs','class'=>'row hpad20 hmar mar-t15', 'id'=>'searchForm', 'name'=>'searchForm','onsubmit'=>'shakeForm();')) !!}
        <div class="form-group col-sm-3 col-xs-12 hpad5">
            <input type="text"  name="search_value" class="form-control" placeholder="Skills, Designation" id="tags" onclick="ch1(); " >

        </div>
        <div class="form-group col-sm-2 col-xs-12 hpad5" >
		
  
  
 <!-- <select id="B"  name="state_id" placeholder="city" class="form-control" id="B">
  <option selected>City<option>
  </select> -->
            {!! Form::select('state_id',["City"], null, ['placeholder'=>'City','class'=>'form-control','id'=>'B' ]) !!}
			<!--{!! Form::select('state_i', $selectstatesall, null, ['placeholder'=>'City','class'=>'form-control','id'=>'state_i' ]) !!}
			{!! Form::select('countr', $selectcountry, null, ['placeholder'=>'Country','class'=>'form-control','id'=>'countr','onclick'=>'fos();' ]) !!}
			<!-- <select  class='form-control' name="state_id" id="select1" onclick="dropChange1();">
            <option value="0" selected>City</option>
            <option value="1" selected>All</option>
            <option value="1">Abu Dhabi</option>
            <option value="1">Ajman</option>
            <option value="1">Dubai</option>
            <option value="1">Fujairah</option>
            <option value="1">Sharjah</option>
            <option value="1">Umm Al Qaiwain</option>
			
            <option value="2" selected>All</option>
            <option value="2">Riyadh</option>
            <option value="2">Jeddah</option>
            <option value="2">Mecca</option>
            <option value="2">Al Madinah</option>
			<option value="2">Al-Ahsa</option>
			<option value="2">Ta'if</option>
			<option value="2">Dammam/Khobar</option>
			<option value="2">Buraidah</option>
			<option value="2">Tabuk</option>
		
			<option value="3" selected>All</option>
			<option value="3">Muscat</option>
			<option value="3">Zufar</option>
			
			<option value="4">Doha</option>
			
			<option value="5" selected>All</option>			
			<option value="5">Al Ahmadi</option>
			<option value="5">Al Farwaniyah</option>
			<option value="5">Al Jahra</option>
			<option value="5">Kuwait City </option>
			<option value="5">Hawally</option>
			
			<option value="6">Manama</option>
								
								
        </select>-->
        </div>
        <div class="form-group col-sm-2 col-xs-6 hpad5">
		<!--<select id="C"  name="visa_type" placeholder="city" class="form-control" >
		<option selected>Visa<option>
  </select>-->
		
		 <!-- {!! Form::select('visa_type', [], null, ['placeholder'=>'Visa', 'class'=>'form-control','id'=>'visa_i' ,'required']) !!}   -->
            {!! Form::select('visa_type',["Visa"], null, ['placeholder'=>'Visa','id'=>'C','class'=>'form-control']) !!} 
			<!--<select class='form-control' name="visa_type" id="select2">
            <option value="0" selected>Visa</option>

           

            <option value="1">Employment Visa</option>
            <option value="1">Employment Visa - Cancelled</option>
            <option value="1">Family Sponsorship Visa</option>
            <option value="1">Long Term Visit - 90days</option>
            <option value="1">Tourist Visa - 30days</option>
            <option value="1">Mission Visa </option>
           

            <option value="2">Business Visa - 180 Days</option>
            <option value="2">Employment Visa - Transferable</option>
            <option value="2">Employment Visa - Non-Transferable</option>
			 <option value="2">Family Sponsorship Visa</option>
			 
			 
			<option value="3">Employment Visa</option>
            <option value="3">Employment Visa - Cancelled</option>
            <option value="3">Family Sponsorship Visa</option>
            <option value="3">Long Term Visit - 90days</option>
            <option value="3">Visit- 30days</option>
            <option value="3">Business Visa</option>
			
            <option value="4">Employment Visa</option>
			<option value="4">Employment Visa - Cancelled</option>
            <option value="4">Family Sponsorship Visa</option>
            <option value="4">Long Term Visit - 90days</option>
            <option value="4">Visit- 30days</option>
            <option value="4">Business Visa</option>
			
			
			<option value="5">Employment Visa</option>
			<option value="5">Employment Visa - Cancelled</option>
            <option value="5">Family Sponsorship Visa</option>
            <option value="5">Long Term Visit - 90days</option>
            <option value="5">Visit- 30days</option>
            <option value="5">Business Visa</option>
			
			<option value="6">Employment Visa</option>
			<option value="6">Employment Visa - Cancelled</option>
            <option value="6">Family Sponsorship Visa</option>
            <option value="6">Long Term Visit - 90days</option>
            <option value="6">Visit- 30days</option>
            <option value="6">Business Visa</option>
           
        </select>-->
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

<!--<script>
	
	document.getElementById("select3").addEventListener("click", 
		function(){ 
			var selectedCountry = sessionStorage.getItem("SelectedItem");
			console.log('Selected country==='+selectedCountry);
			alert("Selected Country is ===="+selectedCountry); 
			});
</script> -->
<!--<h3 class="m-title white-title txtc pad-t20">Browse jobs by </h3>
<ul class="b-jobs row hmar10 pad-t10" style="padding-left:15%;">
    <li class="col-md-2 col-sm-3 col-sm-offset-1 col-md-offset-3 col-xs-6 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-location"></span> Location</a></li><li class="col-md-2 col-sm-3 col-xs-6 hpad10"><a href="{{ route('SearchJobs') }}"><span class="sp-icon sp-category"></span> Category</a></li>
</ul>-->

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