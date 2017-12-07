<?php

require_once('dbcon.php');

class Login
{

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($uname,$umail,$upass)
	{
		// try
		// {
		// 	$new_password = password_hash($upass, PASSWORD_DEFAULT);
    //
		// 	$stmt = $this->conn->prepare("INSERT INTO rod_users(user_name,user_email,user_pass)
		//                                                VALUES(:uname, :umail, :upass)");
    //
		// 	$stmt->bindparam(":uname", $uname);
		// 	$stmt->bindparam(":umail", $umail);
		// 	$stmt->bindparam(":upass", $new_password);
    //
		// 	$stmt->execute();
    //
		// 	return $stmt;
		// }
		// catch(PDOException $e)
		// {
		// 	echo $e->getMessage();
		// }
	}


	public function doLogin($uname,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id, user, pass FROM user WHERE user=:uname  ");
			$stmt->execute(array(':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
        $upasmd5=md5($upass);
				if($upasmd5==$userRow['pass'])
				{

            $_SESSION['level_user']  = 1;
            $_SESSION['id_user']		 = $userRow['id'];

					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if(isset($_SESSION['level_user']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['level_user']);
    unset($_SESSION['id_user']);

		return true;
	}


}
?>
