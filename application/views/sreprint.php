<?php foreach ($record as $rows) { ?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:700px;">
    <colgroup>
        <col style="mso-width-source:userset;mso-width-alt:3547;width:73pt" width="97" />
        <col style="mso-width-source:userset;mso-width-alt:402;width:8pt" width="11" />
        <col style="mso-width-source:userset;mso-width-alt:3986;width:82pt" width="109" />
        <col span="2" style="width:20pt" width="64" />
        <col style="mso-width-source:userset;mso-width-alt:402;width:8pt" width="11" />
        <col style="width:60pt" width="64" />
    </colgroup>
    <tr height="20">
        <td colspan="7" height="20" style="text-align:center;font-size: 25px;font-weight: bold;" width="420">Store Request</td>
    </tr>
    <tr height="20">
        <td colspan="7" height="20" style="text-align:center;font-weight: bold;">Request No: <?php echo $rows['SRNo']; ?></td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Number</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" align="left"><?php echo $rows['SRNo']; ?></td>
        <td></td>
        <td style="font-size:12px;">Request</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;"><?php echo $rows['sRequestBy']; ?></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Date</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" align="left"><?php echo date_format(date_create($rows['Date']),'d-M-Y'); ?></td>
        <td></td>
        <td style="font-size:12px;">Remark</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;"><?php echo $rows['Remark']; ?></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Expected Date</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" align="left"><?php echo date_format(date_create($rows['Expected']),'d-M-Y'); ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Document</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" colspan="5"><?php echo $rows['SRDocument']; ?></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Location</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" colspan="5"><?php echo $rows['Location']; ?></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20">Cost Center</td>
        <td style="font-size:12px;">:</td>
        <td style="font-size:12px;" colspan="5"><?php echo $rows['CostCenter']; ?></td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<?php } ?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
 collapse;width:700px" width="700">
	<thead>
	    <tr>
	      <th style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000;" align="left">Part No</th>
	      <th style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000;" align="left">Description</th>	      
	      <th style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000;" align="left">Unit</th>
	      <th style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000;" align="left">Remark</th>
	      <th style="font-size:12px; border-top:1px solid #000; border-bottom:1px solid #000;" align="right">Qty</th>
	    </tr>
	</thead>
	<?php if(!empty($detail)) { ?>
	<?php foreach ($detail as $rw) { ?>
		<tr style="font-size:small;">
			<td style="font-size:12px;"><?php echo $rw['PartNo'];?></td>
			<td style="font-size:12px;"><?php echo str_replace("\"", "in", $rw['ItemName']);?></td>			
			<td style="font-size:12px;"><?php echo $rw['UnitCode'];?></td>
			<td style="font-size:12px;"><?php echo $rw['Remark'];?></td>
			<td style="font-size:12px;" align="right"><?php echo $rw['Qty'];?></td>
		</tr>
	<?php } }?>
</table>
<br />
<br />
<br />
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:418pt"  style="width:700px;">
    <colgroup>
        <col style="mso-width-source:userset;mso-width-alt:2779;width:57pt" width="76" />
        <col style="width:48pt" width="64" />
        <col style="mso-width-source:userset;mso-width-alt:4315;width:89pt" width="118" />
        <col style="width:48pt" width="64" />
        <col style="mso-width-source:userset;mso-width-alt:3218;width:66pt" width="88" />
        <col style="width:48pt" width="64" />
        <col style="mso-width-source:userset;mso-width-alt:2998;width:62pt" width="82" />
    </colgroup>
    <tr height="20" style="font-size:small;">
        <td style="font-size:12px;" height="20" width="76">Request By</td>
        <td width="64"></td>
        <td style="font-size:12px;" width="118">Approved By</td>
        <td width="64"></td>
        <td style="font-size:12px;" width="88">Transfer By</td>
        <td width="64"></td>
        <td style="font-size:12px;" width="82">Received By</td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="20" style="font-size:small;">
        <td height="20"></td>
        <td></td>
        <td style="font-size:12px;">Department Head</td>
        <td></td>
        <td style="font-size:12px;">Store Keeper</td>
        <td></td>
        <td style="font-size:12px;">………………</td>
    </tr>
    <tr height="20">
        <td height="20"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
