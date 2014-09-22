<?php echo form_open('groups/create'); ?>

  <div class="form-group">
    <label for="group_name">Group Name</label>
    <input type="text" class="form-control" name="group_name">
  </div>
  <div class="form-group">
    <label for="group_description">Group Description</label>
    <textarea name="group_description" class="form-control" rows="5"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="create_group_btn" value="Create Group" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>