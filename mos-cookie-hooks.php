<?php

if ($mos_cookie_options['mos_cookie_content'] && !@$_COOKIE["mos_cookie_notiece"]){
    add_action('wp_footer', 'mos_cookie_html_fnc');
}
function mos_cookie_html_fnc(){
    global $mos_cookie_options;
    ?>
    <div class="cookie-wrapper">
        <div class="cookie-d-flex">
            <div class="cookie-content-part">
                <?php echo $mos_cookie_options['mos_cookie_content'];?>
            </div>
            <div class="cookie-button-part">
                <button type="button" class="button button-primary button-mos-cookie"><?php echo isset( $mos_cookie_options['mos_cookie_button'] ) ? esc_html_e($mos_cookie_options['mos_cookie_button']) : 'OK';?></button>
            </div>
        </div>
    </div>
    <?php
}
/* AJAX action callback */
add_action( 'wp_ajax_set_mos_cookie', 'set_mos_cookie_ajax_callback' );
add_action( 'wp_ajax_nopriv_set_mos_cookie', 'set_mos_cookie_ajax_callback' );
/* Ajax Callback */
function set_mos_cookie_ajax_callback () {
    $days = $_POST['days'];
//    $output = array();
//	echo json_encode($output);
    $cookie_name = "mos_cookie_notiece";
    $cookie_value = 1;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    echo 1;
    exit; // required. to end AJAX request.
}