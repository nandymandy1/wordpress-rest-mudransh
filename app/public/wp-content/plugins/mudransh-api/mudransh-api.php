<?php

/**
 * Plugin Name: Mudransh API's
 * 
 */

/**
 * @Description -> Get all posts from the database with removal of non required fields
 * @Route -> wl/v1/posts
 * @Access -> Public
 */
function wl_posts()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_types' => 'post'
    ));

    $i = 0;
    $data = [];

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        // $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        // $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $i++;
    }

    return $data;
};

/**
 * @Description -> Get recent posts form the database
 * @Route -> wl/v1/recent-posts
 * @Access -> Public
 */
function wl_recent_posts()
{
    $posts = get_posts(array(
        'numberposts' => 3,
        'post_types' => 'post',
        'order' => 'DESC',
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $i++;
    }

    return $data;
}

/**
 * @DESCRIPTION -> Get a single post by slug
 * @Route -> wl/v1/posts/<slug>
 * @Access -> Public
 */
function wl_post($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'post'
    ));

    // get_field('name_of_field', $post[0]->ID);

    if (count($post)) {
        $data['id'] = $post[0]->ID;
        $data['slug'] = $post[0]->post_name;
        $data['title'] = $post[0]->post_title;
        $data['content'] = $post[0]->post_content;
        $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
        $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
        $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
        return $data;
    } else {
        return [];
    }
}

/**
 * @Description -> Banners
 * @Route -> wl/v1/banners/<slug>
 * @Access -> Public
 */
function wl_banners()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'banners'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['content'] = $post->post_content;
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
        $i++;
    }

    return $data;
}

/**
 * @DESCRIPTION -> Get all testimonials
 * @Route -> wl/v1/testimonials
 * @Access -> Public
 */
function wl_testimonials()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'testimonials'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['customer_type'] = get_field('customer_type', $post->ID);
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $i++;
    }

    return $data;
}

/**
 * @DESCRIPTION -> Get a single testimonial by slug
 * @Route -> wl/v1/testimonials/<slug>
 * @Access -> Public
 */
function wl_testimonial($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'testimonials'
    ));

    if (count($post)) {
        $data['id'] = $post[0]->ID;
        $data['slug'] = $post[0]->post_name;
        $data['title'] = $post[0]->post_title;
        $data['content'] = $post[0]->post_content;
        $data['customer_type'] = get_field('customer_type', $post[0]->ID);
        $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
        $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
        $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
        return $data;
    } else {
        return [];
    }
}

/**
 * @DESCRIPTION -> Get all team members
 * @Route -> wl/v1/teams
 * @Access -> Public
 */
function wl_teams()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'team_members'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['twitter'] = get_field('twitter', $post->ID);
        $data[$i]['postion'] = get_field('position', $post->ID);
        $data[$i]['facebook'] = get_field('facebook', $post->ID);
        $data[$i]['linked_in'] = get_field('linked_in', $post->ID);
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');

        $i++;
    }

    return $data;
}

/**
 * @DESCRIPTION -> Get single team member
 * @Route -> wl/v1/teams/<slug>
 * @Access -> Public
 */
function wl_team($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'team_members'
    ));

    if (count($post)) {
        $data['id'] = $post[0]->ID;
        $data['slug'] = $post[0]->post_name;
        $data['title'] = $post[0]->post_title;
        $data['content'] = $post[0]->post_content;
        $data['postion'] = get_field('position', $post[0]->ID);
        $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
        $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
        $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
        return $data;
    } else {
        return [];
    }
}

/**
 * @Description -> Get recent testimonials from the customers
 * @Route -> wl/v1/recent-testimonials
 * @Access -> Public
 */
function wl_recent_testimonials()
{
    $posts = get_posts(array(
        'numberposts' => 3,
        'order' => 'DESC',
        'post_type' => 'testimonials'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['customer_type'] = get_field('customer_type', $post->ID);
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
        $i++;
    }

    return $data;
}

/**
 * @Description -> Terms and Conditions
 * @Route -> wl/v1/terms_conditions
 * @Access -> Public
 */
// function terms_conditions()
// {

// }

/**
 * @Description -> Features
 * @Route -> wl/v1/features
 * @Access -> Public
 */
function wl_features()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'features',
        'order' => 'ASC'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }

    return $data;
}

function wl_features_list()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'features',
        'order' => 'ASC'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $i++;
    }

    return $data;
}


/**
 * @Description -> Features
 * @Route -> wl/v1/features/<slug>
 * @Access -> Public
 */
function wl_feature($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'features'
    ));

    if (count($post)) {
        $data['id'] = $post[0]->ID;
        $data['slug'] = $post[0]->post_name;
        $data['title'] = $post[0]->post_title;
        $data['content'] = $post[0]->post_content;
        $data['excerpt'] = $post[0]->post_excerpt;
        $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
        $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
        $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
        return $data;
    } else {
        return [];
    }
}

/**
 * @Description -> Features
 * @Route -> wl/v1/features/<slug>
 * @Access -> Public
 */
function wl_pages($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'pages'
    ));
}

/**
 * @DESCRIPTION -> Get all services
 * @Route -> wl/v1/services
 * @Access -> Public
 */
