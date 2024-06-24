<?php
/**
* AJAX Endpoint for jobs filters.
* Post to admin-ajax.php with the action param as "jobs_filters"
* This can be used as a sample to create other AJAX endpoints in the theme.
* Add as many of these files in the /endpoints/ directory and they will automatically be loaded into your WP site.
*/
$action_param = 'jobs_filters';

add_action( 'wp_ajax_' . $action_param, 'jobs_filters' );
add_action( 'wp_ajax_nopriv_' . $action_param, 'jobs_filters' );

function jobs_filters()
{   
    $departments = $_POST['checkedDepartments'];
    $locations = $_POST['checkedLocations'];
    $nonce = check_ajax_referer('ajax-jobs-filters-nonce', 'nonce', false);

    // if (!$nonce) {
    //     return wp_send_json(['status' => 'Invalid nonce']);
    // }

    $args = [
        'post_type' => 'job',
        'post_status' => 'publish',
        'tax_query' => [
            'relation' => 'AND',
        ],
        'meta_query' => [
            'relation' => 'AND',
        ],
        'posts_per_page' => 7,
        'orderby' => 'title',
        'order' => 'ASC',
    ];

    if(is_array($departments)) {
        if(count($departments)) {
            $tax_query = [
                'relation' => 'OR',
            ];
            
            foreach($departments as $department) {
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

            foreach($locations as $id) {
                $meta_query[] = [
                    'key' => 'location',
                    'value' => sanitize_text_field($id),
                    'compare' => 'LIKE'
                ];
            }

            $args['meta_query'][] = $meta_query;
        }
    }

    $query = new WP_Query($args);
    $jobs_list = [];

    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();

            $job = get_the_title();
            $job_id = get_the_ID();
            $url = get_field('url');
            $location = get_field('location');
            if(is_array($location)){
                if(count($location)){
                    $city = get_field('location_city', $location[0]);
                    $state_code = get_field('location_state_code', $location[0]);
                }
            }

            $department = get_the_terms( $job_id, 'department' );
            $department_name = '';
            if(is_array($department)){
                if(count($department)){
                      $department_name = $department[0]->name;
                }
            }

            $jobs_list[] = [
                'job' => $job,
                'url' => $url,
                'department' => $department_name,
                'city' => $city,
                'state' => $state_code,
            ];
        }   
    }

    return wp_send_json([
        'status' => 'success',
        'pages' => $query->max_num_pages,
        'is_last' => $query->max_num_pages <= 1 ? true : false,
        'html' => view('partials/join-us/xhr/jobs', ['jobs' => $jobs_list])->render()
    ]);
}