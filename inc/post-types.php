<?php 
/* Custom Post Types */
//DASH ICONS = https://developer.wordpress.org/resource/dashicons/
add_action('init', 'js_custom_init', 1);
function js_custom_init() {
    $post_types = array(
        array(
            'post_type' => 'events',
            'menu_name' => 'Events',
            'plural'    => 'Events',
            'single'    => 'Event',
            'menu_icon' => 'dashicons-star-filled',
            'supports'  => array('title','editor','thumbnail')
        ),
    );
    
    if($post_types) {
        foreach ($post_types as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural']; 
            $menu_icon = ( isset($p['menu_icon']) && $p['menu_icon'] ) ? $p['menu_icon'] : "dashicons-admin-post"; 
            $supports = ( isset($p['supports']) && $p['supports'] ) ? $p['supports'] : array('title','editor','custom-fields','thumbnail'); 
            $taxonomies = ( isset($p['taxonomies']) && $p['taxonomies'] ) ? $p['taxonomies'] : array(); 
            $parent_item_colon = ( isset($p['parent_item_colon']) && $p['parent_item_colon'] ) ? $p['parent_item_colon'] : ""; 
            $menu_position = ( isset($p['menu_position']) && $p['menu_position'] ) ? $p['menu_position'] : 20; 
            
            if($p_type) {
                
                $labels = array(
                    'name' => _x($plural_name, 'post type general name'),
                    'singular_name' => _x($single_name, 'post type singular name'),
                    'add_new' => _x('Add New', $single_name),
                    'add_new_item' => __('Add New ' . $single_name),
                    'edit_item' => __('Edit ' . $single_name),
                    'new_item' => __('New ' . $single_name),
                    'view_item' => __('View ' . $single_name),
                    'search_items' => __('Search ' . $plural_name),
                    'not_found' =>  __('No ' . $plural_name . ' found'),
                    'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'), 
                    'parent_item_colon' => $parent_item_colon,
                    'menu_name' => $menu_name
                );
            
            
                $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true, 
                    'show_in_menu' => true, 
                    'show_in_rest' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'has_archive' => false, 
                    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
                    'menu_position' => $menu_position,
                    'menu_icon'=> $menu_icon,
                    'supports' => $supports
                ); 
                
                register_post_type($p_type,$args); // name used in query
                
            }
            
        }
    }
}

// Add new taxonomy, make it hierarchical (like categories)
add_action( 'init', 'ii_custom_taxonomies', 0 );
function ii_custom_taxonomies() {
        $posts = array();
        // $posts = array(
        //     array(
        //         'post_type' => 'position',
        //         'menu_name' => 'Categories',
        //         'plural'    => 'Assignment Categories',
        //         'single'    => 'Category',
        //         'taxonomy'  => 'position_categories'
        //     ),
        // );
    
    if($posts) {
        foreach($posts as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural'];
            $taxonomy = ( isset($p['taxonomy']) && $p['taxonomy'] ) ? $p['taxonomy'] : "";
            
            
            if( $taxonomy && $p_type ) {
                $labels = array(
                    'name' => _x( $menu_name, 'taxonomy general name' ),
                    'singular_name' => _x( $single_name, 'taxonomy singular name' ),
                    'search_items' =>  __( 'Search ' . $plural_name ),
                    'popular_items' => __( 'Popular ' . $plural_name ),
                    'all_items' => __( 'All ' . $plural_name ),
                    'parent_item' => __( 'Parent ' .  $single_name),
                    'parent_item_colon' => __( 'Parent ' . $single_name . ':' ),
                    'edit_item' => __( 'Edit ' . $single_name ),
                    'update_item' => __( 'Update ' . $single_name ),
                    'add_new_item' => __( 'Add New ' . $single_name ),
                    'new_item_name' => __( 'New ' . $single_name ),
                  );

              register_taxonomy($taxonomy,array($p_type), array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => $taxonomy ),
              ));
            }
            
        }
    }
}

// Add the custom columns to the position post type:
add_filter( 'manage_posts_columns', 'set_custom_cpt_columns' );
function set_custom_cpt_columns($columns) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    
    if($post_type=='events') {
        unset( $columns['title'] );
        unset( $columns['date'] );
        $columns['title'] = __( 'Title', 'bellaworks' );
        $columns['featured'] = __( '', 'bellaworks' );
        $columns['photo'] = __( 'Image', 'bellaworks' );
        $columns['event_date'] = __( 'Event Date', 'bellaworks' );
        $columns['event_time'] = __( 'Event Time', 'bellaworks' );
        $columns['status'] = __( 'Status', 'bellaworks' );
        $columns['date'] = __( 'Created', 'bellaworks' );
    }
    
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_posts_custom_column' , 'custom_post_column', 10, 2 );
function custom_post_column( $column, $post_id ) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='events') {
        switch ( $column ) {
            case 'featured' :
                $homepage_id = get_home_page_id();
                $feat = get_field('featured_event',$homepage_id);
                $feat_post_id = ($feat) ? $feat->ID : 0;
                if($post_id==$feat_post_id) {
                    $home_page_url = get_admin_url() . 'post.php?post='.$homepage_id.'&action=edit';
                    echo '<a href="'.$home_page_url.'" class="featHome" title="Featured Event"><i class="dashicons dashicons-star-filled"></i></a>';
                }
                break;

            case 'photo' :
                $thumbnail_id = get_post_thumbnail_id($post_id);
                $img = wp_get_attachment_image_src($thumbnail_id,'small-thumbnail');
                $img_src = ($img) ? $img[0] : '';
                $the_photo = '<span class="tmphoto" style="display:inline-block;width:50px;height:50px;background:#e2e1e1;text-align:center;">';
                if($img_src) {
                   $the_photo .= '<img src="'.$img_src.'" alt="" style="width:100%;height:auto" />';
                } else {
                    $the_photo .= '<i class="dashicons dashicons-format-image" style="font-size:23px;position:relative;top:14px;left:-1px;opacity:0.2;"></i>';
                }
                $the_photo .= '</span>';
                echo $the_photo;
                break;
            case 'status' :
                $status = get_field('event_status',$post_id);
                $stat = ($status=='active') ? 'active' : 'done';
                $statusTxt = ($status=='active') ? 'Active' : 'Done';
                echo '<span class="event-status '.$stat.'">' . $statusTxt . '</span>';
                break;
            case 'event_date' :
                $start_date = get_field('start_date',$post_id);
                $end_date = get_field('end_date',$post_id);
                $event_date_arr = array($start_date,$end_date);
                $event_date_arr = array_filter($event_date_arr);
                $event_date = '';
                if($event_date_arr){
                    $event_date = implode(' - ',$event_date_arr);
                }                
                echo $event_date;
                break;
            case 'event_time' :
                $start_time = get_field('event_start_time',$post_id);
                $end_time = get_field('event_end_time',$post_id);
                $event_date_arr = array($start_time,$end_time);
                $event_date_arr = array_filter($event_date_arr);
                $event_time = '';
                if($event_date_arr){
                    $event_time = implode('-',$event_date_arr);
                }                
                echo $event_time;
                break;
        }
    }
    
}



