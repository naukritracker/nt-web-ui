{{--<form id="employer-registration-form" class="row pad-t10 pad-b10">--}}
{!! Form::open(array('id' => 'employer-registration-form', 'class' => 'row pad-t10 pad-b10')) !!}
    <div class="clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="companyName" class="form-control" placeholder="Company Name">
                <p id="companyName-error"></p>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="companyEmail" class="form-control" placeholder="Company Email">
                <p id="companyEmail-error"></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-4">
            <div class="form-group">
                <input type="text" name="companyCountryCode" class="form-control" placeholder="+">
                <p id="companyCountryCode-error" style="display:none"></p>
            </div>
            </div>
            <div class="col-sm-8">
            <div class="form-group">
                <input type="text" name="companyPhone" class="form-control" placeholder="Company Phone">
                <p id="companyPhone-error"></p>
            </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <textarea name="companyAddress" cols="30" rows="3" class="form-control" placeholder="Company Address"></textarea>
                <p id="companyEmail-error"></p>
            </div>
        </div>
    </div>
    <hr>
    <!-- <div class="clearfix">
        <div class="col-sm-12">
            <h3>User Details</h3>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="firstName" class="form-control" placeholder="First Name">
                <p id="firstName-error"></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="lastName" class="form-control" placeholder="Last Name">
                <p id="lastName-error"></p>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                <p id="phone-error"></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email Address">
                <p id="email-error"></p>
            </div>
        </div>
    </div> -->
    <div class="clearfix">
        <div class="col-sm-6">
            <div class="form-group">

                <input type="password" name="password" class="form-control" placeholder="Password">
                <p id="password-error"></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <p id="password_confirmation-error"></p>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <input name="terms_and_conditions" type="checkbox"> I agree to the <a href="#">Terms &amp; Conditions</a>
                <p id="terms_and_conditions-error"></p>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-sm-6 mar-b10">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <div class="col-sm-6 mar-b10">
            <p class="pad-t5">Already have an acount, <a href="{{ URL::route('ShowLogin') }}">Login</a> </p>
        </div>
    </div>
    {!! Form::token() !!}
{!! Form::close() !!}
