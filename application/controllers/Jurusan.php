<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

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
        $this->load->model('DBJurusan');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if(!$this->session->userdata('isAdmin')) {
    		redirect(base_url().'');  
    	}
		$data = array('welcome' => 'Welcome to our website',
						'jurusan' => $this->DBJurusan->get_record());
		$this->template->set('title', 'Data Jurusan');
        $this->template->load('default_layout', 'contents' , 'jurusan', $data); 
		
	}
	
	
	function savejurusan() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		$jurusanID = $this->input->post('jurusanID');
		$jurusanNama = $this->input->post('jurusanNama');
		$isAktif = $this->input->post('isAktif');
		if(1 === preg_match('~[0-9]~', $jurusanNama)){
			$output = array("stt"  => 'error: Nama Jurusan tidak valid. Angka tidak diperbolehkan.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		
		
		if($this->DBJurusan->jurusanexist($jurusanID, $jurusanNama)) {
			$output = array("stt"  => 'error: Jurusan sudah ada. '); 
			$recValid =FALSE;
		}
		if(empty($this->input->post('jurusanNama'))) {
			$output = array("stt"  => 'error: Nama Jurusan belum dimasukkan.'); 
			$recValid =FALSE;
		}
		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				$id = $this->DBJurusan->updatejurusan($jurusanID, $jurusanNama, $isAktif);
				if($id > 0) {
					$output = array("stt"  => $id); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}

	function deletejurusan() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		$jurusanID = $this->input->post('jurusanID');


		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				if($this->DBJurusan->delete_jurusan($jurusanID)) {
					$output = array("stt"  => $jurusanID); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}
	
}
