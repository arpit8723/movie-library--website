<?php
//addserver_page.php
include("data_class.php");



$moviename=$_POST['moviename'];
$moviedetail=$_POST['moviedetail'];
$moviedirector=$_POST['moviedirector'];
$movieprod=$_POST['movieprod'];
$country=$_POST['country'];
$movierating=$_POST['movierating'];
$moviequantity=$_POST['moviequantity'];



if (move_uploaded_file($_FILES["moviephoto"]["tmp_name"],"uploads/" . $_FILES["moviephoto"]["name"])) {

    echo "updated";
    $moviepic=$_FILES["moviephoto"]["name"];

$obj=new data();
$obj->setconnection();
$obj->addmovie($moviepic,$moviename,$moviedetail,$moviedirector,$movieprod,$country,$movierating,$moviequantity);
  
}
 
  else {
     echo "File not uploaded";
  }