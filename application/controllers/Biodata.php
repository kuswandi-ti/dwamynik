<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata extends CI_Controller {

	private $sess_nik;
	
	private $table_mst_provinsi;
	private $table_mst_kota;
	private $table_mst_kecamatan;
	private $table_mst_kelurahan;

	private $table_mst_karyawan_hdr;
	private $table_mst_karyawan_ptkp;
	
	public function __construct() {
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_biodata');

		$this->sess_nik = $this->session->userdata('sess_nik_mynik');
		
		$this->table_mst_provinsi 		= $this->config->item('TABLE_MST_PROVINSI');
		$this->table_mst_kota 			= $this->config->item('TABLE_MST_KOTA');
		$this->table_mst_kecamatan		= $this->config->item('TABLE_MST_KECAMATAN');
		$this->table_mst_kelurahan		= $this->config->item('TABLE_MST_KELURAHAN');

		$this->table_mst_karyawan_hdr	= $this->config->item('TABLE_MST_KARYAWAN');
		$this->table_mst_karyawan_ptkp	= $this->config->item('TABLE_MST_KARYAWAN_PTKP');
	}

	public function index() {
		$get_data_karyawan = $this->m_biodata->get_data_karyawan();
		$ptkp = $this->m_biodata->detail_data('SysId, Kode_Status, Keterangan', $this->table_mst_karyawan_ptkp);

		$data = array(
			'title'             	=> 'Biodata',
			'page_title'        	=> 'Biodata',
			'sub_page_title'    	=> '',
			'active_menu_root'  	=> '',
			'active_menu_child' 	=> '',
			'breadcrumb'        	=> '<li class="breadcrumb-item"><i class="fas fa-home"></i><a href="home"> Home</a></li>
										<li class="breadcrumb-item active">Biodata</li>',
			'get_data_karyawan' 	=> $get_data_karyawan,
			'status_ptkp'			=> $this->get_status_ptkp(),
			'ptkp'					=> $ptkp,
			'custom_scripts'    	=> "<script src=".$this->config->item('PATH_ASSET_CUSTOM_SCRIPTS')."biodata.js type='text/javascript'></script>"
		);
		
		if ($get_data_karyawan->provinsi_ktp_id != '') {
			$data['data_provinsi_ktp_id'] = $this->m_biodata->get_data_geo_1($this->table_mst_provinsi, ' ORDER BY name ASC');
		} else {
			$data['data_provinsi_ktp_id'] = $this->m_biodata->get_data_geo_1($this->table_mst_provinsi, ' ORDER BY name ASC');
		}

		if ($get_data_karyawan->kota_ktp_id != '') {
			$data['data_kota_ktp_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kota, ['fndprov_id' => $get_data_karyawan->provinsi_ktp_id], 'name');
		} else {
			$data['data_kota_ktp_id'] = null;
		}
		if ($get_data_karyawan->kec_ktp_id != '') {
			$data['data_kec_ktp_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kecamatan, ['fndkota_id' => $get_data_karyawan->kota_ktp_id], 'name');
		} else {
			$data['data_kec_ktp_id'] = null;
		}
		if ($get_data_karyawan->desa_ktp_id != '') {
			$data['data_desa_ktp_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kelurahan, ['fndkec_id' => $get_data_karyawan->kec_ktp_id], 'name');
		} else {
			$data['data_desa_ktp_id'] = null;
		}

		if ($get_data_karyawan->provinsi_dom_id != '') {
			$data['data_provinsi_dom_id'] = $this->m_biodata->get_data_geo_1($this->table_mst_provinsi, ' ORDER BY name ASC');
		} else {
			$data['data_provinsi_dom_id'] = $this->m_biodata->get_data_geo_1($this->table_mst_provinsi, ' ORDER BY name ASC');
		}

		if ($get_data_karyawan->kota_dom_id != '') {
			$data['data_kota_dom_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kota, ['fndprov_id' => $get_data_karyawan->provinsi_dom_id], 'name');
		} else {
			$data['data_kota_dom_id'] = null;
		}
		if ($get_data_karyawan->kec_dom_id != '') {
			$data['data_kec_dom_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kecamatan, ['fndkota_id' => $get_data_karyawan->kota_dom_id], 'name');
		} else {
			$data['data_kec_dom_id'] = null;
		}
		if ($get_data_karyawan->desa_dom_id != '') {
			$data['data_desa_dom_id'] = $this->m_biodata->get_data_geo_2($this->table_mst_kelurahan, ['fndkec_id' => $get_data_karyawan->kec_dom_id], 'name');
		} else {
			$data['data_desa_dom_id'] = null;
		}
		
		$this->template->view('v_biodata', $data);
	}

	public function get_status_ptkp() {
		$sql = "SELECT
					CONCAT(b.Kode_Status, ' - ', b.Keterangan) AS status_ptkp
				FROM
					".$this->table_mst_karyawan_hdr." a
					LEFT OUTER JOIN ".$this->table_mst_karyawan_ptkp." b ON a.PTKP_SysId = b.SysId
				WHERE
					a.NIK = '".$this->sess_nik."'";
		return $this->db->query($sql)->row()->status_ptkp;					
	}
	
	public function get_kota() {
		$data = $this->m_biodata->get_data_geo_2($this->table_mst_kota, ['fndprov_id' => $this->input->post('provinsi_id')], 'name'); 
		$fnx = null; 
		$fnx .= '<option value="">-- Pilih Kota/Kab --</option>'; 
		foreach ($data as $row) {
			$fnx .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
		} 
		echo $fnx; 
	}
	
	public function get_kecamatan() {
		$data = $this->m_biodata->get_data_geo_2($this->table_mst_kecamatan, ['fndkota_id' => $this->input->post('kota_id')], 'name'); 
		$fnx = null; 
		$fnx .= '<option value="">-- Pilih Kecamatan --</option>'; 
		foreach ($data as $row) {
			$fnx .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
		} 
		echo $fnx; 
	}
	
	public function get_kelurahan() {
		$data = $this->m_biodata->get_data_geo_2($this->table_mst_kelurahan, ['fndkec_id' => $this->input->post('kecamatan_id')], 'name'); 
		$fnx = null; 
		$fnx .= '<option value="">-- Pilih Kelurahan --</option>'; 
		foreach ($data as $row) {
			$fnx .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
		} 
		echo $fnx; 
	}

	public function update() {
		$nik = $this->input->post('nik');
		$data = array(
			'PTKP_SysId'      						=> $this->input->post('status-ptkp'),
			'NPWP'      							=> $this->input->post('nomor-npwp'),
			'No_KTP'      							=> $this->input->post('nomor-ktp'),

			'skawin'          						=> $this->input->post('skawin'),
			
			'alamat_ktp'      						=> $this->input->post('alamat-ktp'),
			'provinsi_ktp_id'    					=> $this->input->post('alamat-ktp-provinsi'),
			'kota_ktp_id'        					=> $this->input->post('alamat-ktp-kota'),
			'kec_ktp_id'         					=> $this->input->post('alamat-ktp-kecamatan'),
			'desa_ktp_id'        					=> $this->input->post('alamat-ktp-desa'),
			'provinsi_ktp'    						=> $this->input->post('provinsi_ktp'),
			'kota_ktp'        						=> $this->input->post('kota_ktp'),
			'kec_ktp'         						=> $this->input->post('kec_ktp'),
			'desa_ktp'        						=> $this->input->post('desa_ktp'),
			'kd_pos_ktp'      						=> $this->input->post('alamat-ktp-kode-pos'),
			
			'alamat_domisili' 						=> $this->input->post('alamat-domisili'),
			'provinsi_dom_id'    					=> $this->input->post('alamat-dom-provinsi'),
			'kota_dom_id'        					=> $this->input->post('alamat-dom-kota'),
			'kec_dom_id'         					=> $this->input->post('alamat-dom-kecamatan'),
			'desa_dom_id'        					=> $this->input->post('alamat-dom-desa'),
			'provinsi_dom'    						=> $this->input->post('provinsi_dom'),
			'kota_dom'        						=> $this->input->post('kota_dom'),
			'kec_dom'         						=> $this->input->post('kec_dom'),
			'desa_dom'        						=> $this->input->post('desa_dom'),
			'kd_pos_dom'      						=> $this->input->post('alamat-dom-kode-pos'),
			
			'no_hp'           						=> $this->input->post('no-hp'),
			
			'status_keluarga_nama'             		=> $this->input->post('suami_nama'),
			'status_keluarga_jk'               		=> $this->input->post('status-keluarga-jk'),
			'status_keluarga_tl'               		=> $this->input->post('status-keluarga-tl'),
			'status_keluarga_tgl'              		=> !empty($this->input->post('status-keluarga-tgl')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('status-keluarga-tgl'))) : '0000-00-00',
			'status_keluarga_pendidikan'       		=> $this->input->post('status-keluarga-pendidikan'),
			'status_keluarga_nama_istri'       		=> $this->input->post('istri_nama'),
			'status_keluarga_jk_istri'         		=> $this->input->post('status-keluarga-jk-istri'),
			'status_keluarga_tl_istri'         		=> $this->input->post('status-keluarga-tl-istri'),
			'status_keluarga_tgl_istri'        		=> date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('status-keluarga-tgl-istri'))),
			'status_keluarga_pendidikan_istri' 		=> $this->input->post('status-keluarga-pendidikan-istri'),
			'keluarga_anak_nama_1'             		=> $this->input->post('keluarga-anak-nama-1'),
			'keluarga_anak_nama_2'             		=> $this->input->post('keluarga-anak-nama-2'),
			'keluarga_anak_nama_3'             		=> $this->input->post('keluarga-anak-nama-3'),
			'keluarga_anak_nama_4'             		=> $this->input->post('keluarga-anak-nama-4'),
			'keluarga_anak_nama_5'             		=> $this->input->post('keluarga-anak-nama-5'),
			'keluarga_anak_jk_1'               		=> $this->input->post('keluarga-anak-jk-1'),
			'keluarga_anak_jk_2'               		=> $this->input->post('keluarga-anak-jk-2'),
			'keluarga_anak_jk_3'               		=> $this->input->post('keluarga-anak-jk-3'),
			'keluarga_anak_jk_4'               		=> $this->input->post('keluarga-anak-jk-4'),
			'keluarga_anak_jk_5'               		=> $this->input->post('keluarga-anak-jk-5'),
			'keluarga_anak_tl_1'               		=> $this->input->post('keluarga-anak-tl-1'),
			'keluarga_anak_tl_2'               		=> $this->input->post('keluarga-anak-tl-2'),
			'keluarga_anak_tl_3'               		=> $this->input->post('keluarga-anak-tl-3'),
			'keluarga_anak_tl_4'               		=> $this->input->post('keluarga-anak-tl-4'),
			'keluarga_anak_tl_5'               		=> $this->input->post('keluarga-anak-tl-5'),
			'keluarga_anak_tgl_1'              		=> !empty($this->input->post('keluarga-anak-tgl-1')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('keluarga-anak-tgl-1'))) : '0000-00-00',
			'keluarga_anak_tgl_2'              		=> !empty($this->input->post('keluarga-anak-tgl-2')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('keluarga-anak-tgl-2'))) : '0000-00-00',
			'keluarga_anak_tgl_3'              		=> !empty($this->input->post('keluarga-anak-tgl-3')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('keluarga-anak-tgl-3'))) : '0000-00-00',
			'keluarga_anak_tgl_4'              		=> !empty($this->input->post('keluarga-anak-tgl-4')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('keluarga-anak-tgl-4'))) : '0000-00-00',
			'keluarga_anak_tgl_5'              		=> !empty($this->input->post('keluarga-anak-tgl-5')) ? date($this->config->item('FORMAT_DATE_TO_INSERT'), strtotime($this->input->post('keluarga-anak-tgl-5'))) : '0000-00-00',
			'keluarga_anak_pendidikan_1'       		=> $this->input->post('keluarga-anak-pendidikan-1'),
			'keluarga_anak_pendidikan_2'       		=> $this->input->post('keluarga-anak-pendidikan-2'),
			'keluarga_anak_pendidikan_3'       		=> $this->input->post('keluarga-anak-pendidikan-3'),
			'keluarga_anak_pendidikan_4'       		=> $this->input->post('keluarga-anak-pendidikan-4'),
			'keluarga_anak_pendidikan_5'       		=> $this->input->post('keluarga-anak-pendidikan-5')
		);
		$update = $this->m_biodata->update_biodata($nik, $data);
		if ($update) {
			echo json_encode(['success' => 'Berhasil update perubahan data karyawan']);
		} else {
			echo json_encode(['error_update' => 'Gagal update perubahan data karyawan !!!']);
		}
	}

	public function update_image() {
		$notifikasi = $this->m_biodata->update_image();
		if ($notifikasi == 1) {
			echo "Image berhasil disimpan";
		} else {
			echo "Image gagal disimpan";
		}
	}

}
