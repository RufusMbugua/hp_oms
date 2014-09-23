<?php echo form_open('users/forgot_password'); ?>

  <div class="form-group">
    <label for="email_address">Email</label>
    <?php
      echo form_error('email_address');
      $email_address = array('class'=>'form-control', 'name'=>'email_address', 'value'=>set_value('email_address'));
      echo form_input($email_address);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="forgot_password_btn" value="Reset Password" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>