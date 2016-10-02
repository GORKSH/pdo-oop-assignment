$(document).ready(function (argument) {
	
	$('#user-credentials').keyup(function() {
		$('#credentials-error').html('');	
	});

	$('#user-password').keyup(function() {
		$('#password-error').html('');	
	});

	var credentials, password;
	var correct_input = true;
	
	$('#login-button').click(function(event) {
		event.preventDefault(event);
		
		credentials = $('#user-credentials').val();
		password = $('#user-password').val();

		if(credentials == '') {
			$('#credentials-error').html('cant be empty');
			correct_input = false;
		} else {
			$('#credentials-error').html('');
		}

		if(password == '') {
			correct_input = false;
			$('#password-error').html('cant be empty');	
		} else {
			$('#password-error').html('');	
		} 

		if(correct_input) {
			$.ajax({
				url: "../control/login.php",
				data : {credentials : credentials, 
					password : password },
				type: "POST",
				
				success:function(result){
					if (result != 'kick')
						window.location = result + '.php';
					else {
						alert('Your credentials did not match! Plz try again');
						$('#user-password').val('');	
						$('#user-credentials').val('');
					}
				}

			});
		}
	});
});