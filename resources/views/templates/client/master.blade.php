<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @section('title')
            Naukri Tracker
        @show
    </title>

    @section('meta')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{{ Session::token() }}}">
    @show

    @section('favicon')
    <!-- <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico') }}"> -->
    @show

    @section('css')
        {!! Html::style('assets/css/bootstrap.min.css') !!}
        {!! Html::style('assets/css/check-radio.css') !!}
        {!! Html::style('assets/css/font-awesome.min.css') !!}
        {!! Html::style('assets/css/animate.css') !!}
        {!! Html::style('assets/css/pnotify.custom-3.min.css') !!}
        {!! Html::style('assets/css/main.css') !!}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

    @show

    @section('html5shiv')
    <!-- Html5 shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show


    @section('google-sign-in')
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="700600975479-fbae9i415b83lp829h61kp86v7h97rvv.apps.googleusercontent.com">
    @show

    @section('google-analytics')
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58721740-1', 'auto');
            ga('send', 'pageview');

        </script>
    @show

</head>
<body>
@section('header')
    <header>
        <div class="navbar navbar-default navbar-fixed-top top--header" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{URL::route('Home')}}" class="navbar-brand logo logo-top mar-t20 mar-b20">Naukri Tracker</a>

                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse">

                    <ul class="nav navbar-nav navbar-right mar-sm-t25">
                        <li id="togg2">
                            <a>Search Jobs by Country:</a>
                        </li>
                        <li id= "togg">

                   <!--   <select class="form-control "  id="select3"  >
                                <option value="ChooseCountry" selected>Choose Country</option>
                                <option value="UAE">UAE</option>
                                <option value="SaudiArabia" >Saudi Arabia</option>
                                <option value="Oman" >Oman</option>
                                <option value="Qatar" >Qatar</option>
                                <option value="Kuwait" >Kuwait</option>
                                <option value="Bahrain" >Bahrain</option>
                              
                            </select>-->
					  		 <select class="form-control "  id="dropdown" >
                                <option value="">Choose Country</option>
                               <option value="UAE">UAE</option>
                                <option value="SaudiArabia" >Saudi Arabia</option>
                                <option value="Oman" >Oman</option>
                                <option value="Qatar" >Qatar</option>
                                <option value="Kuwait" >Kuwait</option>
                                <option value="Bahrain" >Bahrain</option>
                            </select>
					
							
  
                        </li>





                        <!--    <div class="form-group  col-sm-1 col-xs-12 hpad5">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div> -->

                        @if(Auth::user('employer'))
                            <li  @if(route('EmployerProfile') == Request::url() or route('ResumeSearch') == Request::url() or route('ShowEmployerJobPosting') == Request::url()) class="active" @endif>
                                <a href="{{URL::route('EmployerProfile')}}">Employer</a>
                            </li>
                            <li class="dropdown @if(route('ResumeSearch') == Request::url() or route('ShowEmployerJobPosting') == Request::url()) active @endif">
                                @if((route('ResumeSearch'))
                                    or (route('ShowEmployerJobPosting')))
                                    <a href="javascript:void(0)"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       role="button"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span class="caret"></span>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown"
                                       role="button"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span class="caret"></span>
                                    </a>
                                @endif
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{URL::route('ResumeSearch')}}"
                                           @if(route('ResumeSearch') == Request::url()) class="active" @endif>
                                            Search Resumes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL::route('ShowEmployerJobPosting')}}"
                                           @if(route('ShowEmployerJobPosting') == Request::url()) class="active" @endif>
                                            Job Posting</a>
                                    </li>
                                </ul>
                            </li>
                        @else


                            <li id= "togg1" @if(route('Employers') == Request::url()) class="active" @endif>
                                <a href="{{URL::route('Employers')}}">Employers</a>
                            </li>
                        @endif
                    <!-- <li>
                                    <a href="{{URL::route('ShowTermsAndConditions')}}">Terms & Conditions</a>
                                </li> -->
                        @if(count($staticpages))
                            @foreach($staticpages as $page)
                                <li>
                                    <a href="{{URL::route('ShowStaticPage',[$page->slug])}}"
                                       @if(route('ShowStaticPage',[$page->slug]) == Request::url()) class="active" @endif>
                                        {{$page->title}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    <!-- <li><a href="#">Employers</a></li>
                                <li><a href="#">Resume Tips</a></li> -->
                        @if (Auth::user())
                            @if(Auth::user()->hasRole(['admin','su','moderator']))
                                <li>
                                    <a href="{{ URL::route('Dashboard') }}">
                                        <i class="fa fa-dashboard" style="font-size:200%;color:green;" title="View Administration"></i>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a id="drop4" href="{{ URL::route('Profile') }}" class="pull-left clear-pad" aria-haspopup="true" aria-expanded="false">
                                    <span class="pull-left pad-t9 pad-l10 pad-r10">{{ Auth::user()->name }}</span>

                                    @if(isset(Auth::user()->userdetail->profile_image) && Auth::user()->userdetail->profile_image != '')
                                        <img src="{{url('uploads/profile/'.Auth::user()->userdetail->profile_image)}}" class="circle" height="45px" width="45px"/>
                                    @endif
                                </a>
                            </li>
                                <!--<li>
                                    <a id="drop4"
                                       href="{{ URL::route('EmployerProfile') }}"
                                       class="pull-left clear-pad"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                            <span class="pull-left pad-t9 pad-l10 pad-r10">
                                                Employer Profile
                                            </span>
                                    </a>
                                </li> -->
                            <li><a href="{{ URL::route('Logout') }}" class="signup-btn">Log Out</a></li>
                        @elseif(Auth::user('employer'))
                            <li><a href="{{ URL::route('Logout') }}" class="signup-btn">Log Out</a></li>
                        @else
                            <li>
                                <a href="#" class="login-btn" data-toggle="modal" data-target="#login-popup">
                                    Log in
                                </a>
                            </li>
                            <li><a href="{{ URL::route('Register') }}" class="signup-btn">Register</a>
                                <!--<a href="#" class="signup-btn" data-toggle="modal" data-target="#register-popup">
                                    reg
                                </a></li> -->
                        @endif


                    </ul>
                </nav>
            </div>
        </div>
    </header>

@show

@yield('content')


@include('client.partials.loginmodal')







@section('footer')
    <!-- Footer Starts Here -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p class="clearfix"><a href="{{URL::route('Home')}}" class="navbar-brand logo logo-footer mar-t20 mar-b20">Naukri Tracker</a> </p>
                    <p style="width:422px;" class="xs-title white-title" style="word-wrap:break-word"><a href="{{URL::route('Home')}}">naukritracker.com</a> is an online jobs search platform in Gulf region tracking jobs in a highly interactive manner. Naukritracker.com's objective is to track the latest jobs in Gulf Region to bridge the gap in online media recruitment as one-stop destination for Job-Seekers.</p>
                    <!--  <ul class="social-media mar-b20 clearfix pad-t10">
                         <li><a href="#">facebook</a></li>
                         <li><a href="#" class="twitter">twitter</a></li>
                         <li><a href="#" class="gplus">gplus</a></li>
                         <li><a href="#" class="linkedin">linkedin</a></li>
                     </ul> -->
                </div>
                <div class="col-sm-2 mar-t10 mar-b20">
                    <!-- <h5 class="white-title b-title">Company</h5>
                    <ul class="f-links pad-t10 clearfix">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Blogs</a></li>
                    </ul> -->
                </div>
                <div class="col-sm-2 mar-t10 mar-b20">
                    <!-- <h5 class="white-title b-title hidden-xs">&nbsp;</h5>
                    <ul class="f-links pad-t10 clearfix">


                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul> -->
                </div>
                <div class="col-sm-2 mar-t10 mar-b20">
                    <h5 class="white-title b-title">Sitemap</h5>
                    <ul class="f-links pad-t10 clearfix">
                        <li><a href="{{URL::route('SearchJobs')}}">Search Jobs</a></li>
                        <li><a href="{{URL::route('ShowTermsAndConditions')}}">Terms & Conditions</a></li>
                        <!-- <li><a href="#">Employers</a></li> -->
                        <!-- <li><a href="#">Resume Tips</a></li> -->
                        <li>
                            @if(Auth::user())
                                <a href="{{ URL::route('Logout') }}">Logout</a>
                            @else
                                <a href="{{ URL::route('ShowLogin') }}">Login</a> <a href="javascript:void(0)"> / </a><a href="{{ URL::route('Register') }}">Register</a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="col-sm-2 mar-t10 mar-b20">
                    <h5 class="white-title b-title">&nbsp;</h5>
                    <ul class="f-links pad-t10 clearfix">
                        @if(count($staticpages)>0)
                            @foreach($staticpages as $page)
                                <li><a href="{{URL::route('ShowStaticPage',$page->id)}}">{{$page->title}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@show

@section('footerbottom')
    <section class="footer-btm pad-b5">
        <div class="container sm-txtc">
            <p>&copy; 2016 naukritracker. All rights reserved.</p>
        </div>
    </section>
@show
<!-- Footer Ends Here -->

@section('js')

    {!! Html::script('assets/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/pnotify.custom-3.min.js') !!}

    <script type="text/javascript">

        var selectedItem = sessionStorage.getItem("SelectedItem");
        $('#dropdown').val(selectedItem);


        $('#dropdown').change(function() {
            var dropVal = $(this).val();
            sessionStorage.setItem("SelectedItem", dropVal);
        });

		
		

    </script> 
    <script type="text/javascript">//PNotify.prototype.options.styling = "fontawesome";</script>
    <script type="text/javascript">
        token = $('meta[name="csrf-token"]').attr('content');
        animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        pageloading = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><i class="fa fa-circle-o-notch fa-spin green"></i><i class="fa fa-circle-o-notch fa-spin red"></i><i class="fa fa-circle-o-notch fa-spin blue"></i></div></div>';
        reloadbutton = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><button class="btn btn-lg btn-danger" onclick="window.location=window.location;">Reload Page</button></div></div>';

    </script>



    <script>
	
	
	
	
	
		
	var cityMapping = {
  ChooseCountry:["City"],	
  UAE: ["Abu Dhabi", "Ajman", "Dubai","Fujairah","Sharjah","Umm Al Qaiwain"],
  SaudiArabia: ["Riyadh", "Jeddah", "Mecca","Al Madinah","Al-Ahsa","Ta'if","Dammam/Khobar","Buraidah","Tabuk"],
  Oman: ["Muscat", "Zufar"],
  Qatar: ["Doha"],
  Kuwait: ["Al Ahmadi", "Al Farwaniyah", "Al Jahra","Kuwait City","Hawally"],
  Bahrain: ["Manama"]
}	


var visaMapping = {
  ChooseCountry:["Visa"],
  UAE: ["Employment Visa", "Employment Visa - Cancelled", "Family Sponsorship Visa","Long Term Visit - 90days","Tourist Visa - 30days","Mission Visa"],
  SaudiArabia: ["Business Visa - 180 Days", "Employment Visa - Transferable", "Employment Visa - Non-Transferable","Family Sponsorship Visa"],
  Oman: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Qatar: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Kuwait: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"],
  Bahrain: ["Employment Visa", "Employment Visa - Cancelled","Family Sponsorship Visa","Long Term Visit - 90days","Visit- 30days","Business Visa"]
}		
	
	
	
	
	
	
	
	
	

var diction1 = {
  A1: ["B1", "B2", "B3"],
  A2: ["B4", "B5", "B6"]
}

var diction2 = {
  A1: ["B11", "B2", "B3"],
  A2: ["B44", "B5", "B6"]
}
// bind change event handler
$('#dropdown').change(function() {
  // get the second dropdown
  $('#B').html(
      // get array by the selected value
      cityMapping[this.value]
      // iterate  and generate options
      .map(function(v) {
        // generate options with the array element
        return $('<option/>', {
          value: v,
          text: v
        })
      })
    )
  
  $('#C').html(
      // get array by the selected value
      visaMapping[this.value]
      // iterate  and generate options
      .map(function(v) {
        // generate options with the array element
        return $('<option/>', {
          value: v,
          text: v
        })
      })
    )
    // trigger change event to generate second select tag initially
}).change()

	/*function fo1()
	 $('#select5').on('click change', function () {
                        if ($(this).val()) {
                            $.post('async/loadcountryrelateddata/' + $(this).val(), {_token: token}, function (data) {
                                $('#state_i').html(data.states);
                                $('#visa_id').html(data.visas);
                            }).fail(function () {
                                var notice = new PNotify({
                                    title: 'Error',
                                    text: 'We were unable to retrieve form data from our servers.',
                                    type: 'error',
                                    buttons: {
                                        closer: false,
                                        sticker: false
                                    }
                                });

                                notice.get().click(function () {
                                    notice.remove();
                                });
                            });
                        }
                    });
	}*/
	
/*function dropChange1() {
    $("#select1").change(function() {
        if ($(this).data('options') === undefined) {
          

            $(this).data('options', $('#select2 option').clone());
        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');

        $('#select2').html(options);
    });
}

function dropChange() {
    $("#select3").change(function() {
        if ($(this).data('options') === undefined) {
          
            $(this).data('options', $('#select1 option').clone());
			

        }
        var id = $(this).val();
        var options = $(this).data('options').filter('[value=' + id + ']');
         $('#select1').html(options);

    });
}
*/
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
function ch1() {


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
});

}
    </script>

    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script type="text/javascript">
    function shakeForm(e) {

        var x= $('#tags').val();
        var y= $('#B').val();
        var z= $('#C').val();
        var a= $('#exp').val();
        var b= $('#fun_area').val();
        if ((x==null || x=="") &&(y==null || y=="")&&(z==null || z=="")&&(a==null || a=="")&&(b==null || b==""))
        {
            $( "#shake" ).effect( "shake" );

            document.getElementById('tags').style.borderColor = "red";
            document.getElementById('select1').style.borderColor = "red";
            document.getElementById('select2').style.borderColor = "red";
            document.getElementById('exp').style.borderColor = "red";
            document.getElementById('fun_area').style.borderColor = "red";

            event.preventDefault();
        }

    }



