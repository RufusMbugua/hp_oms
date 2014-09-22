<?php echo form_open('users/update/'.$this->uri->segment(3)); ?>

  <div class="form-group">
    <label for="surname">Surname</label>
    <input type="text" class="form-control" name="surname" value="<?php echo $user->surname; ?>">
  </div>
  <div class="form-group">
    <label for="other_names">Other Names</label>
    <input type="text" class="form-control" name="other_names" value="<?php echo $user->other_names; ?>">
  </div>
  <div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" class="form-control">
      <option value="">Select Gender</option>
      <option value="1">Male</option>
      <option value="2">Female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="birthday">Birthday</label>
    <input type="text" class="form-control" name="birthday" value="<?php echo $user->birthday; ?>">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" name="phone" value="<?php echo $user->phone; ?>">
  </div>
  <div class="form-group">
    <input type="submit" name="update_user_btn" value="Update User" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>