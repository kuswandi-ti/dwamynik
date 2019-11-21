<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_attendance extends CI_Model {
		
	function __construct() {
		parent::__construct();
	}
	
	public function total_data($table, $where) {
		$query = $this->db->get_where($table, $where); 
		if ($query->num_rows() > 0) {
			$count_rows = $query->num_rows(); 
		} else {
			$count_rows = 0; 
		} 
		return $count_rows; 
	}

	/* https://stackoverflow.com/questions/13812196/return-empty-array-in-php */
	public function detail_data($select, $table, $where = null, $order = null) {
		if ($order != null) {
			$this->db->order_by($order, 'ASC'); 
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

}