function wl_services()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'services',
        'order' => 'ASC'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $data[$i]['excerpt'] = $post->post_excerpt;
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }

    return $data;
}


/**
 * @DESCRIPTION -> Get single service
 * @Route -> wl/v1/services/<slug>
 * @Access -> Public
 */
function wl_service($slug)
{
    $post = get_posts(array(
        'name' => $slug['slug'],
        'post_type' => 'services'
    ));

    if (count($post)) {
        $data['id'] = $post[0]->ID;
        $data['slug'] = $post[0]->post_name;
        $data['title'] = $post[0]->post_title;
        $data['content'] = $post[0]->post_content;
        $data['excerpt'] = $post[0]->post_excerpt;
        $data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
        $data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
        $data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
        return $data;
    } else {
        return [];
    }
}

function wl_services_list()
{
    $posts = get_posts(array(
        'numberposts' => 9999,
        'post_type' => 'services',
        'order' => 'ASC'
    ));

    $data = [];
    $i = 0;

    foreach ($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['title'] = $post->post_title;
        $i++;
    }

    return $data;
}

function myspace_get_posts_by_tag(WP_REST_Request $request)
{
    // get slug and page number
    $slug = $request['slug'];
    $page = $request['page'];
    // get tag -> more info here: https://www.coditty.com/code/wordpress-rest-api-get-posts-by-tag 
    $term = get_term_by('slug', $slug, 'post_tag');
    $posts_per_page = 2;

    $args = array(
        'paged'             => $page,
        'order'             => 'desc',
        'orderby'           => 'date',
        'tag__in'           => $term->term_id,
        'posts_per_page'    => $posts_per_page,
    );

    // use WP_Query to get the results with pagination
    $query = new WP_Query($args);

    // if no posts found return 
    if (empty($query->posts)) {
        return new WP_Error('no_posts', __('No post found'), array('status' => 404));
    }

    // Set max number of pages and total num of posts
    $max_pages = $query->max_num_pages;
    $total = $query->found_posts;
    $posts = $query->posts;

    // Prepare data for output
    $controller = new WP_REST_Posts_Controller('post');

    foreach ($posts as $post) {
        $response = $controller->prepare_item_for_response($post, $request);
        $data[] = $controller->prepare_response_for_collection($response);
    }

    // Set headers and return response      
    $response = new WP_REST_Response($data, 200);
    $response->header('X-WP-Total', $total);
    $response->header('X-WP-TotalPages', $max_pages);
    return $response;
}

/**
 * Wordpress Hooks for Mudransh Plugin
 */
add_action('rest_api_init', function () {
    register_rest_route(
        'wl/v1',
        'recent-posts',
        array(
            'methods' => 'GET',
            'callback' => 'wl_recent_posts'
        )
    );

    register_rest_route(
        'wl/v1',
        'posts',
        array(
            'methods' => 'GET',
            'callback' => 'wl_posts'
        )
    );

    register_rest_route(
        'wl/v1',
        'posts/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_post'
        )
    );

    register_rest_route(
        'wl/v1',
        'testimonials',
        array(
            'methods' => 'GET',
            'callback' => 'wl_testimonials'
        )
    );

    register_rest_route(
        'wl/v1',
        'testimonials/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_testimonial'
        )
    );

    register_rest_route(
        'wl/v1',
        'recent-testimonials',
        array(
            'methods' => 'GET',
            'callback' => 'wl_recent_testimonials'
        )
    );

    register_rest_route(
        'wl/v1',
        'teams',
        array(
            'methods' => 'GET',
            'callback' => 'wl_teams'
        )
    );

    register_rest_route(
        'wl/v1',
        'teams/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_team'
        )
    );

    register_rest_route(
        'wl/v1',
        'features',
        array(
            'methods' => 'GET',
            'callback' => 'wl_features'
        )
    );

    register_rest_route(
        'wl/v1',
        'features-list',
        array(
            'methods' => 'GET',
            'callback' => 'wl_features_list'
        )
    );

    register_rest_route(
        'wl/v1',
        'features/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_feature'
        )
    );

    register_rest_route(
        'wl/v1',
        'services',
        array(
            'methods' => 'GET',
            'callback' => 'wl_services'
        )
    );

    register_rest_route(
        'wl/v1',
        'services-list',
        array(
            'methods' => 'GET',
            'callback' => 'wl_services_list'
        )
    );

    register_rest_route(
        'wl/v1',
        'services/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_service'
        )
    );

    register_rest_route(
        'wl/v1',
        'pages/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => 'GET',
            'callback' => 'wl_pages'
        )
    );

    register_rest_route(
        'wl/v1',
        'banners',
        array(
            'methods' => 'GET',
            'callback' => 'wl_banners'
        )
    );

    // Paginated Custom End point Test
    register_rest_route(
        'wl/v1',
        'posts-paginated/(?P<slug>[a-z0-9]+(?:-[a-z0-9]+)*)/(?P<page>[1-9]{1,2})',
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'myspace_get_posts_by_tag',
            'args' => array(
                'slug' => array(
                    'required' => true
                ),
                'page' => array(
                    'required' => true
                ),
            )
        )
    );
});
