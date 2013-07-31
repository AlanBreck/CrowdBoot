<h2>Whoah!</h2>
<p>Hold on there, partner. You'll have to log in first.</p>

<form name="loginform" id="loginform" action="<?php echo site_url(); ?>/wp-login.php" method="post">
	<p class="login-username">
		<input type="text" name="log" id="user_login" class="input" placeholder="Email" value="" size="20" />
	</p>
	<p class="login-password">
		<input type="password" name="pwd" id="user_pass" class="input" placeholder="Password" value="" size="20" />
	</p>

	<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></p>
	<p class="login-submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" />
		<input type="hidden" name="redirect_to" value="<?php echo $redirect_url; ?>" />
	</p>
</form>

<h3>Don't have an account?</h3>
<p>Don't have an account yet? The Monkey can help – <a href="http://dev.crowdboot.com/log-in/">Register</a></p>