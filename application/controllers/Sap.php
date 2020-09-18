<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('DBMatakuliah');
        $this->load->model('DBDosen');
        $this->load->model('DBSap');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '6')  //NOT UPT Staff
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }

		$data = array('welcome' => 'Welcome to our website',
						'periods' => $this->DBSap->get_period(),
						'matakuliah' => $this->DBMatakuliah->get_record(),
						'dosen' => $this->DBDosen->get_all_dosen_nidn());
		$this->template->set('title', 'Data Kesesuaian SAP');
        $this->template->load('default_layout', 'contents' , 'sap', $data); 
		
	}
	function fetch_sap() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBSap"); 
  	    	$period = $this->input->post('period');
			$fetch_data = $this->DBSap->make_datatables($period);  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->sapID;  
				$sub_array[] = date('d-M-Y',strtotime($row->tanggal));  
				$sub_array[] = $row->Nama;  
				$sub_array[] = $row->mataKuliah; 
				$sub_array[] = $row->StatName;  
				$sub_array[] = $row->dosenID;  
				$sub_array[] = $row->mataID;  
				$sub_array[] = $row->sapStat; 
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBSap->get_all_data(),  
				"recordsFiltered"     =>     $this->DBSap->get_filtered_data($period),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function deletesap() {
		$id = $this->input->post('sapID');
		if($id !== '0') {
			$v = $this->DBSap->delete_sap($id);

			if(is_numeric($v)) {
				$output = array("stt"  => $v); 
			} else {
				$output = array("stt"  => 'error: An error occured. Please try again later.'.$id); 
			}
		} else {
			$output = array("stt"  => 'error: ID SAP tidak ditemukan.'); 
		}
		
		echo json_encode($output);
	}
	function savesap() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		if(empty($this->input->post('dosenID'))) {
			$output = array("stt"  => 'error: Dosen belum dipilih.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		if(empty($this->input->post('mataID'))) {
			$output = array("stt"  => 'error: Mata Kuliah belum dipilih.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				$id = $this->input->post('sapID');
				$v = $this->DBSap->update_sap($id, 
					$this->input->post('dosenID'),
					$this->input->post('tanggal'),
					$this->input->post('mataID'),
					$this->input->post('sapStat'));

				if(is_numeric($v)) {
					$output = array("stt"  => $v); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again later.'); 
				}
				echo json_encode($output);
				
				
			} else{
				$output = array("stt"  => 'error: Not Posted.');
				echo json_encode($output);
			}
		}
	}
	
	
}
