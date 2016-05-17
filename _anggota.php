<?php 
include('system/php-mysqli/MysqliDb.php');
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
			<td>Aksi</td>
		</tr>
		<?php $no++; 
		} ?>
	</tbody>
</table>

<script type="text/javascript">
	// dataTable
	function tabelku(){
    	$('#tabelku').dataTable();
	}
</script>
