<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
	
	private $sess_nik;
	private $table_trx_tunjangankaryawan;
	private $table_trx_tunjanganstaff;
	private $table_tmp_rekapabsen;
	private $view_hst_absen;
	
	public function __construct() {
		parent::__construct();
		$this->auth->restrict();
		$this->sess_nik = $this->session->userdata('sess_nik_mynik');
		$this->table_trx_tunjangankaryawan = $this->config->item('TABLE_TRX_TUNJANGAN_KARYAWAN');
		$this->table_trx_tunjanganstaff = $this->config->item('TABLE_TRX_TUNJANGAN_STAFF');
		$this->table_tmp_rekapabsen = $this->config->item('TABLE_TMP_REKAP_ABSENSI');
		$this->view_hst_absen = $this->config->item('VIEW_HISTORY_ABSENSI');
		$this->load->model('m_attendance');	
	}

	public function index() {
		$data = array(
			'title'             	=> 'Attendance',
			'page_title'        	=> 'Attendance',
			'sub_page_title'    	=> '',
			'active_menu_root'  	=> '',
			'active_menu_child' 	=> '',
			'breadcrumb'        	=> '<li class="breadcrumb-item"><i class="fas fa-home"></i><a href="home"> Home</a></li>
										<li class="breadcrumb-item active">Attendance</li>',
			'tahun' 				=> date('Y'),
			'get_data_sp'			=> $this->get_data_sp(),
			'custom_scripts'    	=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."attendance.js type='text/javascript'></script>"
		);
		
		$this->template->view('v_attendance', $data);
	}

	public function get_data_sp() {
		$data = $this->m_attendance->detail_data('id, no_ba, tgl_ba, desc_surat_recomend, tgl_mb_awal, tgl_mb_akhir, masa_berlaku', $this->config->item('TABLE_TRX_BERITA_ACARA_HDR'), array('nik' => $this->sess_nik), 'tgl_ba');
		return $data;
	}

	public function detail_data_sp() {
		$id_hdr = $this->input->post('id');

		$data = $this->m_attendance->detail_data('bab, pasal, ayat, butir_desc', $this->config->item('TABLE_TRX_BERITA_ACARA_DTL'), array('id_hdr' => $id_hdr), 'id');
		echo json_encode($data);
	}
	
	public function total_data_kehadiran($tabel, $tahun, $bulan, $kode_kehadiran) {
		$data = $this->m_attendance->total_data($tabel, 
		                                        array('NIK' => $this->sess_nik, 
												      'YEAR(TANGGAL)' => $tahun, 
													  'MONTH(TANGGAL)' => $bulan, 
													  'HADIR' => $kode_kehadiran));
		return $data;
	}

	public function detail_data_kehadiran($select, $tabel, $tahun, $bulan, $kode_kehadiran, $order) {
		$data = $this->m_attendance->detail_data($select, $tabel, 
		                                         array('NIK' => $this->sess_nik, 
												       'YEAR(TANGGAL)' => $tahun, 
													   'MONTH(TANGGAL)' => $bulan, 
													   'HADIR' => $kode_kehadiran),
		                                         $order);
		return $data;
	}

	public function total_data_ijin($tabel, $tahun, $bulan, $kode_ijin) {
		$data = $this->m_attendance->total_data($tabel, 
		                                        array('NIK' => $this->sess_nik, 
												      'TAHUN' => $tahun, 
													  'BULAN' => $bulan, 
													  'KODEIJIN' => $kode_ijin));
		return $data;
	}

	public function detail_data_ijin($select, $tabel, $tahun, $bulan, $kode_ijin, $order) {
		$data = $this->m_attendance->detail_data($select, $tabel, 
		                                         array('NIK' => $this->sess_nik, 
												       'TAHUN' => $tahun, 
													   'BULAN' => $bulan, 
													   'KODEIJIN' => $kode_ijin),
		                                         $order);
		return $data;
	}

	public function proses_absen() {
		if ($this->input->post('thn') != null ) {
			redirect('attendance/absensi/'.$this->input->post('thn')); 
		}
	}

	public function detail_absensi_per_bulan($id_modal, 
		                                     $caption_bulan, 
		                                     $array_detail_T, 
		                                     $array_detail_I, 
		                                     $array_detail_A, 
		                                     $array_detail_SKD, 
		                                     $array_detail_S) {
		$result 	= 	'<div class="modal" id="'.$id_modal.'" tabindex="-1" role="dialog">';
		$result 	.=		'<div class="modal-dialog modal-lg" role="document" style="max-width:100%!important;">';
		$result		.=			'<div class="modal-content">';
		$result		.=           	'<div class="modal-header">';
		$result		.=		         	'<h5 class="modal-title">Detail Absensi ('.$caption_bulan.')</h5>';
		$result		.=		            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
		$result		.=				'</div>';
		$result		.=				'<div class="modal-body">';
		$result		.=					'<div class="row">';
		$result		.=		            	'<div class="col-md-4 col-xs-6 b-r">';
		$result		.=		                	'<h3 class="text-warning">Terlambat (T)</h3>';
				                    			if (!empty($array_detail_T)) {
				                        			foreach ($array_detail_T as $row) {
				                        				if ($row['TANGGAL'] != null) {
		$result		.=		                            	'<ul class="list-group">';
		$result		.=		                                	'<li class="list-group-item">';
		$result		.=		                                    	'<i class="mdi mdi-check"></i>'.date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row["TANGGAL"]));
		$result		.=												'<span class="label label-danger">'.$row['JAMIN'].'</span>';
		$result		.=		                                    '</li>';
		$result		.=		                                '</ul>';
				                            			}
				                        			}
				             					}
		$result		.=		                    '<br>';
		$result		.=		   				'</div>';
		$result		.=		                '<div class="col-md-4 col-xs-6 b-r">';
		$result		.=		                	'<h3 class="text-info">Ijin (I)</h3>';
				                    			if (!empty($array_detail_I)) {
				                    				foreach ($array_detail_I as $row) {
				                            			if ($row['TGLIJIN'] != null) {
		$result		.=		                            	'<ul class="list-group">';
		$result		.=		                                    '<li class="list-group-item">';
		$result		.=		                                        '<i class="mdi mdi-check"></i>'.date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row["TGLIJIN"]));
		$result		.=		                                    '</li>';
		$result		.=		                                '</ul>';
				                            			}
				                        			}
				                     			}
		$result		.=		                	'<br>';
		$result		.=		              	'</div>';
		$result		.=		                '<div class="col-md-4 col-xs-6 b-r">';
		$result		.=		                	'<h3 class="text-danger">Alpha (A)</h3>';
				                    			if (!empty($array_detail_A)) {
				                    				foreach ($array_detail_A as $row) {
				                            			if ($row['TANGGAL'] != null) {
		$result		.=		                            	'<ul class="list-group">';
		$result		.=		                                    '<li class="list-group-item">';
		$result		.=		                                        '<i class="mdi mdi-check"></i>'.date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row["TANGGAL"]));
		$result		.=		                                    '</li>';
		$result		.=		                                '</ul>';
				                            			}
				                        			}
				                     			}
		$result		.=		                	'<br>';
		$result		.=		              	'</div>';
		$result		.=						'<br><br>';
		$result		.=		        	'</div>';
		$result		.=					'<div class="row">';
		$result		.=		            	'<div class="col-md-4 col-xs-6 b-r">';
		$result		.=		                	'<h3 class="text-primary">Sakit Keterangan Dokoter (SKD)</h3>';
				                    			if (!empty($array_detail_SKD)) {
				                    				foreach ($array_detail_SKD as $row) {
				                            			if ($row['TGLIJIN'] != null) {
		$result		.=		                            	'<ul class="list-group">';
		$result		.=		                                    '<li class="list-group-item">';
		$result		.=		                                        '<i class="mdi mdi-check"></i>'.date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row["TGLIJIN"]));
		$result		.=		                                    '</li>';
		$result		.=		                                '</ul>';
				                            			}
				                        			}
				                     			}
		$result		.=		                	'<br>';
		$result		.=		              	'</div>';
		$result		.=		                '<div class="col-md-4 col-xs-6 b-r">';
		$result		.=		                	'<h3 class="text-success">Sakit (S)</h3>';
				                    			if (!empty($array_detail_S)) {
				                    				foreach ($array_detail_S as $row) {
				                            			if ($row['TGLIJIN'] != null) {
		$result		.=		                            	'<ul class="list-group">';
		$result		.=		                                    '<li class="list-group-item">';
		$result		.=		                                        '<i class="mdi mdi-check"></i>'.date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row["TGLIJIN"]));
		$result		.=		                                    '</li>';
		$result		.=		                                '</ul>';
				                            			}
				                        			}
			                     				}
		$result		.=		                	'<br>';
		$result		.=		              	'</div>';
		$result		.=						'<br><br>';
		$result		.=		        	'</div>';
		$result		.=		        '</div>';
		$result		.=			'</div>';
		$result		.=		'</div>';
		$result		.=	'</div>';

		return $result;
	}
	
	public function absensi($tahun = null) {
		if ($tahun != null) {
			$pc_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$this->db->delete($this->config->item('TABLE_TMP_REKAP_ABSENSI'), array('NIK' => $this->sess_nik, 'login_current' => $this->sess_nik, 'pc_name' => $pc_name));

			/* Terlambat */
			$arr_total_terlambat_per_bulan = array();
			$arr_detail_terlambat_per_bulan = array();
			for ($x = 0; $x <= 11 ; $x++) {
				$arr_total_terlambat_per_bulan[$x] = $this->total_data_kehadiran($this->table_trx_tunjangankaryawan, $tahun, $x+1, 'T') +
				                                     $this->total_data_kehadiran($this->table_trx_tunjanganstaff, $tahun, $x+1, 'T');
				$arr_detail_terlambat_per_bulan[$x] = array_merge(
														$this->detail_data_kehadiran('TANGGAL, JAMIN', $this->table_trx_tunjangankaryawan, $tahun, $x+1, 'T', 'TANGGAL'),
													  	$this->detail_data_kehadiran('TANGGAL, JAMIN', $this->table_trx_tunjanganstaff, $tahun, $x+1, 'T', 'TANGGAL')
													  );
			}

			/* Ijin */
			$arr_total_ijin_per_bulan = array();
			$arr_detail_ijin_per_bulan = array();
			for ($x = 0; $x <= 11 ; $x++) {
				$arr_total_ijin_per_bulan[$x] = $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'I1') +
				                                $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'I2') +
				                                $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'I3') +
				                                $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'IP') +
				                                $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'IS');
				$arr_detail_ijin_per_bulan[$x] = array_merge(
													$this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'I1', 'TGLIJIN'),
												  	$this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'I2', 'TGLIJIN'),
												  	$this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'I3', 'TGLIJIN'),
												  	$this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'IP', 'TGLIJIN'),
												  	$this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'IS', 'TGLIJIN')
											     );
			}

			/* Alpa */
			$arr_total_alpa_per_bulan = array();
			$arr_detail_alpa_per_bulan = array();
			for ($x = 0; $x <= 11 ; $x++) {
				$arr_total_alpa_per_bulan[$x] = $this->total_data_kehadiran($this->table_trx_tunjangankaryawan, $tahun, $x+1, 'A') +
				                                $this->total_data_kehadiran($this->table_trx_tunjanganstaff, $tahun, $x+1, 'A');
				$arr_detail_alpa_per_bulan[$x] = array_merge(
												 	$this->detail_data_kehadiran('TANGGAL', $this->table_trx_tunjangankaryawan, $tahun, $x+1, 'A', 'TANGGAL'),
													$this->detail_data_kehadiran('TANGGAL', $this->table_trx_tunjanganstaff, $tahun, $x+1, 'A', 'TANGGAL')
												 );
			}

			/* Sakit */
			$arr_total_sakit_per_bulan = array();
			$arr_detail_sakit_per_bulan = array();
			for ($x = 0; $x <= 11 ; $x++) {
				$arr_total_sakit_per_bulan[$x] = $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'S');
				$arr_detail_sakit_per_bulan[$x] = $this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'S', 'TGLIJIN');
			}

			/* SKD */
			$arr_total_skd_per_bulan = array();
			$arr_detail_skd_per_bulan = array();
			for ($x = 0; $x <= 11 ; $x++) {
				$arr_total_skd_per_bulan[$x] = $this->total_data_ijin($this->view_hst_absen, $tahun, $x+1, 'SKD');
				$arr_detail_skd_per_bulan[$x] = $this->detail_data_ijin('TGLIJIN', $this->view_hst_absen, $tahun, $x+1, 'SKD', 'TGLIJIN');
			}

			$data = array(
				'title'             				=> 'Attendance',
				'page_title'        				=> 'Attendance',
				'sub_page_title'    				=> '',
				'active_menu_root'  				=> '',
				'active_menu_child' 				=> '',
				'breadcrumb'        				=> '<li class="breadcrumb-item"><i class="fas fa-home"></i><a href="home"> Home</a></li>
														<li class="breadcrumb-item active">Attendance</li>',

				'tahun' 							=> $tahun,

				'TOTAL_TERLAMBAT_1'					=> $arr_total_terlambat_per_bulan[0],
				'TOTAL_TERLAMBAT_2'					=> $arr_total_terlambat_per_bulan[1],
				'TOTAL_TERLAMBAT_3'					=> $arr_total_terlambat_per_bulan[2],
				'TOTAL_TERLAMBAT_4'					=> $arr_total_terlambat_per_bulan[3],
				'TOTAL_TERLAMBAT_5'					=> $arr_total_terlambat_per_bulan[4],
				'TOTAL_TERLAMBAT_6'					=> $arr_total_terlambat_per_bulan[5],
				'TOTAL_TERLAMBAT_7'					=> $arr_total_terlambat_per_bulan[6],
				'TOTAL_TERLAMBAT_8'					=> $arr_total_terlambat_per_bulan[7],
				'TOTAL_TERLAMBAT_9'					=> $arr_total_terlambat_per_bulan[8],
				'TOTAL_TERLAMBAT_10'				=> $arr_total_terlambat_per_bulan[9],
				'TOTAL_TERLAMBAT_11'				=> $arr_total_terlambat_per_bulan[10],
				'TOTAL_TERLAMBAT_12'				=> $arr_total_terlambat_per_bulan[11],
				'DETAIL_TERLAMBAT_1'				=> $arr_detail_terlambat_per_bulan[0],
				'DETAIL_TERLAMBAT_2'				=> $arr_detail_terlambat_per_bulan[1],
				'DETAIL_TERLAMBAT_3'				=> $arr_detail_terlambat_per_bulan[2],
				'DETAIL_TERLAMBAT_4'				=> $arr_detail_terlambat_per_bulan[3],
				'DETAIL_TERLAMBAT_5'				=> $arr_detail_terlambat_per_bulan[4],
				'DETAIL_TERLAMBAT_6'				=> $arr_detail_terlambat_per_bulan[5],
				'DETAIL_TERLAMBAT_7'				=> $arr_detail_terlambat_per_bulan[6],
				'DETAIL_TERLAMBAT_8'				=> $arr_detail_terlambat_per_bulan[7],
				'DETAIL_TERLAMBAT_9'				=> $arr_detail_terlambat_per_bulan[8],
				'DETAIL_TERLAMBAT_10'				=> $arr_detail_terlambat_per_bulan[9],
				'DETAIL_TERLAMBAT_11'				=> $arr_detail_terlambat_per_bulan[10],
				'DETAIL_TERLAMBAT_12'				=> $arr_detail_terlambat_per_bulan[11],

				'TOTAL_IJIN_1'						=> $arr_total_ijin_per_bulan[0],
				'TOTAL_IJIN_2'						=> $arr_total_ijin_per_bulan[1],
				'TOTAL_IJIN_3'						=> $arr_total_ijin_per_bulan[2],
				'TOTAL_IJIN_4'						=> $arr_total_ijin_per_bulan[3],
				'TOTAL_IJIN_5'						=> $arr_total_ijin_per_bulan[4],
				'TOTAL_IJIN_6'						=> $arr_total_ijin_per_bulan[5],
				'TOTAL_IJIN_7'						=> $arr_total_ijin_per_bulan[6],
				'TOTAL_IJIN_8'						=> $arr_total_ijin_per_bulan[7],
				'TOTAL_IJIN_9'						=> $arr_total_ijin_per_bulan[8],
				'TOTAL_IJIN_10'						=> $arr_total_ijin_per_bulan[9],
				'TOTAL_IJIN_11'						=> $arr_total_ijin_per_bulan[10],
				'TOTAL_IJIN_12'						=> $arr_total_ijin_per_bulan[11],
				'DETAIL_IJIN_1'						=> $arr_detail_ijin_per_bulan[0],
				'DETAIL_IJIN_2'						=> $arr_detail_ijin_per_bulan[1],
				'DETAIL_IJIN_3'						=> $arr_detail_ijin_per_bulan[2],
				'DETAIL_IJIN_4'						=> $arr_detail_ijin_per_bulan[3],
				'DETAIL_IJIN_5'						=> $arr_detail_ijin_per_bulan[4],
				'DETAIL_IJIN_6'						=> $arr_detail_ijin_per_bulan[5],
				'DETAIL_IJIN_7'						=> $arr_detail_ijin_per_bulan[6],
				'DETAIL_IJIN_8'						=> $arr_detail_ijin_per_bulan[7],
				'DETAIL_IJIN_9'						=> $arr_detail_ijin_per_bulan[8],
				'DETAIL_IJIN_10'					=> $arr_detail_ijin_per_bulan[9],
				'DETAIL_IJIN_11'					=> $arr_detail_ijin_per_bulan[10],
				'DETAIL_IJIN_12'					=> $arr_detail_ijin_per_bulan[11],

				'TOTAL_ALPA_1'						=> $arr_total_alpa_per_bulan[0],
				'TOTAL_ALPA_2'						=> $arr_total_alpa_per_bulan[1],
				'TOTAL_ALPA_3'						=> $arr_total_alpa_per_bulan[2],
				'TOTAL_ALPA_4'						=> $arr_total_alpa_per_bulan[3],
				'TOTAL_ALPA_5'						=> $arr_total_alpa_per_bulan[4],
				'TOTAL_ALPA_6'						=> $arr_total_alpa_per_bulan[5],
				'TOTAL_ALPA_7'						=> $arr_total_alpa_per_bulan[6],
				'TOTAL_ALPA_8'						=> $arr_total_alpa_per_bulan[7],
				'TOTAL_ALPA_9'						=> $arr_total_alpa_per_bulan[8],
				'TOTAL_ALPA_10'						=> $arr_total_alpa_per_bulan[9],
				'TOTAL_ALPA_11'						=> $arr_total_alpa_per_bulan[10],
				'TOTAL_ALPA_12'						=> $arr_total_alpa_per_bulan[11],
				'DETAIL_ALPA_1'						=> $arr_detail_alpa_per_bulan[0],
				'DETAIL_ALPA_2'						=> $arr_detail_alpa_per_bulan[1],
				'DETAIL_ALPA_3'						=> $arr_detail_alpa_per_bulan[2],
				'DETAIL_ALPA_4'						=> $arr_detail_alpa_per_bulan[3],
				'DETAIL_ALPA_5'						=> $arr_detail_alpa_per_bulan[4],
				'DETAIL_ALPA_6'						=> $arr_detail_alpa_per_bulan[5],
				'DETAIL_ALPA_7'						=> $arr_detail_alpa_per_bulan[6],
				'DETAIL_ALPA_8'						=> $arr_detail_alpa_per_bulan[7],
				'DETAIL_ALPA_9'						=> $arr_detail_alpa_per_bulan[8],
				'DETAIL_ALPA_10'					=> $arr_detail_alpa_per_bulan[9],
				'DETAIL_ALPA_11'					=> $arr_detail_alpa_per_bulan[10],
				'DETAIL_ALPA_12'					=> $arr_detail_alpa_per_bulan[11],

				'TOTAL_SKD_1'						=> $arr_total_skd_per_bulan[0],
				'TOTAL_SKD_2'						=> $arr_total_skd_per_bulan[1],
				'TOTAL_SKD_3'						=> $arr_total_skd_per_bulan[2],
				'TOTAL_SKD_4'						=> $arr_total_skd_per_bulan[3],
				'TOTAL_SKD_5'						=> $arr_total_skd_per_bulan[4],
				'TOTAL_SKD_6'						=> $arr_total_skd_per_bulan[5],
				'TOTAL_SKD_7'						=> $arr_total_skd_per_bulan[6],
				'TOTAL_SKD_8'						=> $arr_total_skd_per_bulan[7],
				'TOTAL_SKD_9'						=> $arr_total_skd_per_bulan[8],
				'TOTAL_SKD_10'						=> $arr_total_skd_per_bulan[9],
				'TOTAL_SKD_11'						=> $arr_total_skd_per_bulan[10],
				'TOTAL_SKD_12'						=> $arr_total_skd_per_bulan[11],
				'DETAIL_SKD_1'						=> $arr_detail_skd_per_bulan[0],
				'DETAIL_SKD_2'						=> $arr_detail_skd_per_bulan[1],
				'DETAIL_SKD_3'						=> $arr_detail_skd_per_bulan[2],
				'DETAIL_SKD_4'						=> $arr_detail_skd_per_bulan[3],
				'DETAIL_SKD_5'						=> $arr_detail_skd_per_bulan[4],
				'DETAIL_SKD_6'						=> $arr_detail_skd_per_bulan[5],
				'DETAIL_SKD_7'						=> $arr_detail_skd_per_bulan[6],
				'DETAIL_SKD_8'						=> $arr_detail_skd_per_bulan[7],
				'DETAIL_SKD_9'						=> $arr_detail_skd_per_bulan[8],
				'DETAIL_SKD_10'						=> $arr_detail_skd_per_bulan[9],
				'DETAIL_SKD_11'						=> $arr_detail_skd_per_bulan[10],
				'DETAIL_SKD_12'						=> $arr_detail_skd_per_bulan[11],

				'TOTAL_SAKIT_1'						=> $arr_total_sakit_per_bulan[0],
				'TOTAL_SAKIT_2'						=> $arr_total_sakit_per_bulan[1],
				'TOTAL_SAKIT_3'						=> $arr_total_sakit_per_bulan[2],
				'TOTAL_SAKIT_4'						=> $arr_total_sakit_per_bulan[3],
				'TOTAL_SAKIT_5'						=> $arr_total_sakit_per_bulan[4],
				'TOTAL_SAKIT_6'						=> $arr_total_sakit_per_bulan[5],
				'TOTAL_SAKIT_7'						=> $arr_total_sakit_per_bulan[6],
				'TOTAL_SAKIT_8'						=> $arr_total_sakit_per_bulan[7],
				'TOTAL_SAKIT_9'						=> $arr_total_sakit_per_bulan[8],
				'TOTAL_SAKIT_10'					=> $arr_total_sakit_per_bulan[9],
				'TOTAL_SAKIT_11'					=> $arr_total_sakit_per_bulan[10],
				'TOTAL_SAKIT_12'					=> $arr_total_sakit_per_bulan[11],
				'DETAIL_SAKIT_1'					=> $arr_detail_sakit_per_bulan[0],
				'DETAIL_SAKIT_2'					=> $arr_detail_sakit_per_bulan[1],
				'DETAIL_SAKIT_3'					=> $arr_detail_sakit_per_bulan[2],
				'DETAIL_SAKIT_4'					=> $arr_detail_sakit_per_bulan[3],
				'DETAIL_SAKIT_5'					=> $arr_detail_sakit_per_bulan[4],
				'DETAIL_SAKIT_6'					=> $arr_detail_sakit_per_bulan[5],
				'DETAIL_SAKIT_7'					=> $arr_detail_sakit_per_bulan[6],
				'DETAIL_SAKIT_8'					=> $arr_detail_sakit_per_bulan[7],
				'DETAIL_SAKIT_9'					=> $arr_detail_sakit_per_bulan[8],
				'DETAIL_SAKIT_10'					=> $arr_detail_sakit_per_bulan[9],
				'DETAIL_SAKIT_11'					=> $arr_detail_sakit_per_bulan[10],
				'DETAIL_SAKIT_12'					=> $arr_detail_sakit_per_bulan[11],

				'MODAL_ABSEN_1'						=> $this->detail_absensi_per_bulan('modal_dtl_1', 'Januari '.$tahun, $arr_detail_terlambat_per_bulan[0], $arr_detail_ijin_per_bulan[0], $arr_detail_alpa_per_bulan[0], $arr_detail_skd_per_bulan[0], $arr_detail_sakit_per_bulan[0]),
				'MODAL_ABSEN_2'						=> $this->detail_absensi_per_bulan('modal_dtl_2', 'Februari '.$tahun, $arr_detail_terlambat_per_bulan[1], $arr_detail_ijin_per_bulan[1], $arr_detail_alpa_per_bulan[1], $arr_detail_skd_per_bulan[1], $arr_detail_sakit_per_bulan[1]),
				'MODAL_ABSEN_3'						=> $this->detail_absensi_per_bulan('modal_dtl_3', 'Maret '.$tahun, $arr_detail_terlambat_per_bulan[2], $arr_detail_ijin_per_bulan[2], $arr_detail_alpa_per_bulan[2], $arr_detail_skd_per_bulan[2], $arr_detail_sakit_per_bulan[2]),
				'MODAL_ABSEN_4'						=> $this->detail_absensi_per_bulan('modal_dtl_4', 'April '.$tahun, $arr_detail_terlambat_per_bulan[3], $arr_detail_ijin_per_bulan[3], $arr_detail_alpa_per_bulan[3], $arr_detail_skd_per_bulan[3], $arr_detail_sakit_per_bulan[3]),
				'MODAL_ABSEN_5'						=> $this->detail_absensi_per_bulan('modal_dtl_5', 'Mei '.$tahun, $arr_detail_terlambat_per_bulan[4], $arr_detail_ijin_per_bulan[4], $arr_detail_alpa_per_bulan[4], $arr_detail_skd_per_bulan[4], $arr_detail_sakit_per_bulan[4]),
				'MODAL_ABSEN_6'						=> $this->detail_absensi_per_bulan('modal_dtl_6', 'Juni '.$tahun, $arr_detail_terlambat_per_bulan[5], $arr_detail_ijin_per_bulan[5], $arr_detail_alpa_per_bulan[5], $arr_detail_skd_per_bulan[5], $arr_detail_sakit_per_bulan[5]),
				'MODAL_ABSEN_7'						=> $this->detail_absensi_per_bulan('modal_dtl_7', 'Juli '.$tahun, $arr_detail_terlambat_per_bulan[6], $arr_detail_ijin_per_bulan[6], $arr_detail_alpa_per_bulan[6], $arr_detail_skd_per_bulan[6], $arr_detail_sakit_per_bulan[6]),
				'MODAL_ABSEN_8'						=> $this->detail_absensi_per_bulan('modal_dtl_8', 'Agustus '.$tahun, $arr_detail_terlambat_per_bulan[7], $arr_detail_ijin_per_bulan[7], $arr_detail_alpa_per_bulan[7], $arr_detail_skd_per_bulan[7], $arr_detail_sakit_per_bulan[7]),
				'MODAL_ABSEN_9'						=> $this->detail_absensi_per_bulan('modal_dtl_9', 'September '.$tahun, $arr_detail_terlambat_per_bulan[8], $arr_detail_ijin_per_bulan[8], $arr_detail_alpa_per_bulan[8], $arr_detail_skd_per_bulan[8], $arr_detail_sakit_per_bulan[8]),
				'MODAL_ABSEN_10'					=> $this->detail_absensi_per_bulan('modal_dtl_10', 'Oktober '.$tahun, $arr_detail_terlambat_per_bulan[9], $arr_detail_ijin_per_bulan[9], $arr_detail_alpa_per_bulan[9], $arr_detail_skd_per_bulan[9], $arr_detail_sakit_per_bulan[9]),
				'MODAL_ABSEN_11'					=> $this->detail_absensi_per_bulan('modal_dtl_11', 'November '.$tahun, $arr_detail_terlambat_per_bulan[10], $arr_detail_ijin_per_bulan[10], $arr_detail_alpa_per_bulan[10], $arr_detail_skd_per_bulan[10], $arr_detail_sakit_per_bulan[10]),
				'MODAL_ABSEN_12'					=> $this->detail_absensi_per_bulan('modal_dtl_12', 'Desember '.$tahun, $arr_detail_terlambat_per_bulan[11], $arr_detail_ijin_per_bulan[11], $arr_detail_alpa_per_bulan[11], $arr_detail_skd_per_bulan[11], $arr_detail_sakit_per_bulan[11]),

				'get_data_sp'						=> $this->get_data_sp(),

				'custom_scripts'    				=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."attendance.js type='text/javascript'></script>"
			);			
			$this->template->view('v_attendance', $data);

		} else {
			/*
				https://gist.github.com/nveselinov/1749498
			*/
			redirect($this->uri->uri_string());
		}
	}

}
