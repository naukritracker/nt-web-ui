@extends('templates.client.master')

@section('content')
<div style="clear:both"></div>
<br/><br/>
<div class="container" style="  margin-top: 94px;">
	<div class="row mar-b20">
	    <div class="col-sm-8">
	        {!!Form::open(array('route'=>'ResetForgottenPassword','class'=>'row pad-t10 pad-b10','id'=>'forgot_password_form'))!!}
	            <div class="col-sm-4 txtc hidden-xs">
	                {!!Html::image('assets/img/logo_eb.png',null,['class'=>'img-responsive'])!!}
	            </div>
	            <div class="col-sm-8">
	                <div class="col-xs-10">
	                    <div class="form-group">
	                        {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Please provide your email ID','required'])!!}
	                    </div>
	                </div>
	                <div class="col-xs-2" id="emailerror" style="padding:1%"></div>
	           	                
	                <div class="clearfix">
	                    <div class="col-xs-10">
	                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
	                    </div>
	                </div>
	            </div>
	        {!!Form::close()!!}
	    </div>
	</div>
</div>
@stop