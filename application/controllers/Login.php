<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		
		if ($this->session->userdata('logged_in') == TRUE)     //If user already sign in then don't need to show the login page
  	    {
  	        redirect(base_url().'home');                       //just redirect to home page
  	    }
  	    //$data['test'] = $this->db->hotel_database;
  	    //$this->load->view('login',$data);
  	    $this->load->view('login');
		
	}
	function process_login()
	{

	   //Prevent Injection...
	    $username = htmlentities(trim(strip_tags(stripcslashes($this->input->post('login')))));     //Get entered username variable  
	    $password  = htmlentities(trim(strip_tags(stripcslashes($this->input->post('pass')))));    //Get entered password variable
        
        $hash=md5($password);                       //Hashing the password
                
        $this->db->where('username', $username);
        $this->db->where('webpassword', $hash);

        $query = $this->db->get('tbluser');            //Query the database for current user

        //$data['log'] =$query->num_rows() .'/'. $this->db->last_query();
        //$this->load->view('log', $data);

        if ($query->num_rows() > 0) {               //User and password is correct
            $i=0;
            foreach ($query->result() as $row) {    //Get the record and ready to store into session
                $userid = $row->userid;
                $name = $row->fullname;
                $dosenID = $row->dosenID;
                $userType = $row->userType;
                $isAdmin = $row->isAdmin;
                $lastlogin = $row->lastLogin;
                $stat = $row->userActive;
                $pwd = $row->webpassword;   
                               
            }            
            
                if ($stat == 0) {
                    $this->session->set_flashdata('msg', 'Account blocked. Please contact Administrator.');
                    redirect(base_url().'login');                
                } elseif ($pwd == $hash) {
                    //================== SESSION NEED TO BE ENCRYPTED FOR LIVE SERVER. ==========================
                    $newdata = array(
	                    'userid' => $userid,
	                    'name' => $name,
                        'dosenID' => $dosenID,
                        'userType' => $userType,
                        'isAdmin' => $isAdmin,
	                    'logged_in' => TRUE
                    );                                  //User data recorded in an array

                    
                    //Save user data into session
                    $this->session->set_userdata($newdata);

                    //Update last login
                    $this->DBUser->updateLastLogin();
                    
                    //redirect to index page
                    redirect('');
                }
        }
	    else 
	    {   
            $this->session->set_flashdata('msg', 'Incorrect Username or Password. Please try again.. ');
            redirect(base_url());
	    }
        
	}
	function logout()
	{
	   //destroy all session and redirect user to login page.
	    $this->session->sess_destroy();
	    redirect(base_url().'#');
	}
}
