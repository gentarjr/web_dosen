<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dosen
        <small>data</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12" style="padding-left:5px; padding-right:5px;">         

          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <a onclick="reloaddt()" class="btn btn-xs" id="reloadsre"><i class="fa fa-fw fa-refresh"></i>Refresh</a>
                <a href="<?php echo base_url();?>dosen/editdosen" class="btn btn-xs"><i class="fa fa-fw fa-plus"></i>Tambah Baru</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table id="sretable" class="table display table-bordered table-striped" style="width:100% !important; font-size:small;">
                <thead>
	                <tr>
	                  <th>ID</th>
                    <th>NIDN</th>
	                  <th>Nama</th>	                  
	                  <th>Status</th>
	                  <th>Fakultas</th>
	                  <th>Jurusan</th>
	                  <th>Golongan</th>
	                  <th>Telp.</th>
                    <th>Aktif?</th>
	                </tr>
                </thead>
                <tfoot>
    		            <tr>
      			          <th>ID</th>
                      <th>NIDN</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Fakultas</th>
                      <th>Jurusan</th>
                      <th>Golongan</th>
                      <th>Telp.</th>
                      <th>Aktif?</th>
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

<!-- page script -->
<script type="text/javascript">
  var table;
  $(function () {   

    $('#sretable tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" style="width:100%;" />' );
      } );

    reloaddt();  

  })

  function myFunc(vr) {
    if ( 'undefined' != typeof vr ) {
      location.href = '<?php echo base_url(); ?>dosen/editdosen/'+vr;
    } else alert('Unknown row id.');
  }
  function reloaddt() {
    //$('#sretable').DataTable().ajax.reload(null, false).draw();
    $('#sretable').DataTable().destroy();
    table = $('#sretable').DataTable({
      "pageLength": 10,
       "processing":true,  
       "serverSide":true, 
       "responsive": true,
       "order":[],
       dom: 'Bfrtip',
       "bInfo": false,
       "ajax":{  
            url:"<?php echo base_url() . 'dosen/fetch_dosen/'; ?>" ,
            type:"POST"          
       }, 
       "columnDefs": [ {
          "targets": 1,
          "data": null,
          "render": function ( data, type, row, meta ) {
            return '<button type="button" class="btn btn-primary" onclick="myFunc('+data[0]+')">'+data[1]+'</button>';
          }
      },{ "visible": false, "targets": 0 } ],
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

</script>
