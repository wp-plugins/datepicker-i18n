<?php
/*
Plugin Name: Datepicker i18n
Plugin URI: 
Description: Pick the default language of Datepickers on your site.
Author: Dan Coulter
Version: 0.1
Author URI: http://dancoulter.com
*/

class dtc_DP_i18n {
	function getURL() {
		return  get_bloginfo('wpurl') . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/';
	}
	
	function getPath() {
		return dirname(__FILE__) . '/';
	}
	
	function localize($handles) {
		if ( get_option('datepicker-i18n') && in_array('jquery-ui-datepicker', $handles) ) {
			$handles[] = 'jquery-ui-datepicker-i18n';
		}
		return $handles;
	}
	
	function add_settings_page() {
		load_plugin_textdomain('dp-i18n', dtc_DP_i18n::getPath());
		add_options_page(__('Datepicker i18n', 'dp-i18n'), __('Datepicker i18n', 'dp-i18n'), 8, __FILE__, array('dtc_DP_i18n', 'settings_page'));
	}
	
	function settings_page() {
		$languages = array(
			'am' => __('Amharic [am]', 'dp-i18n'),
			'ar' => __('Arabic [ar]', 'dp-i18n'),
			'bg' => __('Bulgarian [bg]', 'dp-i18n'),
			'ca' => __('Catalan [ca]', 'dp-i18n'),
			'cs' => __('Czech [cs]', 'dp-i18n'),
			'da' => __('Danish [da]', 'dp-i18n'),
			'de' => __('German [de]', 'dp-i18n'),
			'es' => __('Spanish [es]', 'dp-i18n'),
			'fi' => __('Finnish [fi]', 'dp-i18n'),
			'fr' => __('French [fr]', 'dp-i18n'),
			'he' => __('Hebrew [he]', 'dp-i18n'),
			'hu' => __('Hungarian [hu]', 'dp-i18n'),
			'id' => __('Indonesian [id]', 'dp-i18n'),
			'is' => __('Icelandic [is]', 'dp-i18n'),
			'it' => __('Italian [it]', 'dp-i18n'),
			'ja' => __('Japanese [ja]', 'dp-i18n'),
			'ko' => __('Korean [ko]', 'dp-i18n'),
			'lt' => __('Lithuanian [lt]', 'dp-i18n'),
			'lv' => __('Latvian [lv]', 'dp-i18n'),
			'nl' => __('Dutch [nl]', 'dp-i18n'),
			'no' => __('Norwegian [no]', 'dp-i18n'),
			'pl' => __('Polish [pl]', 'dp-i18n'),
			'pt-BR' => __('Portuguese [pt-BR]', 'dp-i18n'),
			'ro' => __('Romanian [ro]', 'dp-i18n'),
			'ru' => __('Russian [ru]', 'dp-i18n'),
			'sk' => __('Slovak [sk]', 'dp-i18n'),
			'sv' => __('Swedish [sv]', 'dp-i18n'),
			'th' => __('Thai [th]', 'dp-i18n'),
			'tr' => __('Turkish [tr]', 'dp-i18n'),
			'uk' => __('Ukrainian [uk]', 'dp-i18n'),
			'zh-CN' => __('Chinese [zh-CN]', 'dp-i18n'),
			'zh-TW' => __('Chinese [zh-TW]', 'dp-i18n'),
		);
		?>
			<div class="wrap">
				<h2><?php _e('Datepicker i18n', 'dp-i18n') ?></h2>
				<form method="post" action="options.php">
					<input type="hidden" name="action" value="update" />
					<?php wp_nonce_field('update-options'); ?>
					<input type="hidden" name="page_options" value="datepicker-i18n" />
					<p>
						<?php _e('Select a localization:', 'dp-i18n') ?>
						<select name="datepicker-i18n">
							<?php foreach ( $languages as $code => $name ) : ?>
								<option value="<?php echo $code; ?>" <?php if ( get_option('datepicker-i18n') == $code ) echo 'selected="selected"'?>><?php echo $name; ?></option>
							<?php endforeach; ?>
						</select>
						
					</p>
					<p class="submit">
						<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
					</p>
				</form>
			</div>
		<?php
	}
}

if ( get_option('datepicker-i18n') ) {
	wp_register_script('jquery-ui-datepicker-i18n', dtc_DP_i18n::getURL() . 'i18n/ui.datepicker-' . get_option('datepicker-i18n') . '.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'), 1.5);
}

add_action('admin_menu', array('dtc_DP_i18n', 'add_settings_page'));
add_filter('print_scripts_array', array('dtc_DP_i18n', 'localize'));


?>