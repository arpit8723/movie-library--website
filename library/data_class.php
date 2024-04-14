<?php
session_start();
include("db.php");

class data extends db{

    private $moviepic;
    private $moviename;
    private $moviedetail;
    private $moviedirector;
    private $movieprod;
    private $country;
    private $movierating;
    private $moviequantity;
    private $type;
    private $movie;
    private $userselect;
    private $days;
    private $getdate;
    private $returndate;
    

function __construct(){
   // echo "working";
}

function adminLogin($t1 ,$t2){

    $q="SELECT * FROM admin where email='$t1' and Password='$t2' ";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();


    if($result > 0){
        foreach($recordSet->fetchAll() as $row){
            $logid=$row['id'];
            $_SESSION["adminid"] = $logid;
        
        header("location:admin_service_dashboard.php");
        }
    }
    elseif($result <=0){
        header("location:index.php?msg=Invalid Credentials");
    }
}
//return movie
function returnmovie($id){
    $fine="";
    $movieavail="";
    $issuemovie="";
    $movierental="";

    $q="SELECT * FROM issuemovie where id='$id'";
    $recordSet=$this->connection->query($q);

    foreach($recordSet->fetchAll() as $row) {
        $userid=$row['userid'];
        $issuemovie=$row['issuemovie'];
        $fine=$row['fine'];

    }
    if($fine==0){

    $q="SELECT * FROM movie where moviename='$issuemovie'";
    $recordSet=$this->connection->query($q);   

    foreach($recordSet->fetchAll() as $row) {
        $movieavail=$row['movieavail']+1;
        $movierental=$row['movierent']-1;
    }
    $q="UPDATE movie SET movieavail='$movieavail', movierent='$movierental' where moviename='$issuemovie'";
    $this->connection->exec($q);

    $q="DELETE from issuemovie where id=$id and issuemovie='$issuemovie' and fine='0' ";
    if($this->connection->exec($q)){

        header("Location:otheruser_dashboard.php?userlogid=$userid");
     }
    //  else{
    //     header("Location:otheruser_dashboard.php?msg=fail");
    //  }
    }
    // if($fine!=0){
    //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
    // }
   

}

function getissuemovie($userloginid) {

    $newfine="";
    $issuereturn="";

    $q="SELECT * FROM issuemovie where userid='$userloginid'";
    $recordSetss=$this->connection->query($q);


    foreach($recordSetss->fetchAll() as $row) {
        $issuereturn=$row['issuereturn'];
        $fine=$row['fine'];
        $newfine= $fine;

        
            //  $newmovierent=$row['movierent']+1;
    }


    $getdate= date("d/m/Y");
    if($issuereturn<$getdate){
        $q="UPDATE issuemovie SET fine='$newfine' where userid='$userloginid'";

        if($this->connection->exec($q)) {
            $q="SELECT * FROM issuemovie where userid='$userloginid' ";
            $data=$this->connection->query($q);
            return $data;
        }
        else{
            $q="SELECT * FROM issuemovie where userid='$userloginid' ";
            $data=$this->connection->query($q);
            return $data;  
        }

    }
    else{
        $q="SELECT * FROM issuemovie where userid='$userloginid'";
        $data=$this->connection->query($q);
        return $data;

    }






}

function addnewuser($name,$password,$email,$type){
    $this->name=$name;
    $this->password=$password;
    $this->email=$email;
    $this->type=$type;

    $q="INSERT INTO userdata(id, name,email,pass,type)VALUES('','$name','$email','$password','$type')";
if($this->connection->exec($q)){
    header("location:admin_service_dashboard.php?msg=New Add done");
}

else{
    header("location:admin_service_dashboard.php?msg=register fail");
    }

}

function addmovie($moviepic,$moviename,$moviedetail,$moviedirector,$movieprod,$country,$movierating,$moviequantity){
    $this->$moviepic=$moviepic;
    $this->moviename=$moviename;
    $this->moviedetail=$moviedetail;
    $this->moviedirector=$moviedirector;
    $this->movieprod=$movieprod;
    $this->country=$country;
    $this->movierating=$movierating;
    $this->moviequantity=$moviequantity;
     $q="INSERT INTO movie(id,moviepic,moviename, moviedetail,moviedirector, movieprod,country, movierating,moviequantity,movieavail,movierent)VALUES('','$moviepic', '$moviename', '$moviedetail', '$moviedirector', '$movieprod', '$country', '$movierating', '$moviequantity','$moviequantity',0)";;

     if($this->connection->exec($q)){
        header("location:admin_service_dashboard.php?msg=done");

     }
     else{
        header("location:admin_service_dashboard.php?msg=fail");

     }
}

function userdata(){
   $q="SELECT * FROM userdata";
    $data=$this->connection->query($q);
    return $data;
}


function getmovieissue(){
    $q="SELECT * FROM movie where movieavail !=0 ";
    $data=$this->connection->query($q);
    return $data;
}

function userdetail($id){
    $q="SELECT * FROM userdata where id ='$id'";
    $data=$this->connection->query($q);
    return $data;
}

function userLogin($t1, $t2) {
    $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();
    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $logid=$row['id'];
            header("location: otheruser_dashboard.php?userlogid=$logid");
        }
    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }

}


