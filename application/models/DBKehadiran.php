<?php
class DBkehadiran extends CI_Model {

var $table = "tblkehadiran";  
var $select_column = array("hadirID","tbldosen.dosenID", "Nama", "tanggal", "tblkehadiran.Jabatan", "hadirStatus", 
	"tblkehadiran.mataID", "mataKuliah","sks","smtr","kls","tblkehadiran.jadwalID","jadwalNama","mingguKe",
	"totalWajib","totalHadir","perc","keterangan", "tblkehadiran.jurusanID");  
var $order_column = array("hadirID","tbldosen.dosenID", "Nama", "tanggal", "tblkehadiran.Jabatan", "hadirStatus", 
	"tblkehadiran.mataID", "mataKuliah","sks","smtr","kls","tblkehadiran.jadwalID","jadwalNama","mingguKe",
	"totalWajib","totalHadir","perc", "keterangan","tblkehadiran.jurusanID");  
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

	function get_totalhadir($period, $dosenID, $jurusanID, $mataID) {
		//period = 201801
		$this->db->select('dosenID');
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('jurusanID', $jurusanID);
		$this->db->where('mataID', $mataID);
		$this->db->where('dosenID', $dosenID);
		$this->db->from('tblkehadiran');
		$query = $this->db->get();  
		return $query->num_rows();
	}

	function make_query($period = '', $jurusanID = '')  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblkehadiran.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblkehadiran.mataID = tblmatakuliah.mataID');
		$this->db->join('tbljadwal','tblkehadiran.jadwalID = tbljadwal.jadwalID');

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();
		    $this->db->like("tbldosen.dosenID", $_POST["search"]["value"]);
		    $this->db->or_like("hadirID", $_POST["search"]["value"]);   
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("tblkehadiran.Jabatan", $_POST["search"]["value"]); 
		    $this->db->or_like("hadirStatus", $_POST["search"]["value"]); 
		    $this->db->or_like("mataKuliah", $_POST["search"]["value"]); 
		    $this->db->or_like("sks", $_POST["search"]["value"]);
		    $this->db->or_like("smtr", $_POST["search"]["value"]);
		    $this->db->or_like("kls", $_POST["search"]["value"]);
		    $this->db->or_like("jadwalNama", $_POST["search"]["value"]);
		    $this->db->or_like("keterangan", $_POST["search"]["value"]);
		    $this->db->group_end();
		}
		if($period !== '') {
			
			//$_POST["columns"][1]["search"]["value"]
			if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
				$this->db->like("hadirID",$_POST["columns"][0]["search"]["value"]);
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
				$this->db->like("tblkehadiran.Jabatan",$_POST["columns"][4]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
				$this->db->like("hadirStatus",$_POST["columns"][5]["search"]["value"]);
			}

			if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
				$this->db->like("tblkehadiran.mataID",$_POST["columns"][6]["search"]["value"]);
			}
			if(isset($_POST["columns"][7]["search"]["value"]) && $_POST["columns"][7]["search"]["value"] !== '') {
				$this->db->like("mataKuliah",$_POST["columns"][7]["search"]["value"]);
			}
			if(isset($_POST["columns"][8]["search"]["value"]) && $_POST["columns"][8]["search"]["value"] !== '') {
				$this->db->like("sks",$_POST["columns"][8]["search"]["value"]);
			}
			if(isset($_POST["columns"][9]["search"]["value"]) && $_POST["columns"][9]["search"]["value"] !== '') {
				$this->db->like("smtr",$_POST["columns"][9]["search"]["value"]);
			}
			if(isset($_POST["columns"][10]["search"]["value"]) && $_POST["columns"][10]["search"]["value"] !== '') {
				$this->db->like("kls",$_POST["columns"][10]["search"]["value"]);
			}
			if(isset($_POST["columns"][11]["search"]["value"]) && $_POST["columns"][11]["search"]["value"] !== '') {
				$this->db->like("tblkehadiran.jadwalID",$_POST["columns"][11]["search"]["value"]);
			}
			if(isset($_POST["columns"][12]["search"]["value"]) && $_POST["columns"][12]["search"]["value"] !== '') {
				$this->db->like("jadwalNama",$_POST["columns"][12]["search"]["value"]);
			}
			if(isset($_POST["columns"][13]["search"]["value"]) && $_POST["columns"][13]["search"]["value"] !== '') {
				$this->db->like("mingguKe",$_POST["columns"][13]["search"]["value"]);
			}
			
			if(isset($_POST["columns"][14]["search"]["value"]) && $_POST["columns"][14]["search"]["value"] !== '') {
				$this->db->like("totalWajib",$_POST["columns"][14]["search"]["value"]);
			}
			if(isset($_POST["columns"][15]["search"]["value"]) && $_POST["columns"][15]["search"]["value"] !== '') {
				$this->db->like("totalHadir",$_POST["columns"][15]["search"]["value"]);
			}
			if(isset($_POST["columns"][16]["search"]["value"]) && $_POST["columns"][16]["search"]["value"] !== '') {
				$this->db->like("perc",$_POST["columns"][16]["search"]["value"]);
			}
			if(isset($_POST["columns"][17]["search"]["value"]) && $_POST["columns"][17]["search"]["value"] !== '') {
				$this->db->like("keterangan",$_POST["columns"][17]["search"]["value"]);
			}

			$this->db->where("date_format(tanggal,'%Y%m')",$period);
			$this->db->where("jurusanID",$jurusanID);
		}
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('tanggal', 'DESC');  
		}  
		$this->db->group_by("tbldosen.dosenID, tanggal, jadwalID, mataID");
	}  
	function make_datatables($period = '', $jurusanID =''){  
		$this->make_query($period, $jurusanID);  
		if(isset($_POST["length"])) {
				if($_POST["length"] != -1)  
		   {  
		        $this->db->limit($_POST['length'], $_POST['start']);  
		   }
		}

		$query = $this->db->get();  
		
		return $query->result();  
	}  
	
	function get_filtered_data($period = '', $jurusanID = ''){  
		$this->make_query($period, $jurusanID);  
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
		$query = $this->db->query("SELECT Period
			FROM
			  (SELECT DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
			   FROM
			     tblkehadiran t
			   GROUP BY
			     DATE_FORMAT(`tanggal`, '%Y-%m')
			  UNION ALL
			  SELECT DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
			   FROM
			     tblnilai t
			   GROUP BY
			     DATE_FORMAT(`tanggal`, '%Y-%m')
			  UNION ALL
			  SELECT DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
			   FROM
			     tblpenelitian t
			   GROUP BY
			     DATE_FORMAT(`tanggal`, '%Y-%m')
			  UNION ALL
			  SELECT DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
			   FROM
			     tblpengabdian t
			   GROUP BY
			     DATE_FORMAT(`tanggal`, '%Y-%m')
			  UNION ALL
			  SELECT DATE_FORMAT(`tanggal`, '%Y-%m') AS Period
			   FROM
			     tblsap t
			   GROUP BY
			     DATE_FORMAT(`tanggal`, '%Y-%m')) Query1
			GROUP BY
			  Period;");
		return $query->result_array();
	}
	function rec_exist($dosenID, $tanggal, $jadwalID, $mataID, $jurusanID) {
		$v = $this->PublicModel->dLookUp('hadirID','tblkehadiran','dosenID = '.$dosenID.' AND 
			DATE(tanggal) = DATE("'.date('Y-m-d', strtotime($tanggal)).'") AND 
				jadwalID = '.$jadwalID.' AND mataID ='.$mataID.' AND jurusanID='.$jurusanID);
		if(is_numeric($v)) {
			return TRUE;
		}
		return FALSE;
	}
	function get_jurusan(){
		$query = $this->db->query("SELECT
		  jurusanID, jurusanNama FROM tbljurusan WHERE isAktif <> 0 ORDER BY jurusanNama ASC;");
		return $query->result_array();
	}
	function update_kehadiran($hadirID, $dosenID, $tanggal, $status, $mataID, $sks, $smtr, $kls, $jadwalID,
		$mingguKe, $totalWajib, $totalHadir, $keterangan,$jurusanID) {
		if($hadirID == 0) {
			$this->db->set('dosenID',$dosenID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('Jabatan',$this->PublicModel->dLookUp('Jabatan','tbldosen','dosenID='.$dosenID));
			$this->db->set('hadirStatus',$status);
			$this->db->set('mataID',$mataID);
			$this->db->set('sks',$sks);
			$this->db->set('smtr',$smtr);
			$this->db->set('kls',$kls);
			$this->db->set('jadwalID',$jadwalID);
			$this->db->set('mingguKe',$mingguKe);
			$this->db->set('totalHadir',$totalHadir);
			$this->db->set('totalWajib',$totalWajib);
			$this->db->set('keterangan',$keterangan);
			$this->db->set('jurusanID', $jurusanID);
			if( $this->db->insert('tblkehadiran')) {
				return $this->db->insert_id();
			} else {
				return $this->db->error();
			}
			
		} else {
			//UPDATE
			$this->db->set('dosenID',$dosenID);
			$this->db->set('tanggal',date('Y-m-d', strtotime($tanggal)));
			$this->db->set('hadirStatus',$status);
			$this->db->set('mataID',$mataID);
			$this->db->set('sks',$sks);
			$this->db->set('smtr',$smtr);
			$this->db->set('kls',$kls);
			$this->db->set('jadwalID',$jadwalID);
			$this->db->set('mingguKe',$mingguKe);
			$this->db->set('totalHadir',$totalHadir);
			$this->db->set('totalWajib',$totalWajib);
			$this->db->set('keterangan',$keterangan);
			$this->db->where('hadirID',$hadirID);			
			if( $this->db->update('tblkehadiran')) {
				return $hadirID;
			} else {
				return $this->db->error();
			}
		}
		
	}
	function delete_kehadiran($id) {
		$this->db->where('hadirID',$id);
		if( $this->db->delete('tblkehadiran')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}
	public function get_detail($period, $dosenID, $mataID, $jurusanID)
	{

		$this->db->select($this->select_column);  
		$this->db->select('jurusanNama');
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tblkehadiran.dosenID = tbldosen.dosenID');
		$this->db->join('tblmatakuliah','tblkehadiran.mataID = tblmatakuliah.mataID');
		$this->db->join('tbljadwal','tblkehadiran.jadwalID = tbljadwal.jadwalID');
		$this->db->join('tbljurusan','tblkehadiran.jurusanID = tbljurusan.jurusanID');
		$this->db->where('tblkehadiran.dosenID', $dosenID);
		$this->db->where('date_format(tanggal,"%Y%m")',$period);
		$this->db->where('tblkehadiran.mataID',$mataID);
		$this->db->where('tblkehadiran.jurusanID', $jurusanID);
		return $this->db->get()->result_array();
	}
}