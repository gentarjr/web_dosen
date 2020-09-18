<?php
class DBSap extends CI_Model {

var $table = "tblsap";  
var $select_column = array("sapID","tbldosen.dosenID", "Nama", "tanggal", "tblmatakuliah.mataID", "mataKuliah", 
	"sapStat","if(sapStat=0,'Tidak','Ya') as StatName");  
var $order_column = array("sapID","tbldosen.dosenID", "Nama", "tanggal", "tblmatakuliah.mataID", "mataKuliah", 
	"sapStat","if(sapStat=0,'Tidak','Ya') as StatName");  
var $relstatID = 1;

    public function __construct()
    {
    	$this->load->model('PublicModel');
    	//$this->output->enable_profiler(TRUE);
    }
    
    public function get_record()
	{

		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		return $this->db->get()->result_array();
	}

	function make_query($period = '')  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblsap.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblsap.mataID = tblmatakuliah.mataID');

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();  
		    $this->db->or_like("sapID", $_POST["search"]["value"]); 
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("mataKuliah", $_POST["search"]["value"]); 
		    $this->db->group_end();
		}
		if($period !== '') {
			
			//$_POST["columns"][1]["search"]["value"]
			if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
				$this->db->like("sapID",$_POST["columns"][0]["search"]["value"]);
			}
			if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][1]["search"]["value"] !== '') {
				$this->db->like("tanggal",$_POST["columns"][1]["search"]["value"]);
			}
			if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
				$this->db->like("Nama",$_POST["columns"][2]["search"]["value"]);
			}
			if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
				$this->db->like("mataKuliah",$_POST["columns"][3]["search"]["value"]);
			}
			if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
				$this->db->like("if(sapStat=0,'Tidak','Ya')",$_POST["columns"][4]["search"]["value"]);
			}
			
			$this->db->where("date_format(tanggal,'%Y%m')",$period);
			
		}
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('tanggal', 'DESC');  
		}  
		$this->db->group_by("sapID");
	}  
	function make_datatables($period = ''){  
		$this->make_query($period);  
		if(isset($_POST["length"])) {
				if($_POST["length"] != -1)  
		   {  
		        $this->db->limit($_POST['length'], $_POST['start']);  
		   }
		}

		$query = $this->db->get();  
		
		return $query->result();  
	}  
	
	function get_filtered_data($period = ''){  
		$this->make_query($period);  
		$query = $this->db->get();  
		return $query->num_rows();  
	}       
	function get_all_data()  
	{  
		$this->db->select("*");  
		$this->db->from($this->table);  
		return $this->db->count_all_results();  
	}  
	function get_period(){
		$query = $this->db->query("SELECT
		  DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
		FROM tblsap t
		GROUP BY DATE_FORMAT(`tanggal`, '%Y-%m') ORDER BY DATE_FORMAT(`tanggal`, '%Y-%m') DESC;");
		return $query->result_array();
	}
	function update_sap($sapID, $dosenID, $tanggal, $mataID, $sapStat) {
		if($sapID == 0) {
			$this->db->set('dosenID',$dosenID);
			$this->db->set('mataID',$mataID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('sapStat',$sapStat);
			
			if( $this->db->insert('tblsap')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('dosenID',$dosenID);
			$this->db->set('mataID',$mataID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('sapStat',$sapStat);
			$this->db->where('sapID',$sapID);
			if( $this->db->update('tblsap')) {
				return $sapID;
			} else {
				return 'An error occured';
			}
		}
		
	}
	function delete_sap($id) {
		$this->db->where('sapID',$id);
		if( $this->db->delete('tblsap')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}

	function get_totalsap($period, $dosenID, $mataID) {
		//period = 201801
		$this->db->select('dosenID');
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('dosenID', $dosenID);
		if($mataID <> 0) {
			$this->db->where('mataID', $mataID);	
		}
		
		$this->db->from('tblsap');
		$query = $this->db->get();  
		return $query->num_rows();
	}
	public function get_detail($period, $dosenID, $mataID)
	{

		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblsap.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblsap.mataID = tblmatakuliah.mataID');
		$this->db->where('tbldosen.dosenID', $dosenID);
		$this->db->where('tblmatakuliah.mataID', $mataID);
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		return $this->db->get()->result_array();
	}
}