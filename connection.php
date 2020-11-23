<?php
class ConnDb{
    private $dsn= "mysql:host=localhost;dbname=db_news;charset=utf8";
  private $username = "root";
  private $password = '';
  private  $conn;
 function __construct()
 {
   $this->conn = new PDO($this->dsn, $this->username, $this->password,
   //array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  );
 }
 function connect(){
  try {
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
     // set the PDO error mode to exception
     return $this->conn;
 
  } catch(PDOException $e) {
     echo "Connection failed: " . $e->getMessage();
  }
 }


}