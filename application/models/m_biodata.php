<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_biodata extends CI_Model {
		
	function __construct() {
		parent::__construct();
	}
	
	public function get_data_karyawan() {
		$this->db->order_by('Tgl_Masuk', 'DESC'); 
		$query = $this->db->get_where($this->config->item('QUERY_MST_KARYAWAN_AKTIF'), array('NIK' => $this->session->userdata('sess_nik_mynik'))); 
		$data = $query->row(); 
		$query->free_result(); 
		return $data;
	}

	/* https://stackoverflow.com/questions/13812196/return-empty-array-in-php */
	public function detail_data($select, $table, $where = null, $order = null, $limit = null) {
		if ($order != null) {
			$this->db->order_by($order, 'ASC'); 
		}
		if ($limit != null) {
			$this->db->limit($limit);
		}

		$query = $this->db->select($select)->get_where($table, $where); 
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row; 
			}
			return $data;
		} else {
			return [];
		} 
	}
	
	public function get_data_geo_1($table, $where = null) {
		$query = $this->db->query("SELECT * FROM $table $where"); 
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row; 
			} 
			$query->free_result(); 
			$cek = $query->num_rows(); 
		} else {
			$data[] = NULL; 
			$cek = NULL; 
		} 
		return $data;		
		return $cek; 
	}
	
	public function get_data_geo_2($table, $where = null, $order = null) {
		if ($order != null) {
			$this->db->order_by($order, 'ASC'); 
		} 
		$query = $this->db->get_where($table, $where);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row; 
			} 
			$query->free_result(); 
			$cek = $query->num_rows(); 
		} else {
			$data[] = NULL; 
			$cek = NULL; 
		} 
		return $data; 
		return $cek;
	}
	
	public function update_biodata($nik, $data) {
		$this->db->where('NIK', $nik); 
		if ($this->db->update($this->config->item('TABLE_MST_KARYAWAN'), $data)) {
			return 1; 
		} else {
			return 0; 
		}
	}
	
	public function update_image() {
		$nik = $this->input->post('nik');
		
		if ($_FILES['img_kk']['tmp_name']=='' && 
		    $_FILES['img_ktp']['tmp_name']=='' && 
			$_FILES['img_npwp']['tmp_name']=='' && 
			$_FILES['img_ijazah']['tmp_name']=='') {
			
		} else {
			if ($_FILES['img_kk']['tmp_name']!='') { // kk ada, lainnya kosong
				if ($_FILES['img_kk']['size'] <= '1999999') {
					$file_name_kk = $_FILES['img_kk']['name'];
					$array_var_kk = explode(".", $file_name_kk);
					$file_ext_kk = end($array_var_kk);
					$file_tmp_kk = $_FILES['img_kk']['tmp_name'];
					$new_file_kk = $this->config->item('PATH_ASSET_IMAGE_KK').$file_name_kk;
					$rename_file_kk = $this->config->item('PATH_ASSET_IMAGE_KK').$nik."_KK.".$file_ext_kk;		
					move_uploaded_file($file_tmp_kk, $new_file_kk);
					rename($new_file_kk, $rename_file_kk);
					$data['file_kk'] = $rename_file_kk;
				}
			} 

			if ($_FILES['img_ktp']['tmp_name']!='') { // lainnya kosong, ktp ada
				if ($_FILES['img_ktp']['size'] <= '1999999') {
					$file_name_ktp = $_FILES['img_ktp']['name'];
					$array_var_ktp = explode(".", $file_name_ktp);
					$file_ext_ktp = end($array_var_ktp);
					$file_tmp_ktp = $_FILES['img_ktp']['tmp_name'];
					$new_file_ktp = $this->config->item('PATH_ASSET_IMAGE_KTP').$file_name_ktp;
					$rename_file_ktp = $this->config->item('PATH_ASSET_IMAGE_KTP').$nik."_KTP.".$file_ext_ktp;		
					move_uploaded_file($file_tmp_ktp, $new_file_ktp);
					rename($new_file_ktp, $rename_file_ktp);
					$data['file_ktp'] = $rename_file_ktp;
				}
			} 

			if ($_FILES['img_npwp']['tmp_name']!='') { // lainnya kosong, npwp ada
				if ($_FILES['img_npwp']['size'] <= '1999999') {
					$file_name_npwp = $_FILES['img_npwp']['name'];
					$array_var_npwp = explode(".", $file_name_npwp);
					$file_ext_npwp = end($array_var_npwp);
					$file_tmp_npwp = $_FILES['img_npwp']['tmp_name'];
					$new_file_npwp = $this->config->item('PATH_ASSET_IMAGE_NPWP').$file_name_npwp;
					$rename_file_npwp = $this->config->item('PATH_ASSET_IMAGE_NPWP').$nik."_NPWP.".$file_ext_npwp;		
					move_uploaded_file($file_tmp_npwp, $new_file_npwp);
					rename($new_file_npwp, $rename_file_npwp);
					$data['file_npwp'] = $rename_file_npwp;
				}
			} 

			if ($_FILES['img_ijazah']['tmp_name']!='') { // lainnya kosong, ijazah ada
				if ($_FILES['img_ijazah']['size'] <= '1999999') {
					
					$file_name_ijazah = $_FILES['img_ijazah']['name'];
					$array_var_ijazah = explode(".", $file_name_ijazah);
					$file_ext_ijazah = end($array_var_ijazah);
					$file_tmp_ijazah = $_FILES['img_ijazah']['tmp_name'];
					$new_file_ijazah = $this->config->item('PATH_ASSET_IMAGE_IJAZAH').$file_name_ijazah;
					$rename_file_ijazah = $this->config->item('PATH_ASSET_IMAGE_IJAZAH').$nik."_IJAZAH.".$file_ext_ijazah;		
					move_uploaded_file($file_tmp_ijazah, $new_file_ijazah);
					rename($new_file_ijazah, $rename_file_ijazah);
					$data['file_ijazah'] = $rename_file_ijazah;
				}
			}
	        
		}
		$result = $this->db->update($this->config->item('TABLE_MST_KARYAWAN'), $data, array('nik' => $nik));
        return $result;
    }
	
}
