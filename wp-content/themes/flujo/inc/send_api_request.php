<?php 
/* To get 8 Departments Near the user */
function get_department_listing($user_latitude ,$user_longitude) {
    global $post;
    $data = array();
    query_posts(array('post_type' => 'departamento',  'numberposts' => -1));
    while (have_posts()) : the_post();

    //Collecting Data
        $latitude = get_post_meta($post->ID, "latitude" , true);
        $longitude = get_post_meta($post->ID, "longitude" , true);
        $address = get_post_meta($post->ID, "address" , true);
        $city = get_post_meta($post->ID, "city" , true);
        $new = get_post_meta($post->ID, "new" , true);
    //Collecting Data

    //Collecting Distance
    $distance = distance($user_latitude , $user_longitude ,$latitude , $longitude , "K");
    //Collecting Distance

    $data[] = array("title" => (isset($post->post_title) ? $post->post_title : '')  , "address" => (isset($address) ? $address : '')  , "city" => (isset($city) ? $city : '')  , "distance" => $distance , "isNew" => (isset($new) ? $new : 'no'));
    endwhile; wp_reset_query();

    $price = array();
    foreach ($data as $key => $row) {
        $price[$key] = $row['distance'];
    }
    array_multisort($price, SORT_ASC, $data);
    return $data = array_slice($data, 0 , 8);
}
?>