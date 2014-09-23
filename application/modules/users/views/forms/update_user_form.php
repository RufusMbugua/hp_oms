<?php 
echo form_open('users/update/'.$this->uri->segment(3)); ?>

  <div class="form-group">
    <label for="surname">Surname</label>
    <?php
      echo form_error('surname');
      $surname = array('class'=>'form-control', 'name'=>'surname', 'value'=>$user->surname);
      echo form_input($surname);
    ?>
  </div>
  <div class="form-group">
    <label for="other_names">Other Names</label>
    <?php
      echo form_error('other_names');
      $other_names = array('class'=>'form-control', 'name'=>'other_names', 'value'=>$user->other_names);
      echo form_input($other_names);
    ?>
  </div>
  <div class="form-group">
    <label for="gender">Gender</label>
    <?php echo form_error('gender'); ?>
    <select name="gender" class="form-control">
      <option value="">Select Gender</option>
      <option value="1" <?php if($user->gender === '1'){ echo 'selected'; } ?>>Male</option>
      <option value="2" <?php if($user->gender === '2'){ echo 'selected'; } ?>>Female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="birthday">Birthday</label>
    <?php
      echo form_error('birthday');
      $birthday = array('class'=>'form-control', 'name'=>'birthday', 'id'=>'datepicker', 'value'=>$user->birthday);
      echo form_input($birthday);
    ?>
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <?php
      echo form_error('phone');
      $phone = array('class'=>'form-control', 'name'=>'phone', 'value'=>$user->phone);
      echo form_input($phone);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="update_user_btn" value="Update User" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>

<script>
  $(function() {
    $('#datepicker').datepicker({
        endDate: "-18y",
        autoclose: true
    });
  });
</script>