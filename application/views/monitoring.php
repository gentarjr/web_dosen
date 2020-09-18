<style type="text/css">
	.loadinggif {
	    background:url('<?php echo site_url();?>assets/dist/img/ajax-loader3.gif') no-repeat right center;
	}
</style>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan 
        <small>data</small>
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
	                </div>
	                <div class="form-group">
	                  <label class="col-sm-3 control-label">Pilih NIDN : </label>
	                  <select class="form-control select2" style="width: 300px;" name="dosenID" id="dosenID">
	                  	<option disabled <?php if($isnew){ echo "selected"; }?> value="0"> -- pilih NIDN -- </option>
	                    <?php foreach($dosen as $dos) { ?>
	                        <option value="<?php echo $dos['dosenID']; ?>" <?php if($dos['dosenID'] == $dosenID) {echo 'selected="selected"';}?>><?php echo $dos['NamaNIDN'];?></option>
	                      <?php } ?>
	                  </select>
	                  
	                </div>	
	                <div class="form-group">
	                	<label class="col-sm-3 control-label">Nama Dosen : </label>
	                	<label class="col-sm-8 control-label" id="nmdosen" name="nmdosen"><?php if(!$isnew){ echo $nama; } else {echo '...';} ?></label>
	                </div>
	                <div class="form-group">
	                  <label class="col-sm-3 control-label">Pilih Jurusan : </label>
	                  <select class="form-control select2" style="width: 300px;" name="jurusanID" id="jurusanID">
	                    <?php foreach($jurusan as $jur) { ?>
	                        <option value="<?php echo $jur['jurusanID']; ?>" <?php if($jur['jurusanID'] == $jurusanID) {echo 'selected';}?>><?php echo $jur['jurusanNama'];?></option>
	                      <?php } ?>
	                  </select>
	                </div>	
	                <div class="form-group">
	                  <label class="col-sm-3 control-label">Pilih Mata Kuliah : </label>
	                  <select class="form-control select2" style="width: 300px;" name="mataID" id="mataID">
	                    <?php foreach($mata as $mat) { ?>
	                        <option value="<?php echo $mat['mataID']; ?>" <?php if($mat['mataID'] == $mataID) {echo 'selected';}?>><?php echo $mat['mataKuliah'];?></option>
	                      <?php } ?>
	                  </select>
						<button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-info"><i class="fa fa-fw fa-search"></i>Lihat</button>
	                  
	                </div>	
	            </div>
	          </form>
	          	<?php if(isset($ispost)) { ?>
				<div class="box-body" id="tbl" name="tbl" style="margin-left:20px; border-style:solid; width:600px;">

					<?php
						$ok = FALSE;
						$hasilakhir = FALSE;
						$utype = $this->session->userType;
						switch ($utype) {
							case 4:
							case 3:
							case 5:
								$ok = TRUE;
								break;
						}
						if($utype == 3) {
							$hasilakhir = TRUE;
						}
						if($this->session->isAdmin) {
							$ok = TRUE;
						}
						 ?>
						<table cellpadding="0" cellspacing="0" style="border-collapse:
collapse;width:432pt" width="576">
								<colgroup>
										<col span="9" style="width:48pt" width="64" />
								</colgroup>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style1" colspan="9" height="20" width="576" style="text-align:center;">&nbsp;</td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style2" colspan="9" height="20" style="text-align:center;">Laporan Monitoring Dosen Fakultas Teknik Universitas Krisnadwipayana</td>
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
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style3" colspan="5" height="20">Output Penjamin Mutu</td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style5" height="20">NIDN<span style="mso-spacerun:yes">&nbsp;</span></td>
										<td class="auto-style6" colspan="3">: <?php echo $nidn; ?></td>
										<td class="auto-style4"></td>
										<td class="auto-style7">Jurusan<span style="mso-spacerun:yes">&nbsp;</span></td>
										<td class="auto-style6" colspan="3">: <?php echo $jurusanNama; ?></td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style5" height="20">Nama</td>
										<td class="auto-style6" colspan="3">: <?php echo $nama; ?></td>
										<td class="auto-style4"></td>
										<td class="auto-style7">MK</td>
										<td class="auto-style6" colspan="3">: <?php echo $mataKuliah; ?></td>
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
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style8" height="20"></td>
										<td class="auto-style4">TA<span style="mso-spacerun:yes">&nbsp;</span></td>
										<td class="auto-style6" colspan="4">: <?php echo $tahunajar; ?></td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style8" height="20"></td>
										<td class="auto-style4">Semester</td>
										<td class="auto-style6" colspan="4">: Ganjil / Genap</td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
										<td class="auto-style4"></td>
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
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style9" colspan="4" height="20">1. Penyerahan Nilai</td>
										<td class="auto-style10">:</td>
										<td class="auto-style11"><?php echo $nilai; ?></td>
										<td class="auto-style11" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="detailnilai()" class="btn btn-info btn-xs">Detail PDF</a>
											<a href="#" onclick="detailnilaixl()" class="btn btn-info btn-xs">Detail Excel</a>
										<?php } ?>										
										</td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style12" colspan="4" height="20">2. Kehadiran</td>
										<td class="auto-style7">:</td>
										<td class="auto-style13"><?php echo $kehadiran; ?>%</td>
										<td class="auto-style13" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="detailhadir()"  class="btn btn-info btn-xs">Detail PDF</a>
											<a href="#" onclick="detailhadirxl()"  class="btn btn-info btn-xs">Detail Excel</a>
										<?php } ?>
										</td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style12" colspan="4" height="20">3. Penelitian</td>
										<td class="auto-style14">:</td>
										<td class="auto-style13"><?php echo $penelitian; ?></td>
										<td class="auto-style13" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="detailpenelitian()" class="btn btn-info btn-xs">Detail PDF</a>
											<a href="#" onclick="detailpenelitianxl()" class="btn btn-info btn-xs">Detail Excel</a>
										<?php } ?>									
										</td>
								</tr>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style12" colspan="4" height="20">4. Pengabdian Masyarakat</td>
										<td class="auto-style14">:</td>
										<td class="auto-style13"><?php echo $pengabdian; ?></td>
										<td class="auto-style13" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="detailpengabdian()" class="btn btn-info btn-xs">Detail PDF</a>
											<a href="#" onclick="detailpengabdianxl()" class="btn btn-info btn-xs">Detail Excel</a>
										<?php } ?>
										</td>										
								</tr>

								<tr height="20" style="height:15.0pt">
										<td class="auto-style12" colspan="4" height="20">5. Kesesuaian SAP</td>
										<td class="auto-style14">:</td>
										<td class="auto-style13"><?php echo $sap; ?></td>
										<td class="auto-style13" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="detailsap()" class="btn btn-info btn-xs">Detail PDF</a>
											<a href="#" onclick="detailsapxl()" class="btn btn-info btn-xs">Detail Excel</a>
										<?php } ?>
										</td>										
								</tr>
								
								<tr height="20" style="height:15.0pt">
										<td class="auto-style18" height="20">&nbsp;</td>
										<td class="auto-style19">&nbsp;</td>
										<td class="auto-style19">&nbsp;</td>
										<td class="auto-style19">&nbsp;</td>
										<td class="auto-style20">&nbsp;</td>
										<td class="auto-style11">&nbsp;</td>
										<td class="auto-style19">&nbsp;</td>
										<td class="auto-style19">&nbsp;</td>
										<td class="auto-style21">&nbsp;</td>
								</tr>
								<?php if($hasilakhir) { ?>
								<tr height="20" style="height:15.0pt">
										<td class="auto-style22" height="20">&nbsp;</td>
										<td class="auto-style23" colspan="3" style="mso-ignore: colspan">Hasil Akhir Monitoring<span style="mso-spacerun:yes">&nbsp;</span></td>
										<td class="auto-style24">:</td>
										<td class="auto-style17" style="text-align:center;"><?php echo $nilaiakhir; ?></td>
										<td class="auto-style25" colspan="3">
										<?php 
										if($ok) { ?>
											<a href="#" onclick="cetaklaporan()" class="btn btn-info btn-xs">Cetak PDF</a>
											<a href="#" onclick="cetaklaporanxl()" class="btn btn-info btn-xs">Export Excel</a>
										<?php } ?>	
										</td>
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
  	//$('.select2').select2();
  	$('.select2').select2({
		templateResult: formatDesign
	});

  	<?php if($isnew) { ?>
  	$("#dosenID").val($("#dosenID option:first").val());
  	<?php } ?>
  	$("#dosenID").on("change", function () {
    	var dsid = $('#dosenID').val();
    	$('#nmdosen').addClass('loadinggif');
    	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>dosen/getnama",
			data: { 
		        'dosenid': dsid
		    },
			success: function(data){
				var d = $.parseJSON(data);	
				$('#nmdosen').removeClass('loadinggif');				
				$('#nmdosen').text(d['msg']);					
			},
			error: function(){
				$('#nmdosen').removeClass('loadinggif');
				//showalert(1,'Can not fetch Dosen Name. Please try again in a few minutes.');	
				$('#nmdosen').text('N/A');
			}
		});
    })

  	$("#edit-form").submit(function(){
  		var d = $("#dosenID").val();
  		if (d == null) {
  			showalerthome(1,'NIDN Dosen belum dipilih.');
  			return false;
  		}
	    
	});
	
  })
