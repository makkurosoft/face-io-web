
<div class="container">
    <h1>Sign in</h1>
    <?php echo form_open("main/signin"); ?>
        <div class="form-group row">
            <label for="user_name" class="col-sm-2 col-form-label">ユーザ名</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="user_name">
            </div>
        </div>
        <div class="col-sm-5">
            <font color="#ff0000"><?php echo form_error('user_name'); ?></font>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">パスワード</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="col-sm-5">
            <font color="#ff0000"><?php echo form_error('password'); ?></font>
        </div>
        <div class="col-sm-5">
            <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
        </div>
        <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>
</div>