</script>

    @if (!Auth::user())
        {!! Html::script('assets/js/jquery.validate.min.js') !!}

        <script type="text/javascript">

            function ajaxerrorclicktoclose (){
                var notice = new PNotify({
                    title: 'Error',
                    text: 'We were unable to retrieve data from our servers. Click here to try again.',
                    type : 'error',
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                });

                notice.get().click(function() {
                    notice.remove();
                    window.location = window.location;
                });
            }






            $('#login_form input[name="type"]').on("click", function (e) {
                if ($(this).val() == "user") {
                    $(this).attr("checked", true);
                    $('#login_form input[name="type"][value="employer"]').removeAttr("checked");
                }
                if ($(this).val() == "employer") {
                    $(this).attr("checked", true);
                    $('#login_form input[name="type"][value="user"]').removeAttr("checked");
                }
            });
            $('#login_form input[name="remember"]').on("click", function (e) {
                if ($(this).attr("checked")) {
                    $(this).removeAttr("checked");
                } else {
                    $(this).attr("checked", true);
                }

            });
            $("#login_form").validate({
                onkeyup: function(element) {$(element).valid()},
                errorPlacement: function(label, element) {
                    label.css('color','red');
                    label.appendTo('#'+element.attr('id')+'error');
                },
                rules:{
                    email: {
                        required:true,
                        email:true
                    },
                    password: {
                        required:true,
                    }
                },
                messages:{
                    email:{
                        required:"Please specify your Email ID",
                    },
                    password:{
                        required:"Please enter your Password",
                    }
                }
            });

            $('#login_form input[type="radio"][name="type"]').change(function () {
                if ("user" == this.value) {
                    $('#loginform-social').show();
                    $('#employee-signup').show();
                    $('#employer-signup').hide();
                } else {
                    $('#loginform-social').hide();
                    $('#employee-signup').hide();
                    $('#employer-signup').show();
                }
            });

            $('#forgot_password_form').validate({
                onkeyup: function(element) {$(element).valid()},
                errorPlacement: function(label, element) {
                    label.css('color','red');
                    label.insertBefore(element);
                },
                rules:{
                    email: {
                        required:true,
                        email:true
                    },
                },
                messages:{
                    email:{
                        required:"<span class='glyphicon glyphicon-exclamation-sign'></span>  Please provide your registered email to recover your account",
                        email:"<span class='glyphicon glyphicon-ban-circle'></span>  A valid email is required"
                    },
                }
            });
            $('#password').bind("cut copy paste",function(e) {
                e.preventDefault();
            });

            $('#login_form').submit(function (e) {
                e.preventDefault();
                $('#loginerrorfield').html('');
                var url = $(this).attr('action');
                var data = $(this).serialize();
                if($('#login_form').valid()){
                    $.post(url,$(this).serialize(),function (result){
                        // success logic
                        if(result.success){
                            window.location = result.redirect;
                        }else{
                            $('#loginerrorfield').html(result.errors);
                        }
                    }).fail(function (){
                        ajaxerrorclicktoclose();
                    });
                }
                return false;
            });

        </script>
    @endif
