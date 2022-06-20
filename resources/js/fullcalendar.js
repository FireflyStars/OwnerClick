import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
// import timeGridPlugin from '@fullcalendar/timegrid';
// import listPlugin from '@fullcalendar/list';
// import itLocale from '@fullcalendar/core/locales/it'; //italian language and config
window.calendarItem;

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    reloadCalendar(calendarEl)

});

window.reloadCalendar = function() {
    let calendarEl = this;
    if (calendarEl != null) {
        let calendar = window.calendarItem = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin  ],
            themeSystem: "bootstrap",
            locale: 'tr',
            // contentHeight: "auto",
            height: "auto",
            initialView: 'dayGridMonth',
            events: $(calendarEl).attr('data-url'),
            eventContent: function(event,element) {
                if(event.event._def.extendedProps.icon){
                    // element.find(".fc-event-title").prepend("<i class='fa fa-"+event.event._def.extendedProps.icon+"'></i>");
                    const text = "<em class='mx-1 text-rose fa fa-" + event.event._def.extendedProps.icon + "'></em> <b class='mr-1'>"+event.timeText +"</b> " + event.event._def.title;
                    return {
                        html: text
                    };
                }
            },
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                dayGrid: {
                    dayMaxEventRows: 6, // adjust to 6 only for timeGridWeek/timeGridDay
                },
                timeGrid: {
                    dayMaxEventRows: 4, // adjust to 6 only for timeGridWeek/timeGridDay

                }
            },
            customButtons: {
                newReminderButton: {
                    icon: 'plus-square',
                    text: lang.get('dashboard.new_remainder'),
                    click: function() {
                        $(document).find('#createEventButton').click();
                    }
                },
            },
            headerToolbar: {
                right: 'prev,next today newReminderButton',
            },
            eventClick: function (calEvent, jsEvent, view) {
                createModal('#calendarEvent')
                getAjax(null, '#calendarEvent .modal-dialog', calEvent.event.toJSON().extendedProps.link, false, false, true)
                $('#calendarEvent').modal({show: false, backdrop: 'static'}).modal('show')

            },

        });
        calendar.render();

        $('.fc-daygrid-event-harness').on('click', function () {

        })
    }
}
