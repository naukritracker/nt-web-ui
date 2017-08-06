<!-- Companies Slider Starts Here-->
<div class="container">
    <h1 class="l-title txtc pad-t20">Companies We’ve Helped</h1>
    <p style="display:none;" class="txtc pad-t10">Let us help you find the right talent for your business</p>
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
<!-- Companies Slider Ends Here-->