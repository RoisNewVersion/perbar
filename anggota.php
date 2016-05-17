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
                    <button class="btn btn-info btn-xs" type="button" data-target="#modalAdd" data-toggle="modal">Tambah</button>
                    <button type=button id="openmodal">aa</button>
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
                      $db->where('status_aktif', '1');
                      $data = $db->get('anggota');
                      ?>
                      <table id="tabelku" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tgl daftar</th>
                            <th>Tgl berakhir</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; 
                          foreach ($data as $key ){ ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $key['nama'] ?></td>
                            <td><?= $key['alamat'] ?></td>
                            <td><?= $key['tgl_daftar'] ?></td>
                            <td><?= $key['tgl_berakhir'] ?></td>
                            <td><?= $key['angkatan'] ?></td>
                            <td>
                              <button class="btn btn-primary btn-round btn-xs" type="button" value="<?= $key['id_anggota'] ?>">Edit</button>
                              <button class="btn btn-danger btn-round btn-xs" type="button" value="<?= $key['id_anggota'] ?>">Hapus</button>
                            </td>
                          </tr>
                          <?php $no++; 
                          } ?>
                        </tbody>
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
                <h4 class="modal-title" id="myModalLabel2">Tambah Anggota</h4>
              </div>
              <div class="modal-body">
                <form id="formAdd" class="form-horizontal form-label-left" action="" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input class="form-control" type="text" name="nama" placeholder="Nama">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <input class="form-control" type="text" name="alamat" placeholder="Alamat">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Tgl daftar</label>
                    <input class="form-control" id="tgl_daftar" type="text" name="tgl_daftar" placeholder="Tgl daftar">
                  </div>

                  <div class="form-group">
                    <label class="control-label">Angkatan</label>
                    <input class="form-control" id="angkatan" type="text" name="angkatan" placeholder="Angkatan">
                  </div>
                  
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger  btn-round btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-round btn-sm">Simpan</button>
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
    // onload content
    // loadContent();
    function loadContent()
    {
      $.ajax({
        url: '_anggota.php',
        type: 'GET',
        dataType: 'html',
        
      })
      .done(function(msg) {
        console.log("success");
        $('#content').append(msg);
      })
      .fail(function(jqXHR, textStatus) {
        console.log("error");
        alert("Terjadi kesalahan "+textStatus);
      })
      .always(function() {
        console.log("complete");
      });
    }

    var dt = $('#tabelku').dataTable();

    // angkatan
    $('#angkatan').datepicker({
      // format: 'yy',
      viewMode: 'years',
      minViewMode : 'years'
    });
    // tgl daftar
    $('#tgl_daftar').datepicker({
      format: 'yyyy-mm-dd',
      
    }).on('changeDate', function(e){
      $(this).datepicker('hide');
    });
    

    // click modal
    $('#openmodal').click(function(event) {
      console.log('aaa');
      $('#modalAdd').modal('show');
    });
  });
</script>