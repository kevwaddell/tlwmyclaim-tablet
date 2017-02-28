<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
		
		<div class="row">
		
			<div class="col-xs-6 col-xs-offset-3">
				<div class="form-group">
					<label for="user_login<?php $template->the_instance(); ?>"><?php
						if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
							_e( 'Username', 'theme-my-login' );
						} elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
							_e( 'E-mail', 'theme-my-login' );
						} else {
							_e( 'Username or E-mail', 'theme-my-login' );
						}
					?></label>
					<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input form-control input-lg" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
				</div>
				
				<div class="form-group">
					<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
					<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input form-control input-lg" value="" size="20" autocomplete="off" />
				</div>

		<?php do_action( 'login_form' ); ?>
				<div class="tml-rememberme-submit-wrap">
					<div class="form-group">
						 <div class="checkbox">
						 <label for="rememberme<?php $template->the_instance(); ?>" class="text-center">
							<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" /> <?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?>
							</label>
						 </div>
					</div>
				</div>
				
				<div class="form-group">
					<input type="submit" name="wp-submit" class="btn btn-block btn-lg" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
					<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
					<input type="hidden" name="action" value="login" />
				</div>
			
			</div>		
			
		</div>
		
	</form>
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<?php $template->the_action_links( array( 'login' => false ) ); ?>
			<a href="<?php echo get_option('home'); ?>/"><i class="fa fa-angle-double-left"></i> Return to home page</a>
		</div>
	</div>
</div>
