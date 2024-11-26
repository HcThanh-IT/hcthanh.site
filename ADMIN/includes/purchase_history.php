<?php
class purchase_history{
	//DB params
	private $table = "purchase_history";
	private $conn;

	//Myguests properties
	public $purchase_history_ID;
	public $product_ID;
	public $user_ID;
    public $product_code;

    public function __construct($db){
		$this->conn = $db;
	}
    public function purchase_history_ID($user_ID) {
		$sql = "SELECT * FROM $this->table WHERE user_ID = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $user_ID);
		$stmt->execute();
		return $stmt; 
	}
	public function add_purchase_history($temp_product_ID, $temp_user_ID, $temp_product_code){
		$sql = "INSERT INTO $this->table (product_ID, user_ID, product_code, active) VALUES (:product_ID, :user_ID,:product_code,0)";
		$stmt = $this->conn->prepare($sql);
	
		// Bind giá trị vào câu lệnh SQL
		$stmt->bindParam(':product_ID', $temp_product_ID, PDO::PARAM_INT);
		$stmt->bindParam(':user_ID', $temp_user_ID, PDO::PARAM_INT);
		$stmt->bindParam(':product_code', $temp_product_code);
		try {
			if ($stmt->execute()) {
				return true;
			}
		} catch (PDOException $e) {
			echo "Error insert record: <br>" . $e->getMessage();
			return false;
		}
	}
	public function user_ID($user_ID) {
		$sql = "SELECT * FROM $this->table WHERE user_ID = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $user_ID);
		$stmt->execute();
		return $stmt; 
	}
	
	
}
?>