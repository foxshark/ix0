<p>Please login:</p>

<form method="post" action="<?=current_url()?>" class="form">

    <section>
        <div class="form-line">
            <label for="login_username">Username <span class="note">Your email address.</span></label>
            <div class="form-input">
                <input type="text" name="username" id="login_username">
                <?= form_error('username') ?>
            </div>
        </div>
    
        <div class="form-line">
            <label for="login_password">Password</label>
            <div class="form-input">
                <input type="password" name="password" id="lagin_password">
                <?= form_error('password') ?>
            </div>
        </div>
	</section>
    
    <section class="form-save">
	    <button class="button">Login</button>
		<p><a href="<?=base_url()?>register">Or register</a>.</p>
	</section>
	
	

</form>