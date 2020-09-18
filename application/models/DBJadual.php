<?php
class DBJadual extends CI_Model {

var $table = "tbljadual";  
var $select_column = array("jadualID","jadualNama", "isAktif");  
var $order_column = array("jadualID","jadualNama", "isAktif");  

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

	function updatejadual($jadualID, $jadualNama, $isAktif) {
		if($jadualID == 0) {
			$this->db->set('jadualNama',$jadualNama);
			if( $this->db->insert('tbljadual')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('jadualNama',$jadualNama);
			$this->db->set('isAktif',$isAktif);
			$this->db->where('jadualID',$jadualID);
			if( $this->db->update('tbljadual')) {
				return 1;
			} else {
				return 'An error occured';
			}
		}
		
	}

	function jadualexist($jadualID, $jadualNama) {
		if($jadualID == 0) {
			$p = $this->PublicModel->dLookUp("jadualID","tbljadual","jadualNama='".$jadualNama."'");
		} else {
			$p = $this->PublicModel->dLookUp("jadualID","tbljadual","jadualID<>'".$jadualID."' AND jadualNama='".$jadualNama."'");
		}
		
		if(!empty($p)) {
			if($p !== '') {
				return TRUE;
			}
		}
		return FALSE;
	}
	function get_jadual() {
		$query = $this->db->query("select jadualID, jadualNama FROM tbljadual ORDER BY jadualNama ASC");
		return $query->result_array();
	}

}