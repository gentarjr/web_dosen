<?php
class DBNilai extends CI_Model {

var $table = "tblnilai";  
var $select_column = array("nilaiID","tbldosen.dosenID", "Nama", "tanggal", "tblnilai.mataID","mataKuliah", "jenisNilai", 
	"if(isActive =0,'Tidak','Ya') as StatName","tblnilai.isActive","tblnilai.jurusanID","jurusanNama");  
var $order_column = array("nilaiID","tbldosen.dosenID", "Nama", "tanggal", "tblnilai.mataID", "mataKuliah", "jenisNilai", 
	"if(isActive =0,'Tidak','Ya') as StatName","tblnilai.jurusanID","jurusanNama");  
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
		$this->db->join('tbldosen','tblnilai.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblnilai.mataID = tblmatakuliah.mataID');
		$this->db->join('tbljurusan','tblnilai.jurusanID = tbljurusan.jurusanID');

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();
		    $this->db->like("tbldosen.dosenID", $_POST["search"]["value"]);
		    $this->db->or_like("nilaiID", $_POST["search"]["value"]);   
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("tanggal", $_POST["search"]["value"]); 
		    $this->db->or_like("jenisNilai", $_POST["search"]["value"]); 
		    $this->db->or_like("mataKuliah", $_POST["search"]["value"]); 
		    $this->db->or_like("jurusanNama", $_POST["search"]["value"]); 
		    $this->db->or_like("if(isActive =0,'Tidak','Ya')", $_POST["search"]["value"]); 
		    $this->db->group_end();
		}
		if($period !== '') {
			
			//$_POST["columns"][1]["search"]["value"]
			if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
				$this->db->like("nilaiID",$_POST["columns"][0]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
				$this->db->like("Nama",$_POST["columns"][2]["search"]["value"]);
			}
			if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
				$this->db->like("tanggal",$_POST["columns"][3]["search"]["value"]);
			}
			if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
				$this->db->like("jurusanNama",$_POST["columns"][4]["search"]["value"]);
			}
			if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
				$this->db->like("mataKuliah",$_POST["columns"][5]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
				$this->db->like("jenisNilai",$_POST["columns"][6]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][7]["search"]["value"]) && $_POST["columns"][7]["search"]["value"] !== '') {
				$this->db->like("if(isActive =0,'Tidak','Ya')",$_POST["columns"][7]["search"]["value"]);
			}


			$this->db->where("date_format(tanggal,'%Y%m')",$period);

			
		}
		$this->db->where("tblnilai.dosenID",$this->session->dosenID);
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('tanggal', 'DESC');  
		}  
		$this->db->group_by("nilaiID");
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
		FROM tblnilai t
		GROUP BY DATE_FORMAT(`tanggal`, '%Y-%m') ORDER BY DATE_FORMAT(`tanggal`, '%Y-%m') DESC;");
		return $query->result_array();
	}
	function update_nilai($nilaiID, $dosenID, $tanggal, $isActive, $mataID, $jenisNilai, $jurusanID) {
		if($nilaiID == 0) {
			$this->db->set('dosenID',$dosenID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('jenisNilai',$jenisNilai);
			$this->db->set('mataID',$mataID);
			$this->db->set('jurusanID',$jurusanID);
			$this->db->set('isActive',$isActive);
			if( $this->db->insert('tblnilai')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('dosenID',$dosenID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('jenisNilai',$jenisNilai);
			$this->db->set('mataID',$mataID);
			$this->db->set('jurusanID',$jurusanID);
			$this->db->set('isActive',$isActive);
			$this->db->where('nilaiID',$nilaiID);
			if( $this->db->update('tblnilai')) {
				return $nilaiID;
			} else {
				return 'An error occured';
			}
		}
		
	}
	function delete_nilai($id) {
		$this->db->where('nilaiID',$id);
		if( $this->db->delete('tblnilai')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}

	function get_totalnilai($period, $dosenID, $jurusanID, $mataID) {
		//period = 201801
		/*$this->db->select('dosenID');
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('jurusanID', $jurusanID);
		$this->db->where('mataID', $mataID);
		$this->db->where('dosenID', $dosenID);
		$this->db->where('isActive', 1);
		$this->db->from('tblnilai');
		$query = $this->db->get();  
		return $query->num_rows();*/

		$query = $this->db->query("SELECT `dosenID`
			     , sum(if(jenisNilai = 'UAS', 1, 0)) AS UAS
			     , sum(if(jenisNilai = 'UTS', 1, 0)) AS UTS
			FROM
			  `tblnilai`
			WHERE
			  date_format(tanggal, '%Y%m') = '".$period."'
			  AND `jurusanID` = ".$jurusanID." 
			  AND `mataID` = ".$mataID." 
			  AND `dosenID` =  ".$dosenID." 
			  AND `isActive` = 1
			GROUP BY
			  dosenID
			HAVING
			  sum(if(jenisNilai = 'UAS', 1, 0)) = 1
			  AND sum(if(jenisNilai = 'UTS', 1, 0)) = 1");
		return  $query->num_rows();
	}

	public function get_detail($period, $dosenID, $mataID, $jurusanID)
	{

		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblnilai.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblnilai.mataID = tblmatakuliah.mataID');
		$this->db->join('tbljurusan','tblnilai.jurusanID = tbljurusan.jurusanID');
		$this->db->where('tblnilai.dosenID', $dosenID);
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('tblnilai.mataID',$mataID);
		$this->db->where('tblnilai.jurusanID', $jurusanID);
		return $this->db->get()->result_array();
	}
}