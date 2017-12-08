<div class="clearfix">
    <div class="row" id="hhk">
        {!! Form::open(["class"=>"row pad-t10 pad-b10", "id"=> "profile_form", "route" => "SaveProfile", "files"=>"true"]) !!}
        <div class="clearfix">
            <div class="col-sm-12">
                <div class="form-group" >
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
            <a href="javascript:void(0)" id="load_image" >Upload</a>
            <input type="file" name="load_image_field" id="load_image_field" accept="image/*" style="display:none" onchange="ValidateSingleInput(this);" >
			  <a href="{{URL::route('DeleteImage',[Auth::user()->userdetail->profile_image])}}" >Remove</a>
            <!-- <a href="#" id="remove" onclick="foo()">Remove</a> -->


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

                <label for="" >Contact Number <span class="error-text">*</span></label>
                <div class="form-group">
                    <div class="col-xs-5" >
                        <input type="text" class="form-control" name="country_code" placeholder="+00"  value="{!! $userdetail->country_code !!}"  required onkeypress="return isNumber(event)"/>
                    </div>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="contact_no" placeholder="+00000000"   value="{!! $userdetail->contact_no !!}" required onkeypress="return isNumber(event)"/>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="current_location">Country of Residence <span class="error-text">*</span></label>

                    {!! Form::select('current_location', $selectlocations, $userdetail->current_location, ['placeholder'=>'Select current location', 'required', 'class'=>'form-control','id'=>'register_coun','onclick'=>'fo2();' ]) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="city">State/City <span class="error-text">*</span></label>
                    {!!Form::select('city',[], $userdetail->city,['placeholder'=>'Select State','class'=>'form-control','id'=>'register_stat','required'])!!}

                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="industry">Industry <span class="error-text">*</span></label>
                    {!! Form::select('industry', $selectindustry, $userdetail->industry, ['placeholder'=>'Select industry', 'class'=>'form-control', 'id'=>'industry','required']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="functional_area">Functional Area<span class="error-text">*</span> </label>
                    {!! Form::select('functional_area', $selectfunctional, $userdetail->functional_area, ['placeholder'=>'Select functional area', 'class'=>'form-control', 'id'=>'functional_area','required']) !!}
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="role">Role </label>
                    {!! Form::text('role',$userdetail->role, ['placeholder'=>'your role', 'class'=>'form-control', 'id'=>'role', 'value'=>$userdetail->role]) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group"  >

                    <label for="dob" >Date of Birth <span class="error-text">*</span></label>
                    <div class="row hmar5">
                        <div class="col-sm-4 hpad5" >
                            {!! Form::select('dob_day', $dob_day_options, $userdetail->dob_day, ['placeholder'=>'DD', 'class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-4 hpad5" >
                            {!! Form::select('dob_month', $dob_month_options, $userdetail->dob_month, ['placeholder'=>'MM', 'class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-4 hpad5">
                            {!! Form::select('dob_year', $dob_year_options, $userdetail->dob_year, ['placeholder'=>'YYYY', 'class'=>'form-control', 'required']) !!}
                        <div class="col-sm-4 hpad5" ></div>
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
                    <label for="marital_status">Marital Status</label>
                    {!! Form::select('marital_status', $selectmaritalstatus, $userdetail->marital_status, ['placeholder'=>'Select status', 'class'=>'form-control', 'id'=>'marital_status']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
			
			
                <label for="permanent_address">Permanent Address</label>
               {!!Form::textarea('permanent_address',Auth::user()->userdetail->permanent_address,['placeholder'=>'Permanent address','class'=>'form-control', 'rows'=>'2','required'])!!}
            </div>
        </div>
        <div class="clearfix">

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="preferred_location">Preferred Location<span class="error-text">*</span></label>
                    {!! Form::select('preferred_location', $selectlocations, $userdetail->preferred_location, ['placeholder'=>'your preferred location', 'class'=>'form-control', 'id'=>'preferred_location','required']) !!}
                </div>
				 </div>
				 <div class="col-sm-6">
				<div class="form-group">
                    <label for="preferred_location">Experience<span class="error-text">*</span></label>					
				 {!!Form::select('exp',$selectexp,Auth::user()->userdetail->exp_level,['placeholder'=>'Select','class'=>'form-control','required' ])!!}
				  </div>
            </div>
        </div>



        {!! Form::hidden('progress_percentage', 30, ['class'=>'form-control','required']) !!}

        <hr>
        <div class="clearfix pad-t10">
            <button class="btn btn-primary pad-l20 pad-r20" type="submit">Save</button>
            <button class="btn btn-default mar-l10" type="submit">Cancel</button>
        </div>
    </div>
</div>
{!! Form::token() !!}
{!! Form::close() !!}
