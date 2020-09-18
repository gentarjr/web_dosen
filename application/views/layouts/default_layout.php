<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo $title;?> | Data Dosen</title>
  <link rel="shortcut icon" href="<?php echo site_url();?>assets/dist/img/favicon.ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/datatables.net/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/datatables.net/css/rowReorder.dataTables.min.css">

  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
  	tfoot {
	    display: table-header-group;
	}
	.modal {
	  overflow-y:auto;
	}
  </style>

  <!-- jQuery 3 -->
<script src="<?php echo site_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo site_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo site_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo site_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo site_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- DataTables -->
<script src="<?php echo site_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url();?>assets/bower_components/datatables.net/js/dataTables.rowReorder.min.js"></script>
<script src="<?php echo site_url();?>assets/bower_components/datatables.net/js/dataTables.responsive.min.js"></script>
<script src="<?php echo site_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo site_url();?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo site_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo site_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- SlimScroll -->
<script src="<?php echo site_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo site_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo site_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url();?>assets/dist/js/adminlte.min.js"></script>
<link rel="stylesheet"
          type="text/css"
          href="<?php echo site_url();?>assets/dist/css/jquery-confirm.min.css"/>
    <script type="text/javascript"
            src="<?php echo site_url();?>assets/dist/js/jquery-confirm.min.js"></script>
</head>
<body class="sidebar-mini sidebar-collapse fixed skin-blue-light">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url();?>home" class="logo visible-lg visible-md visible-sm">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>D</b>o <b>Se</b>n</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
    </nav>
  </header>
  
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel-->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo site_url();?>assets/dist/img/user9-160x160.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name');?></p>
          <a href="#" onclick="showuseredit()"><i class="fa fa-circle text-success"></i> Profil User</a>
        </div>
      </div> 
      <!-- search form
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
        $okmaster = FALSE;
        $utype1 = $this->session->userType;
        switch ($utype1) {
          case 2:
            $okmaster = TRUE;
            break;
        }
        if ($this->session->userdata('isAdmin')) {
          $okmaster = TRUE;
        }
        if($okmaster) {
        ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (!$this->session->userdata('isAdmin')) { ?>
              <?php if ($this->session->userdata('userType') == '2') { ?>
                <li><a href="<?php echo site_url();?>dosen"><i class="fa fa-circle-o"></i> Data Dosen</a></li>
              <?php }?> 
            <?php } else { ?>
              <li><a href="<?php echo site_url();?>user"><i class="fa fa-circle-o"></i> Data User</a></li>  
              <li><a href="<?php echo site_url();?>dosen"><i class="fa fa-circle-o"></i> Data Dosen</a></li>            
              <li><a href="<?php echo site_url();?>matakuliah"><i class="fa fa-circle-o"></i> Data Mata Kuliah</a></li> 
              <li><a href="<?php echo site_url();?>jurusan"><i class="fa fa-circle-o"></i> Data Jurusan</a></li>             
              <li><a href="<?php echo site_url();?>jadwal"><i class="fa fa-circle-o"></i> Data Jadwal</a></li> 

            <?php } ?>
          </ul>
        </li>
        <?php } ?>


        <?php
        $okinput = FALSE;
        $utype2 = $this->session->userType;
        switch ($utype2) {
          case 1:
          case 3:
          case 6:
            $okinput = TRUE;
            break;
        }
        if ($this->session->userdata('isAdmin')) {
          $okinput = TRUE;
        }
        if($okinput) {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Input Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php if (!$this->session->userdata('isAdmin')) { ?>
              <?php if ($this->session->userdata('userType') == '6') { ?>
                <li><a href="<?php echo site_url();?>kehadiran"><i class="fa fa-circle-o"></i> Data Kehadiran</a></li> 
                <li><a href="<?php echo site_url();?>sap"><i class="fa fa-circle-o"></i> Data Kesesuaian SAP</a></li>  
              <?php } elseif ($this->session->userdata('userType') == '1') { ?>
                <li><a href="<?php echo site_url();?>penelitian"><i class="fa fa-circle-o"></i> Data Penelitian</a></li>
                <li><a href="<?php echo site_url();?>pengabdian"><i class="fa fa-circle-o"></i> Data Pengabdian</a></li>
                <li><a href="<?php echo site_url();?>nilai"><i class="fa fa-circle-o"></i> Data Nilai</a></li>          
              <?php } elseif ($this->session->userdata('userType') == '3') { ?>       
                <li><a href="<?php echo site_url();?>pencapaian"><i class="fa fa-circle-o"></i> Data Evaluasi</a></li> 
              <?php } ?>
            <?php } else { ?>
              <li><a href="<?php echo site_url();?>kehadiran"><i class="fa fa-circle-o"></i> Data Kehadiran</a></li>
              <li><a href="<?php echo site_url();?>sap"><i class="fa fa-circle-o"></i> Data Kesesuaian SAP</a></li>   
              <li><a href="<?php echo site_url();?>penelitian"><i class="fa fa-circle-o"></i> Data Penelitian</a></li>
              <li><a href="<?php echo site_url();?>pengabdian"><i class="fa fa-circle-o"></i> Data Pengabdian</a></li>
              <li><a href="<?php echo site_url();?>nilai"><i class="fa fa-circle-o"></i> Data Nilai</a></li> 
              <li><a href="<?php echo site_url();?>pencapaian"><i class="fa fa-circle-o"></i> Data Evaluasi</a></li>  
            <?php } ?>
          </ul>
        </li>
        <?php } ?>  

        <?php 
        $oklp = FALSE;
        $utype3 = $this->session->userType;
        switch ($utype3) {
          case 3:
          case 4:
          case 5:
            $oklp = TRUE;
            break;
        }
        if ($this->session->userdata('isAdmin')) {
          $oklp = TRUE;
        }
        if($oklp) {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php
            $oklaporan = FALSE;
            $okcapai = FALSE;
            if (!$this->session->userdata('isAdmin')) {
                if ($this->session->userdata('userType') == '3') {
                    $oklaporan = TRUE;
                    $okcapai = TRUE;
                }
            } else if ($this->session->userdata('isAdmin')) {
                $oklaporan = TRUE;
                $okcapai = TRUE;
            }
            $utype = $this->session->userType;
            switch ($utype) {
              case 4:
              case 5:
                $oklaporan = TRUE;
                break;
            }
            if($oklaporan) { ?>
              <li><a href="<?php echo site_url();?>laporan/monitoring"><i class="fa fa-circle-o"></i> Monitoring Dosen</a></li>
              <?php if($okcapai) { ?>
              <li><a href="<?php echo site_url();?>laporan/pencapaian"><i class="fa fa-circle-o"></i> Evaluasi</a></li>
              <?php } ?>
            <?php } ?>
            
          </ul>
        </li>
        <?php } ?>
        
        <li class="header">INFO</li>
        <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>About Us</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Version 2.5</span></a></li>-->
        <li><a href="#" onclick="logout()"><i class="fa fa-sign-out text-aqua"></i> <span>Log Out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
    	
    	<?php echo $contents;?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer visible-sm visible-md visible-lg">
    <div class="pull-right">
      <b>Version</b> 17.4.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="http://unkris.ac.id/" target="_blank">Universitas Krisnadwipayana</a>.</strong> All rights
    reserved.
  </footer>

