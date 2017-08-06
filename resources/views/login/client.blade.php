@extends('templates.client.master')

@section('content')
<div style="clear:both"></div>
<br/><br/>
<div class="container" style="  margin-top: 94px;">
	<div class="row mar-b20">
	    <div class="col-sm-8">
	        {!!Form::open(array('route'=>'Login','class'=>'row pad-t10 pad-b10','id'=>'login_form'))!!}
	            <div class="col-sm-4 txtc hidden-xs">
	                {!!Html::image('assets/img/logo_eb.png',null,['class'=>'img-responsive'])!!}
	            </div>
	            <div class="col-sm-8">
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
	                <div class="col-xs-10">
	                    <div class="form-group">
	                        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter you email','required'])!!}
	                    </div>
	                </div>
	                <div class="col-xs-2" id="emailerror" style="padding:1%"></div>
	                <div class="col-xs-10">
	                    <div class="form-group">
	                        {!!Form::password('password',['class'=>'form-control','placeholder' => 'Enter your password','required'])!!}
	                    </div>    
	                </div>
	                <div class="col-xs-2" id="passworderror" style="padding:1%"></div>
	                
	                <div class="clearfix">
	                    <div class="col-xs-10">
	                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
	                    </div>
	                </div>
	                <div class="pad-t20 clearfix">
	                    <div class="col-xs-10">
	                        <a href="{{ URL::route('ForgotPassword') }}" class="pull-left">Forgot Password?</a><a href="{{ URL::route('Register') }}" class="pull-right">Signup</a>
	                    </div>
	                </div>
	            </div>
	        {!!Form::close()!!}
	    </div>
	</div>
</div>
@stop