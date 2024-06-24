<?php
if(isset($_GET['department'])) {
    $departments_param = $_GET['department'];
    $departments_array = explode(',', $departments_param);
}

if(isset($_GET['location'])) {
    $locations_param = str_replace('-', ' ', $_GET['location']);
    $locations_array = explode(',', $locations_param);
}

$locations_meta_query = [
    'relation' => 'OR',
];

if(is_array($locations_array)) {
    foreach($locations_array as $location) {
        $location = ucwords($location);
        $locations_meta_query[] = [
            'key' => 'location_city',
            'value' => $location,
            'compare' => '=',
        ];
    }
}

$locations_args = [
    'post_type' => 'location',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => $locations_meta_query,
];

$locations_query = new WP_Query($locations_args);
$locations = $locations_query->posts;

$args = [
    'post_type' => 'job',
    'post_status' => 'publish',
    'posts_per_page' => 7,
    'orderby' => 'title',
    'order' => 'ASC',
];

if(is_array($departments_array)) {
    if(count($departments_array)) {
        $tax_query = [
            'relation' => 'OR',
        ];

        foreach($departments_array as $department) {
            $tax_query[] = [
                'taxonomy' => 'department',
                'field' => 'slug',
                'terms' => sanitize_text_field($department),
            ];
        }

        $args['tax_query'][] = $tax_query;
    }
}

if(is_array($locations)) {
    if(count($locations)) {
        $meta_query = [
            'relation' => 'OR',
        ];

        foreach($locations as $location) {
            $meta_query[] = [
                'key' => 'location',
                'value' => $location->ID,
                'compare' => 'LIKE'
            ];
        }

        $args['meta_query'][] = $meta_query;
    }
}

$query = new WP_Query($args);
$jobs_list = $query->posts;
$jobs = [];

foreach($jobs_list as $job) {
    $title = get_the_title($job);
    $url = get_field('url', $job);
    $location = get_field('location', $job);
    if(is_array($location)){
        if(count($location)){
            $city = get_field('location_city', $location[0]);
            $state_code = get_field('location_state_code', $location[0]);
        }
    }

    $department = get_the_terms( $job, 'department');
    $department_name = '';
    if(is_array($department)){
        if(count($department)){
            $department_name = $department[0]->name;
        }
    }

    $jobs[] = [
        'job' => $title,
        'url' => $url,
        'department' => $department_name,
        'city' => $city,
        'state' => $state_code,
    ];
}

$top_title = get_field('open_roles_top_title');
$title = get_field('open_roles_title');
$description = get_field('open_roles_description');
$button_text = get_field('load_more_button_text') ? get_field('load_more_button_text') : 'Load More Jobs';
$is_last = $query->max_num_pages == 1 ? true : false;
?>

<section class="apply" id="open-roles" data-bgcolor="#FBFAF9">
    <div class="container apply-container-top">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="top-row" data-appear-stagger>
                    <div class="txt-col">
                        <div class="module-text-box" data-appear-stagger>
                            <span class="eyebrow mint">{{ $top_title }}</span>
                            <h2>{{ $title }}</h2>
                            <p>{{ $description }}</p>
                        </div>
                    </div>
                    <div class="img-col">
                        <img src="{{ asset('images/illustration-open-roles.svg') }}" width="230" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="btm-row">
                    @include('partials/join-us/filters')
                    <ul class="jobs-list">
                        @include('/partials/join-us/xhr/jobs', ['jobs' => $jobs])
                    </ul>

                    @if (!$is_last)
                        <div class="btn-centered">
                            <button id="load-more-jobs" class="btn-primary" data-page="1">{{ $button_text }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
