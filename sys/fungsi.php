<?php
/**
 *
 */
require_once 'dbcon.php';

class Fungsi
{

  public function __construct(){
        $database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
  }

  public function gallery_list($limit){
    try {
          if ($limit=='') {
            $stmt = $this->conn->prepare("SELECT * FROM gallery ORDER BY waktu DESC ");
          }else{
            $stmt = $this->conn->prepare("SELECT * FROM gallery ORDER BY waktu DESC LIMIT $limit ");
          }

          $stmt->execute(array($limit));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function order_list(){
    try {

          $stmt = $this->conn->prepare("SELECT * FROM ikp_order ORDER BY id DESC ");

          $stmt->execute(array());
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function event_list(){
    try {

          $stmt = $this->conn->prepare("SELECT * FROM events ORDER BY id DESC ");

          $stmt->execute(array());
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }


  public function konten_all(){
    try {
          $stmt = $this->conn->prepare("SELECT * FROM konten");
          $stmt->execute(array());
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function konten_data($id){
    try {
          $stmt = $this->conn->prepare("SELECT * FROM konten where id=?");
          $stmt->execute(array($id));
          $res= $stmt->fetch(PDO::FETCH_OBJ);

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function last_id_order(){
    try {
          $stmt = $this->conn->prepare("SELECT id FROM ikp_order order by id desc limit 1");
          $stmt->execute(array());
          $res= $stmt->fetch(PDO::FETCH_OBJ);

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function konten_jml(){
    try {
          $stmt = $this->conn->prepare("SELECT count(*) FROM konten");
          $stmt->execute(array());
          $res= $stmt->fetch(PDO::FETCH_OBJ);

          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function insert_order($name,$email,$alamat,$date,$message,$phone){
        try {

          date_default_timezone_set('Asia/Jakarta');
          $time = date("Y-m-d H:i:s");
          $ex_date = explode("-", $date);

          $d1 = trim($ex_date[0]);
          $d2 = trim($ex_date[1]);

          $ex_d1 = explode("/", $d1);
          $ex_d2 = explode("/", $d2);

          $start = $ex_d1[2]."-".$ex_d1[1]."-".$ex_d1[0];
          $end   = $ex_d2[2]."-".$ex_d2[1]."-".$ex_d2[0];


          $stmt = $this->conn->prepare("INSERT into ikp_order (name,email,address,message,start_date,end_date,telp) values (?,?,?,?,?,?,?) ");
          $stmt->execute(array($name,$email,$alamat,$message,$start,$end,$phone));

        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function insert_event($id_order,$title,$date,$deskripsi){
          try {

            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $ex_date = explode("-", $date);

            $d1 = trim($ex_date[0]);
            $d2 = trim($ex_date[1]);

            $ex_d1 = explode("/", $d1);
            $ex_d2 = explode("/", $d2);

            $start = $ex_d1[2]."-".$ex_d1[1]."-".$ex_d1[0];
            $end   = $ex_d2[2]."-".$ex_d2[1]."-".$ex_d2[0];


            $stmt = $this->conn->prepare("INSERT into events (id_order,title,start,end,deskripsi) values (?,?,?,?,?) ");
            $stmt->execute(array($id_order,$title,$start,$end,$deskripsi));

          } catch (PDOException $e) {
            echo $e->getMessage();
          }
      }














  public function chat_list($jenis,$id_matug){
    try {

          $stmt = $this->conn->prepare("SELECT * FROM schlaps_chat WHERE id=1 UNION
                    SELECT * FROM schlaps_chat WHERE jenis=? AND id_materitugas=? ORDER BY id ");
          $stmt->execute(array($jenis,$id_matug));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function materi_list(){
    try {
          $stmt = $this->conn->query("SELECT a.id,a.nama_materi,a.waktu,b.nama FROM schlaps_materi a JOIN schlaps_user b WHERE a.id_guru=b.id order by a.id desc");
          $stmt->execute();
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function tugas_list(){
    try {
          $stmt = $this->conn->prepare("SELECT a.id,a.nama_tugas,a.waktu,b.nama FROM schlaps_tugas a JOIN schlaps_user b WHERE a.id_guru=b.id order by a.id desc");
          $stmt->execute();
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function guru_materi_list($id_guru){
    try {
          $stmt = $this->conn->prepare("SELECT * from schlaps_materi where id_guru=?");
          $stmt->execute(array($id_guru));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function guru_tugas_list($id_guru){
    try {
          $stmt = $this->conn->prepare("SELECT * from schlaps_tugas where id_guru=?");
          $stmt->execute(array($id_guru));
          while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
          $res[] = $data;
          }
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function user($id_user){
    try {
          // echo $id_user;
          $stmt = $this->conn->prepare("SELECT * from schlaps_user where id=?");
          $stmt->execute(array($id_user));
          $res= $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function data_diskusi($id,$jenis){
    try {

          if ($jenis=="materi") {
            $stmt = $this->conn->prepare("SELECT *,nama_materi as nama from schlaps_materi where id=?");
          }elseif ($jenis=="tugas") {
            $stmt = $this->conn->prepare("SELECT *,nama_tugas as nama from schlaps_tugas where id=?");
          }

          $stmt->execute(array($id));
          $res= $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  public function upload_data_select($id,$edit){
    try {
          if ($edit=='tugas') {
            $stmt = $this->conn->prepare("SELECT *,nama_tugas as nama from schlaps_tugas where id=?");
          }else{
            $stmt = $this->conn->prepare("SELECT *,nama_materi as nama from schlaps_materi where id=?");
          }

          $stmt->execute(array($id));
          $res= $stmt->fetch(PDO::FETCH_OBJ);
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
  }

  // public function cek_chat(){
  //   try {
  //         $stmt = $this->conn->prepare("SELECT * from schlaps_chat");
  //         $stmt->execute(array());
  //         while ($data= $stmt->fetch(PDO::FETCH_OBJ)) {
  //         $res[] = $data;
  //         }
  //         return $res;
  //       } catch (PDOException $e) {
  //         echo $e->getMessage();
  //       }
  // }

  public function insert_chat($id_user,$chat){
        try {
          date_default_timezone_set('Asia/Jakarta');
          $time = date("Y-m-d H:i:s");
          $stmt = $this->conn->prepare("INSERT into schlaps_chat (id_user,chat,time,level,jenis,id_materitugas) values (?,?,?,?,?,?) ");
          $stmt->execute(array($id_user,$chat,$time));
          return $res;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }

    public function update_konten($id,$isi){
          try {
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            $stmt = $this->conn->prepare("UPDATE konten set isi=? where id=?");
            $stmt->execute(array($isi,$id));
            return $res;
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
      }

    public function upload_guru($id_guru,$nama,$file,$deskripsi,$jenis){
          try {
            date_default_timezone_set('Asia/Jakarta');
            $time = date("Y-m-d H:i:s");
            if ($jenis=='materi') {
              $stmt = $this->conn->prepare("INSERT into schlaps_materi (id_guru,nama_materi,alamat_file,waktu,deskripsi) values (?,?,?,?,?) ");
            }elseif ($jenis=='tugas') {
              $stmt = $this->conn->prepare("INSERT into schlaps_tugas (id_guru,nama_tugas,alamat_file,waktu,deskripsi) values (?,?,?,?,?) ");
            }
            $stmt->execute(array($id_guru,$nama,$file,$time,$deskripsi));
            return $res;
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
      }

}//end

?>
