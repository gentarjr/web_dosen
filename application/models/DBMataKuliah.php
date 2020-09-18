<?php
class DBMataKuliah extends CI_Model {

var $table = "tblmatakuliah";  
var $select_column = array("mataID","mataKuliah", "isAktif");  
var $order_column = array("mataID","mataKuliah", "isAktif");  

    public function __construct()
    {
    	$this->load->model('PublicModel');
    }
    public function get_record()
	{

		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		return $this->db->get()->result_array();
	}

	function updatemata($mataID, $mataKuliah, $isAktif) {
		if($mataID == 0) {
			$this->db->set('mataKuliah',$mataKuliah);
			if( $this->db->insert('tblmatakuliah')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('mataKuliah',$mataKuliah);
			$this->db->set('isAktif',$isAktif);
			$this->db->where('mataID',$mataID);
			if( $this->db->update('tblmatakuliah')) {
				return 1;
			} else {
				return 'An error occured';
			}
		}
		
	}

	function mataexist($mataID, $mataKuliah) {
		if($mataID == 0) {
			$p = $this->PublicModel->dLookUp("mataID","tblmatakuliah","mataKuliah='".$mataKuliah."'");
		} else {
			$p = $this->PublicModel->dLookUp("mataID","tblmatakuliah","mataID<>'".$mataID."' AND mataKuliah='".$mataKuliah."'");
		}
		
		if(!empty($p)) {
			if($p !== '') {
				return TRUE;
			}
		}
		return FALSE;
	}

	function get_matakuliah() {
		$query = $this->db->query("select mataID, mataKuliah FROM tblmatakuliah ORDER BY mataKuliah ASC");
		return $query->result_array();
	}
	function get_matakuliah_aktif() {
		$query = $this->db->query("select mataID, mataKuliah FROM tblmatakuliah WHERE isAktif <> 0 ORDER BY mataKuliah ASC");
		return $query->result_array();
	}
}