{!! Form::open(['route'=>'RegisterClient', 'id'=>'register_form', 'class'=>'row pad-t10 pad-b10', 'files'=>true]) !!}
<div class="row">

    <div class="clearfix">

        <div class="col-sm-6 pad-t20">

            <h4 class="blue-title b-title pad-b10">Login Details</h4>

            <div class="form-group">
                <label for="">Email Address <span class="error-text">*</span></label>
                {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Enter your email','required']) !!}
            </div>

            <div class="form-group ">
                <label for="">Password <span class="error-text">*</span></label>
                {!! Form::password('password', ['id'=>'password', 'class'=>'form-control', 'placeholder'=>'Enter your password']) !!}
            </div>

            <div class="form-group">
                <label for="">Confirm Password <span class="error-text">*</span></label>
                {!! Form::password('password_confirmation', ['id'=>'password_confirmation', 'class'=>'form-control', 'placeholder'=>'Confirm your password']) !!}
            </div>
            <div class="form-group">
                <label for="">Contact Number <span class="error-text">*</span></label>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::number('country_code', null, ['class'=>'form-control','placeholder'=>'Country Code','min'=>'0']) !!}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::number('contact_no', null, ['class'=>'form-control','placeholder'=>'Contact number','min'=>'0']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 pad-t20">

            <h4 class="blue-title b-title pad-b10">Contact Information</h4>

            <div class="form-group">
                <label for="">First Name <span class="error-text">*</span></label>
                {!! Form::text('first_name', null, ['class'=>'form-control','placeholder'=>'Enter your first name','required']) !!}
            </div>

            <div class="form-group">
                <label for="">Last Name <span class="error-text">*</span></label>
                {!! Form::text('last_name', null, ['class'=>'form-control','placeholder'=>'Enter your last name','required']) !!}
            </div>

            <div class="form-group">
                <div class="row hmar5">
                    <div class="col-xs-6 hpad5">
                        <label for="">Country</label>
                        {!! Form::select('country', $selectcountries, null, ['placeholder'=>'Select Country', 'class'=>'form-control', 'id'=>'country']) !!}
                    </div>
                    <div class="col-xs-6 hpad5">
                        <label for="state">State</label>
                        <select name="state" id="state" class="form-control">
                            <option selected="selected" value="">Select State</option>
                        </select>
                    </div>
                </div>
                <!-- <p>Your City & State</p> -->
            </div>
            <div class="form-group">
                <div class="row hmar5">
                    <div class="col-xs-12 hpad5">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city" placeholder="City">

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-12">
        <hr class="c-hr">
    </div>

    <div class="clearfix">

        <div class="col-sm-6">

            <h4 class="blue-title b-title pad-b10">Employment Details</h4>

            <div class="form-group">
                <label for="">Current Employer <span class="error-text">*</span></label>
                {!! Form::select('company', $selectcompanies, null, ['placeholder'=>'Select employer', 'class'=>'form-control', 'id'=>'register_company', 'required']) !!}
            </div>
            <div class="form-group">
                <div class="row hmar5">

                    <div class="col-xs-6 hpad5">
                        <label for="">Start Year</label>
                        <input
                                type="date"
                                name="experience_start_date"
                                class="form-control fresher"
                                placeholder="MM/DD/YYYY"
                                id="experience_start_date"
                                max="<?=date('Y-m-d')?>"
                               />
                    </div>
                    <div class="col-xs-6 hpad5">
                        <label for="">End Year</label>
                        <input
                                type="text"
                                name="experience_end_date"
                                class="form-control fresher"
                                placeholder="mm/dd/yyyy"
                                id="experience_end_date"
                                readonly/>
                    </div>
                </div>
                <div class="row hmar5">
                    <div class="col-xs-6 col-xs-offset-6 hpad5">
                        <label for=""></label>
                        <input
                                type="checkbox"
                                name="experience_to_date"
                                class="toDate"
                                placeholder="To Date"
                                id="experience_to_date"
                                value="1" >&nbsp;&nbsp;To Date
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">

            <h4 class="blue-title b-title pad-b10">Education Details</h4>
            <div class="form-group">
                <label for="">Institution</label>
                {!! Form::text('educational_institute_name', null, ['class'=>'form-control','placeholder'=>'Institution Name']) !!}
            </div>
            <div class="form-group">
                <div class="row hmar5">

                    <div class="col-xs-6 hpad5">
                        <label for="">Start Year</label>
                        <input
                                type="date"
                                name="education_start_date"
                                class="form-control"
                                placeholder="Start Year"
                                id="education_start_date"
                                max="<?=date('Y-m-d')?>"
                        />
                    </div>
                    <div class="col-xs-6 hpad5">
                        <label for="">End Year</label>
                        <input
                                type="date"
                                name="education_end_date"
                                class="form-control"
                                placeholder="End Year"
                                id="education_end_date"
                                max="<?=date('Y-m-d')?>"
                               />
                    </div>

                </div>
            </div>

            <div class="form-control">
                <label class="radio-inline">
                    {!!  Form::radio('education_type', '10')  !!} 10<sup>th</sup>
                </label>
                <label class="radio-inline">
                    {!!  Form::radio('education_type', '12')  !!} 12<sup>th</sup>
                </label>
                <label class="radio-inline">
                    {!!  Form::radio('education_type', '0', true)  !!} UG
                </label>
                <label class="radio-inline">
                    {!!  Form::radio('education_type', '1')  !!} PG
                </label>
                <label class="radio-inline">
                    {!!  Form::radio('education_type', '2')  !!} Other
                </label>
            </div>
        </div>

    </div>

    <div class="col-sm-12">
        <hr class="c-hr">
    </div>

    <div class="clearfix">

        <div class="col-sm-12">

            <h4 class="blue-title b-title pad-b10">Upload Resume</h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Upload Resume Document</label> <input
                                type="file"  accept=".doc,.docx,.rtf,.pdf"name="resume" class="form-control" id="fileUpload" onclick="Upload()">
                        <p class="xs-title pad-t5">Supported Formats: doc, docx, rtf,
                            pdf. Max file size: 300 Kb</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-12">
        <hr class="c-hr">
    </div>

    <div class="clearfix">

        <div class="col-sm-12">

            <h4 class="blue-title b-title pad-b10">Mailer and Privacy
                Settings</h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label> <input name="job_alerts" type="checkbox"> Job Alerts
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input name="fast_forward_emails" type="checkbox"> FastForward E-Mails
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label> <input name="blog_posts" type="checkbox"> Blog Posts
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input name="news" type="checkbox"> News
                        </label>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-sm-12">
        <hr class="c-hr">
    </div>
    <div class="clearfix">
        <div class="col-sm-12">
            <div class="checkbox">
                <label> <input type="checkbox" name="agreetoconditions">
                    I have read, understood and agree to the
                    <a
                            href="javascript:void(0)"
                            data-toggle="modal"
                            data-target="#terms-and-conditions-popup">Terms &amp; Conditions</a>
                    governing the use of <a href="{{ route('Home')  }}">naukritracker.com</a>
                </label>
            </div>
        </div>
        <!-- Login Popup -->
        <div
                class="modal fade"
                id="terms-and-conditions-popup"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModal"
                aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
                    </div>
                    <div class="modal-body">
                        <h3><b>Privacy Policy - Privacy Rights</b></h3>

                        <h4 class="pad-t20"><b><u>Introduction</u></b></h4>

                        <p>We, at <strong>KASA Networks</strong> are committed to respect your online privacy '
                            and recognize your need for appropriate protection and management of any personally '
                            identifiable information (<i>Personal Information</i>) you share with us. We collect this '
                            information to help fetching a <i>Right job to the Right Candidates</i> as we quote.</p>

                        <p>We suggest to read out the complete policy and understand how we shall be collecting your '
                            personal & professional information you shared on the site or any application respectively.</p>

                        <h4 class="pad-t20"><b><u>Age Clause</u></b></h4>
                        <p><strong>KASA Networks</strong> will not contact children under age 13 about special offers '
                            or for marketing purposes without a parent\'s permission. And don\'t offer any Job to '
                            the candidates below 18 years as per the Child labor act.</p>

                        <h4 class="pad-t20"><b><u>Information Collection</u></b></h4>
                        <p>We collect information when you use <strong><i>'
                                    <a href="{{ route('Home') }}">naukritracker.com</a>'
                                    </i></strong>, we collect information such as contact details, profile information you '
                            update & resume provided which may not be limited.
                            We might also collect other information including technical or device used to access our '
                            site, contact lists and user too. And you might also be asked to compete a '
                            registration form and validate it to offer you a personalized browsing experience.</p>

                        <h4 class="pad-t20"><b><u>Information Usage</u></b></h4>
                        <p>We will be using the information collected to delivery high quality services to our '
                            prospect candidates and high quality material to your business partners and associates. '
                            ( Read clause - <b><u><a href="#3rdpartyclause">Third Party services Information '
                                        sharing & Disclosure</a></u></b>).</p>

                        <p>The information shall be use to deliver the services and products, to communicate ,to '
                            operate and keep our site and applications upgraded. Any data update in the profile '
                            database and marked visible shall be accessed, used and stored by others around the '
                            world. Posting of any sensitive information to <strong><i><a href="{{ route('Home') }}">'naukritracker.com</a></i></strong> is not recommended. Though we ensure to provide '
                            secured environment by allowing limited access our database to other users , we do '
                            not guarantee that the unauthorized parties will not gain access. </p>

                        <p>We limit access to personal information about you to employees & Employers  who we '
                            believe reasonably need to come into contact with that information to provide products '
                            or services to you or in order to do their jobs.</p>

                        <h4 class="pad-t20"><b><u>Information Sharing & Disclosure</u></b></h4>
                        <p><strong>KASA Networks</strong> does not sell , rent or share your personal information to '
                            any person or non- affiliated organization and companies except to provide services and '
                            products you have opted for with your permission or under the below mentioned '
                            circumstances.</p>

                        <ul class="mar-l30" style="list-style-type: circle;">
                            <li class="pad-b5">We provide the information to trusted partners who work on behalf of '
                                or with <strong>KASA Networks</strong> under confidentiality agreements. And these '
                                companies do not have any rights to share the same with others.</li>
                            <li class="pad-b5"><span id="3rdpartyclause">We do not share contact information with '
            third parties for their direct marketing purposes without your consent.</span></li>
                            <li class="pad-b5">We may share information to third parties if you consent. For example, '
                                we may use your information to contact you about products or services available from '
                                <strong><i><a href="{{ route('Home') }}">naukritracker.com</a></i></strong> or our '
                                affiliates. If you opt in, we may supply your information to third parties who may '
                                contact you about their products or services. You may change your contact preferences '
                                by adjusting your| notification settings.</li>
                            <li class="pad-b5">We may disclose to third parties information that we have collected '
                                from other websites.</li>
                            <li class="pad-b5">We disclose information where legally required.</li>
                            <li class="pad-b5">We may disclose and transfer information to a third party who acquires '
                                any or all of Naukritracker\'s business units.</li>
                            <li class="pad-b5"><strong>KASA Networks</strong> does not provide any personal information '
                                to the advertiser when you interact with or view a targeted ad.</li>
                            <li class="pad-b5">We transfer information about you if <strong>KASA Networks</strong> '
                                is acquired by or merged with another company. In this event '
                                <strong>KASA Networks</strong> will notify you before information about you is '
                                transferred and becomes subject to a different privacy policy.</li>
                        </ul>

                        <p class="pad-t20">We at <strong>KASA Networks</strong> ensure the authenticity & accuracy '
                            of the data & information shared on <strong><i><a href="{{ route('Home') }}">naukritracker.com</a></i></strong></p>

                        <h4 class="pad-t20"><b><u>Contact Details</u></b></h4>
                        <p><strong>KASA Networks</strong> is contactable online for any concerns and questions '
                            related to our privacy policy.</p>

                        <p>You may also write to us at :</p>

                        <p><small><strong># 3445, 3rd Floor Block-C,<br />
                                    4th Cross, 10th Main<br />
                                    Indira Nagar 2nd Stage,<br />
                                    Bangalore-560038.</strong></small></p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix mar-t20">
        <div class="col-sm-4">
            <button class="btn btn-lg btn-success">Create</button>
        </div>
    </div>
    <div class="col-sm-offset-10">
        <button class="btn btn-instagram" ><a href="{{ route('Home')  }}">home</a></button>
    </div>
</div>

{!! Form::token() !!}
{!! Form::close() !!}





