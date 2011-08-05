<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<section>
	
	<?php if ($use_username) { ?>
	<div class="form-line">
		<?php echo form_label('Username', $username['id']); ?>
		<div class="form-input"><?php echo form_input($username); ?></div>
		<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
	</div>
	<?php } ?>
	<div class="form-line">
		<?php echo form_label('Email Address', $email['id']); ?>
		<div class="form-input"><?php echo form_input($email); ?></div>
		<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
	</div>
	<div class="form-line">
		<?php echo form_label('Password', $password['id']); ?>
		<div class="form-input"><?php echo form_password($password); ?></div>
		<?php echo form_error($password['name']); ?>
	</div>
	<div class="form-line">
		<?php echo form_label('Confirm Password', $confirm_password['id']); ?>
		<div class="form-input"><?php echo form_password($confirm_password); ?></div>
		<?php echo form_error($confirm_password['name']); ?>
	</div>

	<?php if ($captcha_registration) {
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
</section>
<section class="form-save">
	<?php echo form_submit('register', 'Register'); ?>
</section>
<?php echo form_close(); ?>