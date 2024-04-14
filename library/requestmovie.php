<?php

include("data_class.php");

$userid=$_GET['userid'];
$movieid=$_GET['movieid'];





$obj=new data();
$obj->setconnection();
$obj->requestmovie($userid,$movieid);

?>