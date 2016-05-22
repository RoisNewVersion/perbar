<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

// ambil inputan
$type = $_POST['type'];
$id_ang = $_POST['id_ang'];
$nama = $_POST['nama'];
$ttl = $_POST['ttl'];
$tgl_daftar = $_POST['tgl_daftar'];
$tgl_berakhir = $_POST['tgl_berakhir'];

// jadikan array
$dataInput = array(
	'nama'=>ucwords($nama),
	'ttl'=>ucwords($ttl),
	'tgl_daftar'=>$tgl_daftar,
	'tgl_berakhir'=>$tgl_berakhir,	
	'status_aktif'=>1
	);

switch ($type) {
	case 'new':
		$pesan = 'aaa';// $db->insert('anggota', $dataInput);

		if ($pesan) {
			echo json_encode('sukses');
		} else {
		// echo $db->date_get_last_errors()r();
			echo json_encode('gagal '. $db->getLastError());
		}
		break;

	case 'edit':
		# code...
		break;
	
	default:
		# code...
		break;
}
?>