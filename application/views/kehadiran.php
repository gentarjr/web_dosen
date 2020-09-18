<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kehadiran
        <small>data</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>-->
    </section>
<?php $detailcount=1; ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12" style="padding-left:5px; padding-right:5px;">         

          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>Pilih Periode : </label>
                  <select class="form-control select2" style="width: 110px;" name="period" id="period">
                    <?php foreach($periods as $period) { ?>
                        <option value="<?php echo str_replace('-', '', $period['Period']); ?>"><?php echo $period['Period'];?></option>
                      <?php } ?>
                  </select>                 
              </div>
              <div class="form-group">
                <label>Pilih Jurusan : </label>
                  <select class="form-control select2" style="width: 300px;" name="jurusanID" id="jurusanID">
                    <?php foreach($jurusan as $jur) { ?>
                        <option value="<?php echo str_replace('-', '', $jur['jurusanID']); ?>"><?php echo $jur['jurusanNama'];?></option>
                      <?php } ?>
                  </select>
                  <a onclick="reloaddt()" class="btn btn-xs" id="reloadsre"><i class="fa fa-fw fa-refresh"></i>Refresh</a>
                  <a href="#" class="btn btn-xs" onclick="addnew()"><i class="fa fa-fw fa-plus"></i>Tambah Baru</a>                  
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
				<table id="tblhadir" class="table table-bordered table-striped table-hover" style="width:100% !important;">
	                <thead>
				          <tr>
				          	<th>Edit</th>
				            <th>dosenID</th>
				            <th>Dosen</th>
				            <th>Tanggal</th>
				            <th>JA</th>
				            <th>Status</th>
				            <th>MataID</th>
				            <th>Mata Kuliah</th>
				            <th>SKS</th>
				            <th>SMTR</th>
				            <th>KLS</th>
				            <th>JadwalID</th>
				            <th>Jadwal</th>
				            <th>Minggu Ke?</th>
				            <th>Wajib</th>
				            <th>Hadir</th>
				            <th>%</th>
				            <th>Ket.</th>
			            </tr>
				  		</thead>
				        <tfoot>
				            <tr>
				            	<th>Edit</th>
					            <th>dosenID</th>
					            <th>Dosen</th>
					            <th>Tanggal</th>
					            <th>JA</th>
					            <th>Status</th>
					            <th>MataID</th>
					            <th>Mata Kuliah</th>
					            <th>SKS</th>
					            <th>SMTR</th>
					            <th>KLS</th>
					            <th>JadwalID</th>
					            <th>Jadwal</th>
					            <th>Minggu Ke?</th>
					            <th>Wajib</th>
					            <th>Hadir</th>
					            <th>%</th>
					            <th>Ket.</th>
				            </tr>
				        </tfoot>
	              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<div class="modal fade" id="modalhadir" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add/Edit Kehadiran</h4>
      </div>
      <div class="modal-body form-horizontal">
      	<div class="alert alert-error" id="success-alert1" style="display:none;">
		    <div id="errmsg1" name="errmsg1"><strong>Success! </strong></div>
		</div>
      	<input type="hidden" value="0" id="isedit" name="isedit">
      	<form class="form-horizontal" id="edit-form" method="post" enctype="multipart/form-data">
      		<div class="form-group">
		    	<label for="tanggaledits" class="col-sm-3 control-label">Tanggal</label>
		    	<div class="col-sm-4">
		    		<div class="input-group date">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
			    		<input type="text" class="form-control input-sm" id="tanggaledits" 
	                  name="tanggaledits" value="<?php echo date('d-M-Y'); ?>" required>
	                </div>
		      	</div>
		      	<label style="display:none;" for="statusedit" class="col-sm-1 control-label">Status</label>
		      	<div style="display:none;" class="col-sm-3">
			      	
			    	<input type="text" class="form-control input-sm" id="statusedit" name="statusedit" 
			      		value="">
		      	</div>
		  	</div>
		 	
		 	<div class="form-group">
			  	<label for="dosenedit" class="col-sm-3 control-label">Dosen</label>
			  	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="dosenedit" id="dosenedit">
	                	<?php foreach($dosen as $dos) { ?>
	                  		<option value="<?php echo $dos['dosenID']; ?>"><?php echo $dos['NamaDosen'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	      		
		  	</div>

		  	<div class="form-group">
			  	<label for="mataedit" class="col-sm-3 control-label">Mata Kuliah</label>
			  	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="mataedit" id="mataedit">
	                	<?php foreach($matakuliah as $mata) { ?>
	                  		<option value="<?php echo $mata['mataID']; ?>"><?php echo $mata['mataKuliah'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="sksedit" class="col-sm-3 control-label">SKS</label>
			  	<div class="col-sm-2">
		    		<input type="number" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="sksedit" name="sksedit">		    		
	      		</div>
	      		<label for="semesteredit" class="col-sm-3 control-label">Semester</label>
			  	<div class="col-sm-3">
		    		<select class="form-control select2" style="width: 100%;" name="semesteredit" id="semesteredit">
	                	<?php foreach($semester as $smtr) { ?>
	                  		<option value="<?php echo $smtr['smtr']; ?>"><?php echo $smtr['smtr'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>
		  	</div>

		  	<div class="form-group">
			  	<label for="kelasedit" class="col-sm-3 control-label">Kelas</label>
			  	<div class="col-sm-2">
		    		<select class="form-control select2" style="width: 100%;" name="kelasedit" id="kelasedit">
	                	<?php foreach($kelas as $kls) { ?>
	                  		<option value="<?php echo $kls['kelas']; ?>"><?php echo $kls['kelas'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	   
	      		<label for="mingguedit" class="col-sm-3 control-label">Minggu ke</label>
			  	<div class="col-sm-3">
		    		<select class="form-control select2" style="width: 100%;" name="mingguedit" id="mingguedit">
	                	<?php foreach($hadir as $had) { ?>
	                  		<option value="<?php echo $had['hadir']; ?>"><?php echo $had['hadir'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>  		
		  	</div>
		  	
		  	<div class="form-group">
			  		
	      		<label for="jadwaledit" class="col-sm-3 control-label">Jadwal</label>
			  	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="jadwaledit" id="jadwaledit">
	                	<?php foreach($jadwal as $jad) { ?>
	                  		<option value="<?php echo $jad['jadwalID']; ?>"><?php echo $jad['jadwalNama'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>       		
		  	</div>
		  	<div class="form-group">
			  	<label for="wajibedit" class="col-sm-3 control-label">Wajib</label>
			  	<div class="col-sm-2">
		    		<input type="number" min="2" step="1" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="wajibedit" name="wajibedit">		    		
	      		</div>
	      		<label for="hadiredit" class="col-sm-3 control-label">Hadir</label>
			  	<div class="col-sm-2">
		    		<input type="number" min="2" step="1" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="hadiredit" name="hadiredit">		    		
	      		</div>
		  	</div>

		  	<div class="form-group">
		    	<label for="keteranganedit" class="col-sm-3 control-label">Keterangan</label>
		    	<div class="col-sm-8">
		    		<textarea id="keteranganedit" name="keteranganedit" class="form-control input-sm"></textarea>
		    	</div>
		  	</div>	
		  	<input type="hidden" name="hadirID" id="hadirID">
		 </form>
		  	<input type="hidden" name="rowid" id="rowid">
		  	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger" id="delbut" onclick="showdelconfirm()" name="delbut">Hapus</button>
        <button type="button" name="btncontinuehadir" id="btncontinuehadir" class="btn btn-info">Simpan</button>
        <button name="btnloadhadir" id="btnloadhadir" class="btn btn-info disabled" style="display:none;"><i class="fa fa-spinner fa-spin"></i>Simpan</button>
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
	        <h4 class="modal-title">Konfirmasi</h4>
	      </div>
	      <div class="modal-body">
	      		<input type="hidden" name="rowid" id="rowid">
	      		<p>Hapus data yang dipilih?</p>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tidak!</button>
	        <button type="button" class="btn btn-danger" id="delconf" name="delconf" onclick="deleterow()">YA! Hapus.</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
</div>

<input type="hidden" id="idxval" name="idxval">
<!-- page script -->
<script type="text/javascript">
  var table;
  $(function () {   

    $('#tblhadir tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%;" />' );
      } );

    //$('.select2').select2();
    $('.select2').select2({
		templateResult: formatDesign
	});

    reloaddt();

    $("#period").on("change", function () {
      	reloaddt();
    })
    $("#jurusanID").on("change", function () {
      	reloaddt();
    })

    //$('#tblhadir tfoot tr').appendTo('#tblhadir thead');
    $('#tblhadir tbody').on( 'mousedown', 'tr', function () {
	    $('#idxval').val(table.row( this ).index());
	} );

	$("#tanggaledits").datepicker({ 
        format: 'dd-M-yyyy',
        autoclose: true
    });

    $('#btncontinuehadir').click(function() {		    
        $.confirm({
            title: 'Konfirmasi!',
            content: 'Anda yakin data yang dimasukkan sudah benar?!',
            autoClose: 'cancel|5000',
            buttons: {
                confirm: function () {
                    addrow();
                },
                cancel: function () {
                },
            }
        });
        return false;
    })


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
	function reloaddt() {
	    //$('#sretable').DataTable().ajax.reload(null, false).draw();
	    $('#tblhadir').DataTable().destroy();

	    table = $('#tblhadir').DataTable({
	      "pageLength": 10,
	       "processing":true,  
	       "serverSide":true, 
	       "responsive": true,
	       "order":[],
	       dom: 'Bfrtip',
	       "bInfo": false,
	       "ajax":{  
	            url:"<?php echo base_url() . 'kehadiran/fetch_hadir/'; ?>",
	            type:"POST",
	            "data": {
	                "period": $('#period').val(),
	                "jurusanID": $('#jurusanID').val()
	            }
	       }, 
	       "columnDefs": [ {
	          "targets": 0,
	          "data": null,
	          "render": function ( data, type, row, meta ) {
	            return '<button type="button" class="btn btn-primary" onclick="edititem('+data[0]+')">Edit</button>';
	          }
	      },
	      { "visible": false, "targets": 1 },
	      { "visible": false, "targets": 5 },
	      { "visible": false, "targets": 6 },
	      { "visible": false, "targets": 11 } ],
	       initComplete: function() {
	        var api = this.api();
	        // Apply the search
	        api.columns().every(function() {
	          var that = this;
	          $('input', this.footer()).on('keyup change', function() {
	            if (that.search() !== this.value) {
	              that
	                .search(this.value)
	                .draw();
	              }
	            });
	          });
	        }
	    });
  }

  	function addnew() {

		//$("#tanggaledit").datepicker().datepicker("setDate", new Date());
		$("#tanggaledits").datepicker("setDate",new Date());
		$('#statusedit').val('');
		$('#mataedit').val($('#mataedit option:first-child').val()).trigger('change');
		$('#sksedit').val(3);
		$('#semesteredit').val($('#semesteredit option:first-child').val()).trigger('change');
		$('#kelasedit').val($('#kelasedit option:first-child').val()).trigger('change');
		$('#mingguedit').val($('#mingguedit option:first-child').val()).trigger('change');
		$('#jadwaledit').val($('#jadwaledit option:first-child').val()).trigger('change');
		$('#wajibedit').val(2);
		$('#hadiredit').val(0);
		$('#keteranganedit').val('');
		$('#dosenedit').val($('#dosenedit option:first-child').val()).trigger('change');
		$('#hadirID').val(0);
		$('#delbut').hide();
		$('#modalhadir').modal('show');
		
	}
	function edititem(hadirID) {
		
		var s = $('#idxval').val();
		var temp = table.row(s).data();
		$('#tanggaledits').val(temp[3]);
		$('#statusedit').val(temp[5]);
		$('#mataedit').val(temp[6]).trigger('change');
		$('#sksedit').val(temp[8]);
		$('#semesteredit').val(temp[9]).trigger('change');
		$('#kelasedit').val(temp[10]).trigger('change');
		$('#mingguedit').val(temp[13]).trigger('change');
		$('#jadwaledit').val(temp[11]).trigger('change');
		$('#dosenedit').val(temp[1]).trigger('change');
		$('#wajibedit').val(temp[14]);
		$('#hadiredit').val(temp[15]);
		$('#keteranganedit').val(temp[17]);

		$('#hadirID').val(hadirID);
		$('#delbut').show();
		$('#modalhadir').modal('show');
	}
  	function showalert(id,msg) {
		$.alert({
		    title: 'Attention',
		    content: msg,
		});

	}
	function showdelconfirm() {
		$('#modaldelete').modal('show');
	}

	function deleterow() {
		

		var dataString = $('#edit-form').serializeArray();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>kehadiran/deletehadir",
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
				
				//alert(d['stt']);
			    if($.isNumeric( d['stt'] )){
			    	var r = $('#idxval').val(); 
					var temp = table.row(r).remove().draw();
					$('#modaldelete').modal('hide');
					$('#modalhadir').modal('hide');	
			    }else{
			    	$('#modaldelete').modal('hide');
					$('#modalhadir').modal('hide');	
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    		
			    	}else {
			    		showalert(1,'j:'+j);					    	
			    	}
			    }
			},
			error: function(){
				$('#modaldelete').modal('hide');
				$('#modalhadir').modal('hide');	
				showalert(1,'Error on save. Please try again later.');	
				//alert('Error on save. Please try again later.');
			}
		});
	}
	function addrow() {
		var v = $('#delbut').is(":visible");
		$('#btncontinuehadir').hide();
        $('#btnloadhadir').show();

        var jurid = $('#jurusanID').val();
		var dataString = $('#edit-form').serializeArray();
		dataString.push({name: 'jurusanID', value: jurid});
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>kehadiran/savehadir",
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
				
				//alert(d['stt']);
			    if($.isNumeric( d['stt'] )){
			    	$('#btncontinuehadir').show();
    				$('#btnloadhadir').hide();
					$('#modalhadir').modal('hide');

					if($('#period').val() == null) {
						location.href = '<?php echo base_url(); ?>kehadiran/';
					} else {
						 reloaddt();
						 //$('#tblhadir').DataTable().ajax.reload();
					}
			       
			    	
			    }else{
			    	$('#btncontinuehadir').show();
    				$('#btnloadhadir').hide();
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    		
			    	}else {
			    		showalert(1,'j:'+j);					    	
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
