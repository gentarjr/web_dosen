<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

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
        $this->load->model('DBDosen');
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
  	    if ($this->session->userdata('userType') !== '2')  //NOT TU Staff
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }
		//$data = array('welcome' => 'Welcome to our website',
						//'sre' => $this->dbstorerequest->get_record());
		$data = array('welcome' => 'Selamat datang di website kami');
		$this->template->set('title', 'Data Dosen');
        $this->template->load('default_layout', 'contents' , 'dosen', $data); 
		
	}
	
	function getnama() {
		$dsid = $this->input->post('dosenid');

		$ret = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dsid);
		$output = array(
			"msg"                    =>     $ret
		);
	    echo json_encode($output);
	}
	
	function editdosen($id = 0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '2')  //NOT TU Staff
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }
		$i=0;
		$hasil=array();
		$hasil1 = array();
		$list = array(
		  array('dosenStatus'=>'DS'),
		  array('dosenStatus'=>'PR'),
		  array('dosenStatus'=>'DT'),
		  array('dosenStatus'=>'PT')
		);

		$periodes = array();
		for ($i=0; $i<=24; $i++) { 
			array_push($periodes, date('Y-m', strtotime("-$i month")));
		}

		$nilai = array(
		  array('nilai'=>'1'),
		  array('nilai'=>'2'),
		  array('nilai'=>'3'),
		  array('nilai'=>'4'),
		  array('nilai'=>'5')
		);

		$jabatan = array(
		  array('jabatan'=>'D'),
		  array('jabatan'=>'AA'),
		  array('jabatan'=>'L')
		);


		if($id == 0) {
			$hasil[$i]['dosenID'] = 0;
            $hasil[$i]['Nama'] = '';
            $hasil[$i]['Jabatan'] = '';
            $hasil[$i]['Alamat'] = '';
            $hasil[$i]['Telp'] = '';
            $hasil[$i]['Email'] = '';
            $hasil[$i]['Sertifikat'] = '';
            $hasil[$i]['PT'] = '';
            $hasil[$i]['AlamatPT'] = '';
            $hasil[$i]['dosenStatus'] = '';
            $hasil[$i]['Fakultas'] = '';
            $hasil[$i]['Jurusan'] = '';
            $hasil[$i]['Golongan'] = '';
            $hasil[$i]['TempatLahir'] = '';
            $hasil[$i]['TanggalLahir'] = date("d-M-Y");
            $hasil[$i]['S1'] = '';
            $hasil[$i]['S2'] = '';
            $hasil[$i]['S3'] = '';
            $hasil[$i]['dosenActive'] = 1;
            $hasil[$i]['NIDN'] = '';
		} else {
			$s= $this->DBDosen->get_dosen_by_id($id);
			foreach($s as $rows) {
				$hasil[$i]['dosenID'] = $rows['dosenID'];
	            $hasil[$i]['Nama'] = $rows['Nama'];
	            $hasil[$i]['Jabatan'] = $rows['Jabatan'];
	            $hasil[$i]['Alamat'] = $rows['Alamat'];
	            $hasil[$i]['Telp'] = $rows['Telp'];
	            $hasil[$i]['Email'] = $rows['Email'];
	            $hasil[$i]['Sertifikat'] = $rows['Sertifikat'];
	            $hasil[$i]['PT'] = $rows['PT'];
	            $hasil[$i]['AlamatPT'] = $rows['AlamatPT'];
	            $hasil[$i]['dosenStatus'] = $rows['dosenStatus'];
	            $hasil[$i]['Fakultas'] = $rows['Fakultas'];
	            $hasil[$i]['Jurusan'] = $rows['Jurusan'];
	            $hasil[$i]['Golongan'] = $rows['Golongan'];
	            $hasil[$i]['TempatLahir'] = $rows['TempatLahir'];
	            $hasil[$i]['TanggalLahir'] = $rows['TanggalLahir'];
	            $hasil[$i]['S1'] = $rows['S1'];
	            $hasil[$i]['S2'] = $rows['S2'];
	            $hasil[$i]['S3'] = $rows['S3'];
	            $hasil[$i]['dosenActive'] = $rows['dosenActive'];
	            $hasil[$i]['NIDN'] = $rows['NIDN'];
	            $i = $i+1;
			}

		}		
		
		$data['dosenID'] = $id;
		$data['record'] = $hasil;
		$data['stats'] = $list;
		$data['periodes'] = $periodes;
		$data['nilai'] = $nilai;
		$data['jabatan'] = $jabatan;
		$data['tblnilai'] = $this->DBDosen->get_nilai_by_id($id);
		$this->template->set('title', 'Dosen - Edit');
        $this->template->load('default_layout', 'contents' , 'dosenedit', $data); 
	}

	function fetch_dosen() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBDosen"); 

			$fetch_data = $this->DBDosen->make_datatables();  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$sub_array = array();  
				$sub_array[] = $row->dosenID;  
				$sub_array[] = $row->NIDN;
				$sub_array[] = $row->Nama; 
				$sub_array[] = $row->dosenStatus;  
				$sub_array[] = $row->Fakultas;  
				$sub_array[] = $row->Jurusan;  
				$sub_array[] = $row->Golongan;  
				$sub_array[] = $row->Telp;   
				$sub_array[] = $row->dosenActive;  
				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBDosen->get_all_data(),  
				"recordsFiltered"     =>     $this->DBDosen->get_filtered_data(),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}

	function savedosen($id =0) {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		
		$nm = $this->input->post('Nama');
		if ($this->input->post('Nama') == '') {
			$output = array("stt"  => 'error: Nama Dosen belum diisi.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		if(1 === preg_match('~[0-9]~', $nm)){
			$output = array("stt"  => 'error: Nama Dosen tidak valid. Angka tidak diperbolehkan.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		$phn = $this->input->post('Telp');
		if(!is_numeric($phn)) {
			$output = array("stt"  => 'error: Nomor telepon tidak valid. Hanya Angka yang diperbolehkan..'); 
			$recValid =FALSE;
			goto oncheck;
		}
		if(strlen($phn) > 16) {
			$output = array("stt"  => 'error: Nomor telepon tidak valid. Hanya Angka yang diperbolehkan..'); 
			$recValid =FALSE;
			goto oncheck;
		}
		$eml = $this->input->post('Email');
		if (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {
		  $output = array("stt"  => 'error: Format E-Mail tidak valid.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		//NIDN Validation
		if($this->input->post('NIDN') == '') {
			$output = array("stt"  => 'error: Nomor NIDN belum dimasukkan.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		$ndn = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID<>'.$id.' AND NIDN="'.$this->input->post('NIDN').'"');
		if($ndn !== '') {
			$output = array("stt"  => 'error: Nomor NIDN sudah terdaftar untuk dosen '.$ndn.'. Silahkan masukkan nomor yang lain.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {
            	$recValid = TRUE;
            	$i=0;
            	$batch = array();

                if($id == 0) {
                	//INSERT   

                	$data_sre = array('Nama' => $this->input->post('Nama'),
                		'Jabatan' => $this->input->post('Jabatan'),
                		'dosenStatus' => $this->input->post('dosenStatus'),
                        'Alamat' => $this->input->post('Alamat'),
                        'Telp' => $this->input->post('Telp'),
                        'Email' => $this->input->post('Email'),
                        'Sertifikat' => $this->input->post('Sertifikat'),
                        'TempatLahir' => $this->input->post('TempatLahir'),
                        'TanggalLahir' => date('Y-m-d', strtotime($this->input->post('TanggalLahir'))),
                        'PT' => $this->input->post('PT'),
                        'AlamatPT' => $this->input->post('AlamatPT'),
                        'Fakultas' => $this->input->post('Fakultas'),
                        'Jurusan' => $this->input->post('Jurusan'),
                        'Golongan' => $this->input->post('Golongan'),
                        'S1' => $this->input->post('S1'),
                        'S2' => $this->input->post('S2'),
                        'S3' => $this->input->post('S3'),
                        'dosenActive' => $this->input->post('dosenActive'),
                        'NIDN' => $this->input->post('NIDN'));

                	$id = $this->DBDosen->insertdosen($data_sre);
                	$i=0;
	                if($id > 0) {	                	
	                	$response_array['stt'] = $id;  
	                } else { 
	                	$response_array['stt'] = 'error: An error occured. Please try again in a few minutes.';  
	                }

	                echo json_encode($response_array);
                	
                } else {
                	//UPDATE
                	$data_sre = array('Nama' => $this->input->post('Nama'),
                		'Jabatan' => $this->input->post('Jabatan'),
                		'dosenStatus' => $this->input->post('dosenStatus'),
                        'Alamat' => $this->input->post('Alamat'),
                        'Telp' => $this->input->post('Telp'),
                        'Email' => $this->input->post('Email'),
                        'Sertifikat' => $this->input->post('Sertifikat'),
                        'TempatLahir' => $this->input->post('TempatLahir'),
                        'TanggalLahir' => date('Y-m-d', strtotime($this->input->post('TanggalLahir'))),
                        'PT' => $this->input->post('PT'),
                        'AlamatPT' => $this->input->post('AlamatPT'),
                        'Fakultas' => $this->input->post('Fakultas'),
                        'Jurusan' => $this->input->post('Jurusan'),
                        'Golongan' => $this->input->post('Golongan'),
                        'S1' => $this->input->post('S1'),
                        'S2' => $this->input->post('S2'),
                        'S3' => $this->input->post('S3'),
                        'dosenActive' => $this->input->post('dosenActive'),
                        'NIDN' => $this->input->post('NIDN'));

                  	$ret = $this->DBDosen->updatedosen($id,$data_sre);
	                if($ret > 0) {
	                	$response_array['stt'] =$id;

	                } else { 
	                	$response_array['stt'] = 'error: An error occured. Please try again in few minutes.';  
	                }
	                echo json_encode($response_array);             	
            	}
	        }
		}
   
	}
}
