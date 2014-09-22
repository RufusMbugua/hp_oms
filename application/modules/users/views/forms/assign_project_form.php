<?php echo form_open('users/view/user/'.$user->user_id.'/assign_project'); ?>

  <div class="form-group">
    <p class="help-block">Assign <b><?php echo $user->surname.' '.$user->other_names; ?></b> to a project.</p>
    <label for="project_id">Project Name</label>
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
    <input type="submit" name="assign_project_btn" value="Assign Project" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>