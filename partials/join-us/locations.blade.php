<?php
$top_title = get_field('locations_top_title');
$title = get_field('locations_title');
$description = get_field('locations_description');
?>

<section class="our-location" data-bgcolor="#FBFAF9">
    <div class="container" >
        <div class="row" >
            <div class="col-lg-10 col-lg-offset-1" >
                <div class="row heading" data-appear-stagger>
                    <div class="col-sm-6">
                        <div class="txt-col">
                            <div class="module-text-box" data-appear-stagger>
                                <span class="eyebrow cilantro">{{ $top_title }}</span>
                                <p>{{ $description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" data-appear-stagger>
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
                @include('partials/join-us/locations-slider')
            </div>
        </div>
    </div>
</section>
