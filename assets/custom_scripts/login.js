$(document).ready(function() { 

	$('#nik').focus(); 

	$('#form_login').submit(function(e) {
		e.preventDefault();
		$("#btn_login").html('Processing...');
		$("#btn_login").prop("disabled", true);
		$.ajax({
			type 		: 'POST',
			url 		: 'login/do_login',
			dataType	: 'json',
			data 		: $('#form_login').serialize(),
			beforeSend: function() {
				$('body').mLoading('show'); 
			},
			success 	: function(response) {	
				$("#btn_login").html('Submit');
				$("#btn_login").prop("disabled", false);			
				if(response.error_validation) {
					$('body').mLoading('hide');
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: '<u>Kemungkinan error :</u> <br><br>'+
									  response.error_validation,
					});	
					$('#nik').focus();
				} else if(response.error) {
					$('body').mLoading('hide');
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: '<u>Kemungkinan error :</u> <br><br>'+
									  response.error,
					});
					$('#nik').focus();
				} else if(response.success) {
					$('body').mLoading('hide');
					$.toast({
			        	heading				: 'Success',
			            text				: response.success,
			            showHideTransition	: 'slide',
			            position			: 'top-center',
			            loaderBg			: '#ff6849',
			            icon				: 'success',
			            hideAfter			: 2000,
			            afterHidden: function () {
        					window.location.href = 'home';
    					}
			    	});					
				}				
			},
     		error: function(xhr, status, error) {
				$('body').mLoading('hide');
         		var errorMessage = xhr.status + ': ' + xhr.statusText
				Swal.fire({
					type 		: 'error',
					title 		: '<strong>Error</strong>',
					html 		: errorMessage,
				});
		    	$("#btn_login").html('Submit');
				$("#btn_login").prop("disabled", false);
     		}
		});
	});

});