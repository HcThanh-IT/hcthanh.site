<?php
class viewines{
	//DB params
	private $table = "view_product";
	private $conn;

	//Myguests properties
	public $view_ID;
	public $view_time;

	public function __construct($db){
		$this->conn = $db;
	}

	//Add record
	public function add(){
		$sql = "INSERT INTO $this->table
				SET view_time = localtime()";
		$stmt = $this->conn->prepare($sql);
		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error insert record: <br>".$e->getMessage();
			return false;
		}
	}
	// Count
	public function count() {
	    $sql = "SELECT COUNT(*) AS total FROM $this->table";
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute();
	    $row = $stmt->fetch();
	    return $row['total'];
	}
}
?>