<?php
$top_title = get_field('dei_top_title');
$title = get_field('dei_title');
$description = get_field('dei_description');
$accordions = get_field('accordions');
$video_title = get_field('dei_video_title');
$video = get_field('dei_video');
$video_thumbnail = get_field('dei_video_thumbnail');
$video_thumbnail_alt = get_post_meta($video_thumbnail, '_wp_attachment_image_alt', true);
$video_thumbnail_url = wp_get_attachment_image_url($video_thumbnail, 'full');
$i = 0;
?>

<section class="dei" data-bgcolor="#D6E6FF" data-start="-50%">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row" data-appear-stagger>
                    <div class="col-sm-6">
                        <div class="module-text-box" data-appear-stagger>
                            <span class="eyebrow orange">{{ $top_title }}</span>
                            <h2>{{ $title }}</h2>
                            <div class="txt">
                                {{ $description }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="faq">
                            <ul class="accordion accordion-green" data-accordion>
                                @if (is_array($accordions))
                                    @foreach ($accordions as $accordion)
                                        <?php $i++; ?>
                                        <li>
                                            <a href="#" class="{{ $i === 1 ? 'active' : '' }}" data-more>
                                                <span class="caret"></span>
                                                {{ $accordion['title'] }}
                                            </a>
                                            <div class="more-content">
                                                <p>{{ $accordion['description'] }}</p>
                                                @if ($accordion['button'])
                                                    <div class="link-wrap">
                                                        <a target="_blank" href="{{ $accordion['button']['url'] }}"
                                                            class="btn-tertiary"><span class="icon">
                                                            <svg><circle cx="15" cy="15" r="14"></circle>
                                                            </svg></span>{{ $accordion['button']['title'] }}
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="video-wrap" data-bgcolor="#fff">
                    @if ($video)
                        <video id="dei-video" width="100%" height="100%" poster="{{ $video_thumbnail_url }}">
                            <source src="{{ $video['url'] }}" type="{{ $video['mime_type'] }}">
                        </video>
                        <div class="video-info">
                            <a id="toggle-video">
                                <div class="thumb">
                                    <img src="{{ $video_thumbnail_url }}" alt="{{ $video_thumbnail_alt }}">
                                    <span class="play"></span>
                                </div>
                                <div class="right">
                                    <span class="text-overline-sm">{{ $video_title }}</span>
                                    <time id="video-duration" class="small-text"></time>
                                </div>
                            </a>
                        </div>
                    @elseif(!$video && $video_thumbnail_url)
                        <div class="img">
                            <img src="{{ $video_thumbnail_url }}" alt="{{ $video_thumbnail_alt }}">
                        </div>
                    @endif
                    <div id="dei-illustration" class="illustration">
                        <img src="{{ asset('images/illustration04.svg') }}" width="228" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
