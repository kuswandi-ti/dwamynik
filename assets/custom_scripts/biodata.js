$(document).ready(function() {
	
	$('.dropify').dropify({
		messages: {
			default: 'Drag atau drop untuk memilih gambar',
			replace: 'Ganti',
			remove:  'Hapus',
			error:   'error'
		},
		error: {
			'fileSize': 'Maksimal ukuran file ({{ value }} max).',
		}
	});
	
    $('#alamat-ktp-provinsi').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kota', 
				type: 'POST', 
				data: {
					provinsi_id: $(this).val()				
				}, 
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-ktp-kota').removeAttr('disabled'); 
					$('#alamat-ktp-kota option').remove(); 
					$('#alamat-ktp-kecamatan option').remove(); 
					$('#alamat-ktp-desa option').remove(); 
					$('#alamat-ktp-kota').append(fnd); 
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error) {
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			}); 
		} else {
			$('#alamat-ktp-kota').attr('disabled', 'disabled'); 
			$('#alamat-ktp-kecamatan').attr('disabled', 'disabled'); 
			$('#alamat-ktp-desa').attr('disabled', 'disabled'); 
			$('#alamat-ktp-kota option').remove(); 
			$('#alamat-ktp-kecamatan option').remove(); 
			$('#alamat-ktp-desa option').remove(); 
		} 
	});
	
    $('#alamat-ktp-kota').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kecamatan', 
				type: 'POST', 
				data: {
					kota_id: $(this).val()
				}, 
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-ktp-kecamatan').removeAttr('disabled'); 
					$('#alamat-ktp-kecamatan option').remove(); 
					$('#alamat-ktp-desa option').remove(); 
					$('#alamat-ktp-kecamatan').append(fnd); 
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error){
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			}); 
		} else {
			$('#alamat-ktp-kecamatan').attr('disabled', 'disabled'); 
			$('#alamat-ktp-desa').attr('disabled', 'disabled'); 
			$('#alamat-ktp-kecamatan option').remove(); 
			$('#alamat-ktp-desa option').remove(); 
		} 
	});
	
    $('#alamat-ktp-kecamatan').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kelurahan', 
				type: 'POST', 
				data: {
					kecamatan_id: $(this).val()
				}, 
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-ktp-desa').removeAttr('disabled'); 
					$('#alamat-ktp-desa option').remove(); 
					$('#alamat-ktp-desa').append(fnd); 
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error){
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			}); 
		} else {
			$('#alamat-ktp-desa').attr('disabled', 'disabled'); 
			$('#alamat-ktp-desa option').remove(); 
		} 
	});
    
	$('#alamat-dom-provinsi').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kota', 
				type: 'POST', 
				data: {
					provinsi_id: $(this).val()
				}, 
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-dom-kota').removeAttr('disabled'); 
					$('#alamat-dom-kota option').remove(); 
					$('#alamat-dom-kecamatan option').remove(); 
					$('#alamat-dom-desa option').remove(); 
					$('#alamat-dom-kota').append(fnd); 
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error){
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			}); 
		} else {
			$('#alamat-dom-kota').attr('disabled', 'disabled'); 
			$('#alamat-dom-kecamatan').attr('disabled', 'disabled'); 
			$('#alamat-dom-desa').attr('disabled', 'disabled'); 
			$('#alamat-dom-kota option').remove(); 
			$('#alamat-dom-kecamatan option').remove(); 
			$('#alamat-dom-desa option').remove(); 
		} 
	});
	
    $('#alamat-dom-kota').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kecamatan', 
				type: 'POST', 
				data: {
					kota_id: $(this).val()
				}, 
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-dom-kecamatan').removeAttr('disabled'); 
					$('#alamat-dom-kecamatan option').remove(); 
					$('#alamat-dom-desa option').remove(); 
					$('#alamat-dom-kecamatan').append(fnd); 
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error){
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			}); 
		} else {
			$('#alamat-dom-kecamatan').attr('disabled', 'disabled'); 
			$('#alamat-dom-desa').attr('disabled', 'disabled'); 
			$('#alamat-dom-kecamatan option').remove(); 
			$('#alamat-dom-desa option').remove(); 
		} 
	});
	
    $('#alamat-dom-kecamatan').change(function() {
		if ($(this).val() != '') {
			$.ajax({
				url: 'biodata/get_kelurahan',
				type: 'POST',
				data: {
					kecamatan_id: $(this).val()
				},
				beforeSend: function() {
					$('body').mLoading('show'); 
				},
				success: function(fnd) {
					$('#alamat-dom-desa').removeAttr('disabled');
					$('#alamat-dom-desa option').remove();
					$('#alamat-dom-desa').append(fnd);
					$('body').mLoading('hide');
				}, 
				error: function(xhr, status, error){
					$('body').mLoading('hide');
					var errorMessage = xhr.status + ': ' + xhr.statusText
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: errorMessage,
					});
				}
			});
		} else {
			$('#alamat-dom-desa').attr('disabled', 'disabled');
			$('#alamat-dom-desa option').remove();
		}
	});
	
	$(".edit").click(function(e) {
		e.preventDefault();		
		if ($('#img-kk').val() == '' && $('#img-ktp').val() == '' && $('#img-npwp').val() == '' && $('#img-ijazah').val() == '') {
		   alert('Pilih file terlebih dahulu!');
		   return false;
	    }
		
		$(".edit").html('Processing...');
		$(".edit").prop("disabled", true);
				   
		var form = $('#form_submit')[0];
		var formData = new FormData(form);
		
		formData.append('nik', $("#txtnik").val());
		formData.append('file_kk_edit', $('.img_kk').attr('src'));
		formData.append('file_ktp_edit', $('.img_ktp').attr('src'));
		formData.append('file_npwp_edit', $('.img_npwp').attr('src'));
		formData.append('file_ijazah_edit', $('.img_ijazah').attr('src'));
			
		$.ajax({
			type: 'POST',
			url: 'biodata/update_image',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$('.edit').prop('disabled', true);
				$('body').mLoading('show'); 
			},
			success: function(result) {
				$('.edit').prop('disabled', false);
				$("body").mLoading('hide');		
				$(".edit").html('Simpan Atatachment');
				$(".edit").prop("disabled", false);
				$('#img_kk').removeAttr('src')
				$('#img_kk').show();
				$('#img_ktp').removeAttr('src')
				$('#img_ktp').show();
				$('#img_npwp').removeAttr('src')
				$('#img_npwp').show();
				$('#img_ijazah').removeAttr('src')
				$('#img_ijazah').show();
				$.toast({
					heading				: 'Success',
					text				: result,
					showHideTransition	: 'slide',
					position			: 'top-center',
					loaderBg			: '#ff6849',
					icon				: 'success',
					hideAfter			: 5000,
					afterHidden: function () {
						window.location.reload(true);
					}
				});
			},
			error: function(xhr, status, error) {
				$('body').mLoading('hide');
				var errorMessage = xhr.status + ': ' + xhr.statusText
				Swal.fire({
					type 		: 'error',
					title 		: '<strong>Error</strong>',
					html 		: errorMessage,
				});
				$(".edit").html('Simpan Atatachment');
				$(".edit").prop("disabled", false);
			}
		});
	});
	
	$("body").on("click", "#btn_update", function(e) {
		/*
		var provinsi_ktp	= $("#alamat-ktp-provinsi option:selected").text();
		var kota_ktp		= $("#alamat-ktp-kota option:selected").text();
		var kec_ktp			= $("#alamat-ktp-kecamatan option:selected").text();
		var desa_ktp		= $("#alamat-ktp-desa option:selected").text();
		var provinsi_dom	= $("#alamat-dom-provinsi option:selected").text();
		var kota_dom		= $("#alamat-dom-kota option:selected").text();
		var kec_dom			= $("#alamat-dom-kecamatan option:selected").text();
		var desa_dom		= $("#alamat-dom-desa option:selected").text();
		var data = $('#form_update').serialize() + 
		           "&provinsi_ktp="+provinsi_ktp+"&kota_ktp="+kota_ktp+"&kec_ktp=kec_ktp&desa_ktp=desa_ktp&"+
				   "provinsi_dom=provinsi_dom&kota_dom=kota_dom&kec_dom=kec_dom&desa_dom=desa_dom";
		*/
		
		e.preventDefault();		
		
		var $form = $('#form_update');
		var data = {
			'provinsi_ktp' 	: $("#alamat-ktp-provinsi option:selected").text(),
			'kota_ktp' 		: $("#alamat-ktp-kota option:selected").text(),
			'kec_ktp' 		: $("#alamat-ktp-kecamatan option:selected").text(),
			'desa_ktp' 		: $("#alamat-ktp-desa option:selected").text(),
			'provinsi_dom' 	: $("#alamat-dom-provinsi option:selected").text(),
			'kota_dom' 		: $("#alamat-dom-kota option:selected").text(),
			'kec_dom' 		: $("#alamat-dom-kecamatan option:selected").text(),
			'desa_dom' 		: $("#alamat-dom-desa option:selected").text(),
		};
		data = $form.serialize() + '&' + $.param(data);
		
    	Swal.fire({
			title 				: 'Update Data ?',
			html 				: 'Yakin akan melanjutkan proses update data ?',
			type 				: 'question',
			showCancelButton 	: true,
			confirmButtonText 	: 'Yes',
			cancelButtonText 	: "No",
			confirmButtonClass 	: "btn-warning",
			showLoaderOnConfirm : true,
			preConfirm 			: function() {
			  	return new Promise(function(resolve) {
					$("#btn_update").html('Processing...');
					$("#btn_update").prop("disabled", true);
					$.ajax({
						url 		: 'biodata/update',
						type 		: 'POST',
						dataType 	: 'json',
						data 		: data,
						beforeSend: function() {
							$('body').mLoading('show'); 
						},
					})
					.done(function(response){
						$('body').mLoading('hide');
						$("#btn_update").html('Simpan Perubahan');
						$("#btn_update").prop("disabled", false);
						swal.close(); // https://stackoverflow.com/questions/44973038/how-to-close-sweet-alert-on-ajax-request-completion
						if (response.error_update) {
					  		Swal.fire({
								type 		: 'error',
							  	title 		: '<strong>Error</strong>',
							    html 		: '<u>Kemungkinan error :</u> <br>'+
							                  response.error_update,							
							});
						} else if (response.success) {
							$('body').mLoading('hide');
							$.toast({
					        	heading				: 'Successfully',
					            text				: response.success,
					            showHideTransition	: 'slide',
					            position			: 'top-center',
					            loaderBg			: '#ff6849',
					            icon				: 'success',
					            hideAfter			: 5000,
								afterHidden: function () {
									window.location.reload(true);
								}
							});
						}
					})
					.fail(function(xhr, status, error) {
						$('body').mLoading('hide');
						$("#btn_update").html('Simpan Perubahan');
						$("#btn_update").prop("disabled", false);
						var errorMessage = xhr.status + ': ' + xhr.statusText
						Swal.fire({
							type 		: 'error',
						  	title 		: '<strong>Error</strong>',
						    text 		: errorMessage,
						});
					});
			  	});
			},
			allowOutsideClick: false     
		});
    });
	
});