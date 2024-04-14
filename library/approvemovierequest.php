<?php

include("data_class.php");


$request=$_GET['reqid'];
$movie=$_GET['movie'];
$userselect= $_GET['userselect'];
$getdate= date("d/m/Y");
$days= $_GET['days'];

$returnDate=Date('d/m/Y', strtotime('+'.$days.'days'));

$obj=new data();
$obj->setconnection();
$obj->issuemovieapprove($movie,$userselect,$days,$getdate,$returnDate,$request);
