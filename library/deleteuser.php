<?php
include("data_class.php");

$deleteuser=$_GET['useriddelete'];


$obj=new data();
$obj->setconnection();
$obj->deleteuserdata($deleteuser);