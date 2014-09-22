<?php echo form_open('users/login'); ?>

  <div class="form-group">
    <label for="email_address">Email</label>
    <input type="text" class="form-control" name="email_address">
  </div>
  <div class="form-group">
    <label for="account_password">Password</label>
    <input type="password" class="form-control" name="account_password">
  </div>
  <div class="form-group">
    <input type="submit" name="login_user_btn" value="Login" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>