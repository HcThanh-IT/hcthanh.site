<?php
class account_users{

	//DB params
	private $table = "account_users";
	private $conn;

	//Myguests properties
	public $user_ID;
	public $user_name;
    public $user_password;
	public $user_email;
	public $user_security_code;
	public $user_date_created;

	public function __construct($db){
		$this->conn = $db;
	}

	//Read all records
	public function read_all(){
		$sql = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
    public function create_account_user(){
		$sql = "INSERT INTO $this->table
				SET 
					user_name = :new_user_name,
                    user_password = :new_user_password,
					user_email = :new_user_email,
					user_security_code = :new_user_security_code,
					user_date_created = localtime()";


		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_user_name",$this->user_name);
        $stmt->bindParam(":new_user_password",$this->user_password);
		$stmt->bindParam(":new_user_email",$this->user_email);
		$stmt->bindParam(":new_user_security_code",$this->user_security_code);

		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error insert record: <br>".$e->getMessage();
			return false;
		}
	}
	public function read_ID() {
		$sql = "SELECT * FROM $this->table WHERE user_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $this->user_ID);  // Liên kết tham số với ID người dùng trong session
		$stmt->execute();
		return $stmt;  // Trả về đối tượng truy vấn
	}
	
	public function read_login() {
		$sql = "SELECT * FROM $this->table WHERE `user_name` = :get_user_name AND `user_password` = :get_user_password";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_user_name", $this->user_name);  // Liên kết tham số với tên người dùng
		$stmt->bindParam(":get_user_password", $this->user_password);  // Liên kết tham số với mật khẩu
		$stmt->execute();
		return $stmt;  // Trả về đối tượng truy vấn
	}
}
?>