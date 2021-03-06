<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

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
        $this->load->model('DBMataKuliah');

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
						'matakuliah' => $this->DBMataKuliah->get_record());
		$this->template->set('title', 'Data Mata Kuliah');
        $this->template->load('default_layout', 'contents' , 'matakuliah', $data); 
		
	}
	
	
	function savemata() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}


		oncheck:
		$mataID = $this->input->post('mataID');
		$mataKuliah = $this->input->post('mataKuliah');
		$isAktif = $this->input->post('isAktif');

		if($this->DBMataKuliah->mataexist($mataID, $mataKuliah)) {
			$output = array("stt"  => 'error: Mata kuliah sudah ada.'); 
			$recValid =FALSE;
		}
		if(empty($this->input->post('mataKuliah'))) {
			$output = array("stt"  => 'error: Mata kuliah belum dimasukkan.'); 
			$recValid =FALSE;
		}


		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				$id = $this->DBMataKuliah->updatemata($mataID, $mataKuliah, $isAktif);
				if($id > 0) {
					$output = array("stt"  => $id); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}

	function deletemata() {
		$recValid = TRUE;
		$output = array();

		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		$mataID = $this->input->post('mataID');


		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
				//Check if periode for selected dosen is exist
				if($this->DBMataKuliah->delete_mata($mataID)) {
					$output = array("stt"  => $mataID); 
				} else {
					$output = array("stt"  => 'error: An error occured. Please try again in a few minutes');
				}
				echo json_encode($output);
			}
		}
	}
	
}
