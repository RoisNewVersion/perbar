<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_tran = $_GET['id'];
$aksi = $_GET['aksi'];

//ambil nominal denda
$nominal = $db->getOne('denda');

switch ($aksi) {
	case 'denda':
		// $db->where('id_transaksi', $id);
		$query = "SELECT id_transaksi, tgl_kembali, datediff(current_date(), tgl_kembali) as denda from transaksi where id_transaksi = '$id_tran'";
		$cekdenda = $db->rawQuery($query);
		// print_r($cekdenda);
		if ($cekdenda[0]['denda'] > 0) {
			$subtotal = $cekdenda[0]['denda'] * $nominal['nominal'];
			$total = array('jml_hari_telat'=>$cekdenda[0]['denda'], 'total_denda'=>$subtotal);
		} else {
			$total = array('jml_hari_telat'=> 0, 'total_denda'=>'Tidak ada denda');
		}
		echo json_encode($total);
		
		break;
	case 'kembalikan':
		// udate stok buku
		// update status_kembalikan
		// update telat_perhari
		// insert ke tbl pendapatan
		break;
	default:
		# code...
		break;
}
?>