<?php echo form_open('users/login'); ?>

  <div class="form-group">
    <label for="email_address">Email</label>
    <?php
      echo form_error('email_address');
      $email_address = array('class'=>'form-control', 'name'=>'email_address', 'value'=>set_value('email_address'));
      echo form_input($email_address);
    ?>
  </div>
  <div class="form-group">
    <label for="account_password">Password</label>
    <?php
      echo form_error('account_password');
      $account_password = array('class'=>'form-control', 'name'=>'account_password');
      echo form_password($account_password);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="login_user_btn" value="Login" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>