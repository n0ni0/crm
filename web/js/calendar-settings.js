$(function () {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar-holder').fullCalendar({
        aspectRatio: 2,
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'month, agendaWeek, agendaDay,'
        },
        defaultView: 'agendaWeek',
        minTime: "08:00:00",
        maxTime: "21:00:00",
        dow: [ 1, 2, 3, 4 ],
        lazyFetching: true,
        timeFormat: {
            agenda: 'h:mmt',
            month: 'h:mmt',
        },
        //Set to True to show Calendar Week in seperate Row/Field of Calendar View
        weekNumbers: false,
        //Set to your Language to change the text, the first day of week etc acording to yout settings.
        lang: 'es',
        eventSources: [
            {
                url: Routing.generate('fullcalendar_loader'),
                type: 'POST',
                // A way to add custom filters to your event listeners
                data: {
                },
                error: function() {
                   //alert('There was an error while fetching Google Calendar!');
                }
            }
        ]
    });
});
