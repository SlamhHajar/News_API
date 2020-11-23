<?php
// header('Access-Control-Allow-Origin:*');
// header('Content-Type:application/json');
include("../models/categoryModel.php");
  
$category_model=new Category(); //controler

if(isset($_POST)&&!empty($_POST)){
// echo $_POST['title'];
// echo $_POST['details'];
$category_model->cat_name=$_POST['name'];
$category_model->$cat_parent=$_POST['parent'];
$category_model->cat_name=strip_tags($category_model->cat_parent);
$category_model->cat_parent=strip_tags($category_model->cat_parent);
 if($category_model->addRow()){
   $feedback['code'] =2200;
   $feedback['message']="data insert successfull";
 } else{
    $feedback['code'] =2250;
    $feedback['message']=" faild insert data";
 }
 echo json_encode($feedback);
}
else if(isset($_PUT)){
    $date=json_decode(file_get_contents("php://input"));

    $category_model->id= $date->id;
    $category_model->cat_name=$_PUT['name'];
    $category_model->cat_parent=$_PUT['parent'];
 
    $category_model->sport_title=strip_tags($category_model->cat_name);
    $category_model->sport_details=strip_tags($category_model->cat_parent);
     if($category_model->updateRow($date->id)){
       $feedback['code'] =2200;
       $feedback['message']="data update successfull";
     } else{
        $feedback['code'] =2250;
        $feedback['message']=" faild update data";
     }
     echo json_encode($feedback);
    }
    else if(isset($_DELETE['id'])){
        echo json_encode($category_model->deletRow($_GET['id']))  ;      
    }
else if(isset($_GET['id'])){
    echo json_encode($category_model->getSingleRows($_GET['id']))  ;      
}

else{
    echo json_encode($category_model->getParent())  ; 
//echo json_encode($category_model->getRows())  ;   
}
?>