<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../../wp-config.php');

require_once(ABSPATH . 'wp-admin/includes/media.php');

require_once(ABSPATH . 'wp-admin/includes/file.php');

require_once(ABSPATH . 'wp-admin/includes/image.php');

global $wpdb;

require_once(ABSPATH . 'wp-content/plugins/departmentUpload/inc/reader.php');
$excel = new Spreadsheet_Excel_Reader();

function get_attachment_id_from_src($image_src)
{

	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";

	$id = $wpdb->get_var($query);

	return $id;

}


foreach ($wpdb->get_results("SELECT * FROM `wtw_upload_file` ORDER BY `url_id` DESC Limit 1") as $key => $row) {

	$check = explode("/flujo/", $row->url);
}


$x = 1;
$excel->read(ABSPATH . $check[1]);
while ($x <= $excel->sheets[0]['numRows']) {
	if ($x > 1) {
		$regno = $excel->sheets[0]['cells'][$x][1];
		$getData = $wpdb->get_results("SELECT * FROM `wtw_postmeta` WHERE `meta_key` = 'regno' AND `meta_value` = '$regno'");
		if($excel->sheets[0]['cells'][$x][9] == "SI") {
			$excel->sheets[0]['cells'][$x][9] = "YES";
		}
		if(empty($getData)) {
			$post_information = array(
				'post_title' => iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][2]),
				'post_content' => "",
				'post_type' => 'departamento',
				'post_status' => 'publish'
			);
			$post_id = wp_insert_post($post_information, true);
			add_post_meta($post_id, "regno", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][1]), true);
			add_post_meta($post_id, "address", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][3]), true);
			add_post_meta($post_id, "latitude", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][4]), true);
			add_post_meta($post_id, "longitude", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][5]), true);
			add_post_meta($post_id, "barrio", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][6]), true);
			add_post_meta($post_id, "municipio", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][7]), true);
			add_post_meta($post_id, "departments", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][8]), true);
			add_post_meta($post_id, "new", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][9]), true);
		} else {
			$my_post = array(
				'ID' => $getData[0]->post_id,
				'post_title' => iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][2]),
			);

// Update the post into the database
			wp_update_post($my_post);
			echo "<pre>";
			print_r($getData[0]);
			print_r($excel->sheets[0]['cells'][$x]);
			print_r(iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][8]));
			echo "</pre>";
			update_post_meta($getData[0]->post_id, "regno", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][1]));
			update_post_meta($getData[0]->post_id, "address", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][3]));
			update_post_meta($getData[0]->post_id, "latitude", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][4]));
			update_post_meta($getData[0]->post_id, "longitude", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][5]));
			update_post_meta($getData[0]->post_id, "barrio", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][6]));
			update_post_meta($getData[0]->post_id, "municipio", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][7]));
			update_post_meta($getData[0]->post_id, "departments", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][8]));
			update_post_meta($getData[0]->post_id, "new", iconv('ISO-8859-1', 'UTF-8', $excel->sheets[0]['cells'][$x][9]));
		}
			
			
			
			
	}
	$x++;
}





