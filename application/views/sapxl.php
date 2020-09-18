<!-- Content Header (Page header) -->
<?php if(isset($sap)) { ?>  
<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$namafile.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>  
<h4>Detail Kesesuaian SAP</h4>              
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
        <td height="20" style="height:15.0pt" style="font-size:12px;">Mata Kuliah</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;"><?php echo $mataKuliah; ?></td>
    </tr>
   
</table>
<table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
    <thead>
          <tr>
            <th style="font-size:12px; text-align:left;">Tanggal</th>
            <th style="font-size:12px; text-align:left;">Dosen</th>
            <th style="font-size:12px; text-align:left;">Mata Kuliah</th>
            <th style="font-size:12px; text-align:left;">Status Daftar Nilai</th>
        </tr>
      </thead>

      <?php if(isset($sap)) { ?>
      <?php foreach($sap as $sp) { ?>
      <tr>
            <td style="font-size:12px;"><?php echo $sp['tanggal']; ?></td>
            <td style="font-size:12px;"><?php echo $sp['Nama']; ?></td>
            <td style="font-size:12px;"><?php echo $sp['mataKuliah']; ?></td>
            <td style="font-size:12px;"><?php echo $sp['StatName']; ?></td>
      </tr>
      <?php }} ?>
       <tr>
            <td style="font-size:12px;">&nbsp;</td>
            <td style="font-size:12px;">&nbsp;</td>
            <td style="font-size:12px;">&nbsp;</td>
            <td style="font-size:12px;">&nbsp;</td>
      </tr>
      <tr>
            <td style="font-size:12px;">&nbsp;</td>
            <td style="font-size:12px;">&nbsp;</td>
            <td style="font-size:12px; text-align:right;">Total</td>
            <td style="font-size:12px;"><?php echo round($total,2);?>%</td>
      </tr>
  </table>
<?php } ?>
