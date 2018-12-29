<?php
/**
Plugin Name: Legendary Keystone
Plugin URI: https://www.projectalpha.com
Description: For managing WP module integration through Project Alpha CSL .
Author: Legendary Keystone
Version: 1.6
Author URI: https://www.projectalpha.com
*/

define('LEGENDARY_KEYSTONE_ROOT', plugin_dir_path(__FILE__));
define('LEGENDARY_KEYSTONE_ROOT_URL', plugin_dir_url( __FILE__ ));

error_reporting(0);

class LegendaryKeystone {


    public $login ;
    public $registration;


    public function __construct(){
        $this->actionCaller();
        $this->moduleLoader();
        $this->moduleCaller();
    }

    public function loadScripts(){
        wp_enqueue_style( 'legendary_keystone_style',  LEGENDARY_KEYSTONE_ROOT_URL .'assets/css/legendary_keystone_style.css' , array(), '1.0.0' );
        wp_enqueue_script( 'legendary_keystone_script', LEGENDARY_KEYSTONE_ROOT_URL . 'assets/js/legendary_keystone_script.js', array( 'jquery' ), '1.0.0', true );
    }

    public function moduleLoader(){
        spl_autoload_register(function($class){
            include_once LEGENDARY_KEYSTONE_ROOT .'modules/'. strtolower($class) .'/' . $class . '.php';
        });
    }

    public function moduleCaller(){
        $this->login = new Login();
        $this->registration = new Registration();
    }

    public function actionCaller(){
        add_action('wp_enqueue_scripts', array($this,'loadScripts'),9999);
    }

}


$legendarykeystone = new LegendaryKeystone();


