<?php
error_reporting(0);
session_start();
include_once('../sys/fungsi.php');
$fungsi = new fungsi();

$nama      = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$jenis     = $_POST['jenis'];
$id_guru   = $_SESSION['id_user'];

$target_dir = "../uploads/";
$target_file = $target_dir .''.$id_guru.'-'.$jenis.'-'. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
// if (file_exists($target_file)) {
// echo "Maaf, file telah diupload sebelumnya.";
// $uploadOk = 0;
// }
// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
// echo "Maaf, ukuran file terlalu besar.";
// $uploadOk = 0;
// }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "Maaf, file kamu tidak terupload.";
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    $upload_guru = $fungsi->upload_guru($id_guru,$nama,$target_file,$deskripsi,$jenis);
    header("Location:../pages/?pages=upload&send=1");
    } else {
        header("Location:../pages/?pages=upload&send=0");
        echo "Maaf, kita mengalami masalah ketika mengupload file kamu.";
    }
}


?>
