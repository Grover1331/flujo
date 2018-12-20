<?php 
include("../../wp-config.php");
$name = $_GET['parentName'];
$section = $_GET['section'];

if ($section != "") {
    $getFilterElements = getFilterElements($name, $section);
    $arrayFin = array();
   foreach ($getFilterElements as $key => $value) {
       $arrayFin[] = $value->name;
   }
    if (empty($getFilterElements)) {
        $json = array("success" => 0, "result" => array(), "error" => "Primero debes seleccionar el Departamento, Municipio y por último El Barrio.");
    } else {
        $json = array("success" => 1, "result" => $arrayFin, "error" => "No Error Found");
    }
} else {
    $json = array("success" => 0, "result" => null, "error" => "Parameters Missing");
}
echo json_encode($json);