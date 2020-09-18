<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluasi
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
				<table id="tbldata" class="table table-bordered table-striped table-hover" style="width:100% !important;">
	                <thead>
				          <tr>
				          	<th>Edit</th>
				          	<th>Tanggal</th>
				            <th>Parameter</th>
				            <th>Kriteria</th>
				            <th>T. Industri</th>
				            <th>T. Sipil</th>				            
				            <th>T. Informatika</th>
				            <th>T. Elektro</th>
				            <th>T. Arsitektur</th>
				            <th>T. Mesin</th>
				            <th>T. PWK</th>
			            </tr>
				  		</thead>
				        <tfoot>
				            <tr>
				            	<th>Edit</th>
					          	<th>Tanggal</th>
					            <th>Parameter</th>
					            <th>Kriteria</th>
					            <th>T. Industri</th>
					            <th>T. Sipil</th>				            
					            <th>T. Informatika</th>
					            <th>T. Elektro</th>
					            <th>T. Arsitektur</th>
					            <th>T. Mesin</th>
					            <th>T. PWK</th>
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

<div class="modal fade" id="modaldata" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add/Edit Evaluasi</h4>
      </div>
      <div class="modal-body form-horizontal">
      	<div class="alert alert-error" id="success-alert1" style="display:none;">
		    <div id="errmsg1" name="errmsg1"><strong>Success! </strong></div>
		</div>
      	<input type="hidden" value="0" id="isedit" name="isedit">
      	<form class="form-horizontal" id="edit-form" method="post" enctype="multipart/form-data">
      		<div class="form-group">
		    	<label for="tanggal" class="col-sm-3 control-label">Tanggal</label>
		    	<div class="col-sm-4">
		    		<div class="input-group date">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
						</div>
			    		<input type="text" class="form-control input-sm" id="tanggal" 
	                  name="tanggal" value="<?php echo date('d-M-Y'); ?>" required>
	                </div>
		      	</div>
		      	
		  	</div>
		  		  		  	
		  	<div class="form-group">
			  	<label for="paramName" class="col-sm-3 control-label">Parameter</label>
			  	<div class="col-sm-8">
		    		<input type="text" class="form-control input-sm" id="paramName" name="paramName" 
			      		value="">	    		
	      		</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="kriteria" class="col-sm-3 control-label">Kriteria</label>
			  	<div class="col-sm-8">
		    		<input type="text" class="form-control input-sm" id="kriteria" name="kriteria" 
			      		value="">	    		
	      		</div>	      		
		  	</div>	  
		  	<div class="form-group">
			  	<label for="tIndustri" class="col-sm-3 control-label">T. Industri (%)</label>
			  	<div class="col-sm-4">
			      	<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tIndustri" name="tIndustri">	    		
	      		</div>	      	
		  	</div>	
		  	<div class="form-group">
			  	<label for="tSipil" class="col-sm-3 control-label">T. Sipil (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tSipil" name="tSipil">    		
	      		</div>	      		
		  	</div>	
		  	<div class="form-group">
			  	<label for="tInformatika" class="col-sm-3 control-label">T. Informatika (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tInformatika" name="tInformatika"> 	    		
	      		</div>	      		
		  	</div>	
		  	<div class="form-group">
			  	<label for="tElektro" class="col-sm-3 control-label">T. Elektro (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tElektro" name="tElektro"> 	    		
	      		</div>	      		
		  	</div>	
		  	<div class="form-group">
			  	<label for="tArsitektur" class="col-sm-3 control-label">T. Arsitektur (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tArsitektur" name="tArsitektur">    		
	      		</div>	      		
		  	</div>	
		  	<div class="form-group">
			  	<label for="tMesin" class="col-sm-3 control-label">T. Mesin (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tMesin" name="tMesin">	    		
	      		</div>	      		
		  	</div>	
		  	<div class="form-group">
			  	<label for="tPWK" class="col-sm-3 control-label">T. PWK (%)</label>
			  	<div class="col-sm-4">
		    		<input type="number" min="0" step="1" max="100" data-number-to-fixed="2" data-number-stepfactor="100" 
		    		class="form-control input-sm" id="tPWK" name="tPWK">    		
	      		</div>	      		
		  	</div>	 
		  	<input type="hidden" name="capaiID" id="capaiID">
		 </form>
		  	<input type="hidden" name="rowid" id="rowid">
		  	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger" id="delbut" onclick="showdelconfirm()" name="delbut">Hapus</button>
        <button type="button" name="btncontinue" id="btncontinue" class="btn btn-info">Simpan</button>
        <button name="btnload" id="btnload" class="btn btn-info disabled" style="display:none;"><i class="fa fa-spinner fa-spin"></i>Simpan</button>
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
	      		<p>Hapus Pencapaian yang dipilih?</p>
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


    $('#tbldata tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%;" />' );
      } );

    $('.select2').select2();
    reloaddt();

    $("#period").on("change", function () {
      	//$('#tbldata').DataTable().ajax.reload();
      	reloaddt();
    })

    //$('#tbldata tfoot tr').appendTo('#tbldata thead');
    $('#tbldata tbody').on( 'mousedown', 'tr', function () {
	    $('#idxval').val(table.row( this ).index());
	} );

	$("#tanggal").datepicker({ 
        format: 'dd-M-yyyy',
        autoclose: true
    });

    $('#btncontinue').click(function() {		    
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
	    $('#tbldata').DataTable().destroy();

	    table = $('#tbldata').DataTable({
	      "pageLength": 10,
	       "processing":true,  
	       "serverSide":true, 
	       "responsive": true,
	       "order":[],
	       dom: 'Bfrtip',
	       "bInfo": false,
	       "ajax":{  
	            url:"<?php echo base_url() . 'pencapaian/fetch_capai/'; ?>",
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
	      }],
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
		$("#tanggal").datepicker("setDate",new Date());
		$('#paramName').val('');
		$('#kriteria').val('');
		$('#tIndustri').val('0');
		$('#tSipil').val('0');
		$('#tInformatika').val('0');
		$('#tElektro').val('0');
		$('#tArsitektur').val('0');
		$('#tMesin').val('0');
		$('#tPWK').val('0');
		$('#capaiID').val(0);
		$('#delbut').hide();
		$('#modaldata').modal('show');
		
	}
	function edititem(capaiID) {
		var s = $('#idxval').val();
		var temp = table.row(s).data();
		$('#tanggal').val(temp[1]);
		$('#capaiID').val(capaiID);
		$('#paramName').val(temp[2]);
		$('#kriteria').val(temp[3]);
		$('#tIndustri').val(temp[4]);
		$('#tSipil').val(temp[5]);
		$('#tInformatika').val(temp[6]);
		$('#tElektro').val(temp[7]);
		$('#tArsitektur').val(temp[8]);
		$('#tMesin').val(temp[9]);
		$('#tPWK').val(temp[10]);

		$('#delbut').show();
		$('#modaldata').modal('show');
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
			url: "<?php echo base_url(); ?>pencapaian/deletecapai",
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
					$('#modaldata').modal('hide');	
			    }else{
			    	$('#modaldelete').modal('hide');
					$('#modaldata').modal('hide');	
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    		
			    	}else {
			    		showalert(1,'j:'+j);					    	
			    	}
			    }
			},
			error: function(){
				$('#modaldelete').modal('hide');
				$('#modaldata').modal('hide');	
				showalert(1,'Error on save. Please try again later.');	
				//alert('Error on save. Please try again later.');
			}
		});
	}
	function addrow() {
		var v = $('#delbut').is(":visible");
		$('#btncontinue').hide();
        $('#btnload').show();

        var form = $('#edit-form');
        var formdata = false;
	    if (window.FormData){
	        formdata = new FormData(form[0]);
	    }

		//var dataString = $('#edit-form').serializeArray();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pencapaian/savecapai",
			data: formdata ? formdata : form.serialize(),
			cache       : false,
	        contentType : false,
	        processData : false,
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
			    	$('#btncontinue').show();
    				$('#btnload').hide();
					$('#modaldata').modal('hide');

					if($('#period').val() == null) {
						location.href = '<?php echo base_url(); ?>pencapaian/';
					} else {
						 reloaddt();
					}
			       
			    	
			    }else{
			    	$('#btncontinue').show();
    				$('#btnload').hide();
			    	if(j.includes('undefined')) {
			    		showalert(1,d['stt']);
			    		
			    	}else {
			    		showalert(1,'j:'+j);					    	
			    	}
			    }
			},
			error: function(){
				$('#btncontinue').show();
    			$('#btnload').hide();
				showalert(1,'Error on save. Please try again later.');	
				//alert('Error on save. Please try again later.');
			}
		});
	}
</script>
