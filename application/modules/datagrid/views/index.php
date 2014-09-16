<html>
<head>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/media/css/jquery.dataTables.min.css">
   <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
   <script src="<?php echo base_url();?>assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
</head>
<body>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Level Name</th>
                <th>Description</th>
                <th>Indicator</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Level Name</th>
                <th>Description</th>
                <th>Indicator</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
	    $('#example').dataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": "<?php echo base_url(); ?>datagrid/get_remote"
	    });
	});
</script>