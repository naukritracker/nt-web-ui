<!-- Employer Slider Starts Here-->
<div class="container">
    <h1 class="l-title txtc pad-t20">Employers recruiting right now</h1>
    <p style="display:none;" class="txtc pad-t10">Choose a job you love, and you will never have to work a day in your life.</p>
   <div class="row">
      <div class="c-slider txtc">
        @if (count($banners)>0)
            @foreach ($banners as $banner)
              <div><span>{!! Html::image('uploads/banners/'.$banner->banner,'',array('class'=>'img-responsive')) !!}</span></div>  
            @endforeach
        @else
            <div><span>{!! Html::image('assets/img/c-logo1.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo2.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo3.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo4.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo5.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo1.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo2.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo3.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo4.png','',array('class'=>'img-responsive')) !!}</span></div>
            <div><span>{!! Html::image('assets/img/c-logo5.png','',array('class'=>'img-responsive')) !!}</span></div>
        @endif
      </div>
   </div>
</div>
<!-- Employer Slider Ends Here-->