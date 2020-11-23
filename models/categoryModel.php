<?php
include("../connection.php");
class Category{
  public $id;
  public $cat_name;
  public  $cat_parent;
   public $dbConn;

   function __construct()
   {
     $this->dbConn=new ConnDb() ; 
   }


   ///////////////////////////////Requst GET
  function getRows() {

    $pdo=$this->dbConn->connect();// call the fun connect that return
    $qury="SELECT * FROM category" ;
      $stmt=  $pdo->prepare($qury);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
  
         
  }
  function getSingleRows($id) {

    $pdo=$this->dbConn->connect();// call the fun connect that return 
    $qury="SELECT * FROM category  WHERE ID = ?" ;
       $stmt=  $pdo->prepare($qury);
         $stmt->execute([$id]);
           return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
          
  }
  function getParent($cat_parent) {

    $pdo=$this->dbConn->connect();// call the fun connect that return 
    $qury="SELECT * FROM category  WHERE ID = ?" ;
       $stmt=  $pdo->prepare($qury);
         $stmt->execute([$cat_parent]);
           return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
          
  }
  function getChild($id) {

    $pdo=$this->dbConn->connect();// call the fun connect that return 
    $qury="SELECT * FROM category  WHERE cat_parent=? " ;
       $stmt=  $pdo->prepare($qury);
         $stmt->execute([$id]);
           return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
          
  }

//   ///////////////////////////////Post
 function addRow()
 {
   try{
     $pdo=$this->dbConn->connect();// call the fun connect that return 
     $qury='insert into category values(null,?,?)';
    $stmt=  $pdo->prepare($qury);
    $stmt->execute([$this->cat_name,$this->cat_parent]);
  return true;
}
    catch(PDOException $e){
return false;
    }
  


 }
//  //////////////////////////////////Put
 function updateRow($id)
 {
    try{
        $pdo=$this->dbConn->connect();// call the fun connect that return 
       $stmt=  $pdo->prepare("UPDATE category SET  
       Name_Cat=?,cat_parent =? WHERE  ID=?");
         $stmt->execute([$this->cat_name,$this->cat_parent,$this->id]);
           return true;
  
   }
       catch(PDOException $e){
   return false;
       }
  }

 function deletRow($id)
 {
  try{
    $pdo=$this->dbConn->connect();// call the fun connect that return 
   $stmt=  $pdo->prepare("DELETE FROM category WHERE  ID=?");
    // $stmt->execute([$id]);
       return $stmt->execute([$id]);
}
   catch(PDOException $e){
return false;
   }
}
 }

?>