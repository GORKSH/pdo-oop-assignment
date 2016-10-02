/*var subhead;

function updateSubHeadName () {
	$.ajax({
		url: "../Controllers/subhead.php",
		type: "POST",
		data: { function_name : 'getUserName'},
		success: function (result) {
			subhead = result;
			$('#subhead-name').html(result);
		}
	});
}

function logout () {
	$.ajax({
		url: "../Controllers/subhead.php",
		data : { function_name :  'logout' },
		type: "POST",
		success: function (result) {
			window.location = 'index.html';
		}
	});
}


function displayArray(string, target) {
	//console.log(string);
	if((string.length) != 0) {
		var array = string.split(',');
		console.log(array);
		var len = array.length;
		console.log(len);
		//if(target == $('#free-subheads'))
			for(var x = 0 ; x < len ; x++) {
				if(array[x] != subhead)
				target.append('<div class="subhead-name col-xs-4"><input id="' + array[x] +'" class="check" type="checkbox"><img id="img'
								+ array[x] + '" src="images/free-subhead.jpg" /></h6>');
			}

	}
}

function updateFreeSubheads() {
	$.ajax({
		url: "../Controllers/subhead.php",
		type: "POST",
		data: { function_name : 'getFreeSubHeads'},
		success: function (result) {
			//console.log('free');
			displayArray(result, $('#free-subheads'));
		}
	});
}

function updateBusySubheads() {
	$.ajax({
		url: "../Controllers/head.php",
		type: "POST",
		data: { function_name : 'getBusySubHeads'},
		success: function (result) {
			//console.log('busy');
			displayArray(result, $('#busy-subheads'));
		}
	});
}


var subhead_state;
function getSubHeadTask(subhead) {
	$.ajax({
		url: "../Controllers/subhead.php",
		type: "POST",
		data: { function_name : 'getSubHeadState'},
		success: function (result) {
			//alert (result);
			if (result == -1) 
				subhead_state = 'busy';
			else subhead_state = 'free';
					if(subhead_state == 'free') {
				$('#my-task').html('<h2>You are Free At Present</h2>');
			} else {
				$('#my-task').html('<h2>You have a task assigned At Present</h2><h3></h3><p></p>');

			}	
		}
	});
}


$(document).ready(function() {
	
	updateSubHeadName();
	$('#view-task').hide();

	$('#logout-button').click(function (event) {
		logout();	
	});

	//alert(getSubHeadState(subhead));
	getSubHeadTask(subhead);
	
	//alert(subhead_state);
	//alert(subhead_state);
	updateFreeSubheads();
	updateBusySubheads();


	$('#all-task-button').click(function(){
		$('#my-task').hide();
		//updateBusySubheads();
		$('#busy-subheads').show();
		$('#view-task').show();
	});

	$('#my-task-button').click(function(){
		$('#my-task').show();
		//updateBusySubheads();
		$('#busy-subheads').hide();
		$('#view-task').hide();
	});
	var chosen='';
	$('#busy-subheads').on('click', '.subhead-name', function(){
		//alert('alert');

		$('#busy-subheads .check').each(function(){
			$(this).prop("checked", false);//alert($(this).attr('id'));
		});

		$(this).find('.check').prop("checked", true);
		chosen = $(this).find('.check').attr('id');
		//alert(chosen);	
	});

	$('#view-task').click(function(event) {
		if(chosen == '') {
			alert('choose a subhead');
		} else {
			$('.view').css({
				'display' : 'block'
			});
			$.ajax({
				url: "../Controllers/head.php",
				type: "POST",
				data: { function_name : 'getAssignedTask', subhead : chosen},
				success: function (result) {
					//displayArray(result, $('.view-assigned-with'));
					
					alert(result);//console.log('busy');
					//displayArray(result, $('#busy-subheads'));
				}
			});
		}
	});

});*/

var subhead='sdfs';

function logout () {
	$.ajax({
		url: "../control/subhead.php",
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
		url: "../control/subhead.php",
		type: "POST",
		data: { function_name : 'getFreeSubHeads'},
		success: function (result) {
			console.log(result);
			displayArray(result, $('#free-subheads'));
		}
	});
}

function updateBusySubheads() {
	$.ajax({
		url: "../control/subhead.php",
		type: "POST",
		data: { function_name : 'getBusySubHeads'},
		success: function (result) {
			console.log(result);
			displayArray(result, $('#busy-subheads'));
		}
	});
}

var subhead_state;
function getSubHeadState(subhead) {
	$.ajax({
		url: "../control/subhead.php",
		type: "POST",
		data: { function_name : 'getSubHeadState'},
		success: function (result) {
			//console.log(result);//alert (result);
			if (result == -1) 
				subhead_state = 'busy';
			else subhead_state = 'free';
					if(subhead_state == 'free') {
				$('#my-task').html('<h2>You are Free At Present</h2>');
			} else {
				$('#my-task').html('<h2>You have a task assigned At Present</h2>');

			}	
		}
	});
}

	var chosen='SUBHEAD';



$(document).ready(function() {

	//$('#view-task').hide();
	//getSubHeadName();	
	getSubHeadsLists(); //WORKING

	$('#logout-button').click(function (event) {  //WORKING
		//alert(subhead);
		logout();	
	});

	getSubHeadState();

	$('#all-task-button').click(function(){
		$('#my-task').hide();
		$('#busy-subheads').show();
		chosen = '';
	});

	$('#my-task-button').click(function(){
		$('#my-task').show();
		$('#busy-subheads').hide();
		chosen = 'SUBHEAD';
	});

	$('#busy-subheads').on('click', '.subhead-name', function(){
		//alert('alert');
		$('#busy-subheads .check').each(function(){
			$(this).prop("checked", false);//alert($(this).attr('id'));
		});

		$(this).find('.check').prop("checked", true);
		chosen = $(this).find('.check').attr('id');
	});

	$('#view-task').click(function(event) {
		alert(chosen);
		if(chosen == '') {
			alert('choose a subhead first');
		} else {
			$('.view').css({
				'display' : 'block'
			});
			$.ajax({
				url: "../control/subhead.php",
				type: "POST",
				data: { function_name : 'getAssignedTask', subhead : chosen},
				success: function (result) {
					alert(result);/*$('#chosen-subhead').html('<center><h2>'+chosen+'</h2></center>');
					var array = result.split('||');
					
					current_task_body = array[1];
					current_task_title = array[0];

					$('#task-title1').html(array[0]);
					$('#head-name1').append('<div class="head-name col-xs-6"><label><img id="img'+ array[2] + '" src="images/free-subhead.jpg" /></label></h6>')
					$('#task-description1').html(array[1]);
					var len = array.length;
					for(var x = 3 ; x < len ; x++) {
						($('#members-div').append('<div class="subhead-name col-xs-6"><label><img id="img'+ array[x] + '" src="images/free-subhead.jpg" /></label></h6>'));
					}*/

				}
			});

		}
	});	



	/*var chosen='';
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
	});*/
});