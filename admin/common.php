<?php

// hàm insert vào db
if (!function_exists('insert')) {
   function insert($table, $data)
   {
      $connect = getConnection();
      if (!empty($table) && !empty($data)) {
         $field = '';
         $valueInsert = '';
         foreach ($data as $fieldName => $value) {
            // Nối chuỗi
            $field .= $fieldName . ',';
            $valueInsert .= "'" . $value . "'" . ',';
         }
         $field = rtrim($field, ',');
         $valueInsert = rtrim($valueInsert, ',');
         $sql = "INSERT INTO $table ($field ) VALUES ($valueInsert)";
         try {
            $stmt = $connect->prepare($sql);
            return $stmt->execute();
         } catch (\Exception $e) {
            throw new Exception($e->getMessage());
         }
      }
      return false;
   }
}

// hàm lấy dữ liệu 1 bản ghi
if (!function_exists('get_one_data')) {
   function get_one_data($sql)
   // SELECT * FROM users WHERE username='$username' AND password='$password'
   {
      $list_array = array_slice(func_get_args(), 1);
      try {
         $conn = getConnection();
         $stmt = $conn->prepare($sql);
         $stmt->execute($list_array);
         $value = $stmt->fetch(PDO::FETCH_ASSOC);
         return $value;
      } catch (PDOException $e) {
         throw $e;
      } finally {
         unset($conn);
      }
   }
};

if(!function_exists('get_all_data')){
	function get_all_data($sql) {
		$list_array = array_slice(func_get_args(),1);
		try {
			$conn = getConnection();
			$stmt = $conn->prepare($sql);
			$stmt->execute($list_array);
			$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $values;
		}
		catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	   
	}
};


if(!function_exists('delete')){
	function delete($table, $where = '') {
		$connect = getConnection();
		try{
			if(!empty($table) && !empty($where)){
				$sql = "DELETE FROM $table WHERE $where";
				$stmt = $connect->prepare($sql);
				$stmt->execute();
			}
			return true;
		}catch(\Exception $e){
			throw new Exception($e->getMessage());
		}
	}
}


if (!function_exists('getTitle')) {
   function getTitle($fileName)
   {
      $file = explode('.', $fileName);
      $fileName = $file[0] ?? 'index';
      $title = 'Trang chủ';
      switch ($fileName) {
         case 'index':
            $title = 'Trang chủ';
            break;
         case 'news':
            $title = 'Tin tức';
            break;
         case 'product':
            $title = 'Sản phẩm';
            break;
         case 'contact':
            $title = 'Liên hệ';
            break;
         case 'cart':
            $title = 'Giỏ hàng';
            break;
         case 'payment':
            $title = 'Thanh toán';
            break;
         case 'detail':
            $title = 'Chi tiết sản phẩm';
            break;
         default:
            $title = ucfirst($fileName);
            break;
      }
      return $title;
   }
}


?>