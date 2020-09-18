<?php
class DBPencapaian extends CI_Model {

var $table = "tblpencapaian";  
var $select_column = array("capaiID","tanggal","paramName","kriteria","tIndustri","tSipil","tInformatika",
"tElektro","tArsitektur","tMesin","tPWK");  
var $order_column = array("capaiID","tanggal","paramName","kriteria","tIndustri","tSipil","tInformatika",
"tElektro","tArsitektur","tMesin","tPWK");  
var $relstatID = 1;

    public function __construct()
    {
    	$this->load->model('PublicModel');
    	//$this->output->enable_profiler(TRUE);
    }
    
    public function get_record($period ='')
	{

		$this->db->select($this->select_column);  
		if($period !== ''){
			$this->db->where("date_format(tanggal,'%Y%m')",$period);
		}
		$this->db->from($this->table); 
		return $this->db->get()->result_array();
	}

	function make_query($period = '')  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();  
		    $this->db->or_like("capaiID", $_POST["search"]["value"]); 
		    $this->db->or_like("paramName", $_POST["search"]["value"]); 
		    $this->db->or_like("kriteria", $_POST["search"]["value"]); 
		    $this->db->group_end();
		}
		if($period !== '') {
			
			//$_POST["columns"][1]["search"]["value"]
			if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
				$this->db->like("capaiID",$_POST["columns"][0]["search"]["value"]);
			}
			if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][1]["search"]["value"] !== '') {
				$this->db->like("tanggal",$_POST["columns"][1]["search"]["value"]);
			}
			if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
				$this->db->like("paramName",$_POST["columns"][2]["search"]["value"]);
			}
			if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
				$this->db->like("kriteria",$_POST["columns"][3]["search"]["value"]);
			}
			if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
				$this->db->like("tIndustri",$_POST["columns"][4]["search"]["value"]);
			}
			if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
				$this->db->like("tSipil",$_POST["columns"][5]["search"]["value"]);
			}
			if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
				$this->db->like("tInformatika",$_POST["columns"][6]["search"]["value"]);
			}
			if(isset($_POST["columns"][7]["search"]["value"]) && $_POST["columns"][7]["search"]["value"] !== '') {
				$this->db->like("tElektro",$_POST["columns"][7]["search"]["value"]);
			}
			if(isset($_POST["columns"][8]["search"]["value"]) && $_POST["columns"][8]["search"]["value"] !== '') {
				$this->db->like("tArsitektur",$_POST["columns"][8]["search"]["value"]);
			}
			if(isset($_POST["columns"][9]["search"]["value"]) && $_POST["columns"][9]["search"]["value"] !== '') {
				$this->db->like("tMesin",$_POST["columns"][9]["search"]["value"]);
			}
			if(isset($_POST["columns"][10]["search"]["value"]) && $_POST["columns"][10]["search"]["value"] !== '') {
				$this->db->like("tPWK",$_POST["columns"][10]["search"]["value"]);
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
		$this->db->group_by("capaiID");
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
		FROM tblpencapaian t
		GROUP BY DATE_FORMAT(`tanggal`, '%Y-%m') ORDER BY DATE_FORMAT(`tanggal`, '%Y-%m') DESC;");
		return $query->result_array();
	}
	function update_capai($capaiID, $tanggal, $paramName, $kriteria, $tIndustri, $tSipil, $tInformatika, $tElektro,$tArsitektur,
		$tMesin, $tPWK) {
		if($capaiID == 0) {
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('paramName',$paramName);
			$this->db->set('kriteria',$kriteria);
			$this->db->set('tIndustri',$tIndustri);
			$this->db->set('tSipil',$tSipil);
			$this->db->set('tInformatika',$tInformatika);
			$this->db->set('tElektro',$tElektro);
			$this->db->set('tArsitektur',$tArsitektur);
			$this->db->set('tMesin',$tMesin);
			$this->db->set('tPWK',$tPWK);
			
			if( $this->db->insert('tblpencapaian')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('paramName',$paramName);
			$this->db->set('kriteria',$kriteria);
			$this->db->set('tIndustri',$tIndustri);
			$this->db->set('tSipil',$tSipil);
			$this->db->set('tInformatika',$tInformatika);
			$this->db->set('tElektro',$tElektro);
			$this->db->set('tArsitektur',$tArsitektur);
			$this->db->set('tMesin',$tMesin);
			$this->db->set('tPWK',$tPWK);
			$this->db->where('capaiID',$capaiID);
			if( $this->db->update('tblpencapaian')) {
				return $capaiID;
			} else {
				return 'An error occured';
			}
		}
		
	}
	function delete_capai($id) {
		$this->db->where('capaiID',$id);
		if( $this->db->delete('tblpencapaian')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}

}