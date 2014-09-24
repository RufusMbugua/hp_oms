<?php
echo form_open('groups/manage/'.$group->id.'/update'); ?>

  <div class="form-group">
    <label for="group_name">Group Name</label>
    <?php
      echo form_error('group_name');
      $group_name = array('class'=>'form-control', 'name'=>'group_name', 'value'=>$group->name);
      echo form_input($group_name);
    ?>
  </div>
  <div class="form-group">
    <label for="group_description">Group Description</label>
    <?php
      echo form_error('group_description');
      $group_description = array('class'=>'form-control', 'name'=>'group_description', 'value'=>$group->description, 'rows'=>'5');
      echo form_textarea($group_description);
    ?>
  </div>
  <div class="form-group">
    <input type="submit" name="update_group_btn" value="Update Group" class="btn btn-primary">
  </div>

<?php echo form_close();
?>

