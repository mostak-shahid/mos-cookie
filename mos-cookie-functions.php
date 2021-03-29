<?php
function mos_cookie_admin_enqueue_scripts(){
	$page = @$_GET['page'];
	global $pagenow, $typenow;
	/*var_dump($pagenow); //options-general.php(If under settings)/edit.php(If under post type)
	var_dump($typenow); //post type(If under post type)
	var_dump($page); //mos_cookie_settings(If under settings)*/
	
	if ($pagenow == 'options-general.php' AND $page == 'mos_cookie_settings') {
		wp_enqueue_style( 'mos-cookie-admin', plugins_url( 'css/mos-cookie-admin.css', __FILE__ ) );

		//wp_enqueue_media();

		wp_enqueue_script( 'jquery' );
		
		/*Editor*/
		//wp_enqueue_style( 'docs', plugins_url( 'plugins/codemirror/doc/docs.css', __FILE__ ) );
		wp_enqueue_style( 'codemirror', plugins_url( 'plugins/codemirror/lib/codemirror.css', __FILE__ ) );
		wp_enqueue_style( 'show-hint', plugins_url( 'plugins/codemirror/addon/hint/show-hint.css', __FILE__ ) );

		wp_enqueue_script( 'codemirror', plugins_url( 'plugins/codemirror/lib/codemirror.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css', plugins_url( 'plugins/codemirror/mode/css/css.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript', plugins_url( 'plugins/codemirror/mode/javascript/javascript.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'show-hint', plugins_url( 'plugins/codemirror/addon/hint/show-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'css-hint', plugins_url( 'plugins/codemirror/addon/hint/css-hint.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'javascript-hint', plugins_url( 'plugins/codemirror/addon/hint/javascript-hint.js', __FILE__ ), array('jquery') );
		/*Editor*/

		wp_enqueue_script( 'mos-cookie-functions', plugins_url( 'js/mos-cookie-functions.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'mos-cookie-admin', plugins_url( 'js/mos-cookie-admin.js', __FILE__ ), array('jquery') );
	}

}
add_action( 'admin_enqueue_scripts', 'mos_cookie_admin_enqueue_scripts' );
function mos_cookie_enqueue_scripts(){
	global $mos_cookie_option;
	wp_enqueue_style( 'mos-cookie', plugins_url( 'css/mos-cookie.css', __FILE__ ) );
	wp_enqueue_script( 'mos-cookie-functions', plugins_url( 'js/mos-cookie-functions.js', __FILE__ ), array('jquery') );
	wp_enqueue_script( 'mos-cookie', plugins_url( 'js/mos-cookie.js', __FILE__ ), array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'mos_cookie_enqueue_scripts' );
function mos_cookie_ajax_scripts(){
	wp_enqueue_script( 'mos-cookie-ajax', plugins_url( 'js/mos-cookie-ajax.js', __FILE__ ), array('jquery') );
	$ajax_params = array(
		'ajax_url' => admin_url('admin-ajax.php'),
		//'ajax_nonce' => wp_create_nonce('mos_cookie_verify'),
	);
	wp_localize_script( 'mos-cookie-ajax', 'ajax_obj', $ajax_params );
}
add_action( 'wp_enqueue_scripts', 'mos_cookie_ajax_scripts' );
add_action( 'admin_enqueue_scripts', 'mos_cookie_ajax_scripts' );
function mos_cookie_scripts() {
	global $mos_cookie_options;
	if (@$mos_cookie_options['mos_cookie_css']) {
		?>
		<style>
			<?php echo $mos_cookie_options['mos_cookie_css'] ?>
		</style>
		<?php
	}
	if (@$mos_cookie_options['mos_cookie_js']) {
		?>
		<style>
			<?php echo $mos_cookie_options['mos_cookie_js'] ?>
		</style>
		<?php
	}
}
add_action( 'wp_footer', 'mos_cookie_scripts', 100 );