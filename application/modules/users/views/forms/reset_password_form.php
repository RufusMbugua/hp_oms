<?php echo form_open('users/reset_password/'.$this->uri->segment(3)); ?>

  <div class="form-group">
    <label for="new_password">New Password</label>
    <input type="password" class="form-control" name="new_password">
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" class="form-control" name="confirm_password">
  </div>
  <div class="form-group">
    <input type="submit" name="reset_password_btn" value="Reset Password" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>