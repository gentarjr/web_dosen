<!-- Content Header (Page header) -->
<?php if(isset($ispost)) { ?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
 collapse;width:700px">
		<colgroup>
				<col span="9" style="width:48pt" width="64" />
		</colgroup>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style1" colspan="9" height="20" width="576" style="text-align:center;font-size: 25px;font-weight: bold;">&nbsp;</td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style2" colspan="9" height="20" style="text-align:center;font-weight: bold;">Laporan Monitoring Dosen Fakultas Teknik Universitas Krisnadwipayana</td>
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
				<td class="auto-style3" colspan="5" height="20" style="font-size:12px;">Output Penjamin Mutu</td>
				<td class="auto-style4"></td>
				<td class="auto-style4"></td>
				<td class="auto-style4"></td>
				<td class="auto-style4"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style5" height="20" style="font-size:12px;">NIDN<span style="mso-spacerun:yes">&nbsp;</span></td>
				<td class="auto-style6" colspan="3" style="font-size:12px;">: <?php echo $nidn; ?></td>
				<td class="auto-style4"></td>
				<td class="auto-style7" style="font-size:12px;">Jurusan<span style="mso-spacerun:yes">&nbsp;</span></td>
				<td class="auto-style6" colspan="3" style="font-size:12px;">: <?php echo $jurusanNama; ?></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style5" height="20" style="font-size:12px;">Nama</td>
				<td class="auto-style6" colspan="3" style="font-size:12px;">: <?php echo $nama; ?></td>
				<td class="auto-style4"></td>
				<td class="auto-style7" style="font-size:12px;">MK</td>
				<td class="auto-style6" colspan="3" style="font-size:12px;">: <?php echo $mataKuliah; ?></td>
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
				<td class="auto-style4" style="font-size:12px;">TA<span style="mso-spacerun:yes">&nbsp;</span></td>
				<td class="auto-style6" colspan="4" style="font-size:12px;">: <?php echo $tahunajar; ?></td>
				<td class="auto-style4"></td>
				<td class="auto-style4"></td>
				<td class="auto-style4"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style8" height="20"></td>
				<td class="auto-style4" style="font-size:12px;">Semester</td>
				<td class="auto-style6" colspan="4" style="font-size:12px;">: Ganjil / Genap</td>
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
				<td class="auto-style9" colspan="4" height="20" style="font-size:12px;">1. Penyerahan Nilai</td>
				<td class="auto-style10" style="font-size:12px;">:</td>
				<td class="auto-style11" style="font-size:12px;"><?php echo $nilai; ?></td>
				<td class="auto-style11" colspan="3"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style12" colspan="4" height="20" style="font-size:12px;">2. Kehadiran</td>
				<td class="auto-style7" style="font-size:12px;">:</td>
				<td class="auto-style13" style="font-size:12px;"><?php echo $kehadiran; ?>%</td>
				<td class="auto-style13" colspan="3"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style12" colspan="4" height="20" style="font-size:12px;">3. Penelitian</td>
				<td class="auto-style14" style="font-size:12px;">:</td>
				<td class="auto-style13" style="font-size:12px;"><?php echo $penelitian; ?></td>
				<td class="auto-style13" colspan="3"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style12" colspan="4" height="20" style="font-size:12px;">4. Pengabdian Masyarakat</td>
				<td class="auto-style14" style="font-size:12px;">:</td>
				<td class="auto-style13" style="font-size:12px;"><?php echo $pengabdian; ?></td>
				<td class="auto-style13" colspan="3"></td>
		</tr>
		<tr height="20" style="height:15.0pt">
				<td class="auto-style12" colspan="4" height="20" style="font-size:12px;">5. Kesesuaian SAP</td>
				<td class="auto-style14" style="font-size:12px;">:</td>
				<td class="auto-style13" style="font-size:12px;"><?php echo $sap; ?></td>
				<td class="auto-style13" colspan="3"></td>
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
		<tr height="20" style="height:15.0pt">
				<td class="auto-style22" height="20">&nbsp;</td>
				<td class="auto-style23" colspan="3" style="mso-ignore: colspan" style="font-size:12px;">Hasil Akhir Monitoring<span style="mso-spacerun:yes">&nbsp;</span></td>
				<td class="auto-style24" style="font-size:12px;">:</td>
				<td class="auto-style17" style="font-size:12px;"><?php echo $nilaiakhir; ?></td>
				<td class="auto-style25" colspan="3"></td>
		</tr>
</table>
<?php } ?>

<!-- page script -->
<script type="text/javascript">

  $(function () {   
  	

  })

</script>
