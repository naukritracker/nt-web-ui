@extends('templates.client.master')

@section('content')
<section class="banner">
        <div id="carousel-example-generic" class="carousel slide carousel-fade home-banner" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    {!! Html::image('assets/img/banner.png') !!}
                </div>
            </div>
        </div>
        <div class="container banner-inner pad-t85">
            <div class="row">
                <div class="col-sm-12 col-lg-10 col-lg-offset-1 mar-t20 animated pulse" id="employer_banner">
                    <div class="clearfix">
                        <div class="clearfix pad-t25pr pad-l50pr">
                            <i class="fa fa-circle-o-notch fa-spin green"></i>
                            <i class="fa fa-circle-o-notch fa-spin red"></i>
                            <i class="fa fa-circle-o-notch fa-spin blue"></i>
                            <p><b>Loading...</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Banner Ends Here -->

    @include('client.partials.companyslider')
    
    <hr class="c-hr pad-b15">

    @include('client.partials.employerhowitworks')
    
    <!-- Free Trial Section Starts Here -->        
    <section class="free-trial">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h2>Start your free trial today, No credit card is requried.</h2>
                </div>
                <div class="col-sm-3">
                    <a href="javascript:void(0)" id="post-a-job" class="btn btn-big btn-block">Post a Job!</a>

                </div>
            </div>
        </div>
    </section>
    <!-- Free Trial Section Ends Here -->

    <div class="container">
        <div class="row">
            @include('client.partials.employerfaq')
            @include('client.partials.employertestimonials')
        </div>
    </div>

    <!-- Registration Model starts here -->
    <!-- Register Employer Modal -->
    <div class="modal fade" id="employerModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="employerModalLabel">Employer Options</h4>
          </div>
          <div class="modal-body" id="employerModalBody">
              <div class="col-sm-12 col-lg-10 col-lg-offset-1 mar-t20 animated pulse" id="employer_modal">
                  <div class="clearfix">
                      <div class="clearfix pad-t25pr pad-l50pr">
                          <i class="fa fa-circle-o-notch fa-spin green"></i>
                          <i class="fa fa-circle-o-notch fa-spin red"></i>
                          <i class="fa fa-circle-o-notch fa-spin blue"></i>
                          <p><b>Loading...</b></p>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Registration Model ends here -->
@stop


@section('js')
    @parent
    {!! Html::script('assets/js/slick.min.js') !!}
    {!! Html::script('assets/js/jquery.validate.min.js') !!}
    {!! Html::script('assets/unisharp/laravel-ckeditor/ckeditor.js') !!}
    <script type="text/javascript">
         $('.c-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 6,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        $(document).ready(function(){
            $.post('async/employers/loadbanner',{_token:token},function(data){
                $('#employer_banner').html(data);
                $('#employer-register-now').click(function (clickEvent) {
                    $.post('async/employers/loadregister',{_token:token},function(data){
                        $('#employerModalLabel').html('Register as Employer');
                        $('#employerModalBody').html(data);
                        $('#employerModal').modal('show');
                        $('#employer-registration-form').submit(function (submitEvent) {
                            $.post(
                                'async/employers/doregister',
                                $('#employer-registration-form').serialize(),
                                function (responsedata) {
                                    if (responsedata.success) {
                                        $('#employer-registration-form input').parent().removeClass('error');
                                        $('#employer-registration-form select').parent().removeClass('error');
                                        $('#employer-registration-form [id*="-error"]').html('');
                                        window.location = responsedata.redirect;
                                    } else {
                                        $('#employer-registration-form input').parent().removeClass('error');
                                        $('#employer-registration-form select').parent().removeClass('error');
                                        $('#employer-registration-form [id*="-error"]').html('');

                                        $.each(responsedata.errors, function (name, error) {
                                            $('#employer-registration-form [name=' + name + ']').parent().addClass('error');
                                            $('#' + name + '-error').html(error[0]);
                                        })
                                    }
                                }
                            );
                            return false;
                        });
                    }).fail(function(){
                        new PNotify({
                            title: 'Error',
                            text: 'We were unable to retrieve search data from our servers. Refresh the page to try again.',
                            type : 'error',
                        });
                    });
                });
            }).fail(function(){
                new PNotify({
                    title: 'Error',
                    text: 'We were unable to retrieve search data from our servers. Refresh the page to try again.',
                    type : 'error',
                });
            });
        });
        $('#post-a-job').click(function (clickEvent) {
            var originalbutton =  $(this);
            var originaltext = $(this).html();
            $(this).html('<i class="fa fa-spin fa-gear"></i>');
            $.post('async/employers/loadpostajob',{_token:token},function(data){
                originalbutton.html(originaltext);
                $('#employerModalLabel').html('Post a Job');
                $('#employerModalBody').html(data);
                $('#employerModal').modal('show');
                $('#country_id').on('click change',function(){
                    if($(this).val()){
                        $.post('jobposting/add/async/loadcountryrelateddata/'+$(this).val(),{_token:token},function (data){
                            $('#state_id').html(data.states);
                            $('#visa_id').html(data.visas);
                        }).fail(function(){
                            var notice = new PNotify({
                                title: 'Error',
                                text: 'We were unable to retrieve form data from our servers.',
                                type : 'error',
                                buttons: {
                                    closer: false,
                                    sticker: false
                                }
                            });

                            notice.get().click(function() {
                                notice.remove();
                            });
                        });
                    }
                });
                CKEDITOR.replace( 'description' );
                CKEDITOR.instances['description'].on( 'focus', function( evt ) {
                    if (isFirst) {
                        isFirst = 0;
                        CKEDITOR.instances['description'].setData( '' );
                    }
                });
            }).fail(function(jqXHR, textStatus, errorThrown){
                originalbutton.html(originaltext);
                if (jqXHR.status == 401) {
                    new PNotify({
                        title: 'Unauthorized !',
                        text: 'Please <a href="show/login">login</a> to access this section',
                        type : 'warning',
                    });
                } else {
                    new PNotify({
                        title: 'Error',
                        text: 'We were unable to retrieve search data from our servers. Refresh the page to try again.',
                        type : 'error',
                    });
                }
            });
        });
    </script>
@stop
