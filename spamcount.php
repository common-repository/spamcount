<?php
/*
Plugin Name: SpamCount
Description: Use this little plugin to show the total spams caught by askismet.
Author: Simon Prosser
Version: 0.3
Plugin URI: http://www.pross.org.uk/wordpress-plugins/
Author URI: http://www.pross.org.uk
*/
function spamcount($text = 'spams caught since') {
if (function_exists(akismet_counter)) {
$count = number_format_i18n(get_option('akismet_spam_count'));
if ($text == 'number') {
		echo $count;
		} else {
		global $wpdb;
		$firstpost = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID >0 LIMIT 1");
		echo '<span id="spam_count">' . $count . ' ' . $text . ' ' . gmdate('M Y',strtotime($firstpost)) . '</span>';
		}
		
		} else { 
		echo "Error retrieving spam count. Check if you have <a href='http://akismet.com/'>Akismet</a> installed and enabled.";
		}
}
?>