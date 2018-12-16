<?php 
include("../../../../wp-config.php");
$event = $_POST['event'];
$section = $_POST['section'];
$getFilterElements = getFilterElements($event, $section);
?>

    <option value="">Select Municipality</option>
<?php
foreach ($getFilterElements as $key => $value) {
    ?>
    <option value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
    <?php
}
?>