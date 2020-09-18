<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nilai
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
				            <th>Jurusan</th>
				            <th>Mata Kuliah</th>
				            <th>Nilai</th>
				            <th>Aktif</th>
				            <th>isActive</th>
				            <th>mataID</th>
				            <th>jurusanID</th>
			            </tr>
				  		</thead>
				        <tfoot>
				            <tr>
				            	<th>Edit</th>
					            <th>dosenID</th>
					            <th>Dosen</th>
					            <th>Tanggal</th>
					            <th>Jurusan</th>
					            <th>Mata Kuliah</th>
					            <th>Nilai</th>
					            <th>Aktif</th>
					            <th>isActive</th>
					            <th>mataID</th>
					            <th>jurusanID</th>
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
        <h4 class="modal-title">Add/Edit Nilai</h4>
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
		  	</div>
		 	

		  	<div class="form-group">
			  	<label for="jurusanID" class="col-sm-3 control-label">Jurusan</label>
			  	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="jurusanID" id="jurusanID">
	                	<?php foreach($jurusan as $jur) { ?>
	                  		<option value="<?php echo $jur['jurusanID']; ?>"><?php echo $jur['jurusanNama'];?></option>
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
			  	<label for="jenisnilai" class="col-sm-3 control-label">Jenis Nilai</label>
			  	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="jenisnilai" id="jenisnilai">
	                	<?php foreach($jenis as $jen) { ?>
	                  		<option value="<?php echo $jen['jenis']; ?>"><?php echo $jen['jenis'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	    
	      		
		  	</div>
		  	<div class="form-group">
		  		<div class="form-group">
		    	<label for="isAktif" class="col-sm-3 control-label">Aktif?</label>
		    	<div class="col-sm-9">
		      		<label class='custom-control custom-checkbox'><input type='checkbox' id="isAktif" name="isAktif" class='custom-control-input'><span class='custom-control-indicator'></span></label>
		    	</div>
		  	</div>	
		  	</div>
		  	<input type="hidden" name="nilaiID" id="nilaiID">
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

    $('.select2').select2();
    reloaddt();

    $("#period").on("change", function () {
      	//$('#tblhadir').DataTable().ajax.reload();
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
	            url:"<?php echo base_url() . 'nilai/fetch_nilai/'; ?>",
	            type:"POST",
	            "data": {
	                "period": $('#period').val()
	            }
	       }, 
	       "columnDefs": [ {
	          "targets": 0,
	          "data": null,
	          "render": function ( data, type, row, meta ) {
	            return '<button type="button" class="btn btn-primary" onclick="edititem('+data[0]+')">Edit</button>';
	          }
	      },{ "visible": false, "targets": 8 },
	      { "visible": false, "targets": 9 },
	      { "visible": false, "targets": 10 },
	      { "visible": false, "targets": 1 }],
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
		$('#mataedit').val($('#mataedit option:first-child').val()).trigger('change');
		$('#jurusanID').val($('#jurusanID option:first-child').val()).trigger('change');
		$('#jenisnilai').val($('#jenisnilai option:first-child').val()).trigger('change');
		$('#isAktif').prop('checked', true);
		$('#nilaiID').val(0);
		$('#delbut').hide();
		$('#modalhadir').modal('show');
		
	}
	function edititem(nilaiID) {
		
		var s = $('#idxval').val();
		var temp = table.row(s).data();
		$('#tanggaledits').val(temp[3]);
		$('#jurusanID').val(temp[10]).trigger('change');
		$('#mataedit').val(temp[9]).trigger('change');
		$('#jenisnilai').val(temp[6]).trigger('change');
		if(temp[8] == 0) {
			$('#isAktif').prop('checked', false);
		} else {
			$('#isAktif').prop('checked', true);
		}

		$('#nilaiID').val(nilaiID);
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
			url: "<?php echo base_url(); ?>nilai/deletenilai",
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

        var a = 0;
        if ($('#isAktif').is(":checked")) {
			a = 1;
		}
		var dataString = $('#edit-form').serializeArray();
		dataString.push({name: 'isAktif', value: a});
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>nilai/savenilai",
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
						location.href = '<?php echo base_url(); ?>nilai/';
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
