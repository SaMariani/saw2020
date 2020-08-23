<?php
class DBController {
	/*private $host = "localhost";
	private $user = "S4538910";
	private $password = "SamuMassi897";
	private $database = "S4538910";
	private $conn;*/

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "saw";
    private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>