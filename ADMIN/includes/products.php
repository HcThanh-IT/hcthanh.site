<?php
class products{
	//DB params
	private $table = "product";
	private $conn;

	//Myguests properties
	public $product_ID;
	public $product_name;
	public $product_image;
	public $product_price;
	public $product_view;
	public $product_download;
	public $product_content;
	public $product_link;
	public $product_code;

    public function __construct($db){
		$this->conn = $db;
	}
    public function read_all(){
		$sql = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	public function add_product(){
		$sql = "INSERT INTO $this->table
				SET
					product_name = :new_product_name,
					product_image = :new_product_image,
					product_price = :new_product_price,
					product_view = 0,
					product_download = 0,
					product_content = :new_product_content,
					product_link = :new_product_link,
					product_code = :new_product_code";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_product_name",$this->product_name);
		$stmt->bindParam(":new_product_image",$this->product_image);
		$stmt->bindParam(":new_product_price",$this->product_price);
		$stmt->bindParam(":new_product_content",$this->product_content);
		$stmt->bindParam(":new_product_link",$this->product_link);
		$stmt->bindParam(":new_product_code",$this->product_code);
		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error insert record: <br>".$e->getMessage();
			return false;
		}
	}
	public function read_ID($product_ID) {
		// Trước khi gán tham số, in ra giá trị
		$sql = "SELECT * FROM $this->table WHERE product_ID = :get_id";
	
		// Chuẩn bị câu lệnh SQL và bind tham số
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $product_ID);  // Sử dụng tham số truyền vào phương thức
	
		// Thực thi câu lệnh
		$stmt->execute();
		
		return $stmt;  // Trả về đối tượng truy vấn
	}
	public function add_view($product_ID){
		$sql = "UPDATE $this->table SET `product_view` = `product_view` + 1 WHERE product_ID = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $product_ID);
		$stmt->execute();
		return $stmt;
	}
}
?>