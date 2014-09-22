<?php 
echo form_open('projects/update/'.$this->uri->segment(3)); ?>

  <div class="form-group">
    <label for="project_name">Project Name</label>
    <input type="text" class="form-control" name="project_name" value="<?php echo $project->project_name; ?>">
  </div>
  <div class="form-group">
    <label for="project_description">Project Description</label>
    <textarea name="project_description" class="form-control" rows="5"><?php echo $project->project_description; ?></textarea>
  </div>
  <div class="form-group">
    <label for="project_url">Project URL</label>
    <input type="text" class="form-control" name="project_url" value="<?php echo $project->project_url; ?>">
  </div>
  <div class="form-group">
    <input type="submit" name="update_project_btn" value="Update Project" class="btn btn-primary">
  </div>

<?php echo form_close();