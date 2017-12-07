<?php
## OOP ###
class Database
{
    // private $host     = 'localhost';
    // private $db_name  = 'rodjolan_project';
    // private $username = 'rodjolan_rio';
    // private $password = 'wsuRMxx^kcpo';

    private $host     = 'localhost';
    private $db_name  = 'rodjo_ikp';
    private $username = 'root';
    private $password = '';
    public  $conn;

    public function dbConnection()
	  {

	    $this->conn = null;
      try
		  {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }
		catch(PDOException $exception)
		  {
        echo "Connection error: " . $exception->getMessage();
      }

        return $this->conn;
    }
}
?>
