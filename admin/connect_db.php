<?php
// Tạo hàm kết nồi đến database
if(!function_exists('getConnection')){
	function getConnection()
	{
		$username = "root";
		$password = "";
		$db_url = "mysql:host=localhost; dbname=du_an_mau";
		$conn = new PDO($db_url, $username, $password);

		try {
			return  $conn;
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		return false;
	}
}

?>