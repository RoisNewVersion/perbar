<?php include 'layout/header.php'; ?>

<?php 
  include('system/fungsi.php');

  $make = new Core();
  $make->check_session('admin');
?>
<?php include 'layout/menu.php' ?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">

                    <h2>Anggota Perpus</h2> --  
                    <!-- <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button> -->
                    <button class="btn btn-info btn-xs" type=button id="openmodal">Tambah</button>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <?php 
                      // include('system/php-mysqli/MysqliDb.php');
                      $db = new MysqliDb();
                     
                      ?>
                      <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Tgl daftar</th>
                            <th>Tgl berakhir</th>
                            <th>Aktif / Tdk</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        
                          
                      </table>
                    <!-- <div id="content"></div> -->
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- modal add -->
        <div class="modal fade modal-wide" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"></h4>
              </div>
              <div class="modal-body">
                <form id="formAdd" class="form-horizontal form-label-left" accept-charset="utf-8">
                  <input type="hidden" name="type" id="type" value="">
                  <input type="hidden" name="id_ang" id="id_ang" value="">
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">TTL</label>
                    <input class="form-control" type="text" name="ttl" id="ttl" placeholder="TTL" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tgl daftar</label>
                    <input class="form-control" id="tgl_daftar" type="text" name="tgl_daftar" placeholder="Tgl daftar" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label">Tgl Berakhir</label>
                    <input class="form-control" id="tgl_berakhir" type="text" name="tgl_berakhir" placeholder="Tgl berakhir" required="">
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary btn-round btn-sm"></button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /modal add -->
        <!-- /page content -->
<?php include 'layout/footer.php' ?>


<script type="text/javascript">
  $(document).ready(function() {

      dt = $('#tabelku').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "system/scripts/server_processing_anggota.php"
    });

    // tgl daftar
    $('#tgl_daftar').datepicker({
      format: 'yyyy-mm-dd',
      
    }).on('changeDate', function(e){
      $(this).datepicker('hide');
    });
    // tgl berakhir
    $('#tgl_berakhir').datepicker({
      format: 'yyyy-mm-dd',
      
    }).on('changeDate', function(e){
      $(this).datepicker('hide');
    });

    // click modal
    $('#openmodal').click(function(event) {
      // console.log('aaa');
      // tambah type
      $('#type').val('new');
      $('#myModalLabel2').html('Tambah Anggota');
      $('#btnSubmit').html('Simpan');
      $('#modalAdd').modal('show');
    });
    // submit form
    $('#btnSubmit').click(function(event) {
      // event.preventDefault();
      // kumpulkan data inputan
      var dataInput = {
        type: $('#type').val(),
        id_ang: $('#id_ang').val(),
        nama: $('#nama').val(),
        ttl: $('#ttl').val(),
        tgl_daftar: $('#tgl_daftar').val(),
        tgl_berakhir: $('#tgl_berakhir').val()
      };

      console.log(dataInput);
      $.ajax({
        url: 'proses_anggota.php',
        type: 'POST',
        
        data: dataInput,
      })
      .success(function(res){
        console.log(res);
        $.notify('Tambah anggota '+res,'success');
        $('#modalAdd').modal('hide');
        $('#formAdd')[0].reset();
        // $('#modalAdd').remove();
        dt.ajax.reload();
      });
      
    });

  });
</script>