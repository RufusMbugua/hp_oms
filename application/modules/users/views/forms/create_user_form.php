<?php echo form_open('users/create'); ?>

  <div class="form-group">
    <label for="surname">Surname</label>
    <input type="text" class="form-control" name="surname">
  </div>
  <div class="form-group">
    <label for="other_names">Other Names</label>
    <input type="text" class="form-control" name="other_names">
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
    <input type="text" class="form-control" name="birthday">
  </div>
  <div class="form-group">
    <label for="email_address">Email</label>
    <input type="text" class="form-control" name="email_address">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" name="phone">
  </div>
  <div class="form-group">
    <input type="submit" name="create_user_btn" value="Create User" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>