function requestmovie($userid,$movieid){

    $q="SELECT * FROM movie where id='$movieid'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where id='$userid'";
    $recordSet=$this->connection->query($q);

    foreach($recordSet->fetchAll() as $row) {
        $username=$row['name'];
        $usertype=$row['type'];
    }

    foreach($recordSetss->fetchAll() as $row) {
        $moviename=$row['moviename'];
    }

    if($usertype=="student"){
        $days=7;
    }
    if($usertype=="subscriber"){
        $days=21;
    }


    $q="INSERT INTO requestmovie (id,userid,movieid,username,usertype,moviename,issuedays)VALUES('','$userid', '$movieid', '$username', '$usertype', '$moviename', '$days')";

    if($this->connection->exec($q)) {
        header("Location:otheruser_dashboard.php?userlogid=$userid");
    }

    else {
        header("Location:otheruser_dashboard.php?msg=fail");
    }

}

function requestmoviedata(){
    $q="SELECT * FROM requestmovie ";
    $data=$this->connection->query($q);
    return $data;
}


function issuemovieapprove($movie,$userselect,$days,$getdate,$returnDate,$redid){
    $this->$movie= $movie;
    $this->$userselect=$userselect;
    $this->$days=$days;
    $this->$getdate=$getdate;
    $this->$returnDate=$returnDate;


    $q="SELECT * FROM movie where moviename='$movie'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where name='$userselect'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $issueid=$row['id'];
            $issuetype=$row['type'];

            // header("location: admin_service_dashboard.php?logid=$logid");
        }
        foreach($recordSetss->fetchAll() as $row) {
            $movieid=$row['id'];
            $moviename=$row['moviename'];

                $newmovieavail=$row['movieavail']-1;
                 $newmovierent=$row['movierent']+1;
        }

    
        $q="UPDATE movie SET movieavail='$newmovieavail', movierent='$newmovierent' where id='$movieid'";
        if($this->connection->exec($q)){

        $q="INSERT INTO issuemovie (userid,issuename,issuemovie,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$movie','$issuetype','$days','$getdate','$returnDate','0')";

        if($this->connection->exec($q)) {

            $q="DELETE from requestmovie where id='$redid'";
            $this->connection->exec($q);
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }




    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }


}
function getmoviedetail($id){
    $q="SELECT * FROM movie where id ='$id'";
    $data=$this->connection->query($q);
    return $data;
}

function getmovie (){
    $q="SELECT * FROM movie";
     $data=$this->connection->query($q);
     return $data;   
}

function deleteuserdata($id){
    $q="DELETE from userdata where id='$id'";
    if($this->connection->exec($q)){

        header("Location:admin_service_dashboard.php?msg=Done");

    }
    else{
        header("Location:admin_service_dashboard.php?msg=fail");

    }
}

//issue movie report
function issuereport(){
    $q="SELECT * FROM issuemovie ";
    $data=$this->connection->query($q);
    return $data;
    
}




//issue movie
function issuemovie($movie,$userselect,$days,$getdate,$returnDate){
    $this->$movie= $movie;
    $this->$userselect=$userselect;
    $this->$days=$days;
    $this->$getdate=$getdate;
    $this->$returnDate=$returnDate;


    $q="SELECT * FROM movie where moviename='$movie'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where name='$userselect'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $issueid=$row['id'];
            $issuetype=$row['type'];

            // header("location: admin_service_dashboard.php?logid=$logid");
        }
        foreach($recordSetss->fetchAll() as $row) {
            $movieid=$row['id'];
            $moviename=$row['moviename'];

                $newmovieavail=$row['movieavail']-1;
                 $newmovierent=$row['movierent']+1;
        }

    
        $q="UPDATE movie SET movieavail='$newmovieavail', movierent='$newmovierent' where id='$movieid'";
        if($this->connection->exec($q)){

        $q="INSERT INTO issuemovie (userid,issuename,issuemovie,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$movie','$issuetype','$days','$getdate','$returnDate','0')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }


    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }


}
}

    
        
    
