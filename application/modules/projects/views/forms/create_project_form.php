<?php echo form_open('projects/create'); ?>

  <div class="form-group">
    <label for="project_name">Project Name</label>
    <input type="text" class="form-control" name="project_name">
  </div>
  <div class="form-group">
    <label for="project_description">Project Description</label>
    <textarea name="project_description" class="form-control" rows="5"></textarea>
  </div>
  <div class="form-group">
    <label for="project_url">Project URL</label>
    <input type="text" class="form-control" name="project_url">
  </div>
  <div class="form-group">
    <input type="submit" name="create_project_btn" value="Create Project" class="btn btn-primary">
  </div>

<?php echo form_close(); ?>