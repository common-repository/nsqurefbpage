<?php 
    global $wpdb;
	$table_name = $wpdb->prefix . "fblikebox";
	
	$myrows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name where id=%d",1 ) );
	if($_POST['fbpage_hidden'] == 'Y') {
		//Form data sent
        $fbpage_url = $_POST['fbpage_url'];
        $fbpage_width = $_POST['fbpage_width'];
		$fbpage_height = $_POST['fbpage_height'];
        $fbpage_small_header = (isset($_POST['fbpage_small_header']) =="on")? '1':'0';
	    $fbpage_contanair_width = (isset($_POST['fbpage_contanair_width']) =="on")? '1':'0';
        $fbpage_hide_cover = (isset($_POST['fbpage_hide_cover']) =="on")? '1':'0';
        $fbpage_show_friend = (isset($_POST['fbpage_show_friend']) =="on")? '1':'0';
        $fbpage_show_post = (isset($_POST['fbpage_show_post']) =="on")? '1':'0';
      	if(sizeof($myrows) == 0){
			$wpdb->insert( $table_name, array( 'fbpage_url' => $fbpage_url, 'fbpage_width' => $fbpage_width, 'fbpage_height' => $fbpage_height, 'fbpage_small_header' => $fbpage_small_header, 'fbpage_contanair_width' => $fbpage_contanair_width, 'fbpage_hide_cover' => $fbpage_hide_cover, 'fbpage_show_friend' => $fbpage_show_friend, 'fbpage_show_post' => $fbpage_show_post ));
		}else{
			$wpdb->update( $table_name, array( 'fbpage_url' => $fbpage_url, 'fbpage_width' => $fbpage_width, 'fbpage_height' => $fbpage_height, 'fbpage_small_header' => $fbpage_small_header, 'fbpage_contanair_width' => $fbpage_contanair_width, 'fbpage_hide_cover' => $fbpage_hide_cover, 'fbpage_show_friend' => $fbpage_show_friend, 'fbpage_show_post' => $fbpage_show_post ),array('id'=>1));
		} 
			$myrows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name where id=%d",1 ) );
			$fbpage_url = $myrows[0]->fbpage_url;
		    update_option('fbpage_url', $fbpage_url);
			$fbpage_width = $myrows[0]->fbpage_width;
			update_option('fbpage_width', $fbpage_width);
			$fbpage_height = $myrows[0]->fbpage_height;
			update_option('fbpage_height', $fbpage_height);
			$fbpage_small_header = $myrows[0]->fbpage_small_header;
			$fbpage_contanair_width = $myrows[0]->fbpage_contanair_width;
			$fbpage_hide_cover = $myrows[0]->fbpage_hide_cover;
			$fbpage_show_friend = $myrows[0]->fbpage_show_friend;
			$fbpage_show_post = $myrows[0]->fbpage_show_post;
		 
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
			$fbpage_url = $myrows[0]->fbpage_url;
		    update_option('fbpage_url', $fbpage_url);
			$fbpage_width = $myrows[0]->fbpage_width;
			update_option('fbpage_width', $fbpage_width);
			$fbpage_height = $myrows[0]->fbpage_height;
			update_option('fbpage_height', $fbpage_height);
			$fbpage_small_header = $myrows[0]->fbpage_small_header;
			$fbpage_contanair_width = $myrows[0]->fbpage_contanair_width;
			$fbpage_hide_cover = $myrows[0]->fbpage_hide_cover;
			$fbpage_show_friend = $myrows[0]->fbpage_show_friend;
			$fbpage_show_post = $myrows[0]->fbpage_show_post;
		 
    }
	
?>
<div class="wrap">
    <?php    echo "<h2>" . __( 'Facebook Page Settings', 'fbpage_trdom' ) . "</h2>"; ?>
     
    <form name="fbpage_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="fbpage_hidden" value="Y">
        <p><?php _e("Facebook Page URL: " ); ?><input type="text" name="fbpage_url" value="<?php echo $fbpage_url; ?>" size="70" pattern="https?://.+" required><?php _e(" ex: https://www.facebook.com/facebook" ); ?></p>
        <p><?php _e("Width: " ); ?><input type="number" name="fbpage_width" value="<?php echo $fbpage_width; ?>" size="20"><?php _e(" ex: The pixel width of the embed (Min. 180 to Max. 500)" ); ?></p>
		<p><?php _e("Height: " ); ?><input type="number" name="fbpage_height" value="<?php echo $fbpage_height; ?>" size="20"><?php _e(" ex: The pixel height of the embed (Min. 70)" ); ?></p>
		<p><?php _e("Use Small Header: " ); ?><input type="checkbox" name="fbpage_small_header" 
		   <?php echo ($fbpage_small_header == 1) ? "checked" : "mndfdf"; ?>
		></p>
		<p><?php _e("Adapt to plugin container width: " ); ?><input type="checkbox" name="fbpage_contanair_width" <?php echo ($fbpage_contanair_width == 1) ? "checked" : ""; ?>></p>
		<p><?php _e("Hide Cover Photo: " ); ?><input type="checkbox" name="fbpage_hide_cover" 
		<?php echo ($fbpage_hide_cover== 1) ? "checked" : ""; ?> ></p>
		<p><?php _e("Show Friend's Faces: " ); ?><input type="checkbox" name="fbpage_show_friend" <?php echo ($fbpage_show_friend == 1) ? "checked" : ""; ?>></p>
		<p><?php _e("Show Page Posts: " ); ?><input type="checkbox" name="fbpage_show_post" <?php echo ($fbpage_show_post == 1) ? "checked" : ""; ?> ></p>
		<p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'fbpage_trdom' ) ?>" />
        </p>
    </form>
</div>