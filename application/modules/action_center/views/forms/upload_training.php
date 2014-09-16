<?php
$formAttr = array('enctype' => 'multipart/form-data', 'name' => 'upload_form', 'id' => "imci_upload_form");
echo form_open('imci/upload', $formAttr);
?>
<label>Training Sign Sheet</label>
<?php echo form_error('training_sign_sheet'); ?>
<div class="input-group">
	<?php $btnAttr = array('id' => 'upload_button', 'class' => 'btn btn-default', 'name' => 'file_1');
	echo form_upload($btnAttr);
	?>
</div>
<input type="hidden" id="activity_id"name= "activity_id">

<?php echo form_close(); ?>