<?php
include("../connection.php");
class News{
  public $id;
  public $new_title;
  public  $new_details;
  public $new_date;
  public $new_image;
  public $cat_id;
   public $dbConn;

   function __construct()
   {
     $this->dbConn=new ConnDb() ; 
   }


   ///////////////////////////////Requst GET
  function getRows() {

    $pdo=$this->dbConn->connect();// call the fun connect that return
    $qury="SELECT new.* ,
    category.Name_Cat as category_name
    FROM  new INNER JOIN  category  ON new.cat_ID = category.ID " ;
      $stmt=  $pdo->prepare($qury);
       //$stmt=  $pdo->prepare("select id,title  from sport");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
//        $rows=  $stmt->fetchAll(PDO::FETCH_OBJ);
//        $data=array();
//        foreach($rows as $row){
//          $content['id']=$row->ID;
//          $content['image']=$row->image;
//          $content['title']=$row->title;
//          $content['date']=$row->date;
//          $content['catagory']=$row->cat_id;
//  array_push($data,$content) ;
//        }
//   return $data  ;   
         
  }
  function getSingleRows($id) {

    $pdo=$this->dbConn->connect();// call the fun connect that return 
    $qury="SELECT new.* ,
    category.Name_Cat as category_name
    FROM  new INNER JOIN  category  ON new.cat_ID = category.ID  WHERE new.ID = ?" ;
       $stmt=  $pdo->prepare($qury);
         $stmt->execute([$id]);
           return $stmt->fetchAll(PDO::FETCH_OBJ); //object that fetch all row in database
          
  }

//   ///////////////////////////////Post
 function addRow()
 {
   try{
     $pdo=$this->dbConn->connect();// call the fun connect that return 
     $qury='insert into new values(null,?,?,now(),?,?)';
    $stmt=  $pdo->prepare($qury);
    $stmt->execute([$this->new_title,$this->new_details,$this->new_image,$this->cat_id]);
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
       $stmt=  $pdo->prepare("UPDATE new SET title=?,details=?,image=?,cat_ID=? WHERE  ID=?");
         $stmt->execute([$this->new_title,$this->new_details,$this->new_image,$this->cat_id,$this->id]);
           return $stmt->fetchAll(PDO::FETCH_OBJ);
  
   }
       catch(PDOException $e){
   return false;
       }
  }

 function deletRow($id)
 {
  try{
    $pdo=$this->dbConn->connect();// call the fun connect that return 
   $stmt=  $pdo->prepare("DELETE FROM new WHERE  ID=?");
    // $stmt->execute([$id]);
       return $stmt->execute([$id]);
}
   catch(PDOException $e){
return false;
   }
}
 }

?>