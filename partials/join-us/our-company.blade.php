<?php
$top_title = get_field('our_company_top_title');
$title = get_field('our_company_title');
$description = get_field('our_company_description');
$button = get_field('our_company_button');
$slider_images = get_field('our_company_slider_images');
?>

<section class="our-company" data-bgcolor="#FBFAF9">
    <div class="container">
        <div class="inner">
            <div class="slider-col">
                <div class="slider-wrap" >
                    <div class="decor decor-1" data-flow-movement="100% 100%" data-flow-invert>
                        <img src="{{ asset('images/illustrate-04.svg') }}" width="118" alt="">
                    </div>
                    <div class="decor decor-2">
                        <img src="{{ asset('images/illustrate-04.svg') }}" width="118" alt="">
                    </div>
                    <div class="our-company-slider">
                        <div class="swiper-wrapper">
                            @if(is_array($slider_images))
                                @foreach($slider_images as $image)
                                <?php
                                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                $image_url = wp_get_attachment_image_url($image, 'large');
                                ?>
                                    <div class="swiper-slide">
                                        <div class="img-cover">
                                            <img src="{{ $image_url }}" alt="{{ $image_alt }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-controls">
                            <div class="swiper-pagination-fraction">
                            </div>
                            <span class="swiper-progress-bar">
                                <span class="bar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module-text-box">
                <div class="text-wrap" data-appear-stagger>
                    <span class="eyebrow orange">{{ $top_title }}</span>
                    <h2>{{ $title }}</h2>
                    <div class="txt">
                        {{ $description }}
                    </div>
                    @if($button)
                        <a href="{{ $button['url'] }}" class="btn btn-primary">{{ $button['title'] }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
