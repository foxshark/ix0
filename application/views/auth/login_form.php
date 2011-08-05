<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>

<section>
	<div class="form-line">
		<?php echo form_label($login_label, $login['id']); ?>
		<div class="form-input"><?php echo form_input($login); ?></div>
		<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
	</div>
	<div class="form-line">
		<?php echo form_label('Password', $password['id']); ?>
		<div class="form-input"><?php echo form_password($password); ?></div>
		<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
	</div>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<div class="form-line">
		<div class="form-input">
			<div id="recaptcha_image"></div>
		</div>
		<div class="form-input">
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</div>
	</div>
	<div class="form-line">
		<div class="form-input">
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</div>
		<div class="form-input"><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></div>
		<?php echo form_error('recaptcha_response_field'); ?>
		<?php echo $recaptcha_html; ?>
	</div>
	<?php } else { ?>
	<div class="form-line">
		<div class="form-input">
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</div>
	</div>
	<div class="form-line">
		<?php echo form_label('Confirmation Code', $captcha['id']); ?>
		<div class="form-input"><?php echo form_input($captcha); ?></div>
		<?php echo form_error($captcha['name']); ?>
	</div>
	<?php }
	} ?>

	<div class="form-line">
		<div class="form-input">
			<?php echo form_checkbox($remember); ?>
			<?php echo form_label('Remember me', $remember['id']); ?>
			<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>
		</div>
	</div>
</section>
<section class="form-save">
	<?php echo form_submit('submit', 'Let me in'); ?>
</section>
<?php echo form_close(); ?>