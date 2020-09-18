<?php if(isset($nilai)) { ?>	
<h4>Detail Nilai</h4>            	
	  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
collapse;width:201pt" width="267">
        <colgroup>
            <col style="mso-width-source:userset;mso-width-alt:4169;width:86pt" width="114" />
            <col style="mso-width-source:userset;mso-width-alt:402;width:8pt" width="11" />
            <col style="mso-width-source:userset;mso-width-alt:5193;width:107pt" width="142" />
        </colgroup>
        <tr height="20" style="height:15.0pt">
            <td style="font-size:12px;" class="auto-style1" colspan="3" height="20" width="267">Periode <?php echo $periode;?></td>
        </tr>
        <tr height="20" style="height:15.0pt">
            <td height="20" style="height:15.0pt" style="font-size:12px;">Dosen</td>
            <td style="font-size:12px;">:</td>
            <td style="font-size:12px;"><?php echo $Nama; ?></td>
        </tr>
        <tr height="20" style="height:15.0pt">
            <td height="20" style="height:15.0pt" style="font-size:12px;">Jurusan</td>
            <td style="font-size:12px;">:</td>
            <td style="font-size:12px;"><?php echo $jurusanNama; ?></td>
        </tr>
        <tr height="20" style="height:15.0pt">
            <td height="20" style="height:15.0pt" style="font-size:12px;">Mata Kuliah</td>
            <td style="font-size:12px;">:</td>
            <td style="font-size:12px;"><?php echo $mataKuliah; ?></td>
        </tr>
    </table>

   <table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
    <thead>
          <tr>
          	<th style="font-size:12px; text-align:left;">Tanggal</th>
            <th style="font-size:12px; text-align:left;">Jurusan</th>
            <th style="font-size:12px; text-align:left;">Mata Kuliah</th>
            <th style="font-size:12px; text-align:left;">Nilai</th>
            <th style="font-size:12px; text-align:left;">Aktif</th>
        </tr>
  		</thead>

  		<?php if(isset($nilai)) { ?>
  		<?php foreach($nilai as $nil) { ?>
  		<tr>
            <td style="font-size:12px;"><?php echo $nil['tanggal']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['jurusanNama']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['mataKuliah']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['jenisNilai']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['StatName']; ?></td>
  		</tr>
  		<?php }} ?>
       
  </table>
<?php } ?>

