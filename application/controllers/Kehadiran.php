<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

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
        $this->load->model('DBKehadiran');
        $this->load->model('DBMataKuliah');
        $this->load->model('DBJadwal');
        $this->load->model('DBDosen');

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

  	    $jabatan = array(
		  array('jabatan'=>'D'),
		  array('jabatan'=>'AA'),
		  array('jabatan'=>'L')
		);
		$smtr = array(
		  array('smtr'=>'I'),
		  array('smtr'=>'II'),
		  array('smtr'=>'III'),
		  array('smtr'=>'IV'),
		  array('smtr'=>'V'),
		  array('smtr'=>'VI'),
		  array('smtr'=>'VII'),
		  array('smtr'=>'VIII'),
		  array('smtr'=>'IX'),
		  array('smtr'=>'X')
		);
		$kelas = array(
		  array('kelas'=>'A'),
		  array('kelas'=>'B'),
		  array('kelas'=>'C'),
		  array('kelas'=>'D')
		);
		$hadir = array(
		  array('hadir'=>'I'),
		  array('hadir'=>'II'),
		  array('hadir'=>'III'),
		  array('hadir'=>'IV'),
		  array('hadir'=>'V'),
		  array('hadir'=>'VI')
		);

		$dosen= $this->DBDosen->get_all_dosen_nidn();

		$data = array('welcome' => 'Welcome to our website',
						'periods' => $this->DBKehadiran->get_period(),
						'jurusan' => $this->DBKehadiran->get_jurusan(),
						'jabatan' => $jabatan,
						'matakuliah' => $this->DBMataKuliah->get_matakuliah(),
						'semester' => $smtr,
						'kelas' => $kelas,
						'hadir' => $hadir,
						'jadwal' => $this->DBJadwal->get_jadwal(),
						'dosen' => $dosen);
		$this->template->set('title', 'Data Kehadiran');
        $this->template->load('default_layout', 'contents' , 'kehadiran', $data); 
		
	}
	function fetch_hadir() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBKehadiran"); 
  	    	$period = $this->input->post('period');
  	    	$jurusanID = $this->input->post('jurusanID');
			$fetch_data = $this->DBKehadiran->make_datatables($period, $jurusanID);  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->hadirID;  
				$sub_array[] = $row->dosenID;  
				$sub_array[] = $row->Nama;  
				$sub_array[] = date('d-M-Y',strtotime($row->tanggal));  
				$sub_array[] = $row->Jabatan;  
				$sub_array[] = $row->hadirStatus;  
				$sub_array[] = $row->mataID;  
				$sub_array[] = $row->mataKuliah;   
				$sub_array[] = $row->sks;  
				$sub_array[] = $row->smtr;  
				$sub_array[] = $row->kls;  
				$sub_array[] = $row->jadwalID;  
				$sub_array[] = $row->jadwalNama;  
				$sub_array[] = $row->mingguKe;  
				$sub_array[] = $row->totalWajib;  
				$sub_array[] = $row->totalHadir; 
				$sub_array[] = $row->perc; 
				$sub_array[] = $row->keterangan; 
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBKehadiran->get_all_data(),  
				"recordsFiltered"     =>     $this->DBKehadiran->get_filtered_data($period, $jurusanID),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function deletehadir() {
		$id = $this->input->post('hadirID');
		$v = $this->DBKehadiran->delete_kehadiran($id);

		if(is_numeric($v)) {
			$output = array("stt"  => $v); 
		} else {
			$output = array("stt"  => 'error: An error occured. Please try again later.'); 
		}
		echo json_encode($output);
	}
	function savehadir() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		/*if($this->session->dosenID == 0) {
			$output = array("stt"  => 'error: Anda tidak terhubung dengan dosen manapun.'); 
			$recValid =FALSE;
			goto oncheck;
		}*/
		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				$recValid = TRUE;
				$id = $this->input->post('hadirID');
				if($id == 0) {
					if($this->DBKehadiran->rec_exist($this->input->post('dosenedit'),$this->input->post('tanggaledits'),
						$this->input->post('jadwaledit'),$this->input->post('mataedit'),$this->input->post('jurusanID'))) {
						$output = array("stt"  => 'error: Data dengan dosen, tanggal, jurusan, mata kuliah dan jadwal yang sama sudah ada.'); 
						$recValid = FALSE;
					}
				}

				if(!$recValid) {
					$output = array("stt"  => 'error: Data dengan dosen, tanggal, jurusan, mata kuliah dan jadwal yang sama sudah ada.'); 
				} else {
					
					$v = $this->DBKehadiran->update_kehadiran($id, 
						$this->input->post('dosenedit'),
						$this->input->post('tanggaledits'),
						$this->input->post('statusedit'),
						$this->input->post('mataedit'),
						$this->input->post('sksedit'),
						$this->input->post('semesteredit'),
						$this->input->post('kelasedit'),
						$this->input->post('jadwaledit'),
						$this->input->post('mingguedit'),
						$this->input->post('wajibedit'),
						$this->input->post('hadiredit'),
						$this->input->post('keteranganedit'),
						$this->input->post('jurusanID'));

					$output = array("stt"  => $v); 
					/*if(is_numeric($v)) {
						$output = array("stt"  => $v); 
					} else {
						$output = array("stt"  => 'error: '.$this->db->error()); 
					}*/
				}
				
				echo json_encode($output);
			} else{
				$output = array("stt"  => 'error: Not Posted.');
				echo json_encode($output);
			}
		}
	}
	
	
}
