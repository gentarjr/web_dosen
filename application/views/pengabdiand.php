<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengabdian 
        <small>data</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12" style="padding-left:5px; padding-right:5px;">         

          <div class="box">	          
	            <div class="box-header">
	            	<?php if(isset($pengabdian)) { ?>	            	
        			  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
 collapse;width:201pt" width="267">
		                <colgroup>
		                    <col style="mso-width-source:userset;mso-width-alt:4169;width:86pt" width="114" />
		                    <col style="mso-width-source:userset;mso-width-alt:402;width:8pt" width="11" />
		                    <col style="mso-width-source:userset;mso-width-alt:5193;width:107pt" width="142" />
		                </colgroup>
		                <tr height="20" style="height:15.0pt">
		                    <td class="auto-style1" colspan="3" height="20" width="267">Periode <?php echo $periode;?></td>
		                </tr>
		                <tr height="20" style="height:15.0pt">
		                    <td height="20" style="height:15.0pt">Dosen</td>
		                    <td>:</td>
		                    <td><?php echo $Nama; ?></td>
		                </tr>
		               
		            </table>
		            <?php } ?>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive">
				<table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
	                <thead>
				          <tr>
				            <th>Tanggal</th>
				            <th>Keterangan</th>
			            </tr>
				  		</thead>

				  		<?php if(isset($pengabdian)) { ?>
				  		<?php foreach($pengabdian as $nil) { ?>
				  		<tr>
				            <td><?php echo $nil['tanggal']; ?></td>
				            <td><?php echo $nil['keterangan']; ?></td>
				  		</tr>
				  		<?php }} ?>
				       
	              </table>
            </div>
	          	
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<!-- page script -->
<script type="text/javascript">

  $(function () {   
  	

  })

</script>
