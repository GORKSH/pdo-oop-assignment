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

$(document).ready(function(){

	getSubHeadsLists();

	$('#logout-button').click(function (event) {
		logout();	
	});


	var chosen='';
	$('#busy-subheads').on('click', '.subhead-name', function(){
		//alert('alert');
		$('#busy-subheads .check').each(function(){
			$(this).prop("checked", false);//alert($(this).attr('id'));
		});

		$(this).find('.check').prop("checked", true);
		chosen = $(this).attr('id');
	});

	
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
});