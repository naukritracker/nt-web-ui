@extends('templates.client.master')

@section('content')
<div class="container pad-t85">
    <div class="row mar-b20">
        <div class="col-sm-8">
            <div class="clearfix" id="register-form-box">
                <div class="clearfix pad-t40pr pad-l50pr">
                    <i class="fa fa-circle-o-notch fa-spin green"></i>
                    <i class="fa fa-circle-o-notch fa-spin red"></i>
                    <i class="fa fa-circle-o-notch fa-spin blue"></i>
                    <p><b>Loading...</b></p>
                </div>
            </div>
        </div>
<!--
        <div class="col-sm-4 mar-b30  pad-t20">
            <h4 class="blue-title b-title pad-b10">Subscribe to newsletter</h4>
            <div class="row hmar5 pad-t10">
                <div class="col-xs-8 hpad5">
                    <input type="text" class="form-control"
                           placeholder="Enter Email Address">
                </div>
                <div class="col-xs-4 hpad5">
                    <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                </div>
            </div>
            <div class="mar-t30">
              <!--  {!!Html::image('assets/img/ad1.png',null,['class'=>'img-responsive'])!!}
            </div>
            <div class="mar-t30">
                {!!Html::image('assets/img/ad2.png',null,['class'=>'img-responsive'])!!} -->
            </div>
        </div>
-->
    </div>
</div>

<!-- Company Popup -->
<div class="modal fade" id="new-company-popup" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter employment details</h4>
      </div>
      <!--OPEN FORM HERE-->
      <div class="modal-body">
        {!!Form::open(array('route'=>'RegisterCompany','id'=>'new_company_form','class'=>'row pad-t10 pad-b10'))!!}
        <div class="col-sm-6 hidden-xs">
            
            <div class="form-group">
              <label for="name">Employer <span class="error-text">*</span></label>                            
              {!!Form::text('name',null,['placeholder'=>'Specify Employer','class'=>'form-control','id'=>'register_company_name','required'])!!}
            </div>
            <div class="form-group">
              <label for="description">Description</label>                            
              <textarea name="description" rows="2" class="form-control" placeholder="A short description"></textarea>
            </div>
            <div class="form-group">
              <label for="city">City of operations</label>                            
              {!!Form::text('city',null,['placeholder'=>'City','class'=>'form-control','id'=>'register_city'])!!}
            </div>
            <div class="form-group"> 
              <label for="country">Select country of operations <span class="error-text">*</span></label>                           
              {!!Form::select('country',$countries,null,['placeholder'=>'Select country','class'=>'form-control','id'=>'register_country','required'])!!}
            </div>
            <div class="form-group">
              <label for="state">Select region of opertaions <span class="error-text">*</span></label>           
              {!!Form::select('state',[],null,['placeholder'=>'Select state','class'=>'form-control','id'=>'register_state','required'])!!}
            </div>
        </div>
         <div class="col-sm-6">
          <div class="form-group">
            <label for="contactNo">Contact number</label>
            {!!Form::number('contactNo',null,['placeholder'=>'Country code - Contact number','class'=>'form-control','id'=>'register_contactNo'])!!}
          </div>
          <div class="form-group">
            <label for="website">Employer Website</label>                            
            {!!Form::text('website',null,['placeholder'=>'Employee website','class'=>'form-control','id'=>'register_country'])!!}
          </div>   
          <div class="form-group">                              
            <!-- COMPANY ADDRESS -->
            <label for="address">Employer Address</label>
            <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
          </div>
          <div class="clearfix text-center">
              <!-- SUBMIT BUTTON -->
              <button type="submit" class="btn btn-lg btn-success">Add Your Company</button>
          </div>                    
         </div>
         {!!Form::token()!!}                                      
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>          

@stop

