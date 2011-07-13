<p>Please login:</p>

<form method="post" action="<?=current_url()?>">

    <label for="login_username">Username</label>
    <input type="text" name="username" id="login_username">
    <?= form_error('username') ?>

    <label for="login_password">Password</label>
    <input type="password" name="password" id="lagin_password">
    <?= form_error('password') ?>
    
    <input type="submit" name="submit" value="Login">

</form>