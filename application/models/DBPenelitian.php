<?php
class DBPenelitian extends CI_Model {

var $table = "tblpenelitian";  
var $select_column = array("penelitianID","tbldosen.dosenID", "Nama", "tanggal", "penelitianJudul", "penelitianKeterangan", 
	"penelitianFile");  
var $order_column = array("penelitianID","tbldosen.dosenID", "Nama", "tanggal", "penelitianJudul", "penelitianKeterangan", 
	"penelitianFile");  
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
		$this->db->join('tbldosen','tblpenelitian.dosenID = tbldosen.dosenID');

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();
		    $this->db->like("tbldosen.dosenID", $_POST["search"]["value"]);  
		    $this->db->or_like("penelitianID", $_POST["search"]["value"]); 
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("penelitianJudul", $_POST["search"]["value"]); 
		    $this->db->or_like("penelitianKeterangan", $_POST["search"]["value"]); 
		    $this->db->or_like("penelitianFile", $_POST["search"]["value"]); 
		    $this->db->group_end();
		}
		if($period !== '') {
			
			//$_POST["columns"][1]["search"]["value"]
			if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
				$this->db->like("penelitianID",$_POST["columns"][0]["search"]["value"]);
			}
			if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][1]["search"]["value"] !== '') {
				$this->db->like("tbldosen.dosenID",$_POST["columns"][1]["search"]["value"]);
			}
			if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
				$this->db->like("Nama",$_POST["columns"][2]["search"]["value"]);
			}
			if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
				$this->db->like("tanggal",$_POST["columns"][3]["search"]["value"]);
			}
			if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
				$this->db->like("penelitianJudul",$_POST["columns"][4]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
				$this->db->like("penelitianKeterangan",$_POST["columns"][5]["search"]["value"]);
			}

			if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
				$this->db->like("penelitianFile",$_POST["columns"][6]["search"]["value"]);
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
		$this->db->group_by("penelitianID");
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
		FROM tblpenelitian t
		GROUP BY DATE_FORMAT(`tanggal`, '%Y-%m') ORDER BY DATE_FORMAT(`tanggal`, '%Y-%m') DESC;");
		return $query->result_array();
	}
	function update_penelitian($penelitianID, $dosenID, $tanggal, $judul, $keterangan, $file) {
		if($penelitianID == 0) {
			$this->db->set('dosenID',$dosenID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('penelitianJudul',$judul);
			$this->db->set('penelitianKeterangan',$keterangan);
			if($file !== '') {
				$this->db->set('penelitianFile',$file);	
			}
			
			if( $this->db->insert('tblpenelitian')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('penelitianJudul',$judul);
			$this->db->set('penelitianKeterangan',$keterangan);
			if($file !== '') {
				$this->db->set('penelitianFile',$file);
			}
			$this->db->where('penelitianID',$penelitianID);
			if( $this->db->update('tblpenelitian')) {
				return $penelitianID;
			} else {
				return 'An error occured';
			}
		}
		
	}
	function delete_penelitian($id) {
		$this->db->where('penelitianID',$id);
		if( $this->db->delete('tblpenelitian')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}

	function get_totalpenelitian($period, $dosenID) {
		//period = 201801
		$this->db->select('dosenID');
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('dosenID', $dosenID);
		$this->db->from('tblpenelitian');
		$query = $this->db->get();  
		return $query->num_rows();
	}
	public function get_detail($period, $dosenID)
	{

		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblpenelitian.dosenID = tbldosen.dosenID');
		$this->db->where('tblpenelitian.dosenID', $dosenID);
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		return $this->db->get()->result_array();
	}
}