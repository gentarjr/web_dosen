<!-- Content Header (Page header) -->
<?php if(isset($penelitian)) { ?>
 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$namafile.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>     	            	
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
    <table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
        <thead>
	          <tr>
	            <th>Tanggal</th>
	            <th>Judul</th>
	            <th>Keterangan</th>
            </tr>
	  		</thead>

	  		<?php if(isset($penelitian)) { ?>
	  		<?php foreach($penelitian as $nil) { ?>
	  		<tr>
	            <td><?php echo $nil['tanggal']; ?></td>
	            <td><?php echo $nil['penelitianJudul']; ?></td>
	            <td><?php echo $nil['penelitianKeterangan']; ?></td>
	  		</tr>
	  		<?php }} ?>
	       
      </table>
<?php } ?>
