<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_login');		
	}

	public function index() {
		$data = array(
			'title' 			=> 'Login',
			'page_title' 		=> 'Login',
			'breadcrumb' 		=> '',
			'custom_scripts' 	=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."login.js type='text/javascript'></script>"
		);
		$this->load->view('v_login', $data);
	}

	public function do_login(){
		$nik = $this->input->post('nik');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			echo json_encode(['error_validation'=>$errors]);
			
		} else {
			if ($this->m_login->login_check_nik($nik) > 0) {
				if ($this->m_login->login_check_password($nik) == '') {
					$data = array (
						'password' => $password
					);
					$this->db->update($this->config->item('TABLE_MST_KARYAWAN'), $data, array('nik' => $nik));
					$query = $this->m_login->data_karyawan($nik);
					$data = $query->row_array();
					$session_data = array(
						'sess_nik_mynik'	=> $data['NIK'],
						'sess_nama_mynik'	=> $data['Nama'],
						'sess_dept_mynik'	=> $data['Dept_Alias'],
					);
					$this->session->set_userdata($session_data);
					echo json_encode(['success' => 'Login sukses']);
				} else {
					if ($this->m_login->login_check_all($nik, $password) == 0) {
						echo json_encode(['error'=>'NIK & Password tidak sama']);
					} else {
						$query = $this->m_login->data_karyawan($nik);
						$data = $query->row_array();
						$session_data = array(
							'sess_nik_mynik'	=> $data['NIK'],
							'sess_nama_mynik'	=> $data['Nama'],
							'sess_dept_mynik'	=> $data['Dept_Alias'],
						);
						$this->session->set_userdata($session_data);
						echo json_encode(['success' => 'Login sukses']);
					}
				}
			} else {
				echo json_encode(['error'=>'NIK belum terdaftar di sistem']);
			}
		}
	}

	public function logout() {
        $this->session->sess_destroy();
    }

}
