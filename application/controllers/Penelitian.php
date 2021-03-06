<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends CI_Controller {

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
        $this->load->model('DBPenelitian');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '1')  //NOT DOSEN Staff
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }

		$data = array('welcome' => 'Welcome to our website',
						'periods' => $this->DBPenelitian->get_period());
		$this->template->set('title', 'Data Penelitian');
        $this->template->load('default_layout', 'contents' , 'penelitian', $data); 
		
	}
	function fetch_penelitian() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBPenelitian"); 
  	    	$period = $this->input->post('period');
			$fetch_data = $this->DBPenelitian->make_datatables($period);  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->penelitianID;  
				$sub_array[] = $row->dosenID;  
				$sub_array[] = $row->Nama;  
				$sub_array[] = date('d-M-Y',strtotime($row->tanggal));  
				$sub_array[] = $row->penelitianJudul;  
				$sub_array[] = $row->penelitianKeterangan;  
				$sub_array[] = $row->penelitianFile;  
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBPenelitian->get_all_data(),  
				"recordsFiltered"     =>     $this->DBPenelitian->get_filtered_data($period),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function showfile($id, $dosenID) {
		if ($this->session->userdata('logged_in') == FALSE) {
			redirect(base_url().'');   
		}
		$fname = $this->PublicModel->dLookUp('penelitianFile', 'tblpenelitian','penelitianID='.$id);
		$pdfFile = './uploads/'.$dosenID.'/'.$fname;
		if($pdfFile !== '') {
			$this->output
           ->set_content_type('application/pdf')
           ->set_output(file_get_contents($pdfFile));
       } else {
       		redirect(base_url().'');   
       }
		

	}
	function deletepenelitian() {
		$id = $this->input->post('penelitianID');
		if($id !== '0') {
			$v = $this->DBPenelitian->delete_penelitian($id);

			if(is_numeric($v)) {
				$output = array("stt"  => $v); 
			} else {
				$output = array("stt"  => 'error: An error occured. Please try again later.'.$id); 
			}
		} else {
			$output = array("stt"  => 'error: ID Penelitian tidak ditemukan.'); 
		}
		
		echo json_encode($output);
	}
	function savepenelitian() {
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
				$name_file ='';
				if($_FILES['fileedit']['name'] !== '') {
					$name_file = $_FILES['fileedit']['name'];
					$name_file = date('ymdhi').'-pnl-'.$name_file;
					if (!file_exists('./uploads/'.$this->session->dosenID.'/')) {
					    mkdir('./uploads/'.$this->session->dosenID.'/', 0777, true);
					}
					if(isset($name_file)) {
						$config['upload_path']          = './uploads/'.$this->session->dosenID.'/';
						$config['file_name']          = $name_file;
						$config['allowed_types']        = 'pdf|doc|jpg|png|docx';

		                $this->load->library('upload', $config);
		                if ( ! $this->upload->do_upload('fileedit')) {
		                	$output = array("stt"  => 'error: '.$this->upload->display_errors());
		                	$recValid = FALSE;
		                } 
					}
				} else {
					$output = array("stt"  => 'error: File penelitian belum dimasukkan.');
		            $recValid = FALSE;
				}				
				
                if ( !$recValid) {
                	echo json_encode($output);
                } else {                	
                	$recValid = TRUE;
					$id = $this->input->post('penelitianID');
					$v = $this->DBPenelitian->update_penelitian($id, 
						$this->session->dosenID,
						$this->input->post('tanggaledits'),
						$this->input->post('judul'),
						$this->input->post('keterangan'),
						$name_file);

					if(is_numeric($v)) {
						$output = array("stt"  => $v); 
					} else {
						$output = array("stt"  => 'error: An error occured. Please try again later.'); 
					}
					echo json_encode($output);
                }
				
				
			} else{
				$output = array("stt"  => 'error: Not Posted.');
				echo json_encode($output);
			}
		}
	}
	
	
}
