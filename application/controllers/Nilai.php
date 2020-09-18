<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

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
        $this->load->model('DBNilai');
        $this->load->model('DBMataKuliah');
        $this->load->model('DBDosen');
        $this->load->model('DBJurusan');
        $this->load->model('PublicModel');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '1')  //NOT Dosen
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }

  	    $jenis = array(
		  array('jenis'=>'UAS'),
		  array('jenis'=>'UTS')
		);
		$data = array('welcome' => 'Welcome to our website',
						'periods' => $this->DBNilai->get_period(),
						'jenis' => $jenis,
						'matakuliah' => $this->DBMataKuliah->get_matakuliah_aktif(),
						'jurusan' => $this->DBJurusan->get_jurusan_aktif());
		$this->template->set('title', 'Data Nilai');
        $this->template->load('default_layout', 'contents' , 'nilai', $data); 
		
	}
	function fetch_nilai() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBNilai"); 
  	    	$period = $this->input->post('period');
			$fetch_data = $this->DBNilai->make_datatables($period);  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->nilaiID;  
				$sub_array[] = $row->dosenID;  
				$sub_array[] = $row->Nama;  
				$sub_array[] = date('d-M-Y',strtotime($row->tanggal)); 
				$sub_array[] = $row->jurusanNama;    
				$sub_array[] = $row->mataKuliah;    
				$sub_array[] = $row->jenisNilai;  
				$sub_array[] = $row->StatName;  
				$sub_array[] = $row->isActive; 				
				$sub_array[] = $row->mataID;
				$sub_array[] = $row->jurusanID;
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBNilai->get_all_data(),  
				"recordsFiltered"     =>     $this->DBNilai->get_filtered_data($period),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function deletenilai() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '1')  //NOT Dosen
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }
		$id = $this->input->post('nilaiID');
		$v = $this->DBNilai->delete_nilai($id);

		if(is_numeric($v)) {
			$output = array("stt"  => $v); 
		} else {
			$output = array("stt"  => 'error: An error occured. Please try again later.'); 
		}
		echo json_encode($output);
	}
	function savenilai() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		if($this->session->dosenID == 0) {
			$output = array("stt"  => 'error: Anda tidak terhubung dengan dosen manapun.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				$recValid = TRUE;
				$id = $this->input->post('nilaiID');
				$isAktif = $this->input->post('isAktif');
				//$nilaiID, $dosenID, $tanggal, $isActive, $mataID, $jenisNilai
				$v = $this->DBNilai->update_nilai($id, 
					$this->session->dosenID,
					$this->input->post('tanggaledits'),
					$isAktif,
					$this->input->post('mataedit'),
					$this->input->post('jenisnilai'),
					$this->input->post('jurusanID'));

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
