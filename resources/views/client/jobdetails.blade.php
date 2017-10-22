@extends('templates.client.master')

@section('meta')
    @parent
    <meta name="keywords" content="Naukri Tracker - Job search :: {{$data['job']->title}} ({{$data['job']->short_description}})">
    <meta name="description" content="Naukri Tracker, Located in {{$data['job']->state->state}} ({{$data['job']->country->country}}), {{$data['job']->description}}, Job search results for your dream job">
    <meta name="robots" content="index/nofollow">
@stop

@section('content')
    <div class="container">


        <div class="row mar-t100">

            <div class="col-sm-8 mar-b20">

                <div class="page-header">
                    <h3 class="m-title b-title">{{$data['job']->title}}</h3>
                    <small>{{$data['job']->short_description}}</small>
                </div>

                @if($data['job']->description != '')
                    <div class="container">
                        {!! html_entity_decode($data['job']->description) !!}
                    </div>
                @endif
                @if($data['job']->requirements != '')
                    <div class="container">
                        <div>
                        <h5><b>Requirements :</b></h5>
                        <span class="pad-t20"><small>{!! html_entity_decode($data['job']->requirements) !!}</small></span>
                        </div>
                        <div class="panel panel-default col-sm-2 col-xs-12 col-md-offset-5">
                            <div class="panel-body">
                                <h5 >Job Views:<b>{{$data['job']->no_of_views}}</b></h5>
                                <h5 >Job Applicants:<b>{{$data['job']->no_of_applicants}}</b></h5>
                            </div>
                        </div>
                    </div>
                @endif




            <!-- @if(Auth::user())
                    @if($data['job']->apply != '')
                    <div class="row clearfix pad-t20">
                        <p class="text-center"><a href="{{$data['job']->apply}}" target="_blank" class="btn btn-md btn-info">Apply Now</a></p>
              </div>
              @endif
                @endif -->


                <p>
                    <div class="panel panel-info">
                        <!-- Default panel contents -->

                        <div class="panel-heading text-center" id="less" ><a href="javascript:void(0)" data-toggle="collapse" data-target="#details-table">View all details </a></div>

                        <div class="panel-body collapse" id="details-table">
                            <!-- Table -->
                            <table class="table" id="details-table" class="collapse">
                                <tbody>

                                @if($data['job']->company_id != 0)
                                    <tr>
                                        <td><b>Employer</b></td>
                                        <td>{{$data['job']->company->name}} ({{$data['job']->company->state->state}} - {{$data['job']->company->country->country}})</td>
                                    </tr>
                                @endif

                                @if($data['job']->role != NULL)
                                    <tr>
                                        <td><b>Job Role</b></td>
                                        <td>{{$data['job']->role}}</td>
                                    </tr>
                                @endif

                                @if($data['job']->open_positions != 0)
                                    <tr>
                                        <td><b>Open Positions</b></td>
                                        <td>{{$data['job']->open_positions}}</td>
                                    </tr>
                                @endif

                                @if($data['job']->minimum_education != '')
                                    <tr>
                                        <td><b>Minimum Education</b></td>
                                        <td>{{$data['job']->getReadableQualification($data['job']->minimum_education)}}</td>
                                    </tr>
                                @endif

                                @if($data['job']->minimum_experience != 0)
                                    <tr>
                                        <td><b>Minimum Experience</b></td>
                                        <td>{{$data['job']->minimum_experience}}+ @if($data['job']->minimum_experience > 1) years @else year @endif</td>
                                    </tr>
                                @endif

                                <!--@if($data['job']->preferred_nationality != '')
                                    <tr>
                                        <td><b>Preferred Nationality</b></td>
                                        <td>
                                            @foreach(explode("||",$data['job']->preferred_nationality) as $nationality)
                                                @if($nationality)
                                                    {{$data['job']->getCountryName($nationality)}},
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif-->


                                @if($data['job']->salary_range_start != 0 || $data['job']->salary_range_end != 0)
                                    <tr>
                                        <td><b>Salary Offered</b></td>
                                        <td>
                                            @if($data['job']->salary_range_start != 0)
                                                {{$data['job']->salary_range_start}}
                                            @endif
                                            @if($data['job']->salary_range_end != 0)
                                                - {{$data['job']->salary_range_end}}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if($data['job']->job_locations != '' && $data['job']->job_locations != 0)
                                    <tr>
                                        <td><b>Job Locations</b></td>
                                        <td>
                                            @foreach(explode("||",$data['job']->job_locations) as $loc)
                                                @if($loc)
                                                    {{$data['job']->getCountryName($loc)}},
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                @if($data['job']->state_id != 0 || $data['job']->country_id != 0)
                                    <tr>
                                        <td><b>Job Posting Location</b></td>
                                        <td>
                                            @if($data['job']->state_id != 0)
                                                {{$data['job']->state->state}} /
                                            @endif

                                            @if($data['job']->country_id != 0)
                                                {{$data['job']->country->country}}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if($data['job']->visa != '' && $data['job']->visa != 0)
                                    <tr>
                                        <td><b>Visa Type Preferred</b></td>
                                        <td>
                                            @foreach(explode("||",$data['job']->visa) as $visa)
                                                @if($visa)
                                                    {{$data['job']->getVisaName($visa)}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                @if($data['job']->job_type != '')
                                    <tr>
                                        <td><b>Job Type</b></td>
                                        <td>{{$data['job']->getReadableJobType($data['job']->job_type)}}</td>
                                    </tr>
                                @endif

                                @if($data['job']->employment_type != '')
                                    <tr>
                                        <td><b>Employment Type</b></td>
                                        <td>{{$data['job']->getReadableEmploymentType($data['job']->employment_type)}}</td>
                                    </tr>
                                @endif

                                @if($data['job']->gender_type != '')
                                    <tr>
                                        <td><b>Gender</b></td>
                                        <td>{{$data['job']->getReadableGenderType($data['job']->gender_type)}}</td>
                                    </tr>
                                @endif


                                @if($data['job']->industry != '')
                                    <tr>
                                        <td><b>Industry</b></td>
                                        <td>{{$data['job']->industry}}</td>
                                    </tr>
                                @endif

                                <!-- @if($data['job']->apply != '')
                                    <tr>
                                        <td><b>Application Type</b></td>
                                        <td>Link - <a href="{{$data['job']->apply}}" target="_blank">{{$data['job']->apply}}</a></td>
                                </tr>
                                @endif -->

                                @if($data['job']->walkin != 0)
                                    <tr>
                                        <td><b>Application Type</b></td>
                                        <td>Walk In</td>
                                    </tr>
                                @endif



                                @if($data['job']->updated_at)
                                    <tr>
                                        <td><b>Job Posted </b></td>
                                        <td>{{$data['job']->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>

                                </tbody>
                            </table>


                            <!-- <button onclick="buttonClick();">Click Me</button>
                             <input type="text" name="viewsp" id="inc" value="0"></input>-->




                @if($data['job']->apply)
                    <p class="text-center">
                    <form method="POST" action="" id="job_details_form"  >
                        {{ csrf_field() }}
                        @if (Auth::user())

                                {!! Form::hidden('sp', 1, ['class'=>'form-control','required','id'=>'inc']) !!}
                            <button  style="background-color:#334ea2; width:90%;" class="btn btn-md btn-info"  type="submit" >Apply Now</button>

                        @else

                            <a style="background-color:#334ea2; width:90%;" href="javascript:void(0)" onclick="engageOverhang()" data-toggle="modal" data-target="#login-popup" class="btn btn-md btn-info" >Apply Now</a>
                        @endif
                    </form>
                    </p>
                @endif


                <div class="container pad-t40" style="padding-left:37%">
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_default_style">
                        <!-- <span class="a2a_divider"></span> -->
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_google_plus"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_linkedin"></a>
                    </div>
                    <script type="text/javascript">
                        var a2a_config = a2a_config || {};
                        a2a_config.linkname = "{{$data['job']->title}} :\n{{$data['job']->short_description}}\n";
                        a2a_config.linkurl = "{!!Request::url()!!}";
                        a2a_config.color_main = "D7E5ED";
                        a2a_config.color_border = "AECADB";
                        a2a_config.color_link_text = "333333";
                        a2a_config.color_link_text_hover = "333333";
                    </script>
                    <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                    <!-- AddToAny END -->
                </div>
            </div>
        </div>
        </p>
    </div>

    <div class="col-sm-4 mar-b30">
    <!-- @include('client.partials.subscribetonewsletter') -->
    <!-- @include('client.partials.homeads') -->
    </div>
    </div>
    </div>

@stop

@section('js')
    @parent
    <script type="text/javascript">


        $('#less').click(function() {
            jQuery(this).text('Hide details');
            if($('#details-table').is(':visible')){
                jQuery(this).text('View all details');
            }else{
                jQuery(this).text('Hide details');
            }
            $('#details-table').slideToggle('fast');
            return false;
        });

        function engageOverhang() {
            $('.overhang').fadeIn(100).show();

            $('.close-overhang').on('click',function(e){
                $('.overhang').fadeOut(500).hide();
            });
        }



        /*$('#job_details_form').submit(function (e) {
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function (data){
                window.location.reload(true);
            })
        });*/




        $('#job_details_form').submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(){
                        alert("success");
                    },

                    error: function(data){
                        var newWindow = window.open("","_blank");
                        newWindow.location.href = "{{$data['job']->apply}}";
                    }
                });

        });



    </script>
@stop
