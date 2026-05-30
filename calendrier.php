<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js'></script>





  <script>
    $(document).ready(function() {
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        locale: 'fr',
        defaultDate: '<?php echo date('Y-m-d');?>',
        navLinks: true,
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: 'events.php',
        eventRender: function(event, element) {
          element.find('.fc-title').append("<br/>" + event.location);
        },
        eventAfterRender: function(event, element, view) {
          if (event.start && event.start.format('YYYY-MM-DD') !== '1970-01-01') {
            element.css('background-color', 'green');
          }
        }
      });
    });
  </script>
  <style>
    #calendar {
      max-width: 900px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>