@show

<!--Handle Errors-->
@if (count($errors) > 0)
    @foreach($errors->all() as $error)
        <script type="text/javascript">
            var defaulterrornot = new PNotify({
                title: 'Error <i class="fa fa-hand-stop-o pull-right"></i>',
                text: '{{$error}}',
                type : 'error',
            });

            defaulterrornot.get().click(function() {
                defaulterrornot.remove();
            });
        </script>
    @endforeach
@endif
<!--Handle Error Ends-->

<!--Handle Success-->
@if(isset($success))
    @if (count($success) > 0)
        @foreach($success as $success)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-thumbs-o-up',
                    text: '{{$success}}',
                    type : 'success',
                });
            </script>
        @endforeach
    @endif
@endif
@if(null !== session('success'))
    @if (count(session('success')) > 0)
        @foreach(session('success') as $success)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-thumbs-o-up',
                    text: '{{$success}}',
                    type : 'success',
                });
            </script>
        @endforeach
    @endif
@endif
<!--Handle Success Ends-->

<!--Handle Warnings-->
@if(isset($warnings))
    @if (count($warnings) > 0)
        @foreach($warnings as $warning)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-flash',
                    text: '{{$warning}}',
                    type : 'warning',
                });
            </script>
        @endforeach
    @endif
@endif
@if(null !== session('warnings'))
    @if (count(session('warnings')) > 0)
        @foreach(session('warnings') as $warning)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-flash',
                    text: '{{$warning}}',
                    type : 'warning',
                });
            </script>
        @endforeach
    @endif
@endif
<!--Handle Warnings Ends-->

<!--Handle Info-->
@if(isset($info))
    @if (count($info) > 0)
        @foreach($info as $inf)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-tv',
                    text: '{{$inf}}',
                    type : 'info',
                });
            </script>
        @endforeach
    @endif
@endif
@if(null !== session('info'))
    @if (count(session('info')) > 0)
        @foreach(session('info') as $inf)
            <script type="text/javascript">
                new PNotify({
                    icon: 'fa fa-tv',
                    text: '{{$inf}}',
                    type : 'info',
                });
            </script>
        @endforeach
    @endif
@endif





<!--Handle Info Ends-->
</body>

</html>
