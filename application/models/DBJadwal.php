<?php
class DBJadwal extends CI_Model {

var $table = "tbljadwal";  
var $select_column = array("jadwalID","jadwalNama", "isAktif");  
var $order_column = array("jadwalID","jadwalNama", "isAktif");  

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

	function updatejadwal($jadwalID, $jadwalNama, $isAktif) {
		if($jadwalID == 0) {
			$this->db->set('jadwalNama',$jadwalNama);
			if( $this->db->insert('tbljadwal')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('jadwalNama',$jadwalNama);
			$this->db->set('isAktif',$isAktif);
			$this->db->where('jadwalID',$jadwalID);
			if( $this->db->update('tbljadwal')) {
				return 1;
			} else {
				return 'An error occured';
			}
		}
		
	}

	function jadwalexist($jadwalID, $jadwalNama) {
		if($jadwalID == 0) {
			$p = $this->PublicModel->dLookUp("jadwalID","tbljadwal","jadwalNama='".$jadwalNama."'");
		} else {
			$p = $this->PublicModel->dLookUp("jadwalID","tbljadwal","jadwalID<>'".$jadwalID."' AND jadwalNama='".$jadwalNama."'");
		}
		
		if(!empty($p)) {
			if($p !== '') {
				return TRUE;
			}
		}
		return FALSE;
	}
	function get_jadwal() {
		$query = $this->db->query("select jadwalID, jadwalNama FROM tbljadwal ORDER BY jadwalNama ASC");
		return $query->result_array();
	}

}