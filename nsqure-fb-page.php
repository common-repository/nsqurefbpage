<?php
/**
 * Plugin Name: FBPAGE
 * Plugin URI: http://www.jaishivshankar.com
 * Description: FBPAGE helps you to show your Facebook page on your website. 
	Add shortcode for display facebook page on your website.
	Use [fbpage] shortcode for display facebook page plugin in post.
	Use <?php echo do_shortcode('[fbpage]'); ?> code for add facebook page plugin in theme.
 * Version: 1.0.0
 * Author: Navjot Singh
 * Author URI: http://www.jaishivshankar.com
 * License: GPL2
 */
 add_action( 'wp_head', 'nsqure_fb_page' );
function nsqure_fb_page() {
   ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
}/**/
function fb_install () {
   global $wpdb;
   $table_name = $wpdb->prefix . "fblikebox"; 
   $charset_collate = $wpdb->get_charset_collate();

   $sql = "CREATE TABLE $table_name (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fbpage_url` varchar(256) NOT NULL,
  `fbpage_width` int(10) NOT NULL,
  `fbpage_height` int(10) NOT NULL,
  `fbpage_small_header` int(10) NOT NULL DEFAULT '0',
  `fbpage_contanair_width` int(10) DEFAULT '0',
  `fbpage_hide_cover` int(10) NOT NULL DEFAULT '0',
  `fbpage_show_friend` int(10) NOT NULL DEFAULT '0',
  `fbpage_show_post` int(10) NOT NULL DEFAULT '0',
   PRIMARY KEY (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'fb_install' );
function nsqure_fb_page_form() {
    include('fb-config.php');
}
function nsqure_fb_page_actions() {
    add_options_page("My Facebook Page", "My Facebook Page", 1, "My_Facebook_Page", "nsqure_fb_page_form");
}
function nsqurefbpage() {
	global $wpdb;
	$table_name = $wpdb->prefix . "fblikebox";
	$myrows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name where id=%d",1 ));
	if(sizeof($myrows) > 0){
	$fbpage_url = ($myrows[0]->fbpage_url) ? $myrows[0]->fbpage_url :"";
	$fbpage_width = ($myrows[0]->fbpage_width > 0) ? $myrows[0]->fbpage_width :"";
	$fbpage_height = ($myrows[0]->fbpage_height > 0) ? $myrows[0]->fbpage_height :"";
	$fbpage_small_header = ($myrows[0]->fbpage_small_header == 1) ? "true" :"false";
	$fbpage_contanair_width = ($myrows[0]->fbpage_contanair_width == 1) ? "true" :"false";
	$fbpage_hide_cover = ($myrows[0]->fbpage_hide_cover == 1) ? "true" :"false";
	$fbpage_show_friend = ($myrows[0]->fbpage_show_friend == 1) ? "true" :"false";
	$fbpage_show_post = ($myrows[0]->fbpage_show_post == 1) ? "true" :"false";
	return '<div class="fb-page" data-href="'.$fbpage_url.'" data-width="'.$fbpage_width.'" data-height="'.$fbpage_height.'" data-small-header="'.$fbpage_small_header.'" data-adapt-container-width="'.$fbpage_contanair_width.'" data-hide-cover="'.$fbpage_hide_cover.'" data-show-facepile="'.$fbpage_show_friend.'" data-show-posts="'.$fbpage_show_post.'"><div class="fb-xfbml-parse-ignore"><blockquote cite="'.$fbpage_url.'"><a href="'.$fbpage_url.'">Facebook</a></blockquote></div></div>';
	}
}
add_shortcode( 'fbpage' , 'nsqurefbpage' );
add_action('admin_menu', 'nsqure_fb_page_actions');