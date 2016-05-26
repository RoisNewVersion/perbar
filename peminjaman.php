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
                    <h2>Peminjaman buku</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- isinya disini -->
                    <div class="col-md-7">
                     <form class="form-inline">
                      <div class="form-group">
                        <input type="text" id="uid_ang" class="form-control" placeholder="ID Anggota">
                        <input type="hidden" id="anggota_id" name="anggota_id">
                      </div>
                      <div class="form-group">
                        <input type="text" id="uid_buku" class="form-control" placeholder="ID Buku">
                        <input type="hidden" id="buku_id" name="buku_id">
                      </div>
                      <button type="button" class="btn btn-primary btn-xs">Submit</button>
                    </form>
                    </div>
                    <div class="col-md-5">
                      <p id="nama_ang"></p>
                      <p id="nama_buku"></p>
                    </div>

                    <!-- tabel -->
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>a</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>b</td>
                        </tr>
                      </tbody>
                    </table>
                  <!-- /isi -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include 'layout/footer.php' ?>
<script type="text/javascript">
  $(document).ready(function() {
    // keyup uid anggota
    $('#uid_ang').keyup(function(event) {
      /* Act on the event */
      uid_ang = $('#uid_ang').val();
      $.getJSON('getDataPeminjaman.php', {uid_ang: uid_ang, type: 'anggota'}, function(json, textStatus) {
          /*optional stuff to do after success */
          // console.log('json',json);
          $('#anggota_id').val(json.id_anggota);
          $('#nama_ang').html('Nama anggota : <u>'+json.nama+'</u>');
      });
    });
    // keyup uid buku
    $('#uid_buku').keyup(function(event) {
      /* Act on the event */
      uid_buku = $('#uid_buku').val();
      $.getJSON('getDataPeminjaman.php', {uid_buku: uid_buku, type: 'buku'}, function(json, textStatus) {
          /*optional stuff to do after success */
          // console.log('json',json);
          $('#buku_id').val(json.id_buku);
          $('#nama_buku').html('Nama Buku : <u>'+json.judul+'</u> | Stok : '+json.stok);
      });
    });

  });
</script>