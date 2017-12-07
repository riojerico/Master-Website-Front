<?php
session_start();
error_reporting(0);
####--- cek url ---####
// $actual_link = "$_SERVER[REQUEST_URI]";
// $dir = explode("/",$actual_link);
// $jml_dir = count($dir);

// if ($jml_dir=="4") {
//   $dot_dir = "";
// }elseif ($jml_dir=="5") {
//   $dot_dir = "../";
// }elseif ($jml_dir=="6") {
//   $dot_dir = "../../";
// }
####--- end cek url ---####



######## KONEKSI ########
// $host 		  = 'localhost';
// $user		    = 'rodjolan_rio';
// $pass 		  = 'wsuRMxx^kcpo';
// $database   = 'rodjolan_project';

$host 		  = 'localhost';
$user		    = 'root';
$pass 		  = '';
$database   = 'rodjo_ikp';
try{
	$conn = new PDO ("mysql:host=$host;dbname=$database", $user, $pass);

		 "Connected!";
	}catch(PDOException $e){
		echo $e->getMessage();
	}
######## END KONEKSI ########
?>
