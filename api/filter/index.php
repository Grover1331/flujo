<?php 
include("../../wp-config.php");
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$departmento = $_GET['departmento'];
$municipio = $_GET['municipio'];
$barrio = $_GET['barrio'];

if ($latitude != "" && $longitude != "") {
    $getFilterData = getFilterData($departmento , $municipio, $barrio);
    $final = get_department_listing_filter($latitude, $longitude , $getFilterData);
    if(empty($getFilterData)) {
        $json = array("success" => 0, "result" => array(), "error" => "No hemos encontrando un D1 bajo dicho parámetro. Inténtalo nuevamente seleccionado otro departamento / municipio / barrio");
    } else {
        $json = array("success" => 1, "result" => $final, "error" => "No Error Found");
    }
} else {
    $json = array("success" => 0, "result" => null, "error" => "Parameters Missing");
}
echo json_encode($json);
?>