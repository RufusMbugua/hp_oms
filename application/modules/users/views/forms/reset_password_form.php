<?php echo form_open('users/reset_password/'.$this->uri->segment(3)); ?>

  <div class="form-group">
    <label for="new_password">New Password</label>
    <?php
      echo form_error('new_password');
      $new_password = array('class'=>'form-control', 'name'=>'new_password', 'value'=>set_value('new_password'));
      echo form_password($new_password);
    ?>
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <?php
      echo form_error('confirm_password');
      $confirm_password = array('class'=>'form-control', 'name'=>'confirm_password');
      echo form_password($confirm_password);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="reset_password_btn" value="Reset Password" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>