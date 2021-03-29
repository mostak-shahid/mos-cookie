<?php
function mos_cookie_settings_init() {
	register_setting( 'mos_cookie', 'mos_cookie_options' );
	add_settings_section('mos_cookie_section_top_nav', '', 'mos_cookie_section_top_nav_cb', 'mos_cookie');
	add_settings_section('mos_cookie_section_dash_start', '', 'mos_cookie_section_dash_start_cb', 'mos_cookie');   
    
    add_settings_field( 'field_content', __( 'Content', 'mos_cookie' ), 'mos_cookie_field_content_cb', 'mos_cookie', 'mos_cookie_section_dash_start', [ 'label_for' => 'mos_cookie_content' ] );
    add_settings_field( 'field_button', __( 'Button Text', 'mos_cookie' ), 'mos_cookie_field_button_cb', 'mos_cookie', 'mos_cookie_section_dash_start', [ 'label_for' => 'mos_cookie_button' ] );
    
	add_settings_section('mos_cookie_section_dash_end', '', 'mos_cookie_section_end_cb', 'mos_cookie');
	
	add_settings_section('mos_cookie_section_scripts_start', '', 'mos_cookie_section_scripts_start_cb', 'mos_cookie');    
    add_settings_field( 'field_css', __( 'Custom Css', 'mos_cookie' ), 'mos_cookie_field_css_cb', 'mos_cookie', 'mos_cookie_section_scripts_start', [ 'label_for' => 'mos_cookie_css' ] );
	add_settings_field( 'field_js', __( 'Custom Js', 'mos_cookie' ), 'mos_cookie_field_js_cb', 'mos_cookie', 'mos_cookie_section_scripts_start', [ 'label_for' => 'mos_cookie_js' ] );
	add_settings_section('mos_cookie_section_scripts_end', '', 'mos_cookie_section_end_cb', 'mos_cookie');

}
add_action( 'admin_init', 'mos_cookie_settings_init' );

function get_mos_cookie_active_tab () {
	$output = array(
		'option_prefix' => admin_url() . "/options-general.php?page=mos_cookie_settings&tab=",
		//'option_prefix' => "?post_type=p_file&page=mos_cookie_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function mos_cookie_section_top_nav_cb( $args ) {
	$data = get_mos_cookie_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function mos_cookie_section_dash_start_cb( $args ) {
	$data = get_mos_cookie_active_tab ();
    global $mos_cookie_options;
	?>
	<div id="mos-cookie-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php //var_dump($mos_cookie_options) ?>

	<?php
}
function mos_cookie_field_content_cb( $args ) {
	global $mos_cookie_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>">
	<textarea name="mos_cookie_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mos_cookie_options[ $args['label_for'] ] ) ? esc_html_e($mos_cookie_options[$args['label_for']]) : '';?></textarea>
	<?php
}
function mos_cookie_field_button_cb( $args ) {
	global $mos_cookie_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>">
	<input name="mos_cookie_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="full-input" value="<?php echo isset( $mos_cookie_options[ $args['label_for'] ] ) ? esc_html_e($mos_cookie_options[$args['label_for']]) : 'OK';?>" />
	<?php
}
function mos_cookie_section_scripts_start_cb( $args ) {
	$data = get_mos_cookie_active_tab ();
	?>
	<div id="mos-cookie-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function mos_cookie_field_css_cb( $args ) {
	global $mos_cookie_options;
	?>
	<textarea name="mos_cookie_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mos_cookie_options[ $args['label_for'] ] ) ? esc_html_e($mos_cookie_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_cookie_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_cookie_field_js_cb( $args ) {
	global $mos_cookie_options;
	?>
	<textarea name="mos_cookie_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $mos_cookie_options[ $args['label_for'] ] ) ? esc_html_e($mos_cookie_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("mos_cookie_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function mos_cookie_section_end_cb( $args ) {
	$data = get_mos_cookie_active_tab ();
	?>
	</div>
	<?php
}


function mos_cookie_options_page() {
	//add_menu_page( 'WPOrg', 'WPOrg Options', 'manage_options', 'mos_cookie', 'mos_cookie_options_page_html' );
	add_submenu_page( 'options-general.php', 'Settings', 'Cookie Settings', 'manage_options', 'mos_cookie_settings', 'mos_cookie_admin_page' );
}
add_action( 'admin_menu', 'mos_cookie_options_page' );

function mos_cookie_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_cookie_messages', 'mos_cookie_message', __( 'Settings Saved', 'mos_cookie' ), 'updated' );
	}
	settings_errors( 'mos_cookie_messages' );
	?>
	<div class="wrap mos-cookie-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'mos_cookie' );
		do_settings_sections( 'mos_cookie' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}