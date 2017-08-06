@extends('templates.client.master')

@section('content')
    <div class="container">
        <div class="row mar-b20 pad-t85 mar-t20">
            <div class="col-sm-3">
                @include('client.partials.employerprofilenavigation')
            </div>
            <div class="col-sm-9">
                @include('client.partials.resumesearchfilters')
                <div class="clearfix mar-t20">
                    <div class="row">
                        <div class="col-sm-6">

                            @if(isset($search_keywords) and !empty($search_keywords))
                            <p class="mar-b0">
                                <?php $keywords = '<strong>' . implode('</strong>, <strong>', $search_keywords) . '</strong>'; ?>
                                Searched for Keywords:
                                {!! $keywords !!}
                            </p>
                                <h4 class="sm-title mar-t10 mar-b15">

                                    {{ $candidateCount }} <strong>@if($candidateCount > 1) Resumes @else Resume @endif</strong> found
                                </h4>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="navbar-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        Save Search
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Saved Searches <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        Modify this Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @foreach($candidates as $candidate)
                <?php //var_export($candidate);exit;?>
                <div class="search-profile">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="media">
                                <div class="media-left">
                                    @if (isset($candidate->userdetail->profile_image) and $candidate->userdetail->profile_image != '')
                                        {!! Html::image('uploads/profile/'.$candidate->userdetail->profile_image, $candidate->name, ['class'=>'img-responsive', 'height' => '75px', 'width' => '75px']) !!}
                                    @else
                                        {!! Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive', 'height' => '75px', 'width' => '75px']) !!}
                                    @endif
                                    {{--<a href="#">--}}
                                        {{--<img class="media-object" src="img/userpic_large.png" alt="...">--}}
                                    {{--</a>--}}
                                </div>
                                <div class="media-body">
                                    <p class="pad-t5">
                                       <!-- <a href="#" class="primary-sm-title">-->
                                            {{ $candidate->name }}
                                            @if(isset($candidate->userdetail->profile_headline) and $candidate->userdetail->profile_headline != "")
                                                - {{ $candidate->userdetail->profile_headline }}
                                            @endif
                                       <!-- </a> -->
                                        <span class="v-success mar-l10" title="Profile Verified"></span>
                                    </p>
                                    <p class="xs-title last-serach">
                                        <span>Last Modifed: {{ $candidate->userdetail->getHumanUpdatedAtAttribute() }}</span>
                                        <span>Last Active: {{ $candidate->getHumanUpdatedAtAttribute() }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{URL::route('ShowResumeDetails',[$candidate->id])}}" class="btn btn-default view-profile">View Complete Profile</a>
                        </div>
                    </div>

                    @if($candidate->userdetail->currentlocation
                        or $candidate->userdetail->state
                        or $candidate->userdetail->preferredlocation
                    )
                    <hr>
                    <div class="row">
                        @if(isset($candidate->userdetail->currentlocation))
                        <div class="col-sm-4">
                            <p class="mar-b0">Location</p>
                            <p class="mar-b0 primary-sm-title">
                                {{ $candidate->userdetail->currentlocation->state  }}
                                ({{ $candidate->userdetail->currentlocation->country->country  }})
                            </p>
                        </div>
                        @endif
                        @if(isset($candidate->userdetail->state))
                        <div class="col-sm-4">
                            <p class="mar-b0">Nationality</p>
                            <p class="mar-b0 primary-sm-title">{{ $candidate->userdetail->state->country->country }}</p>
                        </div>
                        @endif
                        @if(isset($candidate->userdetail->preferredlocation))
                        <div class="col-sm-4">
                            <p class="mar-b0">Preferred Work Location</p>
                            <p class="mar-b0 primary-sm-title">
                                {{ $candidate->userdetail->preferredlocation->state }}
                                ({{ $candidate->userdetail->preferredlocation->country->country }})
                            </p>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($candidate->experience
                        and count($candidate->experience)
                        and ((isset($candidate->other_institution)
                            and isset($candidate->other_marks)) or
                            (isset($candidate->pg_institution)
                            and isset($candidate->pg_marks)) or
                            (isset($candidate->ug_institution)
                            and isset($candidate->ug_marks)) or
                            (isset($candidate->hsse_institution)
                            and isset($candidate->hsse_marks)) or
                            (isset($candidate->sse_institution)
                            and isset($candidate->sse_marks)))
                    )
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mar-b5">Experience</p>
                            @foreach($candidate->experience as $experience)
                            <div class="clearfix">
                                <p class="mar-b0 primary-sm-title">{{ $experience->company->name }}</p>
                                <p class="xs-title">
                                    @if(isset($candidate->funcationalrole))
                                    Web/Graphic Designer |
                                    @endif
                                    {{ \Carbon::parse($candidate->start_date)->diffInDays(\Carbon::parse($candidate->end_date)) }}
                            </div>
                            @endforeach
                        </div>
                        <div class="col-sm-4">
                            <p class="mar-b5">Industry Domain</p>
                            <div class="clearfix">
                                @foreach($candidate->experience as $experience)
                                    @if(isset($experience->industries))
                                    <p class="primary-sm-title">
                                        {{ $experience->industries->industry }}
                                    </p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @if((isset($candidate->other_institution)
                            and isset($candidate->other_marks)) or
                            (isset($candidate->pg_institution)
                            and isset($candidate->pg_marks)) or
                            (isset($candidate->ug_institution)
                            and isset($candidate->ug_marks)) or
                            (isset($candidate->hsse_institution)
                            and isset($candidate->hsse_marks)) or
                            (isset($candidate->sse_institution)
                            and isset($candidate->sse_marks))
                        )
                        <div class="col-sm-4">
                            <p class="mar-b5">Education</p>
                            @if(isset($candidate->other_institution) and isset($candidate->other_marks))
                            <div class="clearfix">
                                <p class="mar-b0 primary-sm-title">{{ $candidate->other_institution }}</p>
                                <p class="xs-title">Additional</p>
                            </div>
                            @endif
                            @if(isset($candidate->pg_institution) and isset($candidate->pg_marks))
                            <div class="clearfix">
                                <p class="mar-b0 primary-sm-title">{{ $candidate->pg_institution }}</p>
                                <p class="xs-title">Master's Degree</p>
                            </div>
                            @endif
                            @if(isset($candidate->ug_institution) and isset($candidate->ug_marks))
                            <div class="clearfix">
                                <p class="mar-b0 primary-sm-title">{{ $candidate->ug_institution }}</p>
                                <p class="xs-title">Bachelor's Degree</p>
                            </div>
                            @endif
                            @if((isset($candidate->hsse_institution)
                                and isset($candidate->hsse_marks)) or
                                (isset($candidate->sse_institution)
                                and isset($candidate->sse_marks))
                            )
                            <div class="clearfix">
                                @if(isset($candidate->hsse_institution)
                                    and isset($candidate->hsse_marks))
                                <p class="mar-b0 primary-sm-title">{{ $candidate->hsse_institution }}</p>
                                @endif
                                @if(isset($candidate->sse_institution)
                                    and isset($candidate->sse_marks))
                                <p class="mar-b0 primary-sm-title">{{ $candidate->sse_institution }}</p>
                                @endif
                                <p class="xs-title">School(s)</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($candidate->experience)
                    <hr>
                    <p class="mar-b0">Skills</p>
                    <ul class="nt-tags clearfix pad-t10">
                        @foreach($candidate->experience as $experience)
                            @if(isset($experience) and $experience->role != '') <li>{{ $experience->role }}</li> @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>
@stop

@section('js')
    @parent
@stop
