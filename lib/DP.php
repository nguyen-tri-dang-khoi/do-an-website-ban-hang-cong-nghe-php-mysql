<?php  
	class DP {
		// Phương thức kết nối
		private static function connect_DB() {
			$host = 'localhost';
			$dbname = 'laravel';
			$us = 'root';
			$pass = '';
			try {
				// Phương thức PDO gồm 4 đối số
				// 1. Thông tin host và db
				// 2. username đăng nhập vào db
				// 3. mật khẩu đăng nhập db
				// 4. Cấu hình (bắt lỗi, lệnh sql thực thi ban đầu,....)
				$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $us, $pass, 
				array(
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_PERSISTENT => false,
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
					)
				);
				return $conn;
			}
			catch (PDOExecption $e) {
				echo '<script> alert("Error: '. $e->getMessage().'");</script>';
				return null;
			}
		}
		// Phương thức xác định kiểu dữ liệu truyền vào của tham số câu truy vấn
		private static function get_type($var) {
			switch (gettype($var)) {
				case 'integer': return PDO::PARAM_INT;
				case 'boolean': return PDO::PARAM_BOOL;
				case 'NULL': return PDO::PARAM_NULL;
				default: return PDO::PARAM_STR;
			}
		}
		// Phương thức thực thi truy vấn
		public static function run_query($query,$paras,$type) {
			try {
				$con = DP::connect_DB(); // kết nối database
				$h = $con->prepare($query); //
				foreach ($paras as $key=>$para) {
					$h->bindValue($key+1,$para,DP::get_type($para)); // gán giá trị các para
				}
				$h->execute(); // thực thi
				$result;
				switch($type)
				{
					// Khi câu truy vấn không trả kết quả về (insert, update, delete)
					case 1: $result = true; break; 
					// Khi câu truy vấn trả về danh sách (select)
					case 2: $result = $h->fetchAll(); break;
					// Khi câu truy vấn trả về mã tăng tự động (insert)
					case 3: $result = $con->lastInsertId(); break;
				}
				$con = NULL;
				return $result;
			} catch (PDOException $e) {
				echo '<script>alert("'.$e->getMessage().'".);</script>';
			}
		}
	}
?>