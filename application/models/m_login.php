<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function data_karyawan($nik) {
		return $this->db->get_where($this->config->item('QUERY_MST_KARYAWAN_AKTIF'), array('NIK' => $nik));
	}
	
	public function login_check_all($nik, $password) {
		$this->db->from($this->config->item('TABLE_MST_KARYAWAN'));
		$this->db->where(array('nik'=>$nik, 'password'=>$password));
		return $this->db->get()->num_rows();
	 }
	
	public function login_check_password($nik) {
		$this->db->from($this->config->item('TABLE_MST_KARYAWAN'));
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$password = (is_null($query->row()->password)) ? '' : $query->row()->password;
			return $password;
		} else {
			return '';
		}
	}

	public function login_check_nik($nik) {
		$this->db->from($this->config->item('TABLE_MST_KARYAWAN'));
		$this->db->where('nik', $nik);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
