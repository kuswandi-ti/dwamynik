<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eslip extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'title' 			=> 'E-Slip',
			'page_title' 		=> 'E-Slip',
			'breadcrumb' 		=> '',
			'custom_scripts' 	=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."eslip.js type='text/javascript'></script>"
		);
		$this->template->view('v_eslip', $data);
	}

}
