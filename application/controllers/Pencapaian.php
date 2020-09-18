<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencapaian extends CI_Controller {

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
        $this->load->model('DBPencapaian');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '3')  //NOT penjamin mutu
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }

		$data = array('welcome' => 'Welcome to our website',
						'periods' => $this->DBPencapaian->get_period());
		$this->template->set('title', 'Data Pencapaian');
        $this->template->load('default_layout', 'contents' , 'pencapaian', $data); 
		
	}
	function fetch_capai() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBPencapaian"); 
  	    	$period = $this->input->post('period');
			$fetch_data = $this->DBPencapaian->make_datatables($period);  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->capaiID;  
				$sub_array[] = date('d-M-Y',strtotime($row->tanggal));  
				$sub_array[] = $row->paramName;  
				$sub_array[] = $row->kriteria; 
				$sub_array[] = $row->tIndustri;  
				$sub_array[] = $row->tSipil;  
				$sub_array[] = $row->tInformatika;  
				$sub_array[] = $row->tElektro; 
				$sub_array[] = $row->tArsitektur; 
				$sub_array[] = $row->tMesin; 
				$sub_array[] = $row->tPWK; 
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBPencapaian->get_all_data(),  
				"recordsFiltered"     =>     $this->DBPencapaian->get_filtered_data($period),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function deletecapai() {
		$id = $this->input->post('capaiID');
		if($id !== '0') {
			$v = $this->DBPencapaian->delete_capai($id);

			if(is_numeric($v)) {
				$output = array("stt"  => $v); 
			} else {
				$output = array("stt"  => 'error: An error occured. Please try again later.'.$id); 
			}
		} else {
			$output = array("stt"  => 'error: ID Pencapaian tidak ditemukan.'); 
		}
		
		echo json_encode($output);
	}
	function savecapai() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		if(empty($this->input->post('paramName'))) {
			$output = array("stt"  => 'error: Parameter belum dimasukkan.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		if(empty($this->input->post('kriteria'))) {
			$output = array("stt"  => 'error: Kriteria belum dimasukkan.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		$tInformatika = 0;
		$tIndustri = 0;
		$tSipil = 0;
		$tElektro = 0;
		$tArsitektur = 0;
		$tMesin = 0;
		$tPWK = 0 ;
		$tinfo = '';

		if(!empty($this->input->post('tInformatika'))) {
			$tinfo = $this->input->post('tInformatika');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Informatika tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Informatika tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tInformatika = $tinfo;			
			}
		}

		if(!empty($this->input->post('tIndustri'))) {
			$tinfo = $this->input->post('tIndustri');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Industri tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Industri tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tIndustri = $tinfo;	
			}
		}
		if(!empty($this->input->post('tSipil'))) {
			$tinfo = $this->input->post('tSipil');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Sipil tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Sipil tidak valid.'.$tIndustri); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tSipil = $tinfo;
			}
		}
		if(!empty($this->input->post('tElektro'))) {
			$tinfo = $this->input->post('tElektro');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Elektro tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Elektro tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tElektro = $tinfo;
			}
		}
		if(!empty($this->input->post('tArsitektur'))) {
			$tinfo = $this->input->post('tArsitektur');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Arsitektur tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Arsitektur tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tArsitektur = $tinfo;
			}
		}
		if(!empty($this->input->post('tMesin'))) {
			$tinfo = $this->input->post('tMesin');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai Teknik Mesin tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai Teknik Mesin tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tMesin = $tinfo;
			}
		}
		if(!empty($this->input->post('tPWK'))) {
			$tinfo = $this->input->post('tPWK');
			if(!is_numeric($tinfo)) {
				$output = array("stt"  => 'error: Nilai PWK tidak valid.'); 
				$recValid =FALSE;
				goto oncheck;
			} else {
				if($tinfo > 100 || $tinfo < 0) {
					$output = array("stt"  => 'error: Nilai PWK tidak valid.'); 
					$recValid =FALSE;
					goto oncheck;
				}	
				$tPWK = $tinfo;
			}
		}

		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				$id = $this->input->post('capaiID');
				$v = $this->DBPencapaian->update_capai($id, 
					$this->input->post('tanggal'),
					$this->input->post('paramName'),
					$this->input->post('kriteria'),
					$tIndustri, $tSipil, $tInformatika, $tElektro, $tArsitektur, $tMesin, $tPWK);

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
