<?php 
/**
* kumpulan class 
*/
class Core 
{
	
	function __construct()
	{
		$this->init();
		date_default_timezone_set('Asia/Jakarta');
	}

	function init()
	{
		require_once ('php-mysqli/MysqliDb.php');

		$db = new MysqliDb();
	}

	public function test_db()
	{
		$db = MysqliDb::getInstance();
		if ($db->ping()) {
			echo 'sukses';
		}else{
			echo 'gagal '.$db->getLastError();
		}
	}

	public function select_a()
	{
		$db = MysqliDb::getInstance();
		if ($a = $db->get('admin', 1)) {
			print_r($a);
		} else {
			# code...
		}
		
	}

	// check sdh login apa blm
	public function check_login($value)
	{
		if (isset($_SESSION[$value])) {
			header("Location: index.php");
		} 
	}

	// check ada session admin atau tdk
	public function check_session($value)
	{
		if (!isset($_SESSION[$value])) {
			header("Location: login.php");
		}
	}

	// proses login admin
	public function proses_login($username, $password)
	{
		session_start();
		$db = MysqliDb::getInstance();
		$db->where('username', $username);
		$db->where('password', $password);
		$data = $db->getOne('admin');
		if ($db->count>0) {
			$_SESSION['admin'] = $data;
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	// logout
	public function logout($value)
	{
		unset($value);
		session_destroy();
		header("Location: login.php");
	}
}
 ?>