</div>

<!-- Change Pass -->
<div class="modal fade" id="modaluseredit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Infomasi User</h4>
      </div>
      <div class="modal-body form-horizontal">
        <div class="alert alert-error" id="usersuccess-alert1" style="display:none;">
        <div id="usererrmsg1" name="usererrmsg1"><strong>Success! </strong></div>
    </div>
        <form class="form-horizontal" id="useredit-form" method="post" enctype="multipart/form-data">
          
        <div class="form-group">
          <label for="userpass1" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-8">
              
            <input type="password" class="form-control input-sm" id="userpass1" name="userpass1" 
                value="">
            </div>            
        </div>
        <div class="form-group">
          <label for="userpass2" class="col-sm-3 control-label">Ulangi Password</label>
            <div class="col-sm-8">
              
            <input type="password" class="form-control input-sm" id="userpass2" name="userpass2" 
                value="">
            </div>            
        </div>    
                    
        <div class="form-group">
          <label for="userfullname" class="col-sm-3 control-label">Nama Lengkap</label>
            <div class="col-sm-8">
              
            <input type="text" class="form-control input-sm" id="userfullname" name="userfullname" 
                value="">
            </div>            
        </div>
     </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" name="btncontinueuser" id="btncontinueuser" class="btn btn-info">Simpan</button>
        <button name="btnloaduser" id="btnloaduser" class="btn btn-info disabled" style="display:none;"><i class="fa fa-spinner fa-spin"></i>Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
$(function () {   
    $('#btncontinueuser').click(function() {        
        $.confirm({
            title: 'Konfirmasi!',
            content: 'Anda yakin data yang dimasukkan sudah benar?!',
            autoClose: 'cancel|5000',
            buttons: {
                confirm: function () {
                    saveprofile();
                },
                cancel: function () {
                },
            }
        });
        return false;
    })
})
  function logout() {
    $.confirm({
          title: 'Log Out!',
          content: 'Anda yakin ingin <strong>keluar</strong>?!',
          autoClose: 'cancel|5000',
          buttons: {
              logout: function () {                  
                  window.location.replace("<?php echo site_url();?>login/logout");
              },
              cancel: function () {
                  buttonpressed = '';
              },
          }
      });
  }

  function showuseredit() {
    $('#userpass2').val('');
    $('#userpass1').val('');
    $('#userfullname').val('<?php echo $this->session->name; ?>');
    $('#modaluseredit').modal('show');
  }
  function showalerthome(id,msg) {
    $.alert({
        title: 'Attention',
        content: msg,
    });

  }
  function saveprofile() {
    var p = $('#userpass1').val();
    var p2 = $('#userpass2').val();
    var uname = $('#userfullname').val();

    if(p !== '') {
      if(p !== p2) {
        showalerthome(1,'Password yang dimasukkan tidak sama.');
        return false;
      }
    }
    if(uname == '') {
        showalerthome(1,'Nama lengkap harus diisi.');
        return false;
    }
    
    $('#btncontinueuser').hide();
    $('#btnloaduser').show();      

    var dataString = $('#useredit-form').serializeArray();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>user/updateuser",
      data: dataString,
      success: function(data){
        //alert('DATA:'+data);
        var j = '';
          var d = $.parseJSON(data);
         //alert('d:'+d);
          $.each(d, function(i, item) {
            //alert(item.stt);
            j += item.stt+'<br />';
        });
        
        //alert(d['stt']);
          if($.isNumeric( d['stt'] )){
            $('#btncontinueuser').show();
            $('#btnloaduser').hide();
          $('#modaluseredit').modal('hide');
           reloaddt();
             
            
          }else{
            $('#btncontinueuser').show();
            $('#btnloaduser').hide();
            if(j.includes('undefined')) {
              showalerthome(1,d['stt']);
              
            }else {
              showalerthome(1,'j:'+j);                
            }
          }
      },
      error: function(){
        $('#btncontinueuser').show();
          $('#btnloaduser').hide();
        showalerthome(1,'Error on save. Please try again later.');  
        //alert('Error on save. Please try again later.');
      }
    });
  }

</script>

</body>
</html>
