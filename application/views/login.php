<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dosen | Log in</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url();?>assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- jQuery 3 -->
<script src="<?php echo site_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		function showmsg(msg){
	        $("#errmsg").html('<strong>'+msg+'</strong>');
			$("#success-alert").fadeTo(5000, 500).slideUp(1000, function(){			
			    $("#success-alert").slideUp(2000);
			});
	    }
        <?php if($this->session->flashdata('msg') != ''){ ?>      	
        	showmsg("<?php echo $this->session->flashdata('msg') ?>");	        	
        <?php } ?>
  	});
  	
    function changeHashOnLoad() {
        window.location.href += "#";
        setTimeout("changeHashAgain()", "50");
    }

    function changeHashAgain() {
        window.location.href += "1";
    }

    var storedHash = window.location.hash;
    window.setInterval(function () {
        if (window.location.hash != storedHash) {
            window.location.hash = storedHash;
        }
    }, 50);


   </script>
   <style type="text/css">
      .fullscreen_bg {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        /*background-size: cover;
        background-position: 50% 50%;*/
        background-image: url('<?php echo site_url();?>assets/dist/img/bgimg.jpg');
        background-repeat:repeat;
      }
   </style>
</head>
<body class="hold-transition login-page" onload="changeHashOnLoad();">
<div id="fullscreen_bg" class="fullscreen_bg"/>
<div class="login-box">
    <div class="login-logo">
      <img src="<?php echo site_url();?>assets/dist/img/uk.png" />
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Log in untuk memulai sesi Anda</p>
      <div class="alert alert-error" id="success-alert" style="display:none;">
        <div id="errmsg" name="errmsg"><strong>Success! </strong></div>
    </div>
      
      <form action="<?php echo base_url().'login/process_login'; ?>" method="post" name="loginform" id="loginform">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Username" id="login" name="login" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="social-auth-links text-center">
        &nbsp;
      </div>
      &copy;<a href="http://unkris.ac.id/" target="_blank">Universitas Krisnadwipayana</a>&nbsp;<?php echo date('Y');?><br>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->


<!-- jQuery 3 -->
<script src="<?php echo site_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(function () {
    
  });
</script>
</body>
</html>
