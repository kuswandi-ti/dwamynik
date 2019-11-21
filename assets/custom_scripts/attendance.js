$(document).ready(function() {  

	$('body').on('click', '#show_detail_peringatan', function (e) {
		e.preventDefault();

		var id = $(this).data('id');
		var no = $(this).data('no');

		$.ajax({
			url: 'attendance/detail_data_sp',
			data: {
				id: id
			},
			type: 'POST',
			dataType: 'json',
			beforeSend: function() {
				$('body').mLoading('show');
			},
			complete: function() {
				$('body').mLoading('hide');
			},
			success: function(data) {
				$('body').mLoading('hide');
				$('#caption_detail_peringatan').text('No. Surat Peringatan (SP) : ' + no);

				var html = '';
                var i;
                html += '<table class="table table-striped color-table info-table">';
                html += 	'<thead>';
                html += 		'<tr>';
                html += 			'<th class="text-center align-middle" width="25%">Pasal Pelanggaran</th>';
                html += 			'<th class="text-center align-middle">Desc SP</th>';
                html += 		'</tr>';
                html += 	'</thead">';
                html += 	'<tbody>';
                for(i=0; i<data.length; i++){
                    html += 	'<tr>'+
                            		'<td>'+data[i].bab+' - '+data[i].pasal+' - Ayat '+data[i].ayat+'</td>'+
                            		'<td>'+data[i].butir_desc+'</td>'+
                            	'</tr>';
                }
                html += 	'</tbody>';
                html += '</table>';
                $('#data_detail_peringatan').html(html);
				$('#modal_detail_peringatan').modal('show');				
			}
		});
	});
	
});