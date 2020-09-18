<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('DBUser');
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
  	    $tipe = array(
		  array('tipe'=>'1','tipenama'=>'Dosen'),
		  array('tipe'=>'2','tipenama'=>'TU'),
		  array('tipe'=>'3','tipenama'=>'Penjamin Mutu'),
		  array('tipe'=>'4','tipenama'=>'Dekan'),
		  array('tipe'=>'5','tipenama'=>'Kaprodi'),
		  array('tipe'=>'6','tipenama'=>'UPT')
		);

  	    $dosen= $this->DBDosen->get_all_dosen_nidn();

  	    array_push($dosen,array('dosenID'=>'0','Nama'=>'N/A','NamaDosen'=>'N/A'));
  	    sort($dosen);

		$data = array('welcome' => 'Welcome to our website',
			'tipe' => $tipe, 'dosen' => $dosen);
		$this->template->set('title', 'Data User');
        $this->template->load('default_layout', 'contents' , 'user', $data); 
		
	}
	function fetch_user() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	    	$output = array(  
				"msg"                    =>     'error'
			);  
  	        echo json_encode($output);                
  	    } else {
  	    	$this->load->model("DBUser"); 
			$fetch_data = $this->DBUser->make_datatables();  
			$data = array();  
			foreach($fetch_data as $row)  
			{  
				$ustype ='Ya';
				if($row->userActive==1) {
				} else{
					$ustype ='Tidak';
				}
				$dsid = $row->dosenID;
				if(!isset($dsid)) {
					$dsid = 0;
				}
				$sub_array = array();  
				$sub_array[] = $row->userid;  
				$sub_array[] = $row->username;  
				$sub_array[] = $row->fullname;				 
				$sub_array[] = $row->userTypeName; 	
				$sub_array[] = $row->Nama;			  
				$sub_array[] = $ustype;
				$sub_array[] = $row->lastLogin; 
				$sub_array[] = $row->userType;  
				$sub_array[] = $dsid; 
				$sub_array[] = $row->userActive;  

				$data[] = $sub_array;  
			}  
			$s = 0; 
			if(isset($_POST["draw"])) {
				$s = intval($_POST["draw"]);	
			}
			
			$output = array(  
				"draw"                    =>     $s,  
				"recordsTotal"          =>      $this->DBUser->get_all_data(),  
				"recordsFiltered"     =>     $this->DBUser->get_filtered_data(),  
				"data"                    =>     $data
			);  
			echo json_encode($output); 
  	    }
		 
	}
	function deleteuser() {
		$id = $this->input->post('userid');
		if($id !== '0') {
			$v = $this->DBUser->delete_user($id);

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
	function updateuser() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}
		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {				
				
                if ( !$recValid) {
                	echo json_encode($output);
                } else {                	
                	$recValid = TRUE;
					$pass1 = $this->input->post('userpass1');
					$pass2 = $this->input->post('userpass2');
					$fullname = $this->input->post('userfullname');

					//Password validation
					if($pass1 !== '') {
						if($pass1 !== $pass2) {
							$output = array("stt"  => 'error: Password dan Ulangi Password tidak sama.'); 
							goto lastLine;
						}
						if(strlen($pass1) < 6) {
							$output = array("stt"  => 'error: Jumlah karakter Password harus lebih dari enam karakter.'); 
							goto lastLine;
						}
						
					}
					if($fullname == '') {
						$output = array("stt"  => 'error: Nama lengkap tidak boleh kosong.'); 
						goto lastLine;
					}


					//$userid, $username, $fullname, $dosenID, $usetype, $useractive, $pass1, $pass2
					$v = $this->DBUser->update_userprofile($fullname, $pass1);

					if(is_numeric($v)) {
						$this->session->set_userdata('name' , $fullname);
						$output = array("stt"  => $v); 
					} else {
						$output = array("stt"  => 'error: An error occured. Please try again later.'); 
					}
					lastLine:
					echo json_encode($output);
                }
				
				
			} else{
				$output = array("stt"  => 'error: Not Posted.');
				echo json_encode($output);
			}
		}
	}
	function saveuser() {
		$recValid = TRUE;
		$output = array();
		if ($this->session->userdata('logged_in') == FALSE) {
			$output = array("stt"  => 'error: You are not logged in.'); 
			$recValid =FALSE;
			goto oncheck;
		}

		oncheck:
		if(!$recValid) {
			echo json_encode($output);
		} else {
			if($_POST) {				
				
                if ( !$recValid) {
                	echo json_encode($output);
                } else {                	
                	$recValid = TRUE;
					$id = $this->input->post('userid');
					$pass1 = $this->input->post('pass1');
					$pass2 = $this->input->post('pass2');
					$username = $this->input->post('loginname');
					$fullname = $this->input->post('fullname');

					if(strlen($username) < 6) {
						$output = array("stt"  => 'error: Jumlah karakter Login harus lebih besar dari enam karakter.'); 
						goto lastLine;
					}

					if($id ==0 ) {
						//Password validation
						if($pass1 !== $pass2) {
							$output = array("stt"  => 'error: Password dan Ulangi Password tidak sama.'); 
							goto lastLine;
						}

						if(strlen($pass1) < 6) {
							$output = array("stt"  => 'error: Jumlah karakter Password harus lebih besar dari enam karakter.'); 
							goto lastLine;
						}
						//Username
						if($fullname == '') {
							$output = array("stt"  => 'error: Nama lengkap tidak boleh kosong.'); 
							goto lastLine;
						}
						if($username == '') {
							$output = array("stt"  => 'error: Jumlah karakter Login : '.$username.' harus lebih besar dari tiga karakter.'); 
							goto lastLine;
						}
						if(strlen($username) < 3) {
							$output = array("stt"  => 'error: Jumlah karakter Login : '.$username.' harus lebih besar dari tiga karakter.'); 
							goto lastLine;
						}

						$uname = $this->PublicModel->dLookUp('username','tbluser','username="'.$username.'"');
						if($uname !== '') {
							$output = array("stt"  => 'error: Nama login '.$username.' sudah ada. Silahkan masukkan nama login yang lain.'); 
							goto lastLine;
						}
					} else {
						$uname = $this->PublicModel->dLookUp('username','tbluser','username="'.$username.'" AND userid<>'.$id);
						if($uname !== '') {
							$output = array("stt"  => 'error: Nama login '.$username.' sudah ada. Silahkan masukkan nama login yang lain.'); 
							goto lastLine;
						}

						if($pass1 !== '') {
							if($pass1 !== $pass2) {
								$output = array("stt"  => 'error: Password dan Ulangi Password tidak sama.'); 
								goto lastLine;
							}
							if(strlen($pass1) < 3) {
								$output = array("stt"  => 'error: Jumlah karakter Password harus lebih dari tiga karakter.'); 
								goto lastLine;
							}
							
						}
					}
					//$userid, $username, $fullname, $dosenID, $usetype, $useractive, $pass1, $pass2
					$v = $this->DBUser->update_user($id, 
						$username,
						$fullname,
						$this->input->post('dosenid'),
						$this->input->post('usertype'),
						$this->input->post('isactive'),
						$this->input->post('pass1'),
						$this->input->post('pass2'));

					if(is_numeric($v)) {
						$output = array("stt"  => $v); 
					} else {
						$output = array("stt"  => 'error: An error occured. Please try again later.'); 
					}
					lastLine:
					echo json_encode($output);
                }
				
				
			} else{
				$output = array("stt"  => 'error: Not Posted.');
				echo json_encode($output);
			}
		}
	}
	
	
}
