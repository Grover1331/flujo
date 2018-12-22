<?php 

function myplugin_add_restaurants_timings()
{

    $myPostType = array('departamento');

    foreach ($myPostType as $value) {

        add_meta_box(
            'myplugin_sectionid_price_range',
            __('Department Filters', 'myplugin_tprice_range'),
            'myplugin_add_call_restaurants_timings',
            $value
        );
    }
}


add_action('add_meta_boxes', 'myplugin_add_restaurants_timings');
add_action('save_post', 'myplugin_save_meta_restaurants_timings');

function myplugin_add_call_restaurants_timings($post)
{

	// Add an nonce field so we can check for it later.
    wp_nonce_field('myplugin_meta_box', 'myplugin_meta_box_nonce');

	/*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $post_id = $post->ID;
    global $wpdb;
    $municipio = get_post_meta($post_id , "municipio" , true);
    $barrio = get_post_meta($post_id , "barrio" , true);
    $departments1 = get_post_meta($post_id , "departments" , true);

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/jquery.timepicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/toastr.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/style.css" />
        <div class="meta-box-section">
			<div class="container1">
            <?php
            if($municipio == "" && $barrio == "" && $departments == "" )  {
                ?>
                <div class="form-group">
            <label for="deparments">Department</label>
            <select name="departments" id="deparments" class="form-control" onchange="changeDepartment(this , 'M');">
                <option value="">Select Department</option>
                <?php 
                $getFilterElements = getFilterElements("", "D");
                foreach ($getFilterElements as $key => $value) {
                    ?>
                   <option value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
                   <?php 
                }
                ?>
            </select>
            </div>
            <div class="form-group municipality M" style="display:none;">
            <label for="municipality">Municipality</label>
                <select name="municipality" id="municipality" class="form-control" onchange="changeDepartment(this , 'B');">

                </select>
            </div>
            <div class="form-group barrio B" style="display:none;">
            <label for="barrio">Barrio</label>
                <select name="barrio" id="barrio" class="form-control">

                </select>
            </div>
                <?php
            } else {
                ?>
                <div class="form-group">
                <label for="deparments">Department</label>
                <select name="departments" id="deparments" class="form-control" onchange="changeDepartment(this , 'M');">
                    <option value="">Select Department</option>
                    <?php 
                    $getFilterElements = getFilterElements("", "D");
                    foreach ($getFilterElements as $key => $value) {
                        ?>
                    <option <?php if(trim($departments1) == $value->name) { echo "selected"; } ?> value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
                    <?php 
                    }
                    ?>
                </select>
                </div>
                <div class="form-group municipality M">
                <label for="municipality">Municipality</label>
                    <select name="municipality" id="municipality" class="form-control" onchange="changeDepartment(this , 'B');">
                         <option value="">Select Department</option>
                            <?php 
                            $getFilterElements = getFilterElements($departments1, "M");
                            foreach ($getFilterElements as $key => $value) {
                                ?>
                            <option <?php if ($municipio == $value->name) {
                                        echo "selected";
                                    } ?> value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
                            <?php 
                }
                ?>
                    </select>
                </div>
                <div class="form-group barrio B">
                <label for="barrio">Barrio</label>
                    <select name="barrio" id="barrio" class="form-control" >
                         <option value="">Select Department</option>
                            <?php 
                            $getFilterElements = getFilterElements($municipio, "B");
                            foreach ($getFilterElements as $key => $value) {
                                ?>
                            <option <?php if ($barrio == $value->name) {
                                        echo "selected";
                                    } ?> value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
                            <?php 
                        }
                        ?>
                    </select>
                </div>
               
                <?php
            }
            ?>
            
            </div>
            <script>
            function changeDepartment(event , section) {
                var data = jQuery(event).val();
				jQuery.ajax({
					type: "POST",
					url: '<?php echo site_url(); ?>/wp-content/themes/flujo/inc/filterData.php',
					data: { event: data , section : section },
					success: function (resp) {
                        jQuery("."+section).show();
                        jQuery("."+section).find("select").empty().append(resp);
					}
                    });
                }	
            </script>
    <?php
}

function myplugin_save_meta_restaurants_timings($post_id)
{
    global $wpdb;

    
	// Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id)) {
            return;
        }

    } else {

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    update_post_meta($post_id, "municipio", $_POST['municipality']);
    update_post_meta($post_id, "barrio", $_POST['barrio']);
    update_post_meta($post_id, "departments", $_POST['departments']);
    

}

