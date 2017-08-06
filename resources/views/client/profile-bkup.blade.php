@extends('templates.client.master')


@section('content')
<div class="container pad-t85 mar-t20">
    <div class="row mar-b20">
        <div class="col-sm-3">
            <ul class="lhs-nav nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#edit-basic-information" aria-controls="edit-basic-information" role="tab" data-toggle="tab" class="profile-sum-icon">Basic Information</a></li>
                <li role="presentation"><a href="#edit-profile-summary" aria-controls="edit-profile-summary" role="tab" data-toggle="tab" class="profile-sum-icon">Profile Summary</a></li>
                <li><a href="#" class="employment-dt-icon">Employment Details</a></li>
                <li><a href="#" class="education-icon">Education</a></li>
                <li><a href="#" class="key-skills-icon">Key Skills</a></li>
                <li><a href="#" class="lang-icon">Languages</a></li>
                <li><a href="#" class="other-dt-icon">Other Details </a></li>
            </ul>
            <div class="clearfix pad-t20">
                <div class="green-box clearfix"><span class="upload-icon"></span> <span href="#" class="pad-b5 pull-left sm-title">jennifer_wegner_cv.doc</span>
                    <p class="mar-b0"><a href="#" class="white-title mar-r20">Edit</a><a href="#" class="white-title">Delete</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="edit-basic-information">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                {!! Html::image('assets/img/userpic_large.png',null,['class'=>'img-responsive']) !!}
                                <a href="#">Upload</a>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="full_name">Name <span class="error-text">*</span></label>    
                                    {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Enter your name']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="profile_headline">Profile Headline <span class="error-text">*</span></label>
                                    {!!Form::text('profile_headline',null,['class'=>'form-control','placeholder'=>'Enter a profile headline'])!!}
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email Address <span class="error-text">*</span></label>
                                        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter your email'])!!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Mobile Number <span class="error-text">*</span></label>
                                        {!!Form::number('mobile_no',null,['class'=>'form-control','placeholder'=>'Enter your mobile/landline number'])!!}
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Total Experience <span class="error-text">*</span></label>
                                        {!!Form::text('total_experience',null,['class'=>'form-control','placeholder'=>'Specify total years of experience'])!!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Annual Salary <span class="error-text">*</span></label>
                                        <div class="row hmar5">
                                            <div class="form-group col-sm-5 hpad5">
                                                <div class="input-group">
                                                    {!! Form::select('annual_lakh',$data['annual_lakh_options'],0,['class'=>'form-control']) !!}
                                                    <div class="input-group-addon c-add-on">Lakhs</div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-7 hpad5">
                                                <div class="input-group">
                                                    {!! Form::select('annual_thousand',$data['annual_thousand_options'],0,['class'=>'form-control']) !!}
                                                    <div class="input-group-addon c-add-on">Thousands</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <label class="radio-inline">
                                                {!! Form::radio('currency', 'dxb', true) !!} Dubai Currency
                                            </label>
                                            <label class="radio-inline">
                                                {!! Form::radio('currency','us') !!} US Currency
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="current_location">Current Location <span class="error-text">*</span></label>
                                        <select name="current_location" id="current_location" class="form-control">
                                            <option value="">Bangalore</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="preferred_location">Preferred Location</label>
                                        <select name="preferred_location" id="preferred_location" class="form-control">
                                            <option value="">Bangalore</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="industry">Industry <span class="error-text">*</span></label>
                                        <select name="industry" id="industry" class="form-control">
                                            <option value="">IT-Software/Software Services</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="functional_area">Functional Area <span class="error-text">*</span></label>
                                        <select name="functional_area" id="functional_area" class="form-control">
                                            <option value="">Web / Graphic Design / Visualiser</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="role">Role <span class="error-text">*</span></label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Web Designer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Date of Birth</label>
                                        <div class="row hmar5">
                                            <div class="col-sm-4 hpad5">
                                                {!! Form::select('dob_day',$data['dob_day_options'],null,['class'=>'form-control']) !!}
                                            </div>
                                            <div class="col-sm-4 hpad5">
                                                {!! Form::select('dob_month',$data['dob_month_options'],null,['class'=>'form-control']) !!}
                                            </div>
                                            <div class="col-sm-4 hpad5">
                                                {!! Form::select('dob_year',$data['dob_year_options'],$data['setyear'],['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="marital_status">Marital Status</label>
                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option value="unmarried">Single/unmarried</option>
                                            <option value="married">Married</option>
                                            <option value="relationship">In a Relationship</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <textarea name="permanent_address" id="permanent_address" rows="2"  class="form-control" placeholder="Enter your permanent address"></textarea>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">Home Town/City</label>
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pincode">Pincode</label>
                                        <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter your pin">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="clearfix pad-t10">
                        <button class="btn btn-primary pad-l20 pad-r20" type="submit">Save</button>
                        <button class="btn btn-default mar-l10" type="submit">Cancel</button>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="edit-profile-summary">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                {!!Html::image('assets/img/userpic_large.png',null,['class'=>'img-responsive'])!!}
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for=""><b>Name</b></label>
                                    <p>{{Auth::user()->name}}</p> 
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Profile Headline</b> </label>
                                    <p>Content for profile headline</p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Email Address</b> </label>
                                        <p>EMAIL</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Mobile Number</b> </label>
                                        <p>MOBILE</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Total Experience</b> </label>
                                        <p>2 years</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for=""><b>Annual Salary</b> </label>
                                        <p>2 Lakhs 12 thousand (Dollars)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <label for=""><b>Current Location</b> </label>
                                        <p>Bangalore</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Preferred Location</b></label>
                                        <p>Dubai</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Role</b> </label>
                                        <p>Web Designer</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Date of Birth</b></label>
                                        <p>16 January 1900</p>
                                    </div>
                                </div>
                            </div>
                             <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Gender</b></label>
                                        <p>Male</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Marital Status</b></label>
                                        <p>Single</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for=""><b>Permanent Address</b></label>
                                    <p>16, Rue Blanc Avenue, 7th Street, Paris, France</p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Home Town/City</b></label>
                                        <p>CITY</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Pincode</b></label>
                                        <p>PINCODE</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Industry </b></label>
                                        <p>Industry Name</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""><b>Functional Area </b></label>
                                        <p>Description of functional area</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">...</div>
                <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>


        </div>

        <div class="col-sm-3">
            <h3 class="m-title b-title mar-t0">Recommended Jobs</h3>
            <ul class="l-jobs r-jobs mar-t20">
                <li>
                    <p class="tc-text"><a href="#" class="sm-title">Senior Developer/Team Lead/Technology Manager </a></p>
                    <p class="xs-title lj-icons">
                        <span>Sofomation</span>
                        <span>Dubai/ UAE</span>
                    </p>
                </li>
                <li>
                    <p class="tc-text"><a href="#" class="sm-title">Senior Developer/Team Lead/Technology Manager </a></p>
                    <p class="xs-title lj-icons">
                        <span>Sofomation</span>
                        <span>Dubai/ UAE</span>
                    </p>
                </li>
                <li>
                    <p class="tc-text"><a href="#" class="sm-title">Senior Developer/Team Lead/Technology Manager </a></p>
                    <p class="xs-title lj-icons">
                        <span>Sofomation</span>
                        <span>Dubai/ UAE</span>
                    </p>
                </li>
                <li>
                    <p class="tc-text"><a href="#" class="sm-title">Senior Developer/Team Lead/Technology Manager </a></p>
                    <p class="xs-title lj-icons">
                        <span>Sofomation</span>
                        <span>Dubai/ UAE</span>
                    </p>
                </li>                                                                                                                                                 <li>
                    <p class="tc-text"><a href="#" class="sm-title">Senior Developer/Team Lead/Technology Manager </a></p>
                    <p class="xs-title lj-icons">
                        <span>Sofomation</span>
                        <span>Dubai/ UAE</span>
                    </p>
                </li>
            </ul>
            <p class="txtc pad-t20"><a href="#">View All &raquo;</a></p>
            <div class="mar-t30">{!!Html::image('assets/img/ad1.png',null,['class'=>'img-responsive'])!!}</div>
            <div class="mar-t30">{!!Html::image('assets/img/ad2.png',null,['class'=>'img-responsive'])!!}</div>
        </div>
    </div>
</div>
@stop