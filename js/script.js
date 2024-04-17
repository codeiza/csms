var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

$(function() {
    // Fixed schedule events
function generateFixedScheduleEvents() {
    var events = [];
    var currentDate = new Date();
    var currentDay = currentDate.getDay();

    // Define the days for Wednesday, Friday, and Sunday
    const WEDNESDAY = 3;
    const FRIDAY = 5;
    const SUNDAY = 0;

    for (var i = 0; i < 10; i++) {
        // If today is Wednesday or later in the week, add an event for the upcoming Wednesday
        if (currentDay <= WEDNESDAY) {
            currentDate.setDate(currentDate.getDate() + (WEDNESDAY - currentDay));
        } else {
            currentDate.setDate(currentDate.getDate() + (7 - currentDay + WEDNESDAY));
        }

        // Add events for Wednesday 6 PM, Friday 6 PM, Sunday 6 AM, and Sunday 6 PM
        events.push({
            title: 'Regular Mass',
            start: new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), 18, 0, 0),
        });

        // Move to Friday
        currentDate.setDate(currentDate.getDate() + 2);
        events.push({
            title: 'Regular Mass',
            start: new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), 18, 0, 0),
        });

        // Move to Sunday
        currentDate.setDate(currentDate.getDate() + 2);
        events.push({
            title: 'Regular Mass',
            start: new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), 6, 0, 0),
        });

        events.push({
            title: 'Regular Mass',
            start: new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), 18, 0, 0),
        });

        // Move to the next week, which is Wednesday
        currentDate.setDate(currentDate.getDate() + 3);
        currentDay = currentDate.getDay();
    }

    return events;
}

// ...

var fixedEvents = generateFixedScheduleEvents();












    // Push the fixed events to the 'events' array
    events.push(...fixedEvents);

    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k];
            events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime });
        });
    }

    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
        },
        selectable: true,
        themeSystem: 'bootstrap',
        events: events,
        eventClick: function(info) {
            var _details = $('#event-details-modal')
                var id = info.event.id
                if (!!scheds[id]) {
			 $.ajax({
					type:'post',
					url: 'php/detail_schedule.php',
					data:{
						id : id
					}
				}).done(function(data){
			$(".modal-title").html('Detail of Event')
			$(".modal-body-1").html(data)
			$(".modal").modal('show')
				})
                } else {
                    alert("This event is regular");
                }
	  
        },
        eventDidMount: function(info) {
            // Do something after events mounted
        },
        editable: true,
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: 'short'
        }
    });

    calendar.render();

    // Form reset listener
     $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })


    // Edit Button
    $('#edit').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form')
                console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="title"]').val(scheds[id].title)
                _form.find('[name="description"]').val(scheds[id].description)
                _form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"))
                $('#event-details-modal').modal('hide')
                _form.find('[name="title"]').focus()
            } else {
                alert("Event is undefined");
            }
       
    });

    // Delete Button / Deleting an Event
    $('#delete').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this scheduled event?");
                if (_conf === true) {
                    location.href = "./delete_schedule.php?id=" + id;
                }
            } else {
                alert("Event is undefined");
            }
        
    });
});
