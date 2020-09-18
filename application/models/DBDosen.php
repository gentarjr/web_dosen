<?php
class DBDosen extends CI_Model {

var $table = "tbldosen";  
var $select_column = array("dosenID","Nama", "dosenStatus", "Fakultas", "Jurusan", 
	"Golongan", "Telp","dosenActive","NIDN");  
var $order_column = array("dosenID","Nama", "dosenStatus", "Fakultas", "Jurusan", 
	"Golongan", "Telp","dosenActive","NIDN");  

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

	function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();
		    $this->db->like("dosenID", $_POST["search"]["value"]);  
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("dosenStatus", $_POST["search"]["value"]); 
		    $this->db->or_like("Fakultas", $_POST["search"]["value"]); 
		    $this->db->or_like("Jurusan", $_POST["search"]["value"]);  
		    $this->db->or_like("Golongan", $_POST["search"]["value"]);  
		    $this->db->or_like("Telp", $_POST["search"]["value"]);  
		    $this->db->or_like("dosenActive", $_POST["search"]["value"]);
		    $this->db->or_like("NIDN", $_POST["search"]["value"]);   
		    $this->db->group_end();
		}
		
			
		//$_POST["columns"][1]["search"]["value"]
		if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
			$this->db->like("dosenID",$_POST["columns"][0]["search"]["value"]);
		}
		if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][1]["search"]["value"] !== '') {
			$this->db->like("Nama",$_POST["columns"][1]["search"]["value"]);
		}
		if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
			$this->db->like("dosenStatus",$_POST["columns"][2]["search"]["value"]);
		}
		if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
			$this->db->like("Fakultas",$_POST["columns"][3]["search"]["value"]);
		}
		if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
			$this->db->like("Jurusan",$_POST["columns"][4]["search"]["value"]);
		}
		if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
			$this->db->like("Golongan",$_POST["columns"][5]["search"]["value"]);
		}
		if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
			$this->db->like("Telp",$_POST["columns"][6]["search"]["value"]);
		}
		if(isset($_POST["columns"][7]["search"]["value"]) && $_POST["columns"][7]["search"]["value"] !== '') {
			$this->db->like("dosenActive",$_POST["columns"][7]["search"]["value"]);
		}
		if(isset($_POST["columns"][8]["search"]["value"]) && $_POST["columns"][8]["search"]["value"] !== '') {
			$this->db->like("NIDN",$_POST["columns"][8]["search"]["value"]);
		}
			
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('dosenID', 'DESC');  
		}  
	}  
	function make_datatables(){  
		$this->make_query();  
		if(isset($_POST["length"])) {
				if($_POST["length"] != -1)  
		   {  
		        $this->db->limit($_POST['length'], $_POST['start']);  
		   }
		}

		$query = $this->db->get();  
		return $query->result();  
	}  
	function get_filtered_data(){  
		$this->make_query();  
		$query = $this->db->get();  
		return $query->num_rows();  
	}       
	function get_all_data()  
	{  
		$this->db->select("*");  
		$this->db->from($this->table);  
		return $this->db->count_all_results();  
	}  
	
	function get_all_dosen(){
		return $this->db->get($this->table)->result_array();
	}

	function get_all_dosen_nidn(){
		$this->db->select("concat_ws(' (',Nama,concat(NIDN,'',')')) as NamaDosen");
		$this->db->select("concat_ws(' (',NIDN,concat(Nama,'',')')) as NamaNIDN");
		$this->db->select('dosenID');
		$this->db->select('Nama');
		$this->db->select('NIDN');
		return $this->db->get($this->table)->result_array();
	}

	function get_dosen_by_id($id) {
		$this->db->where('dosenID', $id);
		return $this->db->get($this->table)->result_array();
	}
	
	function insertdosen($sredata){
		$this->db->insert('tbldosen', $sredata);
		//return $this->db->affected_rows();
		return $this->db->insert_id();
	}
	function updatedosen($id, $sredata){
		$this->db->where('dosenID', $id);
		return $this->db->update('tbldosen', $sredata);
	}

	function updatenilai($dosenID, $periodeAjar, $hadir, $tepat, $sesuai, $lulus, $quiz) {
		if($this->DBDosen->kehadiranexist($dosenID,$periodeAjar)) {
			//UPDATE
			$this->db->set('kehadiran',$hadir);
			$this->db->set('ketepatan',$tepat);
			$this->db->set('kesesuaian',$sesuai);
			$this->db->set('kelulusan',$lulus);
			$this->db->set('quisioner',$quiz);
			$this->db->where('dosenID',$dosenID);
			$this->db->where('periodeAjar', $periodeAjar);
			return $this->db->update('tblnilai');
		} else {
			$this->db->set('kehadiran',$hadir);
			$this->db->set('ketepatan',$tepat);
			$this->db->set('kesesuaian',$sesuai);
			$this->db->set('kelulusan',$lulus);
			$this->db->set('quisioner',$quiz);
			
			$this->db->set('dosenID',$dosenID);
			$this->db->set('periodeAjar', $periodeAjar);
			return $this->db->insert('tblnilai');
		}
		
	}
	function insertnilai($data) {
		$this->db->insert_batch('tblnilai', $data);
	}

	function kehadiranexist($dosenID, $periodeAjar) {
		$p = $this->PublicModel->dLookUp("periodeAjar","tblnilai","dosenID='".$dosenID."' AND periodeAjar='".$periodeAjar."'");
		if(!empty($p)) {
			if($p !== '') {
				return TRUE;
			}
		}
		return FALSE;
	}
	function get_nilai_by_id($dosenID) {
		$this->db->where('dosenID', $dosenID);
		return $this->db->get('tblnilai')->result_array();
	}
	
	function delete_nilai($id, $periodeAjar){
		$this->db->where('dosenID', $id);
		$this->db->where('periodeAjar', $periodeAjar);		
		return $this->db->delete('tblnilai');
	}
}