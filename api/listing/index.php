<?php 
include("../../wp-config.php");
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

if($latitude != "" && $longitude != "") {
    $final = get_department_listing($latitude , $longitude);

    $json = array("success" => 1, "result" => $final, "error" => "No Error Found");
} else {
    $json = array("success" => 0 , "result" => null , "error" => "Parameters Missing");
}
echo json_encode($json);
?>