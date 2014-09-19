<div class="col-md-10 col-md-offset-1">
  <?php
    $create_group_response = $this->session->flashdata('login_response');
    echo $create_group_response;
    echo form_open('users/login', array('class'=>'form-horizontal', 'role'=>'form'));
  ?>
      <legend>Access Account</legend>
      <div class="form-group">
        <label for="email_address" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="email_address" value="<?php echo set_value('email_address'); ?>" placeholder="Enter Email">
          <?php echo form_error('email_address'); ?>
        </div>
      </div>
      <div class="form-group">
        <label for="account_password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="account_password" placeholder="Enter Password">
          <?php echo form_error('account_password'); ?>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" name="login_btn" value="Login" class="btn btn-primary">
        </div>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>