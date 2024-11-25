<?php
class cart{
	//DB params
	private $table = "cart_temp";
	private $conn;

	//Myguests properties
	public $cart_temp_ID;
	public $product_ID;
	public $user_ID;

    public function __construct($db){
		$this->conn = $db;
	}
    public function cart_ID($user_ID) {
		$sql = "SELECT * FROM $this->table WHERE user_ID = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $user_ID);
		$stmt->execute();
		return $stmt; 
	}
	public function add_cart($temp_product_ID, $temp_user_ID, $temp_product_code){
		$sql = "INSERT INTO $this->table (product_ID, user_ID, product_code	) VALUES (:product_ID, :user_ID,:product_code)";
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
	public function delete_cart_item($cart_item_ID) {
		$sql = "DELETE FROM $this->table WHERE cart_temp_ID = :cart_item_ID";
		
		$stmt = $this->conn->prepare($sql);
		
		$stmt->bindParam(':cart_item_ID', $cart_item_ID, PDO::PARAM_INT);
		
		try {
			if ($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Error deleting record: " . $e->getMessage();
			return false;
		}
	}
	
}
?>