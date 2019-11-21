<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	var $CI = NULL;
	
	function __construct() {
		// get CI's object
		$this->CI =& get_instance();
	}
	
	// untuk validasi di setiap halaman yang mengharuskan authentikasi
	function restrict() {
		if(empty($this->CI->session->userdata('sess_nik_mynik'))) {
			redirect('');
		}
	}

	function restrict_login() {
		if($this->CI->session->userdata('sess_nik_mynik') != '') {
			redirect('home');
		}
	}
	
}

/* End of file auth.php */
/* Location: ./application/libraries/auth.php */