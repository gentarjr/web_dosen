<?php
class DBUser extends CI_Model {

var $table = "tbluser";  
var $select_column = array("userid","username", "fullname","Nama", "isAdmin", "lastLogin", 
	"userActive","userType",
	"if(userType=1,'Dosen',if(userType=2,'TU',if(userType=3,'Penjamin Mutu',if(userType=4,'Dekan',if(userType=5,'Kaprodi','UPT'))))) as userTypeName",
	"tbldosen.dosenID");  
var $order_column = array("userid","username", "fullname","Nama", "isAdmin", "lastLogin", 
	"userActive","userType",
	"if(userType=1,'Dosen',if(userType=2,'TU',if(userType=3,'Penjamin Mutu',if(userType=4,'Dekan',if(userType=5,'Kaprodi','UPT')))))",
	"tbldosen.dosenID");  
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

	function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->join('tbldosen','tbluser.dosenID = tbldosen.dosenID','left outer');

		if(isset($_POST["search"]["value"]))  
		{  
			$this->db->group_start();
		    $this->db->like("userid", $_POST["search"]["value"]);  
		    $this->db->or_like("username", $_POST["search"]["value"]); 
		    $this->db->or_like("fullname", $_POST["search"]["value"]); 
		    $this->db->or_like("Nama", $_POST["search"]["value"]); 
		    $this->db->or_like("isAdmin", $_POST["search"]["value"]); 
		    $this->db->or_like("lastLogin", $_POST["search"]["value"]); 
		    $this->db->or_like("userActive", $_POST["search"]["value"]); 
		    $this->db->or_like("userType", $_POST["search"]["value"]); 
		    $this->db->or_like("if(userType=1,'Dosen',if(userType=2,'TU',if(userType=3,'Penjamin Mutu',if(userType=4,'Dekan','Kaprodi'))))",$_POST["search"]['value']);
		    $this->db->or_like("tbldosen.dosenID", $_POST["search"]["value"]); 
		    $this->db->group_end();
		}
		if(isset($_POST["columns"][0]["search"]["value"]) && $_POST["columns"][0]["search"]["value"] !== '') {
			$this->db->like("userid",$_POST["columns"][0]["search"]["value"]);
		}
		if(isset($_POST["columns"][1]["search"]["value"]) && $_POST["columns"][1]["search"]["value"] !== '') {
			$this->db->like("username",$_POST["columns"][1]["search"]["value"]);
		}
		if(isset($_POST["columns"][2]["search"]["value"]) && $_POST["columns"][2]["search"]["value"] !== '') {
			$this->db->like("fullname",$_POST["columns"][2]["search"]["value"]);
		}
		if(isset($_POST["columns"][3]["search"]["value"]) && $_POST["columns"][3]["search"]["value"] !== '') {
			$this->db->like("Nama",$_POST["columns"][3]["search"]["value"]);
		}
		if(isset($_POST["columns"][4]["search"]["value"]) && $_POST["columns"][4]["search"]["value"] !== '') {
			$this->db->like("isAdmin",$_POST["columns"][4]["search"]["value"]);
		}
		if(isset($_POST["columns"][5]["search"]["value"]) && $_POST["columns"][5]["search"]["value"] !== '') {
			$this->db->like("lastLogin",$_POST["columns"][5]["search"]["value"]);
		}
		
		if(isset($_POST["columns"][6]["search"]["value"]) && $_POST["columns"][6]["search"]["value"] !== '') {
			$this->db->like("userActive",$_POST["columns"][6]["search"]["value"]);
		}

		if(isset($_POST["columns"][7]["search"]["value"]) && $_POST["columns"][7]["search"]["value"] !== '') {
			$this->db->like("userType",$_POST["columns"][7]["search"]["value"]);
		}
		if(isset($_POST["columns"][8]["search"]["value"]) && $_POST["columns"][8]["search"]["value"] !== '') {
			$this->db->like("if(userType=1,'Dosen',if(userType=2,'TU',if(userType=3,'Penjamin Mutu',if(userType=4,'Dekan','Kaprodi'))))",$_POST["columns"][8]["search"]["value"]);
		}
		if(isset($_POST["columns"][9]["search"]["value"]) && $_POST["columns"][9]["search"]["value"] !== '') {
			$this->db->like("tbldosen.dosenID",$_POST["columns"][9]["search"]["value"]);
		}
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('userid', 'DESC');  
		}  
		$this->db->group_by("userid");
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

	function update_user($userid, $username, $fullname, $dosenID, $usertype, $useractive, $pass1, $pass2) {
		if($userid == 0) {
			$this->db->set('username', $username);
			$this->db->set('fullname',$fullname);
			$this->db->set('webpassword',md5($pass1));
			$this->db->set('userType',$usertype);
			$this->db->set('dosenID',$dosenID);
			$this->db->set('userActive',$useractive);
			
			if( $this->db->insert('tbluser')) {
				return $this->db->insert_id();
			} else {
				return 'An error occured.';
			}
			
		} else {
			//UPDATE
			$this->db->set('username', $username);
			$this->db->set('fullname',$fullname);
			if($pass1 !== '') {
				$this->db->set('webpassword',md5($pass1));	
			}
			
			$this->db->set('userType',$usertype);
			$this->db->set('dosenID',$dosenID);
			$this->db->set('userActive',$useractive);

			$this->db->where('userid',$userid);
			if( $this->db->update('tbluser')) {
				return $userid;
			} else {
				return 'An error occured';
			}
		}
		
	}
	function update_userprofile($fullname, $pass1) {
		if($pass1 !== '') {
			$this->db->set('webpassword',md5($pass1));	
		}
		$this->db->set('fullname',$fullname);
		$this->db->where('userid',$this->session->userid);
		if( $this->db->update('tbluser')) {
			return $this->session->userid;
		} else {
			return 'An error occured';
		}
	}
	function delete_user($id) {
		$this->db->where('userid',$id);
		if( $this->db->delete('tbluser')) {
			return $id;
		} else {
			return 'An error occured';
		}
	}
	function updateLastLogin() {
		$this->db->set('lastLogin', date('Y-m-d H:i:s', now()));
		$this->db->where('userid',$this->session->userid);
		return $this->db->update('tbluser');
	}
}