<!DOCTYPE html>
<html>
<head>
	<!--full calendar css-->
	<link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/fullcalendar/dist/fullcalendar.min.css'; ?>"/>
	<!--custom calendar css-->
	<link rel="stylesheet" href="<?php echo base_url().'assets/modules/calendar/calendar.css'; ?>"/>
	<!--jquery js-->
	<script src="<?php echo base_url().'assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
	<title>Calendar Module</title>
</head>
<body>
	<div id='calendar'></div>
    <!--moment js -->
	<script src="<?php echo base_url().'assets/bower_components/moment/min/moment.min.js'; ?>"></script>
	<!--full calendar js-->
	<script src="<?php echo base_url().'assets/bower_components/fullcalendar/dist/fullcalendar.js'; ?>"></script>
	<!--gcal google calendar js-->
	<script src="<?php echo base_url().'assets/bower_components/fullcalendar/dist/gcal.js' ;?>"></script>
	<!--custom calendar js-->
	<script src="<?php echo base_url().'assets/modules/calendar/calendar.js'; ?>"></script>
</body>
</html>