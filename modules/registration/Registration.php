<?php

include_once LEGENDARY_KEYSTONE_ROOT . 'helpers/HtmlGenerator.php' ;

class Registration {

    public $htmlGenerator ;

    public function __construct(){
        $this->htmlGenerator = new HtmlGenerator();
        add_shortcode('getRegistrationPage', array($this,'getRegistrationPage'));
        add_action('init', array($this,'makeRegistration'));
    }

    public function getRegistrationPage($atts){

        $attributes = shortcode_atts( array(
            'wrapper_id' => 'keystone_registration_wrapperId',
            'wrapper_class' => 'keystone_registration_wrapperClass',
            'form_class' => 'keystone_registration_form_class',
            'input_class' => 'input',
            'action_url' => '',
            'submit_id' => 'wp-submit',
            'redirect_to_value' => get_site_url() ,
        ), $atts );
        return $this->htmlGenerator->registrationTemplate($attributes);
    }

    public function makeRegistration(){
        if($_POST){
            if($_POST['registration_form'] == 'registration_form'){
                $username = sanitize_text_field($_POST['log']);
                $email = sanitize_text_field($_POST['user_email']);
                $user_firstname = sanitize_text_field($_POST['user_firstname']);
                $user_lastname = sanitize_text_field($_POST['user_lastname']);
                $pwd = sanitize_text_field($_POST['pwd']);
                $user_pass_confirm = sanitize_text_field($_POST['user_pass_confirm']);

                if($pwd == $user_pass_confirm){
                    $password = $pwd ;
                }

                $userdata = array(
                    'user_login'  =>  $username,
                    'first_name'    =>  $user_firstname,
                    'user_pass'   =>  $password ,
                    'last_name'  =>  $user_lastname,
                    'user_email'    =>  $email,
                );

                $user_id = wp_insert_user( $userdata ) ;
                //On success
                if ( ! is_wp_error( $user_id ) ) {
                    wp_redirect($_POST['redirect_to']);
                    exit;
                }
            }
        }
    }
}