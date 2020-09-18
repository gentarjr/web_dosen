<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jurusan
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
                <a onclick="addnew(1)" class="btn btn-info" role="button" id="additem" 
									style="margin-top:5px; margin-bottom:5px;"><i class="fa fa-fw fa-plus"></i>Tambah baru</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
				<table id="tbljurusan" class="table table-bordered table-striped table-hover" style="width:100% !important;">
	                <thead>
		                <tr>
		                  <th>Edit</th>
		                  <th>Nama Jurusan</th>
		                  <th>Aktif?</th>
		                  <th>isAktif</th>
		                </tr>
	                </thead>
	                <?php if(!empty($jurusan)) { ?>
	                <?php foreach ($jurusan as $rw) { ?>
	                	<tr style="font-size:small;">
	                		<td><a href="#<?php echo $detailcount;?>" onclick="edititem('<?php echo $rw['jurusanID'];?>');">Edit</a></td>
	                		<td><?php echo $rw['jurusanNama'];?></td>
	                		<td><?php if($rw['isAktif'] == 0) { echo 'Tidak';} else{echo 'Ya';}?></td>
	                		<td><?php echo $rw['isAktif'];?></td>
	                	</tr>
	                <?php $detailcount++;} }?>
	                <tfoot>
			            <tr>
				          <th>Edit</th>
		                  <th>Nama Jurusan</th>
		                  <th>Aktif?</th>
		                  <th>isAktif</th>
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

<div class="modal fade" id="modaljurusan" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add/Edit Jurusan</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-error" id="success-alert1" style="display:none;">
		    <div id="errkehadiran" name="errkehadiran"><strong>Success! </strong></div>
		</div>
      	<input type="hidden" value="0" id="isedit" name="isedit">
      	<input type="hidden" id="jurusanID" name="jurusanID">      		
		  	<div class="form-group">
		    	<label for="jurusanNama" class="col-sm-3 control-label">Nama Jurusan</label>
		    	<input type="text" class="form-control input-sm" id="jurusanNama" name="jurusanNama" 
		      		value="">
		  	</div>	 
		  	<div class="form-group">
		    	<label for="isAktif" class="col-sm-3 control-label">Aktif?</label>
		    	<div class="col-sm-9">
		      		<label class='custom-control custom-checkbox'><input type='checkbox' id="isAktif" name="isAktif" class='custom-control-input'><span class='custom-control-indicator'></span></label>
		    	</div>
		  	</div>	   	
		  	<input type="hidden" name="rowidjurusan" id="rowidjurusan">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger" id="delbut" onclick="showdelconfirm()" name="delbut" style="visibility:hidden;">Hapus</button>
        <button type="button" name="btncontinuehadir" id="btncontinuehadir" class="btn btn-info" onclick="addrow()">Simpan</button>
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
	      		<p>Hapus Jurusan yang dipilih?</p>
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

    $('#tbljurusan tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%;" />' );
      } );

    table = $('#tbljurusan').DataTable({
    	"responsive": true,
    	"paging": false,
    	"dom": 'lrtip',
    	"columnDefs": [
				{ "searchable": false, "targets": 3 },
				{ "orderable": false, "targets": 3 },
				{ "visible": false, "targets": 3 }	]
    }); 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    $('#tbljurusan tfoot tr').appendTo('#tbljurusan thead');
    $('#tbljurusan tbody').on( 'mousedown', 'tr', function () {
	    $('#idxval').val(table.row( this ).index());
	} );
  })

  	function addnew() {

		$('#jurusanNama').val('');
		$('#jurusanID').val(0);
		$('#isAktif').prop('checked', true);
		$('#delbut').hide();
		$('#modaljurusan').modal('show');
		
	}
	function edititem(jurusanID) {
		
		var s = $('#idxval').val();
		var temp = table.row(s).data();
		$('#jurusanNama').val(temp[1]);
		if(temp[3] == 0) {
			$('#isAktif').prop('checked', false);
		} else {
			$('#isAktif').prop('checked', true);
		}

		$('#jurusanID').val(jurusanID);
		$('#delbut').show();
		$('#modaljurusan').modal('show');
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

	function addrow() {
		var v = $('#delbut').is(":visible");
		$('#btncontinuehadir').hide();
        $('#btnloadhadir').show();

        var p = $('#jurusanNama').val();
		var n = $('#jurusanID').val();
		var a = 0;
		var stra = 'Tidak';
		if ($('#isAktif').is(":checked")) {
			a = 1;
			stra = 'Ya';
		}
		

		var dataString = $('#jurusanNama').serializeArray();
		dataString.push({name: 'jurusanID', value: n});
		dataString.push({name: 'jurusanNama', value: p});
		dataString.push({name: 'isAktif', value: a});
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>jurusan/savejurusan",
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
			        //alert('numeric:'+d['stt']);
			        if(v==false){
			        	//Insert
			        	//alert('insert');
			    		$('#tbljurusan').dataTable().fnAddData( [
				        '<a href="#" onclick="edititem(\''+d['stt']+'\')">'+d['stt']+'</a>', p, stra, a] );
				    } else {
				    	//Update
				    	//alert('update');
				    	var r =$('#idxval').val();
						var temp =table.row(r).data();
						temp[1] = $('#jurusanNama').val();
						temp[2] = stra;
						temp[3] = a;
						$('#tbljurusan').dataTable().fnUpdate(temp,r,undefined,true);	
				    }
			    	$('#btncontinuehadir').show();
    				$('#btnloadhadir').hide();
					$('#modaljurusan').modal('hide');
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
