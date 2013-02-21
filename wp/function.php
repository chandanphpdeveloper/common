class MySiteLogin
{
	
	function MySiteLogin()
	{
		add_action( 'login_form', 		array(&$this, 'my_site_login') );
		add_action( 'wp_logout', 		array(&$this, 'my_site_login') );
		
		add_action( 'login_button', 	array(&$this, 'my_site_login_button') );
		add_action( 'login_button_next',array(&$this, 'my_site_login_button_next') );
		add_filter( 'gettext', array(&$this,'wpse6096_gettext'), 10, 2 );  
		
		add_filter( 'gettext', array(&$this,'remove_lostpassword_text') );
		add_filter('login_errors',array(&$this,'login_error_message'));
		
	}

	function my_site_login()
	{
		wp_enqueue_script('wp-login-jquery', get_bloginfo('template_directory')   .'/js/jquery-1.8.3.min.js'); 
		wp_enqueue_script('wp-login-page', get_bloginfo('template_directory')   .'/js/login.js'); 
	?>
	
	<div id="login_accesscode" style="display:none; ">
	
		<p>
			<label for="user_pass"><?php _e('Access Code') ?><br />
			<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
		</p>
		<?php do_action('login_button_next'); ?>

	</div>
	<!----------------------/*Password field */----------------->
	<div id="login_companyname" style="display:none;">
		<p>
			<label for="user_login"><?php _e('Company Name') ?><br />
			<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" /></label>
		</p>
		<?php do_action('login_button'); ?>

	</div>
	<?php 
	}
	
	
	function my_site_login_button_next()
	{
	?>
	<input type="submit" name="wp-submit" id="wp-submit-next" class="button button-primary button-large" value="<?php esc_attr_e('Next'); ?>" />
	</p>
	<?php 
	
	}
	
	function my_site_login_button()
	{
	?>
	<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Log In'); ?>" />
	</p>
	
	<?php  
	}
	function wpse6096_gettext( $translation, $original )
	{
		if ( 'Username' == $original ) {
			return 'Company Name';
		}
		if ( 'Password' == $original ) {
			return 'Access Code';
		}
					
		
		return $translation;
	}
	
	
	function remove_lostpassword_text ( $text ) {
		if ($text == 'Lost your password?'){$text = '';}
		return $text;
	}
	



	function login_remember_me()
	{
		?>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" <?php checked( $rememberme ); ?> /> <?php esc_attr_e('Remember Me'); ?></label></p>
		
		<?php 
	
	}
	
	function login_error_message($error){
	
		//check if that's the error you are looking for
		$pos = strpos($error, 'incorrect');
		if ($pos === false) {
			//its the right error so you can overwrite it
			$error = "Invalid Credentials";
		}
		
		$pos = strpos($error, 'invalid_username');
		if ($pos === false) {
			//its the right error so you can overwrite it
			$error = "Invalid Credentials";
		}
		
		$pos = strpos($error, 'incorrect_password');
		if ($pos === false) {
			//its the right error so you can overwrite it
			$error = "Invalid Credentials";
		}
		
		$pos = strpos($error, 'empty_username');
		if ($pos === false) {
			//its the right error so you can overwrite it
			$error = "Invalid Credentials";
		}
		
		
		return $error;
}
	
}

$objMySite =  new MySiteLogin(); 