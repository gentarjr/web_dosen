<style type="text/css">
	.form-group {
		margin-bottom: 5px !important;
	}
</style>
<section class="content-header">
	<h1>
	<a href="<?php echo base_url();?>dosen">Dosen</a>
	<small>Edit</small>
	</h1>
</section>

<!-- Main content -->
<?php $detailcount=1; ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">   
			<div class="box">
			<?php foreach ($record as $rows) { ?>
				<form class="form-horizontal" id="edit-form" method="post" enctype="multipart/form-data">
				<div class="box-header">
	              <div class="form-group">
	              <?php if($rows['dosenID'] <> 0) { ?>
	              		<a href="#" style="margin-left:10px;" onclick="openprint(<?php echo $rows['dosenID']; ?>)"><i class="fa fa-print"></i>Print</a>	   
	              	<?php } ?>
	              
	              	 <a href="<?php echo base_url();?>dosen" class="btn btn-default pull-right" role="button" 
	              	 style="margin-left:4px;margin-right:20px;">Tutup</a>
	              	<button type="submit" name="btnsubmit" id="btnsubmit" value="Save Changes" class="btn btn-success pull-right" style="margin-left:4px;">Simpan Perubahan</button>
		            <button name="btnloading" id="btnloading" class="btn btn-success pull-right disabled" style="margin-left:4px; display:none;"><i class="fa fa-spinner fa-spin"></i>Simpan Perubahan</button>

	              </div>
	            </div>
	            <div class="alert alert-error" id="success-alert" style="display:none;">
				    <div id="errmsg" name="errmsg"><strong>Success! </strong></div>
				</div>
	            <div class="box-body">
				  		<div style="margin-bottom:3px;">&nbsp;</div>
						<div class="col-sm-6">		
					  		<input type="hidden" id="edit-id" value="<?php echo $rows['dosenID']; ?>" class="hidden">
					  		
						  	
					    	<div class="form-group">
						    	<input style="display:none;" type="text" class="form-control input-sm" id="dosenID" name="dosenID" placeholder="ID" 
						      		value="<?php echo $rows['dosenID']; ?>" disabled>
						    	<label for="NIDN" class="col-sm-3 control-label">NIDN</label>
						    	<div class="col-sm-4">
						      		<input type="text" class="form-control input-sm" id="NIDN" name="NIDN" placeholder="NIDN" 
						      		value="<?php echo $rows['NIDN']; ?>" required>
						    	</div>
						    	<label for="dosenStatus" class="col-sm-2 control-label">Status</label>
						    	<div class="col-sm-3">
						      		<select class="form-control select2" style="width: 100%;" name="dosenStatus" id="dosenStatus">
					                	<?php foreach($stats as $stat) { ?>
					                  		<option value="<?php echo $stat['dosenStatus']; ?>"<?php if($rows['dosenStatus'] == $stat['dosenStatus']) {echo " selected"; }?>><?php echo $stat['dosenStatus'];?></option>
					                  	<?php } ?>
					                </select>	
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Nama" class="col-sm-3 control-label">Nama</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="Nama" name="Nama" placeholder="Nama" 
						      		value="<?php echo $rows['Nama']; ?>" required>
						    	</div>
						  	</div>
						  	
						  	<div class="form-group">
						    	<label for="Alamat" class="col-sm-3 control-label">Alamat</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="Alamat" name="Alamat" placeholder="Alamat" 
						      		value="<?php echo $rows['Alamat']; ?>" required>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Telp" class="col-sm-3 control-label">Telp.</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="Telp" name="Telp" placeholder="Telp." 
						      		value="<?php echo $rows['Telp']; ?>" required>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Email" class="col-sm-3 control-label">E-Mail</label>
						    	<div class="col-sm-9">
						      		<input type="email" class="form-control input-sm" id="Email" name="Email" placeholder="E-Mail" 
						      		value="<?php echo $rows['Email']; ?>" required>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Sertifikat" class="col-sm-3 control-label">Sertifikat</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="Sertifikat" name="Sertifikat" placeholder="Sertifikat" 
						      		value="<?php echo $rows['Sertifikat']; ?>" required>
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="PT" class="col-sm-3 control-label">Tempat Lahir</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="TempatLahir" 
						      		name="TempatLahir" placeholder="Tempat Lahir" 
						      		value="<?php echo $rows['TempatLahir']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="TanggalLahir" class="col-sm-3 control-label">Tanggal Lahir</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control input-sm" id="TanggalLahir" 
						      		name="TanggalLahir" placeholder="Tanggal Lahir" 
						      		value="<?php echo date_format(date_create($rows['TanggalLahir']),'d-M-Y'); ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="dosenActive" class="col-sm-3 control-label">Aktif?</label>
						    	<div class="col-sm-9">
						      		<label class='custom-control custom-checkbox'><input type='checkbox' id="dosenActive" name="dosenActive" <?php if($rows['dosenActive']!==0){ echo 'checked="checked"';}?> class='custom-control-input'><span class='custom-control-indicator'></span></label>
						    	</div>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
						    	<label for="PT" class="col-sm-4 control-label">P.T.</label>
						    	<div class="col-sm-8">
						    		<input type="text" class="form-control input-sm" id="PT" name="PT" placeholder="Perguruan Tinggi" 
						      		value="<?php echo $rows['PT']; ?>" required>
						      		
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="AlamatPT" class="col-sm-4 control-label">Alamat P.T.</label>
						    	<div class="col-sm-8">
						    		<input type="text" class="form-control input-sm" id="AlamatPT" name="AlamatPT" placeholder="Alamat Perguruan Tinggi" 
						      		value="<?php echo $rows['AlamatPT']; ?>" required>
						      		
						    	</div>
						  	</div>
							<div class="form-group">
						    	<label for="Fakultas" class="col-sm-4 control-label">Fakultas</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="Fakultas" 
						      		name="Fakultas" placeholder="Fakultas" 
						      		value="<?php echo $rows['Fakultas']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Jurusan" class="col-sm-4 control-label">Jurusan</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="Jurusan" 
						      		name="Jurusan" placeholder="Jurusan" 
						      		value="<?php echo $rows['Jurusan']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Golongan" class="col-sm-4 control-label">Golongan</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="Golongan" 
						      		name="Golongan" placeholder="Golongan" 
						      		value="<?php echo $rows['Golongan']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="S1" class="col-sm-4 control-label">S1</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="S1" 
						      		name="S1" placeholder="Perguruan Tinggi" 
						      		value="<?php echo $rows['S1']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="S2" class="col-sm-4 control-label">S2</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="S2" 
						      		name="S2" placeholder="Perguruan Tinggi" 
						      		value="<?php echo $rows['S2']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="S3" class="col-sm-4 control-label">S3</label>
						    	<div class="col-sm-8">
						      		<input type="text" class="form-control input-sm" id="S3" 
						      		name="S3" placeholder="Perguruan Tinggi" 
						      		value="<?php echo $rows['S3']; ?>">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="Jabatan" class="col-sm-4 control-label">Jabatan</label>
						    	<div class="col-sm-8">
						      		<select class="form-control select2" style="width: 100%;" name="Jabatan" id="Jabatan" required>
						    			<option value=""></option>
					                	<?php foreach($jabatan as $jab) { ?>
					                  		<option value="<?php echo $jab['jabatan']; ?>"<?php if($rows['Jabatan'] == $jab['jabatan']) {echo " selected"; }?>><?php echo $jab['jabatan'];?></option>
					                  	<?php } ?>
					                </select>	
						    	</div>
						  	</div>
						</div>
	            	</div>
	            </form>
	            <?php } ?>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>


<!-- DIALOGUES/MODAL -->


<div class="modal fade" id="modalkehadiran" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add/Edit Nilai Kehadiran</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-error" id="success-alert1" style="display:none;">
		    <div id="errkehadiran" name="errkehadiran"><strong>Success! </strong></div>
		</div>
      	<input type="hidden" value="0" id="isedit" name="isedit">
      		<div class="form-group">
      			<label for="periodekehadiran" class="col-sm-3 control-label">Periode</label>
		    	<select class="form-control select2" style="width: 100%;" name="periodekehadiran" id="periodekehadiran">
                	<?php foreach($periodes as $period) { ?>
                  		<option value="<?php echo $period; ?>"><?php echo $period;?></option>
                  	<?php } ?>
                </select>
		  	</div>
		  	<div class="form-group">
		    	<label for="nhadir" class="col-sm-3 control-label">Kehadiran</label>
		    	<select class="form-control select2" style="width: 100%;" name="nhadir" id="nhadir">
                	<?php foreach($nilai as $nil) { ?>
                  		<option value="<?php echo $nil['nilai']; ?>"><?php echo $nil['nilai'];?></option>
                  	<?php } ?>
                </select>
		  	</div>	
		  	<div class="form-group">
		    	<label for="ntepat" class="col-sm-3 control-label">Ketepatan</label>
		    	<select class="form-control select2" style="width: 100%;" name="ntepat" id="ntepat">
                	<?php foreach($nilai as $nil) { ?>
                  		<option value="<?php echo $nil['nilai']; ?>"><?php echo $nil['nilai'];?></option>
                  	<?php } ?>
                </select>
		  	</div>	
		  	<div class="form-group">
		    	<label for="nsesuai" class="col-sm-3 control-label">Kesesuaian</label>
		    	<select class="form-control select2" style="width: 100%;" name="nsesuai" id="nsesuai">
                	<?php foreach($nilai as $nil) { ?>
                  		<option value="<?php echo $nil['nilai']; ?>"><?php echo $nil['nilai'];?></option>
                  	<?php } ?>
                </select>
		  	</div>	
		  	<div class="form-group">
		    	<label for="nlulus" class="col-sm-3 control-label">Kelulusan</label>
		    	<select class="form-control select2" style="width: 100%;" name="nlulus" id="nlulus">
                	<?php foreach($nilai as $nil) { ?>
                  		<option value="<?php echo $nil['nilai']; ?>"><?php echo $nil['nilai'];?></option>
                  	<?php } ?>
                </select>
		  	</div>	
		  	<div class="form-group">
		    	<label for="nquiz" class="col-sm-3 control-label">Quisioner</label>
		    	<select class="form-control select2" style="width: 100%;" name="nquiz" id="nquiz">
                	<?php foreach($nilai as $nil) { ?>
                  		<option value="<?php echo $nil['nilai']; ?>"><?php echo $nil['nilai'];?></option>
                  	<?php } ?>
                </select>
		  	</div>		  	
		  	<input type="hidden" name="rowidkehadiran" id="rowidkehadiran">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="delbut" onclick="showdelconfirm()" name="delbut">Delete</button>
        <button type="button" name="btncontinuehadir" id="btncontinuehadir" class="btn btn-info" onclick="addrow()">Continue</button>
        <button name="btnloadhadir" id="btnloadhadir" class="btn btn-info disabled" style="display:none;"><i class="fa fa-spinner fa-spin"></i>Continue</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- DELETE CONFIRMATION -->
<div class="modal fade modal-danger" id="modaldelete" role="dialog">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Confirmation</h4>
	      </div>
	      <div class="modal-body">
	      		<input type="hidden" name="rowid" id="rowid">
	      		<p>Are you sure to remove selected row?</p>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">NO!</button>
	        <button type="button" class="btn btn-danger" id="delconf" name="delconf" onclick="deleterow()">YES! Remove.</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
</div>


<!-- END OF DIALOGUES/MODAL -->
<input type="hidden" id="idxval" name="idxval">

<script type="text/javascript">
	var tblKehadiran;
	var buttonpressed;
	$(document).ready(function() {
		//var initialData = [new Data(), new Data()];
		$('#tblkehadiran tfoot th').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="'+title+'"  style="width:100%;" />' );
	    } );

	    tblKehadiran = $('#tblkehadiran').DataTable({
	    	"responsive": true,
	    	"paging": false,
	    	"dom": 'lrtip'
	    });

	    $('.select2').select2();
	    $("#TanggalLahir").datepicker({ 
	        format: 'dd-M-yyyy',
	        autoclose: true
	    });
	    

	    // Apply the search
	    tblKehadiran.columns().every( function () {
	        var that = this;
	 
	        $( 'input', this.footer() ).on( 'keyup change', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
	                    .draw();
	            }
	        } );
	    } );
	    $('#tblkehadiran tfoot tr').appendTo('#tblkehadiran thead');

	    $('#tblkehadiran tbody').on( 'mousedown', 'tr', function () {
		    $('#idxval').val(tblKehadiran.row( this ).index());
		} );

	    

	    $('#btnsubmit').click(function() {		    
	        $.confirm({
                title: 'Konfirmasi!',
                content: 'Anda yakin data yang dimasukkan sudah benar?!',
                autoClose: 'cancel|5000',
                buttons: {
                    confirm: function () {
                        $("#edit-form").submit();
                    },
                    cancel: function () {
                    },
                }
            });
            return false;
	    })


	    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
	        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	    } );
	    
	    $("#edit-form").submit(function(){
            var inp = $("#Nama").val();  
           if(jQuery.trim(inp).length > 0)
            {
            	
            	$('#btnsubmit').hide();
            	$('#btnloading').show();
				
				//tblKehadiran
				/*var tblkehadiran = new Array();    
				$('#tblkehadiran tr').each(function(row, tr){
				    tblkehadiran[row]={
				        "periodeAjar" : $(tr).find('td:eq(0)').text()
				        , "kehadiranNilai" :$(tr).find('td:eq(2)').text()
				    }
				}); 
				tblkehadiran.shift();	// first row is the table filter - so remove
				tblkehadiran.shift();  // second row is the table header - so remove
				tblkehadiran = JSON.stringify(tblkehadiran);*/

				var dataString = $("#edit-form").serializeArray();
				//dataString.push({name: 'tblkehadiran', value: tblkehadiran});

				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>dosen/savedosen/<?php echo $dosenID; ?>",
					data: dataString,
					success: function(data){
						//alert('DATA:'+data);
						var j = '';
					    var d = $.parseJSON(data);
					    //alert(d);
					    $.each(d, function(i, item) {
						    //alert(item.stt);
						    j += item.stt+'<br />';
						});
						
					    if($.isNumeric( d['stt'] )){
					        //alert('numeric');
					    	window.location.href = "<?php echo base_url(); ?>dosen/editdosen/"+d['stt'];
					    }else{
					    	$('#btnsubmit').show();
            				$('#btnloading').hide();
					    	if(j.includes('undefined')) {
					    		showalert(1,d['stt']);
					    	}else {
					    		showalert(1,j);					    	
					    	}
					    }
					},
					error: function(){
						$('#btnsubmit').show();
            			$('#btnloading').hide();
						showalert(1,'Error on save. Please try again later.');	
						//alert('Error on save. Please try again later.');
					}
				});
            } else {
                showalert(1,'Nama Dosen belum dimasukkan.');
            }

		 	return false;  //stop the actual form post !important!
			
		});
	} );

	function showalert(id,msg) {
		$.alert({
            title: 'Attention',
            content: msg,
        });
		
	}
	function addnew(tp) {
		var d = new Date();
		var datestring = d.getFullYear()+"-"+(d.getMonth()+1);
		$('#periodekehadiran').val(datestring).trigger('change');
		$('#nhadir').val(1).trigger('change');
		$('#ntepat').val(1).trigger('change');
		$('#nsesuai').val(1).trigger('change');
		$('#nlulus').val(1).trigger('change');
		$('#nquiz').val(1).trigger('change');
		$('#delbut').hide();
		$('#modalkehadiran').modal('show');
		
	}
	function additem(partNo,Description,Unit, onhandqty) {
		var itmc= table.rows().count();
		itmc++;
		//alert(itmc);
		$('#partnoedit').val(partNo);
		$('#itemnameedit').val(Description);
		$('#unitedit').val(Unit);
		$('#qtyedit').val(1);
		$('#onhandqty').val(onhandqty);
		$('#remarkedit').val('');
		$('#delbut').hide();
		$('#rowid').val(itmc);
		$('#modalitemedit').modal('show');
	}
	function edititem(periode) {
		
		var s = $('#idxval').val();
		var temp = tblKehadiran.row(s).data();
		$('#periodekehadiran').val(periode).trigger('change');
		$('#nhadir').val(temp[1]).trigger('change');
		$('#ntepat').val(temp[2]).trigger('change');
		$('#nsesuai').val(temp[3]).trigger('change');
		$('#nlulus').val(temp[4]).trigger('change');
		$('#nquiz').val(temp[5]).trigger('change');

		$('#delbut').show();
		$('#rowid').val(rowid);
		$('#modalkehadiran').modal('show');
	}

	function showdelconfirm() {
		$('#modaldelete').modal('show');
	}
	function deleterow() {
		var r = $('#idxval').val(); 
		var p = $('#periodekehadiran').val();
		var dataString = $('#periodekehadiran').serializeArray();
		dataString.push({name: 'dosenID', value: <?php echo $rows['dosenID']; ?>});
		dataString.push({name: 'periode', value: p});
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>dosen/deletenilai",
			data: dataString,
			success: function(data){
				//alert('DATA:'+data);
				var j = '';
			    var d = $.parseJSON(data);
			    //alert('d:'+d);
			    $.each(d, function(i, item) {
				    //alert(item.stt);
				    j += item.stt+'<br />';
				});
				
			    if($.isNumeric( d['stt'] )){
			        //alert('numeric');
			        var temp = tblKehadiran.row(r).remove().draw();
					$('#modaldelete').modal('hide');
					$('#modalkehadiran').modal('hide');
			    	
			    }else{
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    	}else {
			    		showalert(1,j);					    	
			    	}
			    }
			},
			error: function(){
				showalert(1,'Error on save. Please try again later.');	
				//alert('Error on save. Please try again later.');
			}
		});

		
	}

	function addrow() {
		//Check delete visibility, if visible then edit else add new
		var v = $('#delbut').is(":visible");
		$('#btncontinuehadir').hide();
        $('#btnloadhadir').show();

        var p = $('#periodekehadiran').val();
		var n = $('#nhadir').val();
		var nt = $('#ntepat').val();
		var ns = $('#nsesuai').val();
		var nl = $('#nlulus').val();
		var nq = $('#nquiz').val();

		var dataString = $('#periodekehadiran').serializeArray();
		dataString.push({name: 'dosenID', value: <?php echo $rows['dosenID']; ?>});
		dataString.push({name: 'periode', value: p});
		dataString.push({name: 'hadir', value: n});
		dataString.push({name: 'tepat', value: nt});
		dataString.push({name: 'sesuai', value: ns});
		dataString.push({name: 'lulus', value: nl});
		dataString.push({name: 'quiz', value: nq});
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>dosen/savenilai",
			data: dataString,
			success: function(data){
				//alert('DATA:'+data);
				var j = '';
			    var d = $.parseJSON(data);
			    //alert('d:'+d);
			    $.each(d, function(i, item) {
				    //alert(item.stt);
				    j += item.stt+'<br />';
				});
				
			    if($.isNumeric( d['stt'] )){
			        //alert('numeric');
			        if(v==false){
			        	//Insert
			    		$('#tblkehadiran').dataTable().fnAddData( [
				        '<a href="#" onclick="edititem(\''+p+'\')">'+p+'</a>', n] );
				    } else {
				    	//Update
				    	var r =$('#idxval').val();
						var temp =tblKehadiran.row(r).data();
						temp[1] = $('#nhadir').val();
						temp[2] = $('#ntepat').val();
						temp[3] = $('#nsesuai').val();
						temp[4] = $('#nlulus').val();
						temp[5] = $('#nquiz').val();
						$('#tblkehadiran').dataTable().fnUpdate(temp,r,undefined,true);	
				    }
			    	$('#btncontinuehadir').show();
    				$('#btnloadhadir').hide();
					$('#modalkehadiran').modal('hide');
			    }else{
			    	$('#btncontinuehadir').show();
    				$('#btnloadhadir').hide();
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    	}else {
			    		showalert(1,j);					    	
			    	}
			    }
			},
			error: function(){
				$('#btncontinuehadir').show();
    			$('#btnloadhadir').hide();
				showalert(1,'Error on save. Please try again later.');	
				//alert('Error on save. Please try again later.');
			}
		});
        	
	}
</script>