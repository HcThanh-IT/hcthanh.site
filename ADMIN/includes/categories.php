<?php
class categories{
	//DB params
	private $table = "categories";
	private $conn;

	//Myguests properties
	public $categories_ID;
	public $categories_name;
	public $categories_image;

    public function __construct($db){
		$this->conn = $db;
	}
    public function read_all(){
		$sql = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	public function add_categories(){
		$sql = "INSERT INTO $this->table
				SET
					categories_name = :new_categories_name,
					categories_image = :new_categories_image,
					categories_price = :new_categories_price,
					categories_view = 0,
					categories_download = 0,
					categories_content = :new_categories_content,
					categories_link = :new_categories_link,
					categories_code = :new_categories_code";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_categories_name",$this->categories_name);
		$stmt->bindParam(":new_categories_image",$this->categories_image);
		$stmt->bindParam(":new_categories_price",$this->categories_price);
		$stmt->bindParam(":new_categories_content",$this->categories_content);
		$stmt->bindParam(":new_categories_link",$this->categories_link);
		$stmt->bindParam(":new_categories_code",$this->categories_code);
		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error insert record: <br>".$e->getMessage();
			return false;
		}
	}
	public function read_ID($categories_ID) {
		// Trước khi gán tham số, in ra giá trị
		$sql = "SELECT * FROM $this->table WHERE categories_ID = :get_id";
	
		// Chuẩn bị câu lệnh SQL và bind tham số
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $categories_ID);  // Sử dụng tham số truyền vào phương thức
	
		// Thực thi câu lệnh
		$stmt->execute();
		
		return $stmt;  // Trả về đối tượng truy vấn
	}
	public function add_view($categories_ID){
		$sql = "UPDATE $this->table SET `categories_view` = `categories_view` + 1 WHERE categories_ID = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id", $categories_ID);
		$stmt->execute();
		return $stmt;
	}
}
?>