function formatDesign(item) {
		var selectionText = item.text.split(" (");
		var returnString = $('<span>'+item.text+'</span>');
		if(selectionText[1] == undefined) {
			returnString = $('<span>'+selectionText[0]+'</span>');
		} else {
			returnString = $('<span>'+selectionText[0] + "<br>(" + selectionText[1]+'</span>');
		}
		
		return returnString;
	};
  function detailnilai() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailnilai/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailnilaixl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailnilai/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailhadir() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailhadir/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailhadirxl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailhadir/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailpenelitian() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailpenelitian/'+periode+'/'+dosenID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailpenelitianxl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailpenelitian/'+periode+'/'+dosenID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailpengabdian() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailpengabdian/'+periode+'/'+dosenID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailpengabdianxl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailpengabdian/'+periode+'/'+dosenID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }

  function detailsap() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailsap/'+periode+'/'+dosenID+'/'+mataID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function detailsapxl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/detailsap/'+periode+'/'+dosenID+'/'+mataID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }

  function cetaklaporan() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/cetak/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID,'_blank' // <- This is what makes it open in a new window.
      );
  }
  function cetaklaporanxl() {
  	var dosenID = $('#dosenID').val();
  	var periode = $('#period').val();
  	var mataID = $('#mataID').val();
  	var jurusanID = $('#jurusanID').val();
  	window.open(
        '<?php echo base_url(); ?>laporan/cetak/'+periode+'/'+dosenID+'/'+mataID+'/'+jurusanID+'/1','_blank' // <- This is what makes it open in a new window.
      );
  }
</script>
