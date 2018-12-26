<?php 
/* To get 8 Departments Near the user */
function get_department_listing($user_latitude ,$user_longitude) {
    global $post;
    $data = array();
    query_posts(array('post_type' => 'departamento',  'numberposts' => -1));
    while (have_posts()) : the_post();

    //Collecting Data
        $latitude = trim(get_post_meta($post->ID, "latitude" , true));
        $longitude = trim(get_post_meta($post->ID, "longitude" , true));
        $address = get_post_meta($post->ID, "address" , true);
        $city = get_post_meta($post->ID, "barrio" , true);
        $new = get_post_meta($post->ID, "new" , true);
    //Collecting Data

    //Collecting Distance
    $distance = distance($user_latitude , $user_longitude ,$latitude , $longitude , "K");
    //Collecting Distance

    $data[] = array("title" => (isset($post->post_title) ? $post->post_title : '')  , "address" => (isset($address) ? $address : '')  , "city" => (isset($city) ? $city : '')  , "distance" => $distance , "isNew" => (isset($new) ? $new : 'no'), 'latitude' => (isset($latitude) ? $latitude : ''), 'longitude' => (isset($longitude) ? $longitude : ''));
    endwhile; wp_reset_query();
   

    $price = array();
    foreach ($data as $key => $row) {
        $price[$key] = $row['distance'];
    }
    array_multisort($price, SORT_ASC, $data);
    return $data = array_slice($data, 0 , 8);
}


function get_department_listing_filter($user_latitude ,$user_longitude , $getFilterData) {
    global $post;
    $data = array();
    query_posts(array('post_type' => 'departamento',  'numberposts' => -1 , 'post__in' => $getFilterData ));
    while (have_posts()) : the_post();

    //Collecting Data
        $latitude = get_post_meta($post->ID, "latitude" , true);
        $longitude = get_post_meta($post->ID, "longitude" , true);
        $address = get_post_meta($post->ID, "address" , true);
        $city = get_post_meta($post->ID, "barrio" , true);
        $new = get_post_meta($post->ID, "new" , true);
    //Collecting Data

    //Collecting Distance
    $distance = distance($user_latitude , $user_longitude ,$latitude , $longitude , "K");
    //Collecting Distance

    $data[] = array("title" => (isset($post->post_title) ? $post->post_title : '')  , "address" => (isset($address) ? $address : '')  , "city" => (isset($city) ? $city : '')  , "distance" => $distance , "isNew" => (isset($new) ? $new : 'no'), 'latitude' => (isset($latitude) ? $latitude : ''), 'longitude' => (isset($longitude) ? $longitude : ''));
    endwhile; wp_reset_query();

    $price = array();
    foreach ($data as $key => $row) {
        $price[$key] = $row['distance'];
    }
    array_multisort($price, SORT_ASC, $data);
    return $data = array_slice($data, 0 , 8);
}

//Get FilterData
function getFilterData($departmento, $municipio, $barrio) {
    //initial Data Collect 
    $posts = get_posts(array( 'numberposts' => -1, 'post_type' => 'departamento', 'post_status' => 'publish' ));
    //All Array 
    foreach ($posts as $postskey => $postsvalue) {
        $postsA[] = $postsvalue->ID;
    }
    if($departmento != "") {

        $department = get_posts(array('numberposts' => -1, 'post_type' => 'departamento', 'post_status' => 'publish', 'meta_query' => array(
            array(
                'key' => 'departments',
                'value' => $departmento,
                'compare' => 'LIKE'
            )
        ),
        ));

        foreach ($department as $departmentkey => $departmentvalue) {
            $departmentA[] = $departmentvalue->ID;
        }
        if(empty($departmentA)) {
            $departmentA = array();
        }
    } else {
        $departmentA = $postsA;
    }
    if($municipio != "") {
        $municipi = get_posts(array( 'numberposts' => -1, 'post_type' => 'departamento', 'post_status' => 'publish', 'meta_query' => array(
                array(
                    'key' => 'municipio',
                    'value' => $municipio,
                    'compare' => 'LIKE'
                )
            ),
        ));
        foreach ($municipi as $municipikey => $municipivalue) {
            $municipiA[] = $municipivalue->ID;
        }
        if (empty($municipiA)) {
            $municipiA = array();
        }
    } else {
        $municipiA = $postsA;
    }
    if($barrio != "") {
        $barri = get_posts(array( 'numberposts' => -1, 'post_type' => 'departamento', 'post_status' => 'publish', 'meta_query' => array(
                array(
                    'key' => 'barrio',
                    'value' => $barrio,
                    'compare' => 'LIKE'
                )
            ),
        ));
        foreach ($barri as $barrikey => $barrivalue) {
            $barriA[] = $barrivalue->ID;
        }
        if (empty($barriA)) {
            $barriA = array();
        }
    } else {
        $barriA = $postsA;
    }
    $intersect = array_intersect($departmentA, $municipiA, $barriA);
    return $intersect;
}
//Get FilterData


//Filer Elements 

function getFilterElements($name, $section) {
    global $wpdb;
    if($section == "D") {
        $parentName = 0;
    } else {
        $parentName = $name;
    }
    $getData = $wpdb->get_results("SELECT `name` FROM `wtw_department_rel` WHERE `parent_name` = '$parentName' AND `section` = '$section'");
    return $getData;
}
//Filer Elements 

?>