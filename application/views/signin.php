
<h1>Sign in</h1>

<?php echo form_open("main/signin_validation"); ?>

<h5>ユーザ名</h5>
<input type="text" name="user_name" value="<?php echo set_value('user_name'); ?>" size="30" />
<?php echo form_error('user_name'); ?>

<h5>パスワード</h5>
<input type="password" name="password" value=""; size="30" />
<?php echo form_error('password'); ?>

<div>
    <input type="submit" value="Sign in" />
</div>
</form>
