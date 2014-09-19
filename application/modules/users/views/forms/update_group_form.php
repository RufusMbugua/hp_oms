<div class="col-md-10 col-md-offset-1">
  <?php
    if(is_array($group_info)){
      foreach($group_info as $group){
          $update_group_response = $this->session->flashdata('update_group_response');
          echo $update_group_response;
          echo form_open('users/update_group/'.$group->id, array('class'=>'form-horizontal', 'role'=>'form'));
        ?>
          <legend>Update Group</legend>
          <div class="form-group">
            <label for="group_name" class="col-sm-2 control-label">Group Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="group_name" value="<?php echo $group->name; ?>" placeholder="Enter Group Name">
              <?php echo form_error('group_name'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="group_description" class="col-sm-2 control-label">Group Description</label>
            <div class="col-sm-10">
              <textarea name="group_description" class="form-control" rows="4" placeholder="Enter Group Description"><?php echo $group->description; ?></textarea>
              <?php echo form_error('group_description'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="update_group_btn" value="Create Group" class="btn btn-primary">
            </div>
          </div>
        <?php 
        echo form_close();
      }
    }else{
      ?>
      <p class="text-danger">Could not get group information.</p>
      <?php
    }
    ?>
  </div>
</div>

