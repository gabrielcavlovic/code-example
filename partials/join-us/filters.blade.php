<?php
$args = [
    'post_type' => 'job',
    'post_status' => 'publish',
    'posts_per_page' => -1,
];

$query = new WP_Query($args);
$jobs = $query->posts;

$cities = [];
if (is_array($jobs)) {
    foreach ($jobs as $job) {
        $location = get_field('location', $job);

        if(is_array($location)){
            if(count($location)){
                $city_name = get_field('location_city', $location[0]);
                $city_slug = strtolower(str_replace(" ", "-", $city_name));
                $city = ['name' => $city_name,'slug' => $city_slug , 'location_id' => $location[0]];
            }
        }

        if (!in_array($city, $cities)) {
            $cities[] = $city;
        }
    }
}

usort($cities, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

$departments = get_terms('department', [
    'hide_empty' => true,
]);

$departments_array = ['all'];
if(isset($_GET['department'])) {
    $departments_param = $_GET['department'];
    $departments_array = explode(',', $departments_param);
}

$locations_array = ['all'];
if(isset($_GET['location'])) {
    $locations_param = $_GET['location'];
    $locations_array = explode(',', $locations_param);
}
?>


<a href="#" class="btn-filter-opener" data-more data-outside data-hide-nav-opener>
    <span>Filter</span>
</a>
<div class="filter-row jobs-filters">
    <?php wp_nonce_field('ajax-jobs-filters-nonce', 'jobs-filters-nonce'); ?>
    <a href="#" class="btn-close" data-close><span class="icon-close"></span></a>
    <strong class="title">Filters</strong>
    <div class="filter-blocks-wrap">
        <div class="filter-block">
            <div class="select-product">
                <a class="department-count" data-more data-outside>By department</a>
                <div class="products-drop">
                    <div class="scroll">
                        <ul id="by-department">
                            <li>
                                <label for="all-departments" class="custom-checkbox">
                                    <input type="checkbox" id="all-departments" class="filter-all" data-value="all"
                                        {{ in_array('all', $departments_array) ? 'checked' : '' }}>
                                    <span class="fake-checkbox"></span>
                                    All departments
                                </label>
                            </li>
                            @if (is_array($departments))
                                @foreach ($departments as $department)
                                    <li>
                                        <label for="{{ $department->slug }}" class="custom-checkbox">
                                            <input type="checkbox" id="{{ $department->slug }}"
                                                data-value="{{ $department->slug }}" {{ in_array($department->slug, $departments_array) ? 'checked' : '' }}>
                                            <span class="fake-checkbox"></span>
                                            <span class="checkbox-name">{{ $department->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-block">
            <div class="select-product">
                <a class="location-count" data-more data-outside>By location</a>
                <div class="products-drop">
                    <ul id="by-location">
                        <li>
                            <label for="all-locations" class="custom-checkbox">
                                <input type="checkbox" id="all-locations" class="filter-all" data-value="all" {{ in_array('all', $locations_array) ? 'checked' : '' }}>
                                <span class="fake-checkbox"></span>
                                All locations
                            </label>
                            @if (is_array($cities))
                                @foreach ($cities as $city)
                                    <li>
                                        <label for="{{ $city['slug'] }}" class="custom-checkbox">
                                            <input type="checkbox" id="{{ $city['slug'] }}" data-value="{{ $city['location_id'] }}"
                                                data-location-id="{{ $city['location_id'] }}" {{ in_array($city['slug'], $locations_array) ? 'checked' : '' }}>
                                            <span class="fake-checkbox"></span>
                                            <span class="checkbox-name">{{ $city['name'] }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-foot">
        <ul class="btn-list">
            <li><button id="clear-filters" class="btn-secondary">Clear</button></li>
            <li><button class="btn-primary" id="apply-filters">Apply</button></li>
        </ul>
    </div>
</div>
