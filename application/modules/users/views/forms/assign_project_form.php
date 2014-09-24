<?php echo form_open('users/manage/'.$user->user_id.'/assign_project'); ?>

  <div class="form-group">
    <label for="project_id">Project Name</label>
    <p class="help-block">What project will <b><?php echo $user->surname.' '.$user->other_names; ?></b> be on?</p>
    <select name="project_id" class="form-control">
      <option value="">Select Project</option>
      <?php
      if(is_array($projects_info))
      {
        foreach($projects_info as $project)
        {
          echo '<option value="'.$project->project_id.'">'.$project->project_name.'</option>';
        }
      }      
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="user_role">Project Role</label>
    <p class="help-block">What role will <b><?php echo $user->surname.' '.$user->other_names; ?></b> be playing in the project?</p>
    <select name="user_role" class="form-control">
      <option value="">Select Role</option>
      <?php
      if(is_array($groups_info))
      {
        foreach($groups_info as $groups)
        {
          echo '<option value="'.$groups->id.'">'.$groups->name.'</option>';
        }
      }      
      ?>
    </select>
  </div>
  <div class="form-group">
    <input type="submit" name="assign_project_btn" value="Assign to Project" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>