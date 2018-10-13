<?php 
include('../../wp-config.php');
global $wbdb;
function get_numerics($str)
{
    preg_match_all('/\d+/', $str, $matches);
    return $matches[0];
}

$one5 = get_post_meta(30, 'url', true);

$arr1 = get_numerics($one5);
$array = array();
foreach ($arr1 as $val1) {

    $small_image_url1 = wp_get_attachment_image_src($val1, 'full');
    $array[] = array("imgUrl" => $small_image_url1[0]);
}
if (!empty($array)) {
    $json = array("success" => 1, "result" => $array, "error" => "No Error Found");
} else {
    $json = array("success" => 0, "result" => "", "error" => "No Image Found");
}
echo json_encode($json);

?>