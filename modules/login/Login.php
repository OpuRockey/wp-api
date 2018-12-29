<?php

include_once LEGENDARY_KEYSTONE_ROOT . 'helpers/HtmlGenerator.php' ;

class Login {

    public $htmlGenerator ;

    public function __construct(){

        $this->htmlGenerator = new HtmlGenerator();
        // Below line is for just an example of record
        //add_action('init', array($this,'getLoginPage1'));
        add_shortcode('getLoginPage', array($this,'getLoginPage'));
    }

    public function getLoginPage($atts){

        $attributes = shortcode_atts( array(
            'wrapper_id' => 'keystone_login_wrapperId',
            'wrapper_class' => 'keystone_login_wrapperClass',
            'form_class' => 'keystone_login_form_class',
            'input_class' => 'input',
            'action_url' => get_site_url() .'/wp-login.php',
            'submit_id' => 'wp-submit',
            'redirect_to_value' => get_site_url() .'/wp-admin/',
        ), $atts );
        return $this->htmlGenerator->loginTemplate($attributes);
    }
}
