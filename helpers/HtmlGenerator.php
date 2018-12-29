<?php

class HtmlGenerator {

    public function __construct(){

    }

    public function loginTemplate($attributes){
        return
            '<div class="keystone_login '. $attributes['wrapper_class'] .'" id="'. $attributes['wrapper_id'] .'">
                <form onsubmit="event.preventDefault();" enctype="multipart/form-data" method="POST" action="'. $attributes['action_url'] .'" class="'. $attributes['form_class'] .'"  id="keystone_login_form">
                    <p>
                        <label for="user_login">* Email Address<br />
                        <input required type="text" name="log" id="user_login_email"  class="log_input '. $attributes['input_class'] .'"  value="" size="20" /></label>
                    </p>
                    <p>
                        <label for="user_pass">* Password<br />
                        <input required type="password" name="pwd" id="user_login_pass"  class="log_input '. $attributes['input_class'] .'" value="" size="20" /></label>
                    </p>
                        <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></p>
                    <p class="submit">
                        <input onclick="lkb.makeLogin()" type="submit" name="wp-submit" id="'. $attributes['submit_id'] .'" class="button button-primary button-large" value="Log In" />
                        <input type="hidden" name="redirect_to" value="'. $attributes['redirect_to_value'] .'" />
                        <input type="hidden" name="testcookie" value="1" />
                    </p>
                </form>
            </div>
            <div id="login_validation"></div>' ;
    }

    public function registrationTemplate($attributes){
        return
            '<div class="keystone_registration '. $attributes['wrapper_class'] .'" id="'. $attributes['wrapper_id'] .'">
                <form enctype="multipart/form-data" method="POST" action="'. $attributes['action_url'] .'" class="'. $attributes['form_class'] .'"  id="keystone_registration_form" onsubmit="event.preventDefault();">
                <input type="hidden" name="registration_form" value="registration_form" />
                    <p>
                        <label for="user_login">* Username<br />
                        <input required type="text" name="log" id="log"  class="reg_input '. $attributes['input_class'] .'"  value="" size="20" /></label>
                    </p>

                    <p>
                        <label for="user_email">* Email Address<br />
                        <input required type="email" name="user_email" id="user_email"  class="reg_input '. $attributes['input_class'] .'"  value="" size="20" /></label>
                    </p>

                    <p>
                        <label for="user_firstname">* First Name<br />
                        <input required type="text" name="user_firstname" id="user_firstname" class="reg_input '. $attributes['input_class'] .'"  value="" size="20" /></label>
                    </p>

                    <p>
                        <label for="user_lastname">* Last Name<br />
                        <input required type="text" name="user_lastname" id="user_lastname"  class="reg_input '. $attributes['input_class'] .'"  value="" size="20" /></label>
                    </p>

                    <p>
                        <label for="user_pass">* Password<br />
                        <input required type="password" name="pwd" id="pwd"  class="reg_input '. $attributes['input_class'] .'" value="" size="20" /></label>
                    </p>

                     <p>
                        <label for="user_pass_confirm">* Confirm Password<br />
                        <input required type="password" name="user_pass_confirm" id="user_pass_confirm"  class="reg_input '. $attributes['input_class'] .'" value="" size="20" /></label>
                    </p>
                        <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> RECEIVE UPDATES FROM THE NERDIST.COM</label></p>
                    <p class="submit">
                        <input onclick="lkb.makeRegistration()" type="submit" name="wp-submit" id="'. $attributes['submit_id'] .'" class="button button-primary button-large" value="Registration" />
                        <input type="hidden" name="redirect_to" value="'. $attributes['redirect_to_value'] .'" />
                        <input type="hidden" name="testcookie" value="1" />
                    </p>
                </form>
            </div>
            <div id="registration_validation"></div>' ;
    }

}