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
                <div class="col-sm-12 col-lg-10 col-lg-offset-1 mar-t20 animated pulse" id="home_banner_search">
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

   @include('client.partials.employerslider')
    
    <hr class="c-hr pad-b15">
    
    <div class="container">
        <div class="row">
           
           @include('client.partials.latestjobs')
            
            <div class="col-sm-4 mar-b30">
                @include('client.partials.subscribetonewsletter')
                @include('client.partials.homeads')
            </div>
        </div>
    </div>

@stop


@section('js')
    @parent
    {!! Html::script('assets/js/slick.min.js') !!}
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
            $.post('async/loadsearch',{_token:token},function(data){
                $('#home_banner_search').html(data);
            }).fail(function(){
                new PNotify({
                    title: 'Error',
                    text: 'We were unable to retrieve search data from our servers. Refresh the page to try again.',
                    type : 'error',
                });
            });
        });
    </script>
@stop
