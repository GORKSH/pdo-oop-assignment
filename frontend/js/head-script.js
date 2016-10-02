function logout () {
	$.ajax({
		url: "../control/head.php",
		data : { function_name :  'logout' },
		type: "POST",
		success: function (result) {
			window.location = 'index.php';
		}
	});
}


function displayArray(string, target) {
	if((string.length) != 0) {
		var array = string.split(',');
		var len = array.length;
			for(var x = 0 ; x < len ; x++) {
				target.append('<div class="subhead-name col-xs-4"><label><input id="' + array[x] +'" class="check" type="checkbox"><img id="img'
								+ array[x] + '" src="images/free-subhead.jpg" /></label></h6>');
			}

	}
}


function updateFreeSubheads() {
	$.ajax({
		url: "../control/head.php",
		type: "POST",
		data: { function_name : 'getFreeSubHeads'},
		success: function (result) {
			displayArray(result, $('#free-subheads'));
		}
	});
}

function updateBusySubheads() {
	$.ajax({
		url: "../control/head.php",
		type: "POST",
		data: { function_name : 'getBusySubHeads'},
		success: function (result) {
			displayArray(result, $('#busy-subheads'));
		}
	});
}

function getSubHeadsLists() {
	updateFreeSubheads();
	updateBusySubheads();
}



$(document).ready(function (argument) {
	
	$('#logout-button').click(function (event) {  //TO LOG OUT: DONE
		//alert(subhead);
		logout();	
	});

	getSubHeadsLists(); //TO SHOW ACTIVE AND FREE : DONE

	$('#free-subheads').on('click', '.subhead-name img', function(event) {  //ORKING OF RADIO BUTTONS FREE SIDE
		if ($(this).parent().find('.check').prop('checked')) {
			$(this).parent().find('.check').prop("checked", true);
		} else {
			$(this).parent().find('.check').prop("checked", false);
		}
	});

	var string='';	
	$('#assign-button').click(function(event) {  //THE ASSIGN BUTTON THAT OPENS A DIV
		string='', flag=0, count=0;
		$('#free-subheads .subhead-name .check').each(function(){
			if($(this).prop('checked')) {
				count++;
				if(flag == 0) {
					string = string + $(this).attr('id');
					flag = 1;
				} else {
					string = string + ',' + $(this).attr('id');
				}
			}
		});
		if(count == 0 ) {
			alert('choose an element first');
		}
		else {
			$('.task').css({ 'display' : 'block' });
			$('.fullscreen-overlay').css({'background-color': 'rgba(0, 0, 0, 0.9)'});
			//$('.task-assigned-by input').val('Task Assigned By : '+ head);
		}
	});

	$('.exit-action').click(function(){		 //CLOSE THE OPEN DIV
		$('.task').css({ 'display' : 'none' });
		$('.fullscreen-overlay').css({'background-color': 'rgba(0, 0, 0, 0.7)'});
		$('.task-assigned-by input').val('');
		$('.task-title input').val('');
		$('.task-description input').val('');
		$('#free-subheads .check').each(function(){
			$(this).prop("checked", false);
		});
	});

	var chosen='';							//WORKING OF CHECKBOXES ON BUSY SIDE
	$('#busy-subheads').on('click', '.subhead-name', function(){
		//alert('alert');

		$('#busy-subheads .check').each(function(){
			$(this).prop("checked", false);//alert($(this).attr('id'));
		});

		$(this).prop("checked", true);
		chosen = $(this).attr('id');
	
	});

	$('#view-button').click(function(event) {     //VIEW BUTTON CLICK
		//alert(chosen);
		if(chosen == '') {
			alert('choose a subhead first');
		} else {
			$('.view').css({
				'display' : 'block'
			});
			$.ajax({
				url: "../control/head.php",
				type: "POST",
				data: { function_name : 'getAssignedTask', subhead : chosen},
				success: function (result) {
					//displayArray(result, $('.view-assigned-with'));
					
					alert(result);//console.log('busy');
					//displayArray(result, $('#busy-subheads'));
				}
			});
			//$('#view-assigned-by input').val($assigned_by);
			//$('#view-assigned-with input').val($assigned_with);
		}
	});


});