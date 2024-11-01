<?php 
/* Plugin Name: WP Start bar
Plugin URI:http://plugins.phploaded.com/startb
Description: This plugin creates a start bar similar to what we have in operating systems. We can add, remove edit links and show all pages in site.
Author: Satish Kumar Sharma
Version: 1.0
Author URI: http://phploaded.com/index.php?user=23
*/

function wpstart_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function register_wpstartbar_options(){
register_setting( 'wpstartbar-options', 'position' );
register_setting( 'wpstartbar-options', 'nouser-name' );
register_setting( 'wpstartbar-options', 'allpgm' );
register_setting( 'wpstartbar-options', 'starttext' );
register_setting( 'wpstartbar-options', 'skin' );
register_setting( 'wpstartbar-options', 'btnskin' );
}

add_action( 'admin_init', 'register_wpstartbar_options' );

function wpstartbar_activate(){
mysql_query("CREATE TABLE IF NOT EXISTS `wp_startbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) DEFAULT NULL,
  `link` varchar(5000) DEFAULT NULL,
  `logo` varchar(5000) DEFAULT NULL,
  `cat` varchar(100) DEFAULT NULL,
  `target` varchar(10) NOT NULL,
  `pos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31");
}
register_activation_hook( __FILE__, 'wpstartbar_activate' );

define('wpstartbarPATH', dirname(__FILE__).'/');
define('wpstartbarURL', plugins_url( '/', __FILE__ ));


function include_wpstartbar_setting_page(){
include('wpstartbar-settings.php');
}

function include_wpstartbar_manage_page(){
include('wpstartbar-manage.php');
}

function include_wpstartbar_newicon_page(){
include('wpstartbar-addicon.php');
}

function wpstartbar_admin_actions() {  
add_menu_page('WP Start Bar', 'WP Start Bar',0,'wpstartbar-manage.php', 'include_wpstartbar_manage_page',plugins_url( 'images/icon.png', __FILE__ ),690); 
add_submenu_page( 'wpstartbar-manage.php', 'Add new icon', 'Add new icon', 0, 'wpstartbar-addicon.php', 'include_wpstartbar_newicon_page' );
add_submenu_page( 'wpstartbar-manage.php', 'Settings', 'Settings', 0, 'wpstartbar-settings.php', 'include_wpstartbar_setting_page' );
}  

add_action('admin_menu', 'wpstartbar_admin_actions');


function init_wpstartbar_files() {
wp_enqueue_script( 'jquery' );
wp_register_script( 'wpstartbarjs', plugins_url( 'js/custom.js', __FILE__ ));
wp_enqueue_script( 'wpstartbarjs' );
wp_register_style( 'wpstartbaracss', plugins_url( 'css/style.css', __FILE__ ));
wp_enqueue_style( 'wpstartbaracss' );

}

function init_wpstartbar_admin() {
wp_enqueue_script( 'jquery' );
wp_register_script( 'wpstartbarajs', plugins_url( 'js/admin.js', __FILE__ ));
wp_enqueue_script( 'wpstartbarajs' );
wp_register_style( 'wpstartbaracss', plugins_url( 'css/admin.css', __FILE__ ));
wp_enqueue_style( 'wpstartbaracss' );
wp_enqueue_media();
}

function wpstartbar_clean($data){
$data = htmlentities($data, ENT_COMPAT, "UTF-8");
return $data;
}

function wpstartbar_footer(){
$wpstartbar_user = wp_get_current_user();
if($wpstartbar_user->ID == 0){
$name = get_option('nouser-name');
$logintext = '<a href="'.wp_login_url(wpstart_url()).'"><img alt="" src="'.plugins_url( 'images/icons/login.png', __FILE__ ).'" />log-in</a>
<a href="'.wp_registration_url().'"><img alt="" src="'.plugins_url( 'images/icons/reg.png', __FILE__ ).'" />register</a>';
} else {
$name = $wpstartbar_user->user_nicename;
$logintext = '<a href="'.wp_logout_url(wpstart_url()).'"><img alt="" src="'.plugins_url( 'images/icons/exit.png', __FILE__ ).'" />logout</a>
<a href="'.get_bloginfo( 'url').'/wp-admin/user-edit.php?user_id='.$wpstartbar_user->ID.'#password"><img alt="" src="'.plugins_url( 'images/icons/pwd.png', __FILE__ ).'" />change password</a>';
}


$args = array(
	'depth'        => 0,
	'show_date'    => '',
	'date_format'  => get_option('date_format'),
	'child_of'     => 0,
	'exclude'      => '',
	'include'      => '',
	'title_li'     => '',
	'echo'         => false,
	'authors'      => '',
	'sort_column'  => 'menu_order, post_title',
	'link_before'  => '',
	'link_after'   => '',
	'walker'       => '',
	'post_type'    => 'page',
    'post_status'  => 'publish' 
);

$ldata = '';	
$lqry = mysql_query("SELECT * FROM `wp_startbar` WHERE `cat` = 'StartBar left links' ORDER BY `pos` ASC");
while($row = mysql_fetch_assoc($lqry)){
if($row['logo']==''){$img = plugins_url( 'images/icons/noimage.jpg', __FILE__ );} else {$img = $row['logo'];}
$ldata = $ldata.'<li><a target="'.$row['target'].'" href="'.$row['link'].'"><img alt="" src="'.$img.'" />'.$row['text'].'</a></li>';
}


$rdata = '';	
$uict=0;
$lqry = mysql_query("SELECT * FROM `wp_startbar` WHERE `cat` = 'StartBar right links' ORDER BY `pos` ASC");
while($row = mysql_fetch_assoc($lqry)){
if($row['logo']==''){$img = plugins_url( 'images/icons/noimage.jpg', __FILE__ );} else {$img = $row['logo'];}
if($uict==3){$uict=-1; $uclass=' class="start-line"'; } else { $uclass=''; }
$rdata = $rdata.'<li'.$uclass.'><a target="'.$row['target'].'" href="'.$row['link'].'"><img alt="" src="'.$img.'" />'.$row['text'].'</a></li>';
++$uict;
}

$mdata = '';	
$lqry = mysql_query("SELECT * FROM `wp_startbar` WHERE `cat` = 'Links on bar' ORDER BY `pos` ASC");
while($row = mysql_fetch_assoc($lqry)){
if($row['logo']==''){$img = plugins_url( 'images/icons/noimage.jpg', __FILE__ );} else {$img = $row['logo'];}
$mdata = $mdata.'<li><a target="'.$row['target'].'" alt="'.$row['text'].'" title="'.$row['text'].'" href="'.$row['link'].'"><img alt="" src="'.$img.'" /></a></li>';
}


echo'<div class="sc-taskbar '.get_option('position').' '.get_option('skin').' '.get_option('btnskin').'">
<a class="start" href="javascript:void(0)">'.get_option('starttext', 'Start').'</a>
<div class="start-back-bg"></div>

<div class="start-menu">
<div class="start-user">
<div class="start-uimg">'.get_avatar( $wpstartbar_user->ID, 100 ).'</div>
<h2>'.$name.'</h2>
<div style="clear:both;"></div>
</div>

<ul class="start-left">
'.$ldata.'
<hr />
<div class="start-bmk">
<a class="start-bmk-init" href="javascript:void(0)">'.get_option('allpgm', 'Site Navigation').'</a>
</div>
</ul>

<ul class="start-right">
'.$rdata.'

<ul class="start-pgm">'.wp_list_pages( $args ).'</ul>

</ul>

<div class="start-options">
'.$logintext.'
</div>

</div>

<div class="startbar-find">
<form role="search" method="get" id="searchform" action="'.home_url( '/' ).'">
<input type="text" value="" placeholder="Type then press Enter to Search" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Search" />
</form>
</div>

<div class="clock"></div>

<ul class="startbar-mini">'.$mdata.'</ul>


</div>';
}

add_action('wp_enqueue_scripts', 'init_wpstartbar_files');
add_action('admin_print_scripts', 'init_wpstartbar_admin');
add_action('wp_footer', 'wpstartbar_footer',1);
?>