<?php
foreach($group_info as $group){
  echo form_open('groups/update/'.$this->uri->segment(3)); ?>

    <div class="form-group">
      <label for="group_name">Group Name</label>
      <input type="text" class="form-control" name="group_name" value="<?php echo $group->name; ?>">
    </div>
    <div class="form-group">
      <label for="group_description">Group Description</label>
      <textarea name="group_description" class="form-control" rows="5"><?php echo $group->description; ?></textarea>
    </div>
    <div class="form-group">
      <input type="submit" name="update_group_btn" value="Update Group" class="btn btn-primary">
    </div>

  <?php echo form_close();
}
?>

