<!-- Content Header (Page header) -->
<?php if(isset($kehadiran)) { ?>
<h4>Detail Kehadiran</h4>	            	
	  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
collapse;width:201pt" width="267">
        <colgroup>
            <col style="mso-width-source:userset;mso-width-alt:4169;width:86pt" width="114" />
            <col style="mso-width-source:userset;mso-width-alt:402;width:8pt" width="11" />
            <col style="mso-width-source:userset;mso-width-alt:5193;width:107pt" width="142" />
        </colgroup>
        <tr height="20" style="height:15.0pt">
            <td class="auto-style1" colspan="3" height="20" width="267" style="font-size:12px;">Periode <?php echo $periode;?></td>
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
            <th style="font-size:12px;">Tanggal</th>
            <th style="font-size:12px;">SKS</th>
            <th style="font-size:12px;">SMTR</th>
            <th style="font-size:12px;">KLS</th>
            <th style="font-size:12px;">Jadwal</th>
            <th style="font-size:12px;">Minggu Ke?</th>
            <th style="font-size:12px;">Wajib</th>
            <th style="font-size:12px;">Hadir</th>				            
            <th style="font-size:12px;">Ket.</th>
        </tr>
  		</thead>

  		<?php if(isset($kehadiran)) { ?>
  		<?php foreach($kehadiran as $nil) { ?>
  		<tr>
            <td style="font-size:12px;"><?php echo $nil['tanggal']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['sks']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['smtr']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['kls']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['jadwalNama']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['mingguKe']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['totalWajib']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['totalHadir']; ?></td>				            
            <td style="font-size:12px;"><?php echo $nil['keterangan']; ?></td>
  		</tr>
  		<?php }} ?>
       
  </table>
 <?php } ?>
