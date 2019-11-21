<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $sess_nik;
	private $table_trx_tunjangankaryawan;
	private $table_trx_tunjanganstaff;
	private $view_hst_absen;

	public function __construct() {
		parent::__construct();
		$this->auth->restrict();
		$this->sess_nik = $this->session->userdata('sess_nik_mynik');
		$this->table_trx_tunjangankaryawan = $this->config->item('TABLE_TRX_TUNJANGAN_KARYAWAN');
		$this->table_trx_tunjanganstaff = $this->config->item('TABLE_TRX_TUNJANGAN_STAFF');
		$this->view_hst_absen = $this->config->item('VIEW_HISTORY_ABSENSI');
		$this->load->model('m_home');
	}

	public function index() {
		$data = array(
			'title' 					=> 'Home',
			'page_title' 				=> '',
			'breadcrumb' 				=> '',
			'get_shift'					=> $this->get_shift(),
			'get_section'				=> $this->get_section(),
			'get_total_data_terlambat'	=> $this->get_total_data_terlambat(),
			'get_total_data_ijin'		=> $this->get_total_data_ijin(),
			'get_total_data_alpa'		=> $this->get_total_data_alpa(),
			'get_total_data_sakit'		=> $this->get_total_data_sakit(),
			'get_total_data_skd'		=> $this->get_total_data_skd(),
			'custom_scripts' 			=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."home.js type='text/javascript'></script>",
		);
		$this->template->view('v_home', $data);
	}

	public function get_shift() {
		$hari = $this->config->item('FORMAT_NOW_DATE_TO_INSERT');

		$id_group_shift = $this->m_home->single_field('fid_groupshift', $this->config->item('TABLE_MST_SHIFT_KARYAWAN'), array('nik' => $this->sess_nik, 'tgl_shift' => $hari), '', '1');

		$data_shift = $this->m_home->detail_data('Kelompok_Shift, jam_kerja_in, jam_kerja_out', $this->config->item('TABLE_MST_GROUP_SHIFT'), array('sysid' => $id_group_shift, '', '1'));

		return $data_shift;
	}

	public function get_section() {
		$data_section = $this->m_home->detail_data('Sect_Alias, Sect_Name, SubSect_Alias, SubSect_Name', $this->config->item('QUERY_MST_KARYAWAN_AKTIF'), array('nik' => $this->sess_nik, '', '1'));

		return $data_section;
	}

	public function total_data_kehadiran($tabel, $tahun, $bulan, $kode_kehadiran) {
		$data = $this->m_home->total_data($tabel, 
		                                  array('NIK' => $this->sess_nik, 
												'YEAR(TANGGAL)' => $tahun, 
												'MONTH(TANGGAL)' => $bulan, 
												'HADIR' => $kode_kehadiran));
		return $data;
	}

	public function total_data_ijin($tabel, $tahun, $bulan, $kode_ijin) {
		$data = $this->m_home->total_data($tabel, 
		                                  array('NIK' => $this->sess_nik, 
												'TAHUN' => $tahun, 
												'BULAN' => $bulan, 
												'KODEIJIN' => $kode_ijin));
		return $data;
	}

	public function get_total_data_terlambat() {
		return $this->total_data_kehadiran($this->table_trx_tunjangankaryawan, date('Y'), date('m'), 'T') +
				                           $this->total_data_kehadiran($this->table_trx_tunjanganstaff, date('Y'), date('m'), 'T');
	}

	public function get_total_data_ijin() {
		return $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'I1') +
               $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'I2') +
               $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'I3') +
               $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'IP') +
               $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'IS');
	}

	public function get_total_data_alpa() {
		return $this->total_data_kehadiran($this->table_trx_tunjangankaryawan, date('Y'), date('m'), 'A') +
			   $this->total_data_kehadiran($this->table_trx_tunjanganstaff, date('Y'), date('m'), 'A');
	}

	public function get_total_data_sakit() {
		return $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'S');
	}

	public function get_total_data_skd() {
		return $this->total_data_ijin($this->view_hst_absen, date('Y'), date('m'), 'SKD');
	}

}
