<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

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
        $this->load->model('DBJadwal');

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
						'jadwal' => $this->DBJadwal->get_record());
		$this->template->set('title', 'Data Jadwal');
        $this->template->load('default_layout', 'contents' , 'jadwal', $data); 
		
	}
	
	
	function savejadwal() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}


		oncheck:
		$jadwalID = $this->input->post('jadwalID');
		$jadwalNama = $this->input->post('jadwalNama');
		$isAktif = $this->input->post('isAktif');

		if($this->DBJadwal->jadwalexist($jadwalID, $jadwalNama)) {
			$output = array("stt"  => 'error: Jadwal sudah ada.'); 
			$recValid =FALSE;
		}
		if(empty($this->input->post('jadwalNama'))) {
			$output = array("stt"  => 'error: Nama Jadwal belum dimasukkan.'); 
			$recValid =FALSE;
		}

		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				$id = $this->DBJadwal->updatejadwal($jadwalID, $jadwalNama, $isAktif);
				if($id > 0) {
					$output = array("stt"  => $id); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}

	function deletejadwal() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		$jadwalID = $this->input->post('jadwalID');


		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				if($this->DBJadwal->delete_jadwal($jadwalID)) {
					$output = array("stt"  => $jadwalID); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}
	
}
