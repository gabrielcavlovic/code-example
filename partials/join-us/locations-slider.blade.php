<?php
$locations = get_field('locations');

$types_array = ['type-1', 'type-2', 'type-3'];
$i = 0;
?>

<div class="location-slider" data-cursor="swiper" data-cursor-color="bg-green">
    <div class="swiper-wrapper">
        @if (is_array($locations))
            @foreach ($locations as $bowery)
                <?php
                $name = get_the_title($bowery);
                $city = get_field('location_city', $bowery);
                $city_slug = strtolower(str_replace(' ', '-', $city));
                $state = get_field('location_state', $bowery);
                $state_code = get_field('location_state_code', $bowery);
                $type = get_field('location_type', $bowery);
                $description = get_field('description', $bowery);
                $background_id = get_field('location_card_background', $bowery);
                $background_url = wp_get_attachment_image_url($background_id, 'large');
                $jobs = get_field('location_jobs', $bowery);
                $url = '';

                $image_id = get_post_thumbnail_id($bowery);
                $image_url = wp_get_attachment_image_url($image_id, 'large');
                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                $location_type = $types_array[$i];

                if ($bowery == end($locations) && $location_type === 'type-1') {
                    $location_type = 'type-2';
                }
                ?>
                <div class="swiper-slide" >
                    <div class="card-img {{ $location_type }}">
                        @if ($image_url)
                            <div class="img" data-image-overlay>
                                <img src="{{ $image_url }}" alt="{{ $image_alt }}">
                            </div>
                        @endif
                        <div class="content">
                            <div class="top-content">
                                <div class="text-overline-sm">{{ $type }}</div>
                            </div>
                            <div class="bottom-content">
                                <h4>{{ $city . ', ' . $state_code }}</h4>
                            </div>
                        </div>

                        <span class="opener" data-more data-outside>
                            <span class="close">
                                <span class="icon-close"></span>
                            </span>
                        </span>
                        <div class="content slide" style="background-image: url({{ $background_url ? $background_url : '' }})">
                            <div class="top-content">
                                <div class="text-overline-sm">{{ $type }}</div>
                            </div>
                            <div class="bottom-content">
                                <h3>{{ $city . ', ' . $state_code }}</h3>
                                <div class="body-medium">
                                    <p>{{ $description }}.</p>
                                    @if($jobs)
                                        <a class="btn-tertiary white jobs-filter-link" href="#open-roles"
                                            data-location="{{ $bowery }}" data-location-slug="{{ $city_slug }}">
                                            <span class="icon"><svg>
                                                    <circle cx="15" cy="15" r="14" />
                                                </svg></span>
                                            See jobs
                                        </a>
                                    @endif
                                </div>
                                <a class="close" data-close><span class="icon-close"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $i++;
                    if ($i === 3) {
                        $i = 0;
                    }
                ?>
            @endforeach
        @endif
    </div>
</div>