@section('js')
	@parent
	{!! Html::script('assets/js/jquery.validate.min.js') !!}

	<script type="text/javascript">
	$(document).ready(function (){
        token = $('meta[name="csrf-token"]').attr('content');
        animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        pageloading = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><i class="fa fa-circle-o-notch fa-spin green"></i><i class="fa fa-circle-o-notch fa-spin red"></i><i class="fa fa-circle-o-notch fa-spin blue"></i></div></div>';
        reloadbutton = '<div class="clearfix"><div class="clearfix pad-t40pr pad-l50pr"><button class="btn btn-lg btn-danger" onclick="window.location=window.location;">Reload Page</button></div></div>';

        jQuery.validator.addMethod("specialChars", function( value, element ) {
            //REGEX for atleast one upper case, one lower case, one number and atleast one special character
            var regex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$");
            return this.optional(element) || (regex.test(value));
        }, "Password must contain at least one upper case, at least one lower case, and at least one special character");


        jQuery.validator.addMethod("NoSpecialChars", function(value, element) {
                var re = new RegExp("^[a-zA-Z'.\\s]{1,40}$");
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );


        jQuery.validator.addMethod("Numbers", function(value, element) {
                var re = new RegExp("^\\+?[0-9]*?[0-9]+$");
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );

        jQuery.validator.addMethod("PNumbers", function(value, element) {
                var re = new RegExp("^\\+?[0-9]*?[0-9]+$");
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );

        $.validator.addMethod(
            "maxfilesize",
            function (value, element) {
                if (this.optional(element) || ! element.files || ! element.files[0]) {
                    return true;
                } else {
                    return element.files[0].size <= 300000;
                }
            },
            'The file size can not exceed 300kb.'
        );

        jQuery.validator.addMethod("emailordomain", function(value, element) {
            return this.optional(element) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(value) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                .test(value);
        }, "Please specify the correct email");



        function ajaxerrorclicktoclose (){
            var notice = new PNotify({
                title: 'Error',
                text: 'We were unable to retrieve data from our servers. Click here to try again.',
                type : 'error',
                buttons: {
                    closer: false,
                    sticker: false
                }
            });

            notice.get().click(function() {
                notice.remove();
                window.location = window.location;
            });
        }

        $.post('register/async/loadregisterform',{_token:token},function (data){
        	var animationName = 'animated fadeInLeft';
            $('#register-form-box').addClass(animationName).html(data).one(animationend,function() {
              $(this).removeClass(animationName);
            });

            $('#register_form').submit(function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var data = $(this).serialize();
                if($('#register_form').valid()){
                  $.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(result){
                      // success logic
                      if(result.success){
                        window.location = result.redirect;
                      }else{
                        var validator = $('#register_form').validate();
                        validator.showErrors(result.errors);
                        validator.focusInvalid();
                      }
                    },
                    error: function(data){
                      ajaxerrorclicktoclose();
                    }
                  });
                }
            });




            $("#register_form").validate({


	            rules: {
	               password: { 
	                required: true,
                  minlength: 8,
	                maxlength: 12,
                  specialChars : true,

	               } , 

	               password_confirmation: { 
	                equalTo: "#password",
	                required: true,
                  minlength: 8,
	                maxlength: 12,

	               },

                 contact_no: {
                  required:true,
                  number:true,
                  minlength:8,
                  maxlength:10,
                     PNumbers:true,
                 },

	               country_code: {
	                required:true,
	                number:true,
	                minlength:2,
	                maxlength:5,
                       Numbers:true,
	               },
                    first_name: {
                        required:true,
                        NoSpecialChars:true,
                    },

                    last_name: {
                        required:true,
                        NoSpecialChars:true,
                    },

                   resume:{
                       maxfilesize:true,
                       extension: "docx|rtf|doc|pdf",
                  },

                    email: {
	                   emailordomain:true,

                    },

                    education_end_date:{
                        required:true ,
                    },

                    agreetoconditions:{
	                required:true ,
	               },

	            },
	            messages:{
	                email:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
	                    email:"- must be valid"
	                },
	                first_name: { 
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",

	                },
	                last_name: { 
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
	                },
	                password_confirmation: { 
	                    equalTo:"- must be same as <b>Password</b>",
	                    required:"<span class='glyphicon glyphicon-exclamation-sign'></span>",
                      minlength:"Min Eight(8) characters",
	                    maxlength:"Max Twelve(12) characters"
	                },
	                password:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
	                    minlength:"Min Eight(8) characters",
                      maxlength:"Max Twelve(12) characters"
	                },
	                contact_no:{
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
                      number:"<span class='glyphicon glyphicon-exclamation-sign' ></span> Number required",
                      minlength:"Contact : Min Eight(8)",
                      maxlength:"Contact : Max Ten(10)"
                  },

                  country_code:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
	                    number:"<span class='glyphicon glyphicon-exclamation-sign' ></span> Number required",
	                    minlength:"Code : Min Two(2)",
	                    maxlength:"Code : Max Five(5)"
	                },
	                city:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
	                },
	                company:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
	                },
	                employement_description:{
	                    required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
	                },
	                agreetoconditions:{
	                    required:"<span class='glyphicon glyphicon-hand-right' style='color:red;float:right;margin-right:200%'></span>"
	                },

                    resume:{
                        extension:"select valied input file format",
                    },
                    country_code:"Please enter a valid Country Code",
                    contact_no:"Please enter a valid Conatact Number",
                    education_end_date:"End Year value can not be prior to Start Year",

	            },



	            onkeyup: function(element) {$(element).valid()},
	            errorPlacement: function(label, element) {
	                var named = $(element).attr('name');
                  if (named == 'country_code' || named == 'contact_no') {
                    label.css('color','red');
                    label.insertBefore($(element).parent('div').parent('div').parent('div'));
                  } else {
                    label.css('color','red');
                    label.insertBefore(element);
                  }
	            },
	        });



                    var today = new Date();
                    var dd=today.getUTCDate()
                    var mm = today.getMonth()+1; //January is 0!
                    var yyyy = today.getFullYear();

                    if(mm<10) {
                        mm='0'+mm
                    }
                    if(dd<10) {
                        dd='0'+dd
                    }
                    today = mm+'/'+dd+'/'+yyyy;

                    $('#experience_end_date').val(today);



          $('#country').on('click change',function (){
            var country = $('#country').val();
            if(country !== ''){
              $.post('register/async/loadstatelist/'+country,{_token:token},function (data){
                $('#state').html(data);
              }).fail(function (){
                var notice = new PNotify({
                    title: 'Error',
                    text: 'We were unable to retrieve state list data from our servers. Reselect country to try again.',
                    type : 'error',
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                });

                notice.get().click(function() {
                    notice.remove();
                });

                $('#edit-basic-information').html(reloadbutton);
              });
            }else{
              $('#state').html('<option value="" selected>Select state</option>');
            }
          });


            $("#register_company").on('click change',function (e){
                if(e.target.value == 0){
                    $('.fresher').prop("disabled", true);
                }

                if(e.target.value === 'ot'){
                    $('.fresher').prop("disabled", true);
                    e.target.value = '';
                    $('#new-company-popup').modal('show');
                }

                if(e.target.value != 0  && e.target.value != 'ot'){
                    $('.fresher').prop("disabled", false);
                }
            });

            $('#password').bind("cut copy paste",function(e) {
                e.preventDefault();
            });
            $('#password_confirmation').bind("cut copy paste",function(e) {
                e.preventDefault();
            });



            var start = document.getElementById('education_start_date');
            var end = document.getElementById('education_end_date');

            start.addEventListener('change', function() {
                if (start.value)

                    end.min = start.value;

            }, false);
            end.addEventLiseter('change', function() {
                if (end.value)

                    start.max =end .value;
            }, false);





        }).fail(function (){
        	var notice = new PNotify({
                title: 'Error',
                text: 'We were unable to retrieve data from our servers. Click here to try again.',
                type : 'error',
                buttons: {
                    closer: false,
                    sticker: false
                }
            });

            notice.get().click(function() {
                notice.remove();
                window.location = window.location;
            });

            $('#edit-basic-information').html(reloadbutton);
        });


        $('#new_company_form').validate({
              messages:{
                  name:{
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>",
                  },
                  country: { 
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
                  },
                  state: { 
                      required:"<span class='glyphicon glyphicon-exclamation-sign' ></span>"
                  }
              },
              onkeyup: function(element) {$(element).valid()},
              errorPlacement: function(label, element) {
                  label.css('color','red');
                  label.insertBefore(element);
              },
          });

        $('form#new_company_form').submit(function (e) {
              e.preventDefault();
              $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $('form').serialize(),
                success: function (data) {
                  $.post('register/async/loadcompanylist/'+data['company_id'],{_token:token},function (data){
                    $('#register_company').html(data);
                    $('form#new_company_form')[0].reset();
                    $('#new-company-popup').modal('hide');
                  }).fail(function (){
                    var notice = new PNotify({
                          title: 'Error',
                          text: 'We were unable to retrieve data from our servers. Click here to try again.',
                          type : 'error',
                          buttons: {
                              closer: false,
                              sticker: false
                          }
                      });

                      notice.get().click(function() {
                          notice.remove();
                          window.location = window.location;
                      });
                  });
                }
              });
          });

        $('#register_country').on('click change',function(event){
          if($(this).val() === ''){
            $('#register_state').html('<option value="" selected>Select state</option>');
          }else{
            $.post('register/async/loadstatelist/'+$(this).val(),{_token:token},function (data){
              $('#register_state').html(data);
            }).fail(function (){
              var notice = new PNotify({
                    title: 'Error',
                    text: 'We were unable to retrieve data from our servers. Click here to try again.',
                    type : 'error',
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                });

                notice.get().click(function() {
                    notice.remove();
                    window.location = window.location;
                });
            });
          }
        });
	});

	</script>
@stop