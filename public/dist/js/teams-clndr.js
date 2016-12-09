
$( function() {

  if($("#time-in").is('[readonly!="readonly"]') )    
  {      
      $("#time-in").bootstrapMaterialDatePicker({ date: false, time: true, format:"HH:mm:ss" });
  }

  if($("#lunch-out").is('[readonly!="readonly"]') )    
  {      
      $("#lunch-out").bootstrapMaterialDatePicker({ date: false, time: true, format:"HH:mm:ss" });
  }

  if($("#lunch-in").is('[readonly!="readonly"]') )    
  {      
      $("#lunch-in").bootstrapMaterialDatePicker({ date: false, time: true, format:"HH:mm:ss" });
  }

  if($("#time-out").is('[readonly!="readonly"]') )    
  {      
      $("#time-out").bootstrapMaterialDatePicker({ date: false, time: true, format:"HH:mm:ss" });
  }  

  if($("#start-date").is('[readonly!="readonly"]') )  	
  {
  	  $("#start-date").bootstrapMaterialDatePicker({ weekStart : 0, time: false, format:"MM/DD/YYYY" });
  }

  if($("#end-date").is('[readonly!="readonly"]') )  	
  {  	 
  	$("#end-date").bootstrapMaterialDatePicker({ weekStart : 0, time: false, format:"MM/DD/YYYY" }).data('plugin_bootstrapMaterialDatePicker');	
  }

 var teamsEvents = [];
 var lates = 0;
 var teamsCalendar = $('#clndr-attendance').clndr({
      template:$('#clndr-attendance-template').html(),
      daysOfTheWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      forceSixRows: false,
      events: teamsEvents,
      multiDayEvents: {
          endDate: 'end',
          singleDay: 'date',
          startDate: 'start'
      },
      clickEvents: {
          // this event fires whenever the month is changed
          onMonthChange: function(month) {
            lates = 0;

            teamsEvents = [];
            $.get($('#clndr-attendance').data('url-holiday'), 
            {
                data: {
                  month: month.format('MM'),
                  year: month.format('YYYY')
                }              
            },
              function (data) {

                $.each(data, function(index, event) {
                  if(event.start_date == event.end_date)
                  {
                    var item = {
                      "date" : moment(event.start_date).format('YYYY-MM-DD'),
                      "title" : event.holiday_description,
                      // "url" : event.id,
                    }
                    teamsEvents.push(item);
                  }
                  else
                  {
                    var multi = {
                        "start" : moment(event.start_date).format('YYYY-MM-DD'),
                        "end" : moment(event.end_date).format('YYYY-MM-DD'),
                        "title" : event.holiday_description,
                        // "url" : event.id,
                        "timeIn" : event.time_in, "timeOut" : event.time_out
                    }                    
                    teamsEvents.push(multi);
                  }


               });
            });
            $.get($('#clndr-attendance').data('url'), 
            {
                data: {
                  month: month.format('MM'),
                  year: month.format('YYYY')
                }              
            },
              function (data) {
                //success data


                $.each(data, function(index, event) {
                  
                  // if($('#clndr-attendance').data('action') == 'edit')
                  // {
                  //   event.id = event.id + '/edit';
                  // }
                  
                  var item = {"date" : moment(event.attendance_date).format('YYYY-MM-DD'), "title" : event.time_in + " - " +  event.time_out, 
                            "url": event.id, "timeIn" : event.time_in, "timeOut" : event.time_out};
                
                    lates = parseFloat(lates) + parseFloat(event.late_hours);
                    
                    teamsEvents.push(item);
                    
                });                

                teamsCalendar.setEvents(teamsEvents);
                if(lates > 0)
                {                  
                  $("#lates-for-month").append(lates.toFixed(2));
                  $("#lates-for-month").show();
                }
                else
                {
                  $("#lates-for-month").hide();
                }

            })
          }
        },
    });      

  if(teamsEvents.length == 0){

     late = 0;
     teamsEvents = [];
      $.get($('#clndr-attendance').data('url-holiday'), 
      {
          data: {
            month: teamsCalendar.month.format('MM'),
            year: teamsCalendar.month.format('YYYY')
          }              
      },
        function (data) {

          $.each(data, function(index, event) {
            if(event.start_date == event.end_date)
            {
              var item = {
                "date" : moment(event.start_date).format('YYYY-MM-DD'),
                "title" : event.holiday_description,
                "url" : event.id,
              }
              teamsEvents.push(item);
            }
            else
            {
              var multi = {
                  "start" : moment(event.start_date).format('YYYY-MM-DD'),
                  "end" : moment(event.end_date).format('YYYY-MM-DD'),
                  "title" : event.holiday_description,
                  "url" : event.id,
                  "timeIn" : event.time_in, "timeOut" : event.time_out
              }                    
              teamsEvents.push(multi);
            }
         });      

      });
     $.get($('#clndr-attendance').data('url'),
     {
        data: {
          month: teamsCalendar.month.format('MM'),
          year: teamsCalendar.month.format('YYYY')
        }              
     },
      function (data) {
        //success data
        $.each(data, function(index, event) {
            // if($('#clndr-attendance').data('action') == 'edit')
            // {
            //   event.id = event.id + '/edit';
            // }
            var item = {"date" : moment(event.attendance_date).format('YYYY-MM-DD'), "title" : event.time_in + " - " +  event.time_out, 
                            "url": event.id, "timeIn" : event.time_in, "timeOut" : event.time_out};

            lates = parseFloat(lates) + parseFloat(event.late_hours);

            teamsEvents.push(item);
            teamsCalendar.setEvents(teamsEvents);       
            if(lates > 0)
            {
              
              $("#lates-for-month").append(lates.toFixed(2));
              $("#lates-for-month").show();
            }
            else
            {
              $("#lates-for-month").hide();
            }
        });                
     });
  }


});
