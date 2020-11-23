<?php
// header('Access-Control-Allow-Origin:*');
// header('Content-Type:application/json');
include("../models/newsModel.php");
  
$news_model=new News(); //controler

if(isset($_POST)&&!empty($_POST)){
// echo $_POST['title'];
// echo $_POST['details'];
$news_model->new_title=$_POST['title'];
$news_model->new_details=$_POST['details'];
$news_model->new_image=$_POST['image'];
$news_model->cat_id=$_POST['cat_ID'];
$news_model->new_title=strip_tags($news_model->new_title);
$news_model->new_detailst_details=strip_tags($news_model->new_details);
 if($news_model->addRow()){
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

    $news_model->id= $date->id;
    $news_model->new_title=$_PUT['title'];
    $news_model->new_details=$_PUT['details'];
    $news_model->new_image=$_PUT['image'];
    $news_model->cat_id=$_PUT['cat_ID'];
    $news_model->sport_title=strip_tags($news_model->new_title);
    $news_model->sport_details=strip_tags($news_model->new_details);
     if($news_model->updateRow($date->id)){
       $feedback['code'] =2200;
       $feedback['message']="data update successfull";
     } else{
        $feedback['code'] =2250;
        $feedback['message']=" faild update data";
     }
     echo json_encode($feedback);
    }
    else if(isset($_DELETE)){
        echo json_encode($news_model->deletRow($_GET['id']))  ;      
    }
else if(isset($_GET['id'])){
    echo json_encode($news_model->getSingleRows($_GET['id']))  ;      
}

else{
echo json_encode($news_model->getRows())  ;   
}
?>