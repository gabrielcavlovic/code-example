<?php
$top_title = get_field('hero_top_title');
$title = get_field('hero_title');
$button_text = get_field('hero_button_text') ? get_field('hero_button_text') : 'See open roles';
$description = get_field('hero_description');
$count = wp_count_posts('job');

$hero_image1_id = get_field('hero_image_1');
$hero_image1_alt = get_post_meta($hero_image1_id, '_wp_attachment_image_alt', TRUE);
$hero_image1_url = wp_get_attachment_image_url($hero_image1_id, 'large');

$hero_image2_id = get_field('hero_image_2');
$hero_image2_alt = get_post_meta($hero_image2_id, '_wp_attachment_image_alt', TRUE);
$hero_image2_url = wp_get_attachment_image_url($hero_image2_id, 'large');

$hero_image3_id = get_field('hero_image_3');
$hero_image3_alt = get_post_meta($hero_image3_id, '_wp_attachment_image_alt', TRUE);
$hero_image3_url = wp_get_attachment_image_url($hero_image3_id, 'large');
?>

<section class="hero hero-join" data-bgcolor="#E5EEFD">
    <div class="container">
        <div class="inner">
            <span class="overline-large">{{ $top_title }}</span>
            <h1 class="alt">{{ $title }}</h1>
            <div class="txt-wrap">
                <p class="large-subtitle">{{ $description }}</p>
            </div>
            <div class="btn-w-num">
                <a href="#open-roles" data-goto class="btn-primary">{{ $button_text }}</a>
                <span class="num">{{ $count->publish }}</span>
            </div>

            @if($hero_image1_url)
                <div class="people people-1 graphic-splash-pin">
                    @include('partials/graphics/pin')
                    <img class="avatar" src="{{ $hero_image1_url }}" alt="{{ $hero_image1_alt }}">
                </div>
            @endif
            @if($hero_image2_url)
                <picture class="people people-2 graphic-splash-pin">
                    @include('partials/graphics/pin')
                    <img class="avatar" src="{{ $hero_image2_url }}" alt="{{ $hero_image2_alt }}">
                </picture>
            @endif
            @if($hero_image3_url)
                <div class="people people-3 graphic-splash-pin">
                    @include('partials/graphics/pin')
                    <img class="avatar" src="{{ $hero_image3_url }}" alt="{{ $hero_image3_alt }}">
                </div>
            @endif
            <div class="decor decor-1 graphic-splash-pin">
                <img src="{{ asset('images/icon-bubble04.svg') }}" alt="">
            </div>
            <div class="decor decor-2 graphic-splash-pin">
                <img src="{{ asset('images/icon-bubble05.svg') }}" alt="">
            </div>
            <div class="decor decor-3 graphic-splash-pin">
                @include('partials/graphics/pin')
            </div>
            <div class="decor decor-4 graphic-splash-star">
                @include('partials/graphics/star')
            </div>
            <div class="decor decor-5 graphic-splash-star">
                <img src="{{ asset('images/icon-star02.svg') }}" alt="">
            </div>
            <div class="decor decor-6 graphic-splash-star">
                <img src="{{ asset('images/icon-star03.svg') }}" alt="">
            </div>
        </div>
    </div>
</section>