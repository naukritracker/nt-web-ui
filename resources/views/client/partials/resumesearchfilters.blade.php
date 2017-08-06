<div class="employer-search-block">
    {!! Form::open(array('route' => 'ResumeSearch')) !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Search</label>
                <div class="col-xs-12 pad-b10">
                    <label class="Form-label--tick">
                        <input type="radio" value="1" name="type" class="Form-label-radio" @if($type) checked @endif>
                        <span class="Form-label-text">Single Term</span>
                    </label>
                    <label class="Form-label--tick">
                        <input type="radio" value="0" name="type" class="Form-label-radio" @if(!$type) checked @endif>
                        <span class="Form-label-text">Individual Terms</span>
                    </label>
                </div>
                <input type="text" name="search" class="form-control" placeholder="Search using keywords..." value="{{ $search }}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Industry &amp; Skills</label>
                <select name="industry[]" id="industry" class="form-control">
                    <option value="">Select</option>
                    @foreach ($users as $user)
                        @if ($user->industries)
                            <option
                                    value="{{ $user->industries->id }}"
                                    @if($industry[0] == $user->industries->id) selected = "selected" @endif
                            >
                                {{ $user->industries->industry }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Location</label>
                <select name="location[]" id="location" class="form-control">
                    <option value="">Select</option>
                    @foreach ($users as $user)
                        @if ($user->currentlocation)
                            <option
                                    value="{{ $user->currentlocation->id }}"
                                    @if($location[0] == $user->currentlocation->id) selected = "selected" @endif
                            >
                                {{ $user->currentlocation->state }}({{  $user->preferredlocation->country->country }})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Functional Area</label>
                <select name="functional_area[]" id="functional_area" class="form-control">
                    <option value="">Select</option>
                    @foreach ($users as $user)
                        @if ($user->functionalareas)
                            <option
                                    value="{{ $user->functionalareas->id }}"
                                    @if($functional_area[0] == $user->functionalareas->id) selected = "selected" @endif
                            >
                                {{ $user->functionalareas->functional_area }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Preferred Location</label>
                <select name="preferred_location" id="preferred_location" class="form-control">
                    <option value="">Select</option>
                    @foreach ($users as $user)
                        @if ($user->preferredlocation)
                            <option
                                    value="{{ $user->preferredlocation->id }}"
                                    @if($preferred_location == $user->preferredlocation->id) selected = "selected" @endif
                            >
                                {{ $user->preferredlocation->state }}({{  $user->preferredlocation->country->country }})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 mar-t25">
            <button type="button" class="btn btn-block btn-inverse" data-toggle="modal" data-target="#searchFilterModal">More Options +</button>
        </div>
        <div class="col-sm-4 mar-t25">
            <button type="submit" class="btn btn-primary btn-block">Search</button>
        </div>
    </div>
    <!-- Search Filter Modal -->
    <div class="modal fade" id="searchFilterModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Search Filters</h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Industry &amp; Skills</label>
                                <select name="industry[]" id="industry1" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->industries)
                                            <option value="{{ $user->industries->id }}">
                                                {{ $user->industries->industry }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Location</label>
                                <select name="location[]" id="location1" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->currentlocation)
                                            <option value="{{ $user->currentlocation->id }}">
                                                {{ $user->currentlocation->state }}({{  $user->preferredlocation->country->country }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Functional Area</label>
                                <select name="functional_area[]" id="functional_area1" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->functionalareas)
                                            <option value="{{ $user->functionalareas->id }}">
                                                {{ $user->functionalareas->functional_area }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Industry &amp; Skills</label>
                                <select name="industry[]" id="industry2" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->industries)
                                            <option value="{{ $user->industries->id }}">
                                                {{ $user->industries->industry }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Location</label>
                                <select name="location[]" id="location2" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->currentlocation)
                                            <option value="{{ $user->currentlocation->id }}">
                                                {{ $user->currentlocation->state }}({{  $user->preferredlocation->country->country }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Functional Area</label>
                                <select name="functional_area[]" id="functional_area2" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->functionalareas)
                                            <option value="{{ $user->functionalareas->id }}">
                                                {{ $user->functionalareas->functional_area }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Industry &amp; Skills</label>
                                <select name="industry[]" id="industry3" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->industries)
                                            <option value="{{ $user->industries->id }}">
                                                {{ $user->industries->industry }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Location</label>
                                <select name="location[]" id="location3" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->currentlocation)
                                            <option value="{{ $user->currentlocation->id }}">
                                                {{ $user->currentlocation->state }}({{  $user->preferredlocation->country->country }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Work Type</label>
                                <select name="functional_area[]" id="functional_area3" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($users as $user)
                                        @if ($user->functionalareas)
                                            <option value="{{ $user->functionalareas->id }}">
                                                {{ $user->functionalareas->functional_area }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-4 mar-t25">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::token() !!}
    {!! Form::close() !!}
</div>