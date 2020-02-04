
<h1>Sign in</h1>
<?php echo form_open("main/signin_validation"); ?>

<div class="form-group row">
    <label for="user_name" class="col-sm-2 col-form-label">ユーザ名</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="user_name">
    </div>
    <?php echo form_error('user_name'); ?>
</div>
<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">パスワード</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="password">
    </div>
    <?php echo form_error('password'); ?>
</div>
<button type="submit" class="btn btn-primary">Sign in</button>
</form>
