@if (!Auth::user())
<!-- Login Popup -->
<div class="modal fade" id="login-popup" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog" style="width:400px; top:45%;">
    <div class="modal-content" style="height:auto">
      	
      <div class="modal-header overhang text-center">
		<button type="button" class="close-mini close-overhang pull-right"><span>&times;</span></button>
		<h4>Don't have a Naukritracker account? Please Register. (It's FREE!)</h4>
      </div>
      <div class="modal-header" style="padding:5px 15px 5px 15px; text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('class'=>'row pad-t10 pad-b10', 'id'=> 'login_form','route' => 'Login')) !!}
        <div class="col-sm-4 txtc hidden-xs" style="display:none;">
            {!! Html::image('assets/img/logo_eb.png') !!}
        </div>
        <div class="col-sm-12">
        <div>
        <div class="col-xs-12 error-text pad-b10" id="loginerrorfield"></div>
        <div class="col-xs-12 pad-b10">
            <label class="Form-label--tick">
                <input type="radio" value="user" name="type" class="Form-label-radio" checked>
                <span class="Form-label-text">User</span>
            </label>
            <label class="Form-label--tick">
                <input type="radio" value="employer" name="type" class="Form-label-radio">
                <span class="Form-label-text">Employer</span>
            </label>
        </div>
          <div class="col-xs-12">
		    <div class="form-group">
			{!! Form::email('email',null,array('id'=>'email', 'class'=>'form-control', 'placeholder'=>'Enter your username/email', 'required'=>'true')) !!}
		    </div>
		  </div>
		  <div class="col-xs-12" id="emailerror" style="padding:1%"></div>
		  <div class="col-xs-12">
		      <div class="form-group">
			{!! Form::password('password',array('id'=>'password', 'class'=>'form-control', 'placeholder'=>'Enter your password', 'required'=>'true')) !!}
		      </div>
		  </div>
		  <div class="col-xs-12" id="passworderror" style="padding:1%"></div>
            <div class="col-xs-12 pad-b10">
                <label class="Form-label--tick">
                    <input type="radio" value="user" name="remember" class="Form-label-radio">
                    <span class="Form-label-text">Keep me signed in</span>
                </label>
            </div>
		  <div class="clearfix">
		    <div class="col-xs-12">
		      <button type="submit" class="btn btn-primary btn-block">Submit</button>
		    </div>
		  </div>
              </div> 
	  <div class="col-xs-12 text-center" style="display:none;">
		<hr style="border:solid 1px grey">
		<h3>OR</h3>
		<h4>You can sign-in with</h4>
	  </div>         
	  <div class="clearfix pad-t20" id="loginform-social">
	    <div class="col-xs-12">
                <div class="col-xs-6 text-center" style="padding:0px;">

                  <!--<div class="g-signin2" data-onsuccess="onSignIn"></div>-->
                  <a class="btn btn-default btn-block" style="background-color: #c23321" href="{!! URL::route('ShowGoogleLogin') !!}" title="Log in with Google+"><i class="fa fa-google-plus" style="font-size:21px; color:#fff;"></i></a>	
                </div>
                <div class="col-xs-6 text-center" style="padding:0px;">
                  <!--LOGIN BUTTON FOR LINKED IN-->
                  <a class="btn btn-default btn-block" style="background-color: #005983" href="{!! URL::route('ShowLinkedInLogin') !!}" title="Log in with LinkedIn"><i class="fa fa-linkedin-square" style="font-size:21px; color:#fff;"></i></a> 
                </div>

            </div>
	  </div>
          <div class="pad-t20 clearfix">
            <div class="a" id="employee-signup">
              <a style="text-decoration:underline;" href="{{ URL::route('ForgotPassword') }}" class="pull-left">Forgot Password?</a><a style="text-decoration:underline;" href="{{ URL::route('Register') }}" class="pull-right">Signup</a>
            </div>
          </div>
            <div class="pad-t20 clearfix">
            <div class="b" id="employer-signup" style="display:none">
                <a style="text-decoration:underline;" href="{{ URL::route('ForgotPassword') }}" class="pull-left">Forgot Password?</a>  <a style="text-decoration:underline;" href="{{ URL::route('Employers') }}" class="pull-right">Signup</a>
            </div>
            </div>

        </div>
         {!! Form::token() !!}                                      
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@endif
