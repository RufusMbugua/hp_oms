<?php echo form_open('users/create'); ?>

  <div class="form-group">
    <label for="surname">Surname</label>
    <?php
      echo form_error('surname');
      $surname = array('class'=>'form-control', 'name'=>'surname', 'value'=>set_value('surname'));
      echo form_input($surname);
    ?>
  </div>
  <div class="form-group">
    <label for="other_names">Other Names</label>
    <?php
      echo form_error('other_names');
      $other_names = array('class'=>'form-control', 'name'=>'other_names', 'value'=>set_value('other_names'));
      echo form_input($other_names);
    ?>
  </div>
  <div class="form-group">
    <label for="gender">Gender</label>
    <?php echo form_error('gender'); ?>
    <select name="gender" class="form-control">
      <option value="">Select Gender</option>
      <option value="1" <?php echo set_select('gender', '1'); ?>>Male</option>
      <option value="2" <?php echo set_select('gender', '2'); ?>>Female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="birthday">Birthday</label>
    <?php
      echo form_error('birthday');
      $birthday = array('class'=>'form-control', 'name'=>'birthday', 'id'=>'datepicker', 'value'=>set_value('birthday'));
      echo form_input($birthday);
    ?>
  </div>
  <div class="form-group">
    <label for="email_address">Email</label>
    <?php
      echo form_error('email_address');
      $email_address = array('class'=>'form-control', 'name'=>'email_address', 'value'=>set_value('email_address'));
      echo form_input($email_address);
    ?>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <?php
      echo form_error('phone');
      $phone = array('class'=>'form-control', 'name'=>'phone', 'value'=>set_value('phone'));
      echo form_input($phone);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="create_user_btn" value="Create User" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>

<script>
  $(function() {
    $('#datepicker').datepicker({
        endDate: "-18y",
        startView: 1,
        autoclose: true
    });
  });
</script>