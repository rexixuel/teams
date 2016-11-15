$(document).ready(function(){

	$("#delete-modal").on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);

		var modal = $(this);
		var formAction = button.data('url');

		modal.find("#delete-modal-form").attr("action", formAction);
	});

	$("#revoke-modal").on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);

		var modal = $(this);
		var formAction = button.data('url');

		modal.find("#revoke-modal-form").attr("action", formAction);
	});

	var weekends = [];
     $.get($("#url").data('url'),
     {	     },
      function (data) {
        //success data        	
        
        $.each(data, function(index, weekend){
        	weekends.push(weekend.day);
        });
		
     });

	$("#emp-num").mask("9999", {placeholder:"0"});	

    $('#job-class').change(function(){
      $.get($(this).data('url'), 
      { option: $(this).val() },        
      function(data) {
        var jobDescription = $('#job-description');
        jobDescription.empty();
        $.each(data, function(index, element) {        		
        		if($("#job-description").data("primary-selected") == element.id){
                	jobDescription.append("<option selected value='"+ element.id +"'>" + element.job_description + "</option>");
        		}
        		else
        		{
                	jobDescription.append("<option value='"+ element.id +"'>" + element.job_description + "</option>");
        		}
            });
      });
      var selected = $(this).find('option:selected');
      var jobClassDescription = selected.data('description');
      
	  var supervisorPosition = /[^ABCDEFG]/i.test(jobClassDescription);      	  

      if(supervisorPosition == true && jobClassDescription != "admin")
      {
      	$('#supervisor-div').hide();
      }
      else
      {
      	$('#supervisor-div').show();
      }      	
    });  
      $.get($('#job-class').data('url'), 
      { option: $('#job-class').val() },        
      function(data) {
        var jobDescription = $('#job-description');
        jobDescription.empty();
        $.each(data, function(index, element) {
        		if($("#job-description").data("primary-selected") == element.id){
                	jobDescription.append("<option selected value='"+ element.id +"'>" + element.job_description + "</option>");
        		}
        		else
        		{
                	jobDescription.append("<option value='"+ element.id +"'>" + element.job_description + "</option>");
        		}
            });
      });
      var selected = $("#job-class").find('option:selected');
      var jobClassDescription = selected.data('description');
      
	  var supervisorPosition = /[^ABCDEFG]/i.test(jobClassDescription);      	  

      if(supervisorPosition == true && jobClassDescription != "admin")
      {
      	$('#supervisor-div').hide();
      }
      else
      {
      	$('#supervisor-div').show();
      }      	      

	if ($('input[name=leave_sub_type]:checked').val() != "whole" && $('input[name=leave_sub_type]:checked').length ){
		if ($("input[type=radio][name=leave_sub_type]").prop("disabled") == false){
			$("#num-of-days").prop("readonly",false);			
		}
			$("#end-date").prop("disabled",true);	
			$("#end-date").val($("#start-date").val());
			$("#num-of-days").val($("#num-of-days").val() * 8);
			$("#num-of-days-label").text("Number of Hours");			

	}

	$("#start-date").change(function(){
	
		if ($("#end-date").val() !== '' && $("#start-date").val() !== ''){
			
			// end - start returns difference in milliseconds 
			if($("#end-date").prop("disabled") == false){

				var end = new Date($("#end-date").val());
				var start = new Date($("#start-date").val())
				var diff = new Date( end - start );

				var numDays = (diff/1000/60/60/24) + 1;

				var range = moment().range(moment(start,'dddd'),moment(end,'dddd'));

				range.by('days', function(day) {
				     if($.inArray(moment(day).format('dddd'), weekends) > -1)
				     {
				     	numDays = parseInt(numDays) - 1;
				     }
				});				

				$("#num-of-days").val(numDays);

			}
		}

  		if($("#end-date").prop("disabled") == true){
			$("#end-date").val($("#start-date").val());			
	  	}

	});	

	$("#end-date").change(function(){
		if ($("#end-date").val() !== '' && $("#start-date").val() !== ''){	
			// end - start returns difference in milliseconds 
			if($("#end-date").prop("disabled") == false){				
				var end = new Date($("#end-date").val());
				var start = new Date($("#start-date").val())
				var diff = new Date( end - start );

				var numDays = (diff/1000/60/60/24) + 1;

				var range = moment().range(moment(start,'dddd'),moment(end,'dddd'));

				range.by('days', function(day) {
				     if($.inArray(moment(day).format('dddd'), weekends) > -1)
				     {
				     	numDays = parseInt(numDays) - 1;
				     }
				});				
			
				$("#num-of-days").val(numDays);
			}
		}
	});		

	if($("#num-of-days").val() == "")
	{	
		$("#num-of-days").val(function(){
			if ($("#end-date").val() !== '' && $("#start-date").val() !== ''){	
				// end - start returns difference in milliseconds 
				if($("#end-date").prop("disabled") == false){				
					var end = new Date($("#end-date").val());
					var start = new Date($("#start-date").val())
					var diff = new Date( end - start );

					var numDays = (diff/1000/60/60/24) + 1;

					var range = moment().range(moment(start,'dddd'),moment(end,'dddd'));

					range.by('days', function(day) {
					     if($.inArray(moment(day).format('dddd'), weekends) > -1)
					     {
					     	numDays = parseInt(numDays) - 1;
					     }
					});				

				
				}
			}

			return numDays;
		});
	}

	$("#start-date").focus(function(){		
  		if($("#end-date").prop("disabled") == true){
			$("#end-date").val($("#start-date").val());			
	  	}
	});

	$("input[type=radio][name=weekend]").change(function(){
		$("#description-group").toggle();
		if(this.value == 1)
		{
			$("#holiday-description").prop("disabled",true);			
		}
		else
		{
			$("#holiday-description").prop("disabled",false);		
		}
	});

	if ($('input[name=weekend]:checked').val() == 1)
	{
		$("#description-group").hide();
	}	
	$("input[type=radio][name=leave_sub_type]").change(function(){
		if(this.value == "under")
		{
			$("#end-date").prop("disabled",true);			
			$("#end-date").val($("#start-date").val());
			$("#num-of-days").prop("readonly",false);
			
			$("#num-of-days-label").text("Number of Hours");
		}

		if(this.value == "half")
		{
			$("#end-date").prop("disabled",true);
			$("#end-date").val($("#start-date").val());
			$("#num-of-days").val("4");
			$("#num-of-days").prop("readonly",true);			
			$("#num-of-days-label").text("Number of Hours");			
		}

		if(this.value == "whole")
		{
			$("#end-date").prop("disabled",false);
			$("#num-of-days").prop("readonly",true);
			$("#num-of-days-label").text("Number of Days");
			if ($("#end-date").val() !== '' && $("#start-date").val() !== ''){
				var end = new Date($("#end-date").val());
				var start = new Date($("#start-date").val())
				
				// end - start returns difference in milliseconds 
				var diff = new Date( end - start );

				var numDays = (diff/1000/60/60/24) + 1;

				var range = moment().range(moment(start,'dddd'),moment(end,'dddd'));

				range.by('days', function(day) {
				     if($.inArray(moment(day).format('dddd'), weekends) > -1)
				     {
				     	numDays = parseInt(numDays) - 1;
				     }
				});				

			
				$("#num-of-days").val(numDays);
			}else{
				$("#num-of-days").val("0");				
			}			
		}		
	});
// add warning validations here. use genericorp as source
});