<!-- Content Header (Page header) -->
<?php if(isset($pengabdian)) { ?>	
<h4>Detail Pengabdian</h4>            	
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
   
</table>
<table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
    <thead>
          <tr>
            <th style="font-size:12px; text-align:left;">Tanggal</th>
            <th style="font-size:12px; text-align:left;">Keterangan</th>
        </tr>
  		</thead>

  		<?php if(isset($pengabdian)) { ?>
  		<?php foreach($pengabdian as $nil) { ?>
  		<tr>
            <td style="font-size:12px;"><?php echo $nil['tanggal']; ?></td>
            <td style="font-size:12px;"><?php echo $nil['keterangan']; ?></td>
  		</tr>
  		<?php }} ?>
       
  </table>
<?php } ?>
