<?php
class DBJurusan extends CI_Model {

var $table = "tbljurusan";  
var $select_column = array("jurusanID","jurusanNama", "isAktif");  
var $order_column = array("jurusanID","jurusanNama", "isAktif");  

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

	function updatejurusan($jurusanID, $jurusanNama, $isAktif) {
		if($jurusanID == 0) {
			$this->db->set('jurusanNama',$jurusanNama);
			if( $this->db->insert('tbljurusan')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('jurusanNama',$jurusanNama);
			$this->db->set('isAktif',$isAktif);
			$this->db->where('jurusanID',$jurusanID);
			if( $this->db->update('tbljurusan')) {
				return 1;
			} else {
				return 'An error occured';
			}
		}
		
	}

	function jurusanexist($jurusanID, $jurusanNama) {
		if($jurusanID == 0) {
			$p = $this->PublicModel->dLookUp("jurusanID","tbljurusan","jurusanNama='".$jurusanNama."'");
		} else {
			$p = $this->PublicModel->dLookUp("jurusanID","tbljurusan","jurusanID<>'".$jurusanID."' AND jurusanNama='".$jurusanNama."'");
		}
		
		if(!empty($p)) {
			if($p !== '') {
				return TRUE;
			}
		}
		return FALSE;
	}
	function get_jurusan() {
		$query = $this->db->query("select jurusanID, jurusanNama FROM tbljurusan ORDER BY jurusanNama ASC");
		return $query->result_array();
	}
	function get_jurusan_aktif() {
		$query = $this->db->query("select jurusanID, jurusanNama FROM tbljurusan WHERE isAktif<>0 ORDER BY jurusanNama ASC");
		return $query->result_array();
	}

}