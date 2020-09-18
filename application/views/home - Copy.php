<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>data</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12" style="padding-left:5px; padding-right:5px;">         

          <div class="box">
            <div class="box-header">
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>Selamat Datang <?php echo $this->session->userdata('name'); ?></p>
              <?php
                switch ($this->session->userType) {
                  case 1:
                    echo 'Dosen';
                    break;
                  case 2:
                    echo 'TU';
                    break;
                  case 3:
                    echo 'Penjamin Mutu';
                    break;
                  case 4:
                    echo 'Dekan';
                    break;
                  case 5:
                    echo 'Kaprodi';
                    break;
                  case 6:
                    echo 'UPT';
                    break;
                  default:
                    # code...
                    break;
                }
              ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

