
<div class="clearfix">
    <div class="row">
        {!! Form::open(["class"=>"row pad-t10 pad-b10", "id"=> "profile_form", "route" => "SaveProfile", "files"=>"true"]) !!}

        <div class="clearfix">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="profile_headline">Profile Headline </label>
                    {!! Form::text('profile_headline', $userdetail->profile_headline, ['class'=>'form-control','placeholder'=>'Enter a profile headline']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-3">

            @if (isset(Auth::user()->userdetail->profile_image) and Auth::user()->userdetail->profile_image != '')

                @if (file_exists(public_path().'/uploads/profile/'.Auth::user()->userdetail->profile_image))
                    {!! Html::image('uploads/profile/'.Auth::user()->userdetail->profile_image, Auth::user()->name, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                @else
                    {!! Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']) !!}
                @endif
            @else

                {!! Html::image('assets/img/userpic_large.png', null, ['class'=>'img-responsive','id'=>'profile_image']) !!}
            @endif
            <a href="javascript:void(0)" id="load_image">Upload</a>
            <input type="file" name="load_image_field" id="load_image_field" style="display:none">
            <a href="#" id="remove" onclick="foo()">Remove</a>




        </div>

        <div class="col-sm-9">
            <div class="form-group">
                <label for="first_name">First Name <span class="error-text">*</span></label>
                {!! Form::text('first_name', $userdetail->first_name,['class'=>'form-control', 'placeholder'=>'Enter your first name', 'required', 'minlength'=>'3', 'maxlength'=>'50']) !!}
            </div>
            <div class="form-group">
                <label for="last_name">Last Name <span class="error-text">*</span></label>
                {!! Form::text('last_name', $userdetail->last_name,['class'=>'form-control', 'placeholder'=>'Enter your last name', 'required', 'minlength'=>'3', 'maxlength'=>'50']) !!}
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Email Address <span class="error-text">*</span></label>
                    {!! Form::email('email', Auth::user()->email, ['class'=>'form-control', 'placeholder'=>'Enter your email', 'required']) !!}
                </div>
            </div>
            <div class="col-sm-6">

                <label for="">Contact Number <span class="error-text">*</span></label>
                <div class="form-group">
                    <div class="col-xs-5">
                        {!! Form::text('country_code', $userdetail->country_code, ['class'=>'form-control', 'placeholder'=>'+00', 'required']) !!}
                    </div>
                    <div class="col-xs-7">
                        {!! Form::text('contact_no', $userdetail->contact_no, ['class'=>'form-control', 'placeholder'=>'0000000', 'required']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    {!! Form::select('gender', $selectgender, $userdetail->gender, ['placeholder'=>'Select Gender', 'class'=>'form-control', 'id'=>'gender']) !!}
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="">Date of Birth <span class="error-text">*</span></label>
                        <div class="row hmar5">
                            <div class="col-sm-4 hpad5">
                                <label for="current_location">Day </label>
                                {!! Form::select('dob_day', $dob_day_options, $userdetail->dob_day, ['placeholder'=>'Day', 'class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-4 hpad5">
                                <label for="current_location">Month </label>
                                {!! Form::select('dob_month', $dob_month_options, $userdetail->dob_month, ['placeholder'=>'Month', 'class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-4 hpad5">
                                <label for="current_location">Year</label>
                                {!! Form::select('dob_year', $dob_year_options, $setyear, ['placeholder'=>'Year', 'class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>               </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="current_location">Current Location <span class="error-text">*</span></label>
                    {!! Form::select('current_location', $selectlocations, $userdetail->current_location, ['placeholder'=>'Select location', 'required', 'class'=>'form-control', 'id'=>'current_location']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    {!! Form::select('marital_status', $selectmaritalstatus, $userdetail->marital_status, ['placeholder'=>'Select status', 'class'=>'form-control', 'id'=>'marital_status']) !!}
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="permanent_address">Permanent Address</label>
                <textarea
                        name="permanent_address"
                        id="permanent_address"
                        rows="2"
                        class="form-control"
                        placeholder="Enter your permanent address"></textarea>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="city">Home Town/City <span class="error-text">*</span></label>
                    {!! Form::text('city', $userdetail->city, ['class'=>'form-control', 'placeholder'=>'Specify your city', 'id'=>'city', 'required']) !!}
                </div>
            </div>
        </div>


        <hr>
        <div class="clearfix pad-t10">
            <button class="btn btn-primary pad-l20 pad-r20" type="submit" onclick="move()">Save</button>
            <button class="btn btn-default mar-l10" type="submit">Cancel</button>

        </div>

    </div>

</div>
</div>

{!! Form::token() !!}
{!! Form::close() !!}


