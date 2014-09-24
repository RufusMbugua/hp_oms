<?php echo form_open('users/manage/'.$user->user_id.'/add_to_group'); ?>

  <div class="form-group">
    <p class="help-block">Assign <b><?php echo $user->surname.' '.$user->other_names; ?></b> to a group.</p>
    <label for="group_id">Group</label>
    <select name="group_id" class="form-control">
      <option value="">Select Group</option>
      <?php
      if(is_array($groups_info))
      {
        foreach($groups_info as $group)
        {
          echo '<option value="'.$group->id.'">'.$group->name.'</option>';
        }
      }      
      ?>
    </select>
  </div>
  <div class="form-group">
    <input type="submit" name="assign_group_btn" value="Assign Group" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>