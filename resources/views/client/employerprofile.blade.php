@extends('templates.client.master')

@section('content')
    <section class="pad-t85 l-gray-box mar-b20">
        <div class="container">
            <div class="row hmar10">
                <div class="col-sm-2 pad-t20 hpad10">
                  <!--  <a href="javascript:void(0)" id="employer-photo">
                    @if (isset(Auth::user("employer")->details->profile_image) and Auth::user("employer")->details->profile_image != '')
                        {!! Html::image('uploads/profile/'.Auth::user("employer")->details->profile_image, Auth::user("employer")->name, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                    @else
                        {!! Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                    @endif
                    </a>-->
                    {!! Form::open(array('route' => 'SaveEmployerPhoto', 'id' => 'employer-photo-form','enctype' => 'multipart/form-data')) !!}
                    <div style="visibility:hidden">
                        {!! Form::file('employerPhoto', array('id' => 'employer-photo-input')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-3 hpad10">
                    <h3 class="title-blue">
                        {!! Auth::user("employer")->employer->name !!}
                    </h3>
                    <p class="mar-b0 pad-t10">Address</p>
                    @if (isset(Auth::user("employer")->employer->address)
                        and Auth::user("employer")->employer->address != "")

                        <p class="xs-title">
                            {!! Auth::user("employer")->employer->address !!}
                        </p>
                        @else
                        <p class="xs-title">
                        NO Address Specified
                        </p>
                    @endif
                </div>
                <div class="col-sm-3 lr-brd">
                    <h3 class="title-blue">Company Details</h3>
                    <p class="mar-b0 pad-t10">Email Address</p>
                    <p class="xs-title">
                        {!! Auth::user("employer")->employer->email !!}
                    </p>
                    @if(isset(Auth::user("employer")->employer->phone))
                        <p class="mar-b0 pad-t10">Contact Number</p>
                        <p class="xs-title">
                            {!! Auth::user("employer")->employer->phone !!}
                        </p>
                    @endif
                </div>
                <div class="col-sm-4 pad-t20 emp-db-top-rhs">
                    <button type="button" id="post-a-job" class="btn big-btn blue-btn">Post a Job Now</button>
                    <button type="button" id="search-for-resumes" class="btn big-btn green-btn">Search Resumes</button>

                </div>

            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mar-b20">
            <div class="col-sm-3">
                @include('client.partials.employerprofilenavigation')
            </div>
            <div class="col-sm-9">
                <h3 class="m-title b-title">
                    Applied Profiles
                    @if(count(Auth::user('employer')->jobs))
                        -  <a href="{{ URL::route('EmployerViewAllApplicants') }}" class="viewall-btn">View All</a> 
                    @endif
                </h3>
                <div class="row">
                    @if(count(Auth::user('employer')->jobs))
                        <?php $applicantCount = 1; ?>
                        @foreach(Auth::user('employer')->jobs as $job)
                        <?php if ($applicantCount < 10) { ?>
                            <div class="col-sm-4">
                                <div class="profile-card">
                                    <h4><a href="#">{{ $job->user_id }}</a></h4>
                                    @if(isset($job->user->userdetail->role) and $job->user->userdetail->role != '')
                                    <p>{{ $job->user->userdetail->role }}</p>
                                    @endif
                                    <a href="{{URL::route('ShowResumeDetails',[$job->id])}}">
                                        <button type="button" class="btn view-profile-btn">View Profile</button>
                                    </a>
                                </div>
                            </div>
                        <?php $applicantCount++; } else { break; } ?>
                        @endforeach
                    @else
                        <div class="col-sm-12">
                            No applicant(s) available yet
                        </div>
                    @endif
                </div>

                <h3 class="m-title b-title">
                    Job Postings
                    @if(count(Auth::user('employer')->jobs))<a href="{{ URL::route('EmployerViewAllPostedJobs') }}" class="viewall-btn">View All</a>@endif
                </h3>
                <div class="table-responsive mar-t20">
                    @if(count(Auth::user('employer')->jobs))
                    <?php $jobCount = 1; ?>
                    <table class="table nt-db-table">
                        <thead>
                        <tr>
                            <th>Job</th>
                            <th class="text-center">Views</th>
                            <th class="text-center">Candidates Applied</th>
                           <!-- <th>Match Candidates</th>-->
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user('employer')->jobs as $job)
                        <?php if ($jobCount < 10) { ?>
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td class="text-center">{{ $job->no_of_views}}</td>
                            <td class="text-center">{{ $job->no_of_applicants }}</td>
                          <!--  <td>@if(count($job->applications)) <a href="#">View Applicants</a>@else No Views @endif</td> -->
                            <td>
                                <a href="{{ URL::route('ShowEmployerJobPosting') }}?edit={{ $job->id }}">Edit</a> /
                                <a href="{{ URL::route('ShowEmployerJobPosting') }}?copy={{ $job->id }}">Copy</a> /
                                <a href="{{ URL::route('DeleteEmployerJobPosting',[$job->id]) }}">Delete</a>
                            </td>
                        </tr>
                        <?php $jobCount++; } else { break; } ?>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        No Jobs posted yet. Post one <a href="{{URL::route('ShowEmployerJobPosting')}}">now</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {




                    $('#togg').hide();
            $('#togg2').hide();


            $('#search-for-resumes').click(function (clickEvent) {
                window.location = "{{URL::route('ResumeSearch')}}";
            });
            $('#post-a-job').click(function (clickEvent) {
                window.location = "{{URL::route('ShowEmployerJobPosting')}}";
            });
            $('#employer-photo').click(function (clickEvent) {
                clickEvent.preventDefault();
                $('#employer-photo-input').trigger('click');
                return false;
            });
            $('#employer-photo-input').change(function (changeEvent) {
                $('#employer-photo-form').trigger('submit');
            });
            $('#employer-photo-form').submit(function (submitEvent) {
                submitEvent.preventDefault();
                var target = $(this).attr('action');
                var formData = new FormData();
                formData.append('employerPhoto', $('#employer-photo-input')[0].files[0]);
                formData.append('_token', token);
                $.ajax({
                    url: target,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                        if (data) {
                            $('#profile_image').attr('src', data);
                        } else {
                            new PNotify({
                                icon: 'fa fa-hand-stop-o pull-right',
                                text: 'Failed to save profile photo ! Please try again',
                                type : 'error'
                            });
                        }
                    },
                    error: function (err) {
                        new PNotify({
                            icon: 'fa fa-hand-stop-o pull-right',
                            text: 'Failed to upload profile photo ! Please try again',
                            type : 'error'
                        });
                    }
                });
                return false;
            });
        });
    </script>
@stop
