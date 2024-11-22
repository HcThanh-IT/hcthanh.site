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
}
?>