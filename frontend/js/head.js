var head;

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
	//console.log(string);
	if((string.length) != 0) {
		var array = string.split(',');
		//console.log(array);
		var len = array.length;
		//console.log(len);
		//if(target == $('#free-subheads'))
			for(var x = 0 ; x < len ; x++) {
				target.append('<div class="subhead-name col-xs-4"><label><input id="' + array[x] +'" class="check" type="checkbox"><img id="img'
								+ array[x] + '" src="images/free-subhead.jpg" /></label></h6>');
			}

	}
}


function getSubHeadsLists() {
	updateFreeSubheads();
	updateBusySubheads();
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

function assignTask(string, task_title, task_body) {
	$.ajax({
		url: "../control/head.php",
		type: "POST",
		data: { 
			function_name : 'assignTask', 
			subhead_string : string,
			task_title : task_title, 
			task_body : task_body
		},
		success: function (result) {
			alert(result);
			$('.task').css({ 'display' : 'none' });
			$('.fullscreen-overlay').css({'background-color': 'rgba(0, 0, 0, 0.7)'});
			$('.task-assigned-by input').val('');
			$('.task-title input').val('');
			$('.task-description input').val('');
			$('#free-subheads .check').each(function(){
				$(this).prop("checked", false);
			});
			$.ajax({
				url: "../control/head.php",
				type: "POST",
				data: { function_name : 'getFreeSubHeads'},
				success: function (result) {
					//console.log('free');
					$('#free-subheads').html('');
					displayArray(result, $('#free-subheads'));
					$.ajax({
						url: "../control/head.php",
						type: "POST",
						data: { function_name : 'getBusySubHeads'},
						success: function (result) {
							//console.log('busy');
							$('#busy-subheads').html('');
							displayArray(result, $('#busy-subheads'));
						}
					});
				}
			});
		}
	});
}

$(document).ready(function() {
	
	getSubHeadsLists(); //WORKING

	$('#logout-button').click(function (event) {  //WORKING
		//alert(subhead);
		logout();	
	});
	//////////////////////////////////////////////////////////////////////////////////////////////
	$('#free-subheads').on('click', '.subhead-name img', function(event) {  //WORKING
		if ($(this).parent().find('.check').prop('checked')) {
			$(this).parent().find('.check').prop("checked", true);
		} else {
			$(this).parent().find('.check').prop("checked", false);
		}
	});
	/////////////////////////////////////////////////////////////////////////////////////////

	var string='';	
	$('#assign-button').click(function(event) {  //WORKING
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

	$('.exit-action').click(function(){		 //WORKING
		$('.task').css({ 'display' : 'none' });
		$('.fullscreen-overlay').css({'background-color': 'rgba(0, 0, 0, 0.7)'});
		$('.task-assigned-by input').val('');
		$('.task-title input').val('');
		$('.task-description input').val('');
		$('#free-subheads .check').each(function(){
			$(this).prop("checked", false);
		});
	});


	$('.assign-action').click(function(){
		var task_title = $('.task-title input').val();
		var task_body = $('.task-description input').val();
		var correct = true;
		if(task_title == '' || task_body == '') {
			correct = false;
		}
		if(correct) {
			assignTask(string, task_title, task_body);
		}else {
			alert('Plz fill the required details');
		}
		
	});
	var chosen='';
	$('#busy-subheads').on('click', '.subhead-name', function(){
		//alert('alert');
		$('#busy-subheads .check').each(function(){
			$(this).prop("checked", false);//alert($(this).attr('id'));
		});

		$(this).find('.check').prop("checked", true);
		chosen = $(this).find('.check').attr('id');
	});

	var current_task_title='', current_task_body='';
	$('#view-button').click(function(event) {
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
					$('#chosen-subhead').html('<center><h2>'+chosen+'</h2></center>');
					var array = result.split('||');
					
					current_task_body = array[1];
					current_task_title = array[0];

					$('#task-title1').html(array[0]);
					$('#head-name1').append('<div class="head-name col-xs-6"><label><img id="img'+ array[2] + '" src="images/free-subhead.jpg" /></label></h6>')
					$('#task-description1').html(array[1]);
					var len = array.length;
					for(var x = 3 ; x < len ; x++) {
						($('#members-div').append('<div class="subhead-name col-xs-6"><label><img id="img'+ array[x] + '" src="images/free-subhead.jpg" /></label></h6>'));
					}

				}
			});

		}
	});

	$('#edit-task').click(function(event) {
		$('#task-title1').html('<input id="new-task-title" type="text" value="'+current_task_title+'">');
		$('#task-description1').html('<input id="new-task-description" type="text" value="'+current_task_body+'">');
		

		/*//alert(chosen);
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
					$('#chosen-subhead').html('<center><h2>'+chosen+'</h2></center>');
					var array = result.split('||');
					$('#task-title1').html(array[0]);
					$('#head-name1').append('<div class="head-name col-xs-6"><label><img id="img'+ array[2] + '" src="images/free-subhead.jpg" /></label></h6>')
					$('#task-description1').html(array[1]);
					var len = array.length;
					for(var x = 3 ; x < len ; x++) {
						($('#members-div').append('<div class="subhead-name col-xs-6"><label><img id="img'+ array[x] + '" src="images/free-subhead.jpg" /></label></h6>'));
					}

				}
			});

		}*/
	});

});