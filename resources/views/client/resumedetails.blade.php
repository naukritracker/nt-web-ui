@extends('templates.client.master')

@section('content')
    <section class="pad-t85 l-gray-box mar-b20">
        <div class="container">
            <div class="row hmar10">
                <div class="col-sm-2 pad-t20 hpad10">
                    @if (isset($user->userdetail->profile_image) and $user->userdetail->profile_image != '')
                        {!! Html::image('uploads/profile/'.$user->userdetail->profile_image, $user->name, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                    @else
                        {!! Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                    @endif
                </div>
                <div class="col-sm-3 hpad10">
                    <h4 class="title-blue pad-t10">
                        {{ $user->userdetail->first_name }} {{ $user->userdetail->last_name }}
                        @if(isset($user->userdetail->gender) and $user->userdetail->gender != '')
                            ({{ $user->userdetail->gender }})
                        @endif
                    </h4>
                    <p class="xs-title">
                        @if(isset($user->userdetail->profile_headline) and $user->userdetail->profile_headline != '')
                            {{ $user->userdetail->profile_headline }}
                        @else
                            No headline added
                        @endif
                    </p>
                    <p class="mar-b0 pad-t5">Profile Status</p>
                    <p class="xs-title">Unspecified</p>   
                    <!--<p class="v-success">Verified Profile</p>                             -->
                </div>  
                <div class="col-sm-3 lr-brd">                
                    <p class="mar-b0 pad-t20">Email Address</p>
                    <p class="xs-title">{{ $user->email }}</p>
                    @if(isset($user->userdetail->contact_no) and $user->userdetail->contact_no != '')
                        <p class="mar-b0 pad-t10">Contact Number</p>
                        <p class="xs-title">{{ $user->userdetail->contact_no }}</p>
                    @endif
                    <p class="mar-b0 pad-t10">Address</p>
                    @if(isset($user->userdetail->permanent_address) and $user->userdetail->permanent_address != '')
                        <p class="xs-title">{{ $user->userdetail->permanent_address }}</p>    
                    @else
                        <p class="xs-title">No address specified</p>    
                    @endif                              
                </div>  
                <div class="col-sm-4 pad-t20 emp-db-top-rhs">
                    <div class="green-box clearfix mar-t10">
                        <span class="upload-icon"></span> 
                        @if($user->userdetail->media and $user->userdetail->media->content != '')
                        <span href="#" class="pad-b5 pull-left sm-title">{{ $user->userdetail->media->content }}</span>
                        <p class="mar-b0">
                            <a href="{{ URL::to('uploads/resume/' . $user->userdetail->media->content) }}" class="white-title mar-r20" target="_blank">
                                Download
                            </a>
                        </p>
                        @else
                        <span href="#" class="pad-b5 pull-left sm-title">No Resume Uploaded</span>
                        @endif                   
                    </div>
                    <!--<button type="button" class="btn big-btn blue-btn">View Complete Profile</button>-->
                </div>                      
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row mar-b20">
            <div class="col-sm-3">
                <ul class="lhs-nav">
                    <li class="active"><a href="#" class="profile-sum-icon">Profile Summary</a></li>
                    <!--<li><a href="#" class="employment-dt-icon">Employment Details</a></li>
                    <li><a href="#" class="education-icon">Education</a></li>-->
                    <!--<li><a href="#" class="key-skills-icon">Key Skills</a></li>
                    <li><a href="#" class="lang-icon">Languages</a></li>
                    <li><a href="#" class="other-dt-icon">Other Details </a></li>-->
                </ul>
                <div class="clearfix pad-t20 mar-t30 mar-b30">
                    <div class="light-gray-box">
                        <p class="pad-b10">
                            Naukritracker is fastest and most effective to find candidates ready to start work within an hour.
                        </p>
                        <a href="{{ URL::route('ShowEmployerJobPosting') }}"><button class="btn big-btn blue-btn btn-block">Post a Job Now</button></a>
                    </div>
                </div>
                @include('client.partials.homeads')
            </div>
            <div class="col-sm-6">
                <div class="clearfix">
                    <p class="gray-text">No description field available at present</p>            
                    <hr>
                </div>
                <div class="clearfix">
                    @if(isset($user->experience))
                        <?php $expCount = 1; ?>
                        @foreach($user->experience as $exp)
                        <?php if ($expCount < 3) { ?>
                        <div class="clearfix">
                            <p class="mar-b0 primary-sm-title">{{ $exp->company->name }}</p>
                            <p class="mar-b5">
                                @if(isset($exp->company->industries))
                                   {{ $exp->company->industries->industry }}
                                @elseif(isset($exp->company->functionalareas))
                                    {{ $exp->company->industries->functionalareas->functional_area }}
                                @elseif(isset($exp->company->role) and $exp->company->role != '')
                                    {{ $exp->company->role }}
                                @else
                                    No speciality specified
                                @endif
                            </p>
                            <p class="xs-title">
                                @if(isset($exp->company->start_date) and $exp->company->start_date != '')
                                    {{ date('F d, Y', $exp->company->start_date) }} 
                                    @if(isset($exp->company->end_date) and $exp->company->end_date != '')
                                        - {{ date('F d, Y', $exp->company->end_date) }}
                                    @else
                                        - Not specified
                                    @endif
                                @else
                                    Duration not specified
                                @endif
                                 | 
                                @if(isset($exp->state))
                                    {{ $exp->state->state }}({{ $exp->state->country->country }})
                                @endif
                            </p>
                        </div>
                        <?php $expCount++; } else { break; } ?>
                        @endforeach
                    @endif
                    <hr>             
                </div>
                <div class="clearfix">
                    <div class="clearfix">
                        @if(isset($user->userdetail->other_institution) and $user->userdetail->other_institution != '')
                            <p class="mar-b0 primary-sm-title">{{ $user->userdetail->other_institution }}</p>
                            @if(isset($user->userdetail->other_type) and $user->userdetail->other_type != '')
                                <p class="mar-b5">{{ $user->userdetail->other_type }}</p>
                            @endif
                            @if(isset($user->userdetail->other_start_date) and $user->userdetail->other_start_date != ''
                                and isset($user->userdetail->other_end_date) and $user->userdetail->other_end_date != ''
                            )
                                <p class="xs-title">
                                    {{ date('F d, Y', $user->userdetail->other_start_date) }} - {{ date('F d, Y', $user->userdetail->other_end_date) }}
                                </p>
                            @endif
                        @else
                            No other education details available
                        @endif
                    </div>
                    <div class="clearfix pad-t15">
                        @if(isset($user->userdetail->pg_institution) and $user->userdetail->pg_institution != '')
                            <p class="mar-b0 primary-sm-title">{{ $user->userdetail->pg_institution }}</p>
                            @if(isset($user->userdetail->pg_type) and $user->userdetail->pg_type != '')
                                <p class="mar-b5">{{ $user->userdetail->pg_type }}</p>
                            @endif
                            @if(isset($user->userdetail->pg_start_date) and $user->userdetail->pg_start_date != ''
                                and isset($user->userdetail->pg_end_date) and $user->userdetail->pg_end_date != ''
                            )
                                <p class="xs-title">
                                    {{ date('F d, Y', $user->userdetail->pg_start_date) }} - {{ date('F d, Y', $user->userdetail->pg_end_date) }}
                                </p>
                            @endif
                        @elseif(isset($user->userdetail->ug_institution) and $user->userdetail->ug_institution != '')
                            <p class="mar-b0 primary-sm-title">{{ $user->userdetail->ug_institution }}</p>
                            @if(isset($user->userdetail->ug_type) and $user->userdetail->ug_type != '')
                                <p class="mar-b5">{{ $user->userdetail->ug_type }}</p>
                            @endif
                            @if(isset($user->userdetail->ug_start_date) and $user->userdetail->ug_start_date != ''
                                and isset($user->userdetail->ug_end_date) and $user->userdetail->ug_end_date != ''
                            )
                                <p class="xs-title">
                                    {{ date('F d, Y', $user->userdetail->ug_start_date) }} - {{ date('F d, Y', $user->userdetail->ug_end_date) }}
                                </p>
                            @endif
                        @elseif(isset($user->userdetail->hsse_institution) and $user->userdetail->hsse_institution != '')
                            <p class="mar-b0 primary-sm-title">{{ $user->userdetail->hsse_institution }}</p>
                            @if(isset($user->userdetail->hsse_type) and $user->userdetail->hsse_type != '')
                                <p class="mar-b5">{{ $user->userdetail->hsse_type }}</p>
                            @endif
                            @if(isset($user->userdetail->hsse_start_date) and $user->userdetail->hsse_start_date != ''
                                and isset($user->userdetail->hsse_end_date) and $user->userdetail->hsse_end_date != ''
                            )
                                <p class="xs-title">
                                    {{ date('F d, Y', $user->userdetail->hsse_start_date) }} - {{ date('F d, Y', $user->userdetail->hsse_end_date) }}
                                </p>
                            @endif
                        @elseif(isset($user->userdetail->sse_institution) and $user->userdetail->sse_institution != '')
                            <p class="mar-b0 primary-sm-title">{{ $user->userdetail->sse_institution }}</p>
                            @if(isset($user->userdetail->sse_type) and $user->userdetail->sse_type != '')
                                <p class="mar-b5">{{ $user->userdetail->sse_type }}</p>
                            @endif
                            @if(isset($user->userdetail->sse_start_date) and $user->userdetail->sse_start_date != ''
                                and isset($user->userdetail->sse_end_date) and $user->userdetail->sse_end_date != ''
                            )
                                <p class="xs-title">
                                    {{ date('F d, Y', $user->userdetail->sse_start_date) }} - {{ date('F d, Y', $user->userdetail->sse_end_date) }}
                                </p>
                            @endif
                        @else
                            No basic education details available
                        @endif
                    </div>
                    <hr>    
                    <div class="clearfix pad-t15">
                        @if(isset($user->userdetail->media))
                            @if($user->userdetail->media->content != "")
                                <p class="xs-title">Resume Details</p>
                                <div id="userResumeBox" style="height:480px;"></div>
                                <script>
                                    function highlight(text)
                                    {
                                        inputText = document.getElementById("userResumeBox");
                                        var innerHTML = inputText.innerHTML
                                        console.log(innerHTML);
                                        var index = innerHTML.indexOf(text);
                                        if ( index >= 0 )
                                        {
                                            innerHTML = innerHTML.substring(0,index)
                                                + "<span class='highlight'>"
                                                + innerHTML.substring(index,index+text.length)
                                                + "</span>"
                                                + innerHTML.substring(index + text.length);
                                            inputText.innerHTML = innerHTML
                                        }

                                    }
                                    var source = '{{ URL::asset('uploads/resume/'.$user->userdetail->media->content) }}';
//                                    document.getElementById('userResumeBox').innerHTML =
//                                        '<object height="100%" width="100%" data="'+source+'#toolbar=0" type="application/pdf">'
//                                        +'<iframe width="100%" height="100%" src="'+source+'#toolbar=0">'
//                                        + 'This browser does not support PDFs. Please download the PDF to view it: '
//                                        + '<a href="'+source+'#toolbar=0">Download PDF</a></iframe></object>';
                                    document.getElementById('userResumeBox').innerHTML =
                                        '<object height="100%" width="100%" data=\''+source+'#toolbar=0&search=\"{{$search_value}}\"\' type="application/pdf">'
                                        +'<embed width="100%" height="100%" src=\''+source+'#toolbar=0&search=\"{{$search_value}}\"\'></object>';
                                </script>
                            @endif
                        @endif
                    </div>         
                </div>               
            </div>
            
            <div class="col-sm-3">
                <ul class="l-jobs r-jobs">
                    <li>
                        <p class="mar-b0">Industry</p>
                        @if(isset($user->userdetail->industries))
                            <p class="primary-sm-title">{{ $user->userdetail->industries->industry }}</p>
                        @else
                            <p class="primary-sm-title">No industry specified</p>
                        @endif
                    </li>  
                    <li>
                        <p class="mar-b0">Functional Area</p>
                        @if(isset($user->userdetail->functionalareas))
                            <p class="primary-sm-title">{{ $user->userdetail->functionalareas->functional_area }}</p>
                        @else
                            <p class="primary-sm-title">No functional area specified</p>
                        @endif
                    </li> 
                    <li>
                        <p class="mar-b0">Preferred Location</p>
                        @if(isset($user->userdetail->preferredlocation))
                            <p class="primary-sm-title">{{ $user->userdetail->preferredlocation->state }}</p>
                        @else
                            <p class="primary-sm-title">No preferred area specified</p>
                        @endif
                    </li>                               
                </ul>
                <h4 class="title-blue pad-t10">Personal Details</h4>                                
                <ul class="l-jobs r-jobs">
                    <li>
                        <p class="mar-b0">Date of Birth</p>
                        <p class="primary-sm-title">
                            @if(isset($user->userdetail->dob_day) and $user->userdetail->dob_day != ''
                                and isset($user->userdetail->dob_month) and $user->userdetail->dob_month != ''
                                and isset($user->userdetail->dob_year) and $user->userdetail->dob_year != ''
                            )
                                {{ date('F', $user->userdetail->dob_month) }} {{ date('d', $user->userdetail->dob_day) }}, 
                                {{ date('Y', $user->userdetail->dob_year) }}
                            @else
                                No DOB specified
                            @endif
                        </p>
                    </li> 
                    <li>
                        <p class="mar-b0">Age</p>
                        <p class="primary-sm-title">
                            @if(isset($user->userdetail->dob_day) and $user->userdetail->dob_day != ''
                                and isset($user->userdetail->dob_month) and $user->userdetail->dob_month != ''
                                and isset($user->userdetail->dob_year) and $user->userdetail->dob_year != ''
                            )
                                {{ date_diff(
                                    date_create(''.$user->userdetail->dob_year.'-'.$user->userdetail->dob_month.'-'.$user->userdetail->dob_day.''), 
                                    date_create('today')
                                )->y }}
                            @else
                                No age specified
                            @endif
                        </p>
                    </li> 
                    <li>
                        <p class="mar-b0">Marital Status</p>
                        <p class="primary-sm-title">
                            @if(isset($user->userdetail->marital_status) and $user->userdetail->marital_status != '')
                                {{ $user->userdetail->marital_status }}
                            @else
                                Not specified
                            @endif
                        </p>
                    </li>                                                               
                </ul>
                <div class="clearfix pad-t20 mar-t30 mar-b30">
                    <div class="light-gray-box">
                        <p class="pad-b10">Find Profiles matching 
        your requiremnts</p>
                        <a href="{{ URL::route('ResumeSearch') }}"><button class="btn big-btn green-btn btn-block">Search Profiles</button></a>
                    </div>
                </div>               
            </div>                 
        </div>
    </div>
@stop

@section('js')
@parent
<script type="text/javascript">
	function engageOverhang() {
	    $('.overhang').fadeIn(100).show();

	    $('.close-overhang').on('click',function(e){
		$('.overhang').fadeOut(500).hide();
	    });
	}
</script>
@stop
