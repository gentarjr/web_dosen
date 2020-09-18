<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
        $this->load->model('DBKehadiran');
        $this->load->model('DBJurusan');
        $this->load->model('DBMataKuliah');
        $this->load->model('DBNilai');
        $this->load->model('DBPenelitian');
        $this->load->model('DBPengabdian');
        $this->load->model('DBSap');
        $this->load->model('DBPencapaian');

        //WARNING ENABLE THIS PROFILE WILL INCLUDED ON RETURN MESSAGE
        //$this->output->enable_profiler(TRUE);
    }
	public function index()
	{
		redirect(base_url().''); 
		/*if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    if ($this->session->userdata('userType') !== '2')  //NOT TU Staff
  	    {
  	    	if(!$this->session->userdata('isAdmin')) {
  	    		redirect(base_url().'');  
  	    	}  	                        
  	    }
		$data = array('welcome' => 'Selamat datang di website kami');
		$this->template->set('title', 'Data Dosen');
        $this->template->load('default_layout', 'contents' , 'dosen', $data); */
		
	}

  function pencapaian() {
    if ($this->session->userdata('logged_in') == FALSE)    
      {
          redirect(base_url().'');                  
      }

      $oklaporan = FALSE;
      if (!$this->session->userdata('isAdmin')) {
          if ($this->session->userdata('userType') == '3') {
              $oklaporan = TRUE;
          }
      } else if ($this->session->userdata('isAdmin')) {
          $oklaporan = TRUE;
      }
      $utype = $this->session->userType;
      switch ($utype) {
        case 4:
        case 5:
          $oklaporan = TRUE;
          break;
      }

      if(!$oklaporan) {
        redirect(base_url().'');  
      }

      $period = $this->input->post('period');

      $periode = $this->DBPencapaian->get_period();
      if(!$_POST) {
          $data = array('welcome' => 'Selamat datang di website kami',
            'periode' => $periode,
            'period' => $period);
          $this->template->set('title', 'Laporan Pencapaian');
          $this->template->load('default_layout', 'contents' , 'rptpencapaian', $data);
      } else {
          $record = $this->DBPencapaian->get_record($period);
          $data = array('welcome' => 'Selamat datang di website kami',
            'periode' => $periode,
            'period' => $period,
            'ispost' => 1,
            'record' => $record);
          $this->template->set('title', 'Laporan Pencapaian');
          $this->template->load('default_layout', 'contents' , 'rptpencapaian', $data);
      }
       
  }

  public function cetakpencapaian($period, $xl=0) {
      $record = $this->DBPencapaian->get_record($period);
      $data = array('welcome' => 'Selamat datang di website kami',
        'period' => $period,
        'record' => $record,
        'namafile' => 'Pencapaian-' . date('Y_m_d_H_i_s'));
      $this->template->set('title', 'Laporan Pencapaian');
      if($xl == 0) {
        $this->load->library('pdf');
        $this->pdf->load_view('rptpencapaianpdf', $data, true);
        $output = 'Pencapaian-' . date('Y_m_d_H_i_s') . '_.pdf';
        $this->pdf->Output("$output","I");
      } else {

        $this->load->view('rptpencapaianxl',$data);
      }
  }

	public function monitoring() {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }

  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }
  	    $periode = $this->DBKehadiran->get_period();
	  	$dosen= $this->DBDosen->get_all_dosen_nidn();
	  	$jurusan = $this->DBJurusan->get_record();
	  	$mata = $this->DBMataKuliah->get_record();

  	    if(!$_POST) {
  	    	
    			$data = array('welcome' => 'Selamat datang di website kami',
    				'periode' => $periode,
    				'dosen' => $dosen,
    				'jurusan' => $jurusan,
    				'mata' => $mata,
    				'period' => 0,
    				'dosenID' => 0,
    				'mataID' => 0,
    				'jurusanID' => 0,
            'isnew' => TRUE);
    			$this->template->set('title', 'Data Laporan');
	        $this->template->load('default_layout', 'contents' , 'monitoring', $data); 
  	    } else {

  	    	$period = $this->input->post('period');
  	    	$dosenID = $this->input->post('dosenID');
  	    	$jurusanID = $this->input->post('jurusanID');
  	    	$mataID = $this->input->post('mataID');

  	    	$nidn = $this->PublicModel->dLookUp('NIDN','tbldosen','dosenID='.$dosenID);
  	    	$nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);
  	    	$jurusanNama = $this->PublicModel->dLookUp('jurusanNama','tbljurusan','jurusanID='.$jurusanID);
  	    	$mataKuliah = $this->PublicModel->dLookUp('mataKuliah','tblmatakuliah','mataID='.$mataID);

  	    	$nilai = 'TIDAK';
  	    	//Count nilai
  	    	$nl = $this->DBNilai->get_totalnilai($period, $dosenID, $jurusanID, $mataID);
  	    	if($nl > 0) {
  	    		$nilai = 'OK';
  	    	}

  	    	$kehadiran = '100';
  	    	//Get total Hadir in period
  	    	//((8 - 0) * 100) / (16 - 0)
  	    	$n = $this->DBKehadiran->get_totalhadir($period, $dosenID, $jurusanID, $mataID);
  	    	$n = (($n - 0) * 100) / (16 - 0);	//16x absensi dalam 1 periode
  	    	$kehadiran = $n;

  	    	$penelitian = 'TIDAK';
  	    	$pen = $this->DBPenelitian->get_totalpenelitian($period, $dosenID);
  	    	if($pen > 0) {
  	    		$penelitian = 'OK';
  	    	}

  	    	$pengabdian = 'TIDAK';
  	    	$pgb = $this->DBPengabdian->get_totalpengabdian($period, $dosenID);
  	    	if($pgb > 0) {
  	    		$pengabdian = 'OK';
  	    	}

          $sap = 'TIDAK';
          $sapMata = $this->DBSap->get_totalsap($period, $dosenID, $mataID);
          $sapTotal = $this->DBSap->get_totalsap($period, $dosenID, 0);
          $ns = 0;
          if($sapTotal <> 0) {
               $ns =  (($sapMata - 0) * 100) / ($sapTotal - 0);
          }
         

          if($ns == 100) {
            $sap = 'OK';
          }

          $nnilai = 0;
          $nhadir = 0;
          $nteliti = 0;
          $npgb = 0;
          $nsap = 0;

          if($nilai == 'OK') {
            $nnilai = 20;
          }

          $perchadir = (($kehadiran - 0) * 100) / (20 - 0);
          $nhadir = $perchadir;

          if($penelitian == 'OK') {
            $nteliti = 20;
          }
          if($pengabdian == 'OK') {
            $npgb = 20;
          }
          if($sap == 'OK') {
            $nsap = 20;
          }

          $ttl = $nnilai + $nhadir + $nteliti + $npgb + $nsap;
          $nilaiakhir = 'C';

          switch (true) {
            case $ttl < 75:
              $nilaiakhir = 'C';
              break;
            case $ttl >= 75:
              $nilaiakhir = 'B';
              break;
            case $ttl < 86:
              $nilaiakhir = 'B';
              break;
            case $ttl >= 86:
              $nilaiakhir = 'A';
              break;
          }

          $retstr = $nnilai.'+'.$nhadir.' ('.$kehadiran.') +'.$nteliti.'+'.$npgb;

  	    	$onyear = substr($period, 0, 4);
  	    	$onmonth = substr($period, 4, 2);
  	    	$tahunajar = '';
  	    	$tahun1 = '';
  	    	$tahun2 = '';
  	    	switch ($onmonth) {
  	    		case '01':
  	    		case '02':
  	    		case '03':
  	    		case '04':
  	    		case '05':
  	    		case '06':
  	    			$tahun1 = (int)$onyear - 1;
  	    			$tahun2 = $onyear;
  	    			break;
  	    		default:
  	    			$tahun1 = $onyear;
  	    			$tahun2 = (int)$onyear+1;
  	    			break;
  	    	}
  	    	
  	    	$tahunajar = $tahun1.'/'.$tahun2;

			$data = array('welcome' => 'Selamat datang di website kami',
				'periode' => $periode,
				'dosen' => $dosen,
				'jurusan' => $jurusan,
				'mata' => $mata,
				'nidn' => $nidn,
				'nama' => $nama,
				'jurusanNama' => $jurusanNama,
				'ispost' => 1,
				'mataKuliah' => $mataKuliah,
				'nilai' => $nilai,
				'kehadiran' => $kehadiran,
				'penelitian' => $penelitian,
				'pengabdian' => $pengabdian,
				'tahunajar' => $tahunajar,
				'period' => $period,
				'dosenID' => $dosenID,
				'mataID' => $mataID,
				'jurusanID' => $jurusanID,
        'sap' => $sap,
        'nilaiakhir' => $nilaiakhir,
        'isnew' => FALSE);

			$this->template->set('title', 'Data Laporan');
	        $this->template->load('default_layout', 'contents' , 'monitoring', $data); 
  	    }
  	    
	}

	function detailnilai($periode, $dosenID, $mataID, $jurusanID, $xl =0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }
		$Nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);
		$jurusanNama = $this->PublicModel->dLookUp('jurusanNama','tbljurusan','jurusanID='.$jurusanID);
		$mataKuliah = $this->PublicModel->dLookUp('mataKuliah','tblmatakuliah','mataID='.$mataID);

		$onperiod = substr($periode, 0, 4).'-'.substr($periode, 4, 2);


		$data = array('welcome' => 'Welcome to our website',
			'nilai' => $this->DBNilai->get_detail($periode, $dosenID, $mataID, $jurusanID),
			'Nama' => $Nama,
			'jurusanNama' => $jurusanNama,
			'mataKuliah' => $mataKuliah,
			'periode' => $onperiod,
			'namafile' => str_replace(" ", "", $Nama).'-'.date('Y_m_d_H_i_s'));

		if($xl == 0) {
			$this->load->library('pdf');
			$this->pdf->load_view('nilaipdf', $data, true);
			$output = $Nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
			$this->pdf->Output("$output","I");
		} else {

			$this->load->view('nilaixl',$data);
		}

		//$this->template->set('title', 'Detail Nilai');
        //$this->template->load('default_layout', 'contents' , 'nilaid', $data);
	}

	function detailhadir($periode, $dosenID, $mataID, $jurusanID, $xl =0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }
		$Nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);
		$jurusanNama = $this->PublicModel->dLookUp('jurusanNama','tbljurusan','jurusanID='.$jurusanID);
		$mataKuliah = $this->PublicModel->dLookUp('mataKuliah','tblmatakuliah','mataID='.$mataID);

		$onperiod = substr($periode, 0, 4).'-'.substr($periode, 4, 2);


		$data = array('welcome' => 'Welcome to our website',
			'kehadiran' => $this->DBKehadiran->get_detail($periode, $dosenID, $mataID, $jurusanID),
			'Nama' => $Nama,
			'jurusanNama' => $jurusanNama,
			'mataKuliah' => $mataKuliah,
			'periode' => $onperiod,
			'namafile' => str_replace(" ", "", $Nama).'-'.date('Y_m_d_H_i_s'));

		if($xl == 0) {
			$this->load->library('pdf');
			$this->pdf->load_view('kehadiranpdf', $data, true);
			$output = $Nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
			$this->pdf->Output("$output","I");
		} else {

			$this->load->view('kehadiranxl',$data);
		}

		//$this->template->set('title', 'Detail Kehadiran');
        //$this->template->load('default_layout', 'contents' , 'kehadirand', $data);
	}
	function detailpenelitian($periode, $dosenID, $xl=0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }
		$Nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);

		$onperiod = substr($periode, 0, 4).'-'.substr($periode, 4, 2);


		$data = array('welcome' => 'Welcome to our website',
			'penelitian' => $this->DBPenelitian->get_detail($periode, $dosenID),
			'Nama' => $Nama,
			'periode' => $onperiod,
			'namafile' => str_replace(" ", "", $Nama).'-'.date('Y_m_d_H_i_s'));

		if($xl == 0) {
			$this->load->library('pdf');
			$this->pdf->load_view('penelitianpdf', $data, true);
			$output = $Nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
			$this->pdf->Output("$output","I");
		} else {

			$this->load->view('penelitianxl',$data);
		}

		//$this->template->set('title', 'Detail penelitian');
        //$this->template->load('default_layout', 'contents' , 'penelitiand', $data);
	}
	function detailpengabdian($periode, $dosenID, $xl=0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }
		$Nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);

		$onperiod = substr($periode, 0, 4).'-'.substr($periode, 4, 2);


		$data = array('welcome' => 'Welcome to our website',
			'pengabdian' => $this->DBPengabdian->get_detail($periode, $dosenID),
			'Nama' => $Nama,
			'periode' => $onperiod,
			'namafile' => str_replace(" ", "", $Nama).'-'.date('Y_m_d_H_i_s'));

		if($xl == 0) {
			$this->load->library('pdf');
			$this->pdf->load_view('pengabdianpdf', $data, true);
			$output = $Nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
			$this->pdf->Output("$output","I");
		} else {

			$this->load->view('pengabdianxl',$data);
		}

		//$this->template->set('title', 'Detail Pengabdian');
        //$this->template->load('default_layout', 'contents' , 'pengabdiand', $data);
	}

  function detailsap($periode, $dosenID, $mataID, $xl=0) {
    if ($this->session->userdata('logged_in') == FALSE)    
        {
            redirect(base_url().'');                  
        }
        $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

        if(!$oklaporan) {
          redirect(base_url().'');  
        }
    $Nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);
    $mataKuliah = $this->PublicModel->dLookUp('mataKuliah','tblmatakuliah','mataID='.$mataID);

    $onperiod = substr($periode, 0, 4).'-'.substr($periode, 4, 2);

    $sapMata = $this->DBSap->get_totalsap($periode, $dosenID, $mataID);
    $sapTotal = $this->DBSap->get_totalsap($periode, $dosenID, 0);
    $ns =  (($sapMata - 0) * 100) / ($sapTotal - 0);

    $data = array('welcome' => 'Welcome to our website',
      'sap' => $this->DBSap->get_detail($periode, $dosenID, $mataID),
      'Nama' => $Nama,
      'mataKuliah' => $mataKuliah,
      'periode' => $onperiod,
      'total' => $ns,
      'namafile' => str_replace(" ", "", $Nama).'-'.date('Y_m_d_H_i_s'));

    if($xl == 0) {
      $this->load->library('pdf');
      $this->pdf->load_view('sappdf', $data, true);
      $output = $Nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
      $this->pdf->Output("$output","I");
    } else {

      $this->load->view('sapxl',$data);
    }

    //$this->template->set('title', 'Detail Pengabdian');
        //$this->template->load('default_layout', 'contents' , 'pengabdiand', $data);
  }

	function cetak($periode, $dosenID, $mataID, $jurusanID, $xl = 0) {
		if ($this->session->userdata('logged_in') == FALSE)    
  	    {
  	        redirect(base_url().'');                  
  	    }
  	    $oklaporan = FALSE;
        if (!$this->session->userdata('isAdmin')) {
            if ($this->session->userdata('userType') == '3') {
                $oklaporan = TRUE;
            }
        } else if ($this->session->userdata('isAdmin')) {
            $oklaporan = TRUE;
        }
        $utype = $this->session->userType;
        switch ($utype) {
          case 4:
          case 5:
            $oklaporan = TRUE;
            break;
        }

  	    if(!$oklaporan) {
  	    	redirect(base_url().'');  
  	    }

  	    $period = $periode;

    	$nidn = $this->PublicModel->dLookUp('NIDN','tbldosen','dosenID='.$dosenID);
    	$nama = $this->PublicModel->dLookUp('Nama','tbldosen','dosenID='.$dosenID);
    	$jurusanNama = $this->PublicModel->dLookUp('jurusanNama','tbljurusan','jurusanID='.$jurusanID);
    	$mataKuliah = $this->PublicModel->dLookUp('mataKuliah','tblmatakuliah','mataID='.$mataID);

    	$nilai = 'TIDAK';
    	//Count nilai
    	$nl = $this->DBNilai->get_totalnilai($period, $dosenID, $jurusanID, $mataID);
    	if($nl > 0) {
    		$nilai = 'OK';
    	}

    	$kehadiran = '100';
    	//Get total Hadir in period
    	//((8 - 0) * 100) / (16 - 0)
    	$n = $this->DBKehadiran->get_totalhadir($period, $dosenID, $jurusanID, $mataID);
    	$n = (($n - 0) * 100) / (16 - 0);	//16x absensi dalam 1 periode
    	$kehadiran = $n;

    	$penelitian = 'TIDAK';
    	$pen = $this->DBPenelitian->get_totalpenelitian($period, $dosenID);
    	if($pen > 0) {
    		$penelitian = 'OK';
    	}

    	$pengabdian = 'TIDAK';
    	$pgb = $this->DBPengabdian->get_totalpengabdian($period, $dosenID);
    	if($pgb > 0) {
    		$pengabdian = 'OK';
    	}
      
      $sap = 'TIDAK';
      $sapMata = $this->DBSap->get_totalsap($period, $dosenID, $mataID);
      $sapTotal = $this->DBSap->get_totalsap($period, $dosenID, 0);
      $ns =  (($sapMata - 0) * 100) / ($sapTotal - 0);

      if($ns == 100) {
        $sap = 'OK';
      }

      $nnilai = 0;
      $nhadir = 0;
      $nteliti = 0;
      $npgb = 0;
      $nsap = 0;

      if($nilai == 'OK') {
        $nnilai = 20;
      }

      $perchadir = (($kehadiran - 0) * 100) / (20 - 0);
      $nhadir = $perchadir;

      if($penelitian == 'OK') {
        $nteliti = 20;
      }
      if($pengabdian == 'OK') {
        $npgb = 20;
      }
      if($sap == 'OK') {
        $nsap = 20;
      }

      $ttl = $nnilai + $nhadir + $nteliti + $npgb + $nsap;
      $nilaiakhir = 'C';

      switch (true) {
        case $ttl < 75:
          $nilaiakhir = 'C';
          break;
        case $ttl >= 75:
          $nilaiakhir = 'B';
          break;
        case $ttl < 86:
          $nilaiakhir = 'B';
          break;
        case $ttl >= 86:
          $nilaiakhir = 'A';
          break;
      }

    	$onyear = substr($period, 0, 4);
    	$onmonth = substr($period, 4, 2);
    	$tahunajar = '';
    	$tahun1 = '';
    	$tahun2 = '';
    	switch ($onmonth) {
    		case '01':
    		case '02':
    		case '03':
    		case '04':
    		case '05':
    		case '06':
    			$tahun1 = (int)$onyear - 1;
    			$tahun2 = $onyear;
    			break;
    		default:
    			$tahun1 = $onyear;
    			$tahun2 = (int)$onyear+1;
    			break;
    	}
    	
    	$tahunajar = $tahun1.'/'.$tahun2;

		$data = array('welcome' => 'Selamat datang di website kami',
			'nidn' => $nidn,
			'nama' => $nama,
			'jurusanNama' => $jurusanNama,
			'ispost' => 1,
			'mataKuliah' => $mataKuliah,
			'nilai' => $nilai,
			'kehadiran' => $kehadiran,
			'penelitian' => $penelitian,
			'pengabdian' => $pengabdian,
			'tahunajar' => $tahunajar,
      'sap' => $sap,
      'nilaiakhir' => $nilaiakhir,
			'namafile' => str_replace(" ", "", $nama).'-' . date('Y_m_d_H_i_s') . '_');

		if($xl == 0) {
			$this->load->library('pdf');
			$this->pdf->load_view('cetak', $data, true);
			$output = $nama.'-' . date('Y_m_d_H_i_s') . '_.pdf';
			$this->pdf->Output("$output","I");
		} else {

			$this->load->view('cetakxl',$data);
		}
		

		//$this->template->set('title', 'Data Laporan');
	    //$this->template->load('default_layout', 'contents' , 'cetak', $data);

	}
}
