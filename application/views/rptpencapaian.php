<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluasi 
        <small>laporan</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12" style="padding-left:5px; padding-right:5px;">         

          <div class="box">
	          <form class="form-vertical" id="edit-form" method="post" enctype="multipart/form-data">
	            <div class="box-header">	            	
        			            	
	              
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body" style="margin-left:10px;">
					<div class="form-group">
		                <label class="col-sm-3 control-label">Pilih Periode : </label>
		                  <select class="form-control select2" style="width: 110px;" name="period" id="period">
		                    <?php foreach($periode as $per) { ?>
		                        <option value="<?php echo str_replace('-', '', $per['Period']); ?>" <?php if(str_replace('-', '', $per['Period'])==$period){ echo 'selected';} ?>><?php echo $per['Period'];?></option>
		                      <?php } ?>
		                  </select>
		                  <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-info"><i class="fa fa-fw fa-search"></i>Lihat</button>
	                </div>
	                
	            </div>
	          </form>
	          	
	          	
	          	<?php if(isset($ispost)) { ?>
				<div class="box-body" id="tbl" name="tbl" style="margin-left:20px;">
					<a href="#" onclick="cetaklaporan()" class="btn btn-info btn-xs">Cetak PDF</a>
					<a href="#" onclick="cetaklaporanxl()" class="btn btn-info btn-xs">Export Excel</a>
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
 collapse;" width="100%">
		                <colgroup>
		                    <col style="mso-width-source:userset;mso-width-alt:1426;width:29pt" width="39" />
		                    <col style="mso-width-source:userset;mso-width-alt:7241;width:149pt" width="198" />
		                    <col style="mso-width-source:userset;mso-width-alt:3364;width:69pt" width="92" />
		                    <col style="mso-width-source:userset;mso-width-alt:3986;width:82pt" width="109" />
		                    <col style="mso-width-source:userset;mso-width-alt:4790;width:98pt" width="131" />
		                    <col style="mso-width-source:userset;mso-width-alt:2560;width:53pt" width="70" />
		                    <col style="mso-width-source:userset;mso-width-alt:1865;width:38pt" width="51" />
		                    <col style="mso-width-source:userset;mso-width-alt:2340;width:48pt" width="64" />
		                    <col style="mso-width-source:userset;mso-width-alt:3401;width:70pt" width="93" />
		                    <col style="mso-width-source:userset;mso-width-alt:2194;width:45pt" width="60" />
		                </colgroup>
		                <tr height="20" style="height:15.0pt">
		                    <td class="auto-style1" colspan="10" height="20" width="907" style="text-align:center;font-weight:bold;">Laporan Evaluasi Internal Prodi periode <?php echo substr($period, 0,4).'-'.substr($period, 4,2); ?></td>
		                </tr>
		                <tr height="20" style="height:15.0pt">
		                    <td height="20" style="height:15.0pt"></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                    <td></td>
		                </tr>
		                <tr height="20" style="height:15.0pt">
		                    <td class="auto-style2" height="40" rowspan="2" style="border-bottom:solid 1px #ccc;">No</td>
		                    <td class="auto-style3" rowspan="2" style="border-bottom:solid 1px #ccc;">Parameter</td>
		                    <td class="auto-style3" rowspan="2" style="border-bottom:solid 1px #ccc;">Kriteria Penerimaan</td>
		                    <td class="auto-style4" colspan="7" style="text-align:center;border-bottom:solid 1px #ccc;">Fakultas</td>
		                </tr>
		                <tr height="20" style="height:15.0pt">
		                    <td class="auto-style5" height="20" style="border-bottom:solid 1px #ccc;">Teknik Industri</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">Teknik Sipil</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">Teknik Informatika</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">Teknik Elektro</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">Teknik Arsitektur</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">Teknik Mesin</td>
		                    <td class="auto-style6" style="border-bottom:solid 1px #ccc;">PWK</td>
		                </tr>
		                
		                	<?php foreach($record as $rec) { ?>
		                	<tr height="20" style="height:15.0pt">
		                    <td class="auto-style7" height="20"><?php echo $rec['capaiID'];?></td>
		                    <td class="auto-style8"><?php echo $rec['paramName'];?></td>
		                    <td class="auto-style9"><?php echo $rec['kriteria'];?></td>
		                    <td class="auto-style9"><?php echo $rec['tIndustri'];?>%</td>
		                    <td class="auto-style9"><?php echo $rec['tSipil'];?>%</td>
		                    <td class="auto-style9"><?php echo $rec['tInformatika'];?>%</td>
		                    <td class="auto-style9"><?php echo $rec['tElektro'];?>%</td>
		                    <td class="auto-style10"><?php echo $rec['tArsitektur'];?>%</td>
		                    <td class="auto-style10"><?php echo $rec['tMesin'];?>%</td>
		                    <td class="auto-style10"><?php echo $rec['tPWK'];?>%</td>
		                     </tr>
		                    <?php } ?>
		               
		            </table>
				</div>
				<?php } ?>
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
  	$('.select2').select2();

  })

  function cetaklaporan() {
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/cetakpencapaian/'+periode,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function cetaklaporanxl() {
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/cetakpencapaian/'+periode+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }
</script>
