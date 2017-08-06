<div class="col-sm-5">
    <h3 class="m-title b-title">What other employers are saying</h3>
    <p class="txtc pad-t20 pad-b10">
        {!! Html::image('assets/img/testimonial_icon.png') !!}
    </p>
    <div id="testimonial-carousel" class="carousel slide testimonial-carousel" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @if(count($testimonials))
                <?php $isFirst = true; ?>
                @for($i=0;$i<count($testimonials);$i++)
                    @if($isFirst)
                        <li data-target="#testimonial-carousel" data-slide-to="{{$i}}" class="active"></li>
                        <?php $isFirst = false; ?>
                    @else
                        <li data-target="#testimonial-carousel" data-slide-to="{{$i}}"></li>
                    @endif
                @endfor
            @else
                <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#testimonial-carousel" data-slide-to="1" class="active"></li>
                <li data-target="#testimonial-carousel" data-slide-to="2" class="active"></li>
            @endif
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @if(count($testimonials))
                <?php $isFirst = true; ?>
                @foreach($testimonials as $testimonial)
                    @if($isFirst)
                        <div class="item active">
                            <p>{{$testimonial->content}}</p>
                            <h5>{{$testimonial->author}}</h5>
                        </div>
                        <?php $isFirst = false; ?>
                    @else
                        <div class="item">
                            <p>{{$testimonial->content}}</p>
                            <h5>{{$testimonial->author}}</h5>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="item active">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed sem sit amet magna cose ctetur rutrum.  Sed vestibulum ultricies ex ac vestibulum. Integer id faucibus sem et magna consectetur ulum ultricies ex ac vestibul ulum ultricies ex ac vestibul.</p>
                    <h5>Rajath</h5>
                </div>
                <div class="item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed sem sit amet magna cose ctetur rutrum.  Sed vestibulum ultricies ex ac vestibulum. Integer id faucibus sem et magna consectetur ulum ultricies ex ac vestibul ulum ultricies ex ac vestibul.</p>
                    <h5>Rohith</h5>
                </div>
                <div class="item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed sem sit amet magna cose ctetur rutrum.  Sed vestibulum ultricies ex ac vestibulum. Integer id faucibus sem et magna consectetur ulum ultricies ex ac vestibul ulum ultricies ex ac vestibul.</p>
                    <h5>Vinay</h5>
                </div>
            @endif
        </div>
    </div>
</div>