<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
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
				            <th>Login</th>
				            <th>Nama Lengkap</th>
				            <th>Tipe</th>					            
				            <th>Dosen</th>				            
				            <th>Aktif?</th>				            
				            <th>Login Terakhir</th>
				            <th>userType</th>
				            <th>dosenID</th>
				            <th>active</th>
			            </tr>
				  		</thead>
				        <tfoot>
				            <tr>
				            	<th>Edit</th>
					            <th>Login</th>
					            <th>Nama Lengkap</th>
					            <th>Tipe</th>					            
					            <th>Dosen</th>				            
					            <th>Aktif?</th>				            
					            <th>Login Terakhir</th>
					            <th>userType</th>
					            <th>dosenID</th>
					            <th>active</th>
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
        <h4 class="modal-title">Add/Edit User</h4>
      </div>
      <div class="modal-body form-horizontal">
      	<div class="alert alert-error" id="success-alert1" style="display:none;">
		    <div id="errmsg1" name="errmsg1"><strong>Success! </strong></div>
		</div>
      	<input type="hidden" value="0" id="isedit" name="isedit">
      	<form class="form-horizontal" id="edit-form" method="post" enctype="multipart/form-data">
      		<div class="form-group">
			  	<label for="loginname" class="col-sm-3 control-label">Login</label>
		      	<div class="col-sm-8">
			      	
			    	<input type="text" class="form-control input-sm" id="loginname" name="loginname" 
			      		value="">
		      	</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="pass1" class="col-sm-3 control-label">Password</label>
		      	<div class="col-sm-8">
			      	
			    	<input type="password" class="form-control input-sm" id="pass1" name="pass1" 
			      		value="">
		      	</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="pass2" class="col-sm-3 control-label">Ulangi Password</label>
		      	<div class="col-sm-8">
			      	
			    	<input type="password" class="form-control input-sm" id="pass2" name="pass2" 
			      		value="">
		      	</div>	      		
		  	</div>		
		  		  		  	
		  	<div class="form-group">
			  	<label for="fullname" class="col-sm-3 control-label">Nama Lengkap</label>
		      	<div class="col-sm-8">
			      	
			    	<input type="text" class="form-control input-sm" id="fullname" name="fullname" 
			      		value="">
		      	</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="usertype" class="col-sm-3 control-label">Tipe</label>
		      	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="usertype" id="usertype">
	                	<?php foreach($tipe as $tip) { ?>
	                  		<option value="<?php echo $tip['tipe']; ?>"><?php echo $tip['tipenama'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	      		
		  	</div>
		  	<div class="form-group" id="dsid" name="dsid">
			  	<label for="dosenid" class="col-sm-3 control-label" name="lbldosen" id="lbldosen">Dosen</label>
		      	<div class="col-sm-8">
		    		<select class="form-control select2" style="width: 100%;" name="dosenid" id="dosenid">
	                	<?php foreach($dosen as $dos) { ?>
	                  		<option value="<?php echo $dos['dosenID']; ?>"><?php echo $dos['NamaDosen'];?></option>
	                  	<?php } ?>
	                </select>		    		
	      		</div>	      		
		  	</div>
		  	<div class="form-group">
			  	<label for="useractive" class="col-sm-3 control-label">Aktif?</label>
		      	<div class="col-sm-9">
		      		<label class='custom-control custom-checkbox'><input type='checkbox' id="useractive" name="useractive" class='custom-control-input'><span class='custom-control-indicator'></span></label>
		    	</div>	      		
		  	</div>
		  	<input type="hidden" name="isactive" id="isactive">
		  	<input type="hidden" name="userid" id="userid">
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
	      		<p>Hapus User yang dipilih?</p>
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

    //$('.select2').select2();
    $('.select2').select2({
		templateResult: formatDesign
	});

    reloaddt();

    //$('#tbldata tfoot tr').appendTo('#tbldata thead');
    $('#tbldata tbody').on( 'mousedown', 'tr', function () {
	    $('#idxval').val(table.row( this ).index());
	} );

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

    $('#usertype').change(function() {	
    	var cnt = $("#usertype").val();
    	$('#dsid').show();
    	$('#lbldosen').html('Dosen');
    	if(cnt == 2 || cnt == 6) {
    		$('#dosenid').val($('#dosenid option:first-child').val()).trigger('change');
    		$('#dsid').hide();
    	} else if(cnt== 5) {
    		$('#lbldosen').html('Kaprodi');
    	} else if(cnt== 4) {
    		$('#lbldosen').html('Dekan');
    	}
    	
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
	            url:"<?php echo base_url() . 'user/fetch_user/'; ?>",
	            type:"POST"
	       }, 
	       "columnDefs": [ {
	          "targets": 0,
	          "data": null,
	          "render": function ( data, type, row, meta ) {
	            return '<button type="button" class="btn btn-primary" onclick="edititem('+data[0]+')">Edit</button>';
	          }
	      },
	      { "visible": false, "targets": 7 },
	      { "visible": false, "targets": 8 },
	      { "visible": false, "targets": 9 }],
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

		$('#loginname').val('');
		$('#pass2').val('');
		$('#pass1').val('');
		$('#usertype').val($('#usertype option:first-child').val()).trigger('change');
		$('#fullname').val('');
		$('#dosenid').val($('#dosenid option:first-child').val()).trigger('change');
		$('#userid').val(0);
		$('#delbut').hide();
		$('#useractive').prop('checked', true);
		$('#modaldata').modal('show');
		
	}
	function edititem(userID) {
		var s = $('#idxval').val();
		var temp = table.row(s).data();
		$('#loginname').val(temp[1]);
		$('#fullname').val(temp[2]);
		$('#usertype').val(temp[7]).trigger('change');
		$('#dosenid').val(temp[8]).trigger('change');
		$('#pass1').val('');
		$('#pass2').val('');
		if(temp[9] == 0) {
			$('#useractive').prop('checked', false);
			$('#isactive').val(0);
		} else {
			$('#useractive').prop('checked', true);
			$('#isactive').val(1);
		}

		$('#userid').val(userID);
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
			url: "<?php echo base_url(); ?>user/deleteuser",
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
		var p = $('#pass1').val();
		var p2 = $('#pass2').val();

		if($('#userid').val() == '0') {
			if(p == '') {
				showalert(1,'Harap masukkan password.');
				return false;
			}
			if(p !== p2) {
				showalert(1,'Password yang dimasukkan tidak sama.');
				return false;
			}
			if($('#loginname').val() == '') {
				showalert(1,'Nama Login belum diisi.');
				return false;
			}
			if($('#fullname').val() == '') {
				showalert(1,'Nama lengkap belum diisi.');
				return false;
			}
		}
		var v = $('#delbut').is(":visible");
		$('#btncontinue').hide();
        $('#btnload').show();
        
        if ($('#useractive').is(":checked")) {
			$('#isactive').val(1);
		} else {
			$('#isactive').val(0);
		}

        var form = $('#edit-form');
        var formdata = false;
	    if (window.FormData){
	        formdata = new FormData(form[0]);
	    }
		//var dataString = $('#edit-form').serializeArray();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>user/saveuser",
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
					 reloaddt();
			       
			    	
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
