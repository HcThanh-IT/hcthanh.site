<?php  
class database{
	//DB params
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "hcthanh.site";
	private $conn;

	//DB connect
	// public function connect(){
	// 	$this->conn = null;
		
	// 	try{
	// 		$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database",$this->username,$this->password);
	// 		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 	}catch(PDOException $e){
	// 		echo "Error connection: <br>".$e->getMessage();
	// 	}
	// 	return $this->conn;
	// }
	public function connect() {
		$this->conn = null;
		
		try {
			// Thêm charset=utf8 vào DSN
			$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			// Đặt charset mặc định cho kết nối
			$this->conn->exec("SET NAMES 'utf8'");
		} catch (PDOException $e) {
			echo "Error connection: <br>" . $e->getMessage();
		}
		return $this->conn;
	}
	
}
?>