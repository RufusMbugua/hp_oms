$(document).ready(function() {
    /* generate calendar */
    $('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
				},
		eventLimit: true,
		events: {
			url: 'https://www.google.com/calendar/feeds/strathmorehp%40gmail.com/public/basic'
		}
    });

});