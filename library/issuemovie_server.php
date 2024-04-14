<?php

include("data_class.php");

$movie=$_POST['movie'];
$userselect= $_POST['userselect'];
$getdate= date("d/m/Y");
$days= $_POST['days'];

$returnDate=Date('d/m/Y', strtotime('+'.$days.'days'));

$obj=new data();
$obj->setconnection();
$obj->issuemovie($movie,$userselect,$days,$getdate,$returnDate);
