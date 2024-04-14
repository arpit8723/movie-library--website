<?php
include("data_class.php");
// session_start();

$adminid= $_SESSION["adminid"];
?>
<html>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>

    <style>
         .innerright,label,table {
    color: rgb(250, 250, 250);
    font-weight:bold;
    text-align: end;
}
        body{
          
            background-image: url('images/797848.jpg');
            background-size: cover;
          
        }
        .imglogo{
            margin:auto;
        }
        .innerdiv {
            text-align: center;
        margin: 10px;  
          }
        .leftinnerdiv {
            float: left;
            width: 25%;

          }
          .rightinnerdiv {
    float: right;
    width: 75%;
}

          .redbtn{
            background-color:rgb(139, 0, 0);
            font-weight: bolder;
            color: white;
            width: 95%;
            height: 40px;
            margin-top: 8px;
            border-radius: 12px;
            border-color: darkred;
          }
          .redbtn,
a {
    text-decoration: none;
    color: white;
    font-size: large;
}

th{
    background-color: darkred;
    color: black;
}
td{
    background-color:black;
    color: white;
    
}
td, a{
    color:white;
}
        </style>
    <body>

    <div class="container">
    <div class="innerdiv">
        <div class="row"><img class="imglogo" src="images/logo5.jpg" width="400" height="87"  /></div>
        <div class="leftinnerdiv">

       <button class="redbtn">Admin</button>
       <Button class="redbtn" onclick="openpart('addmovie')" >ADD MOVIE</Button>
       <Button class="redbtn" onclick="openpart('moviereport')" >MOVIE REPORT</Button>
       <Button class="redbtn" onclick="openpart('movierequestapprove')" >MOVIE REQUEST</Button>          
       <Button class="redbtn" onclick="openpart('addperson')">  ADD STUDENT</Button> 
       <Button class="redbtn" onclick="openpart('studentrecord')">  STUDENT REPORT</Button>
       <Button class="redbtn"  onclick="openpart('issuemovie')">  ISSUE MOVIE</Button>
       <Button class="redbtn" onclick="openpart('issuemoviereport')"> ISSUE REPORT</Button>
       <a href="index.php"><Button class="redbtn" > LOGOUT</Button></a>
            </div>
            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <Button class="redbtn" >ADD Person</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="addname"/>
            </br>
            <label>Password:</label><input type="password" name="addpass"/>
            </br>
            <label>Email:</label><input  type="email" name="addemail"/></br>
            <label for="typw">Choose type:</label>
            <select name="type" >
                <option value="student">student</option>
                <option value="subscriber">subscriber</option>
            </select>
        
            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>
            

 <!--movie requests by students/teachers-->
 <div class="rightinnerdiv">   
            <div id="movierequestapprove" class="innerright portion" style="display:none">
            <Button class="redbtn" >MOVIE REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestmoviedata();
            $recordset=$u->requestmoviedata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='
            padding: 8px;'>Person Name</th><th>person type</th><th>Movie name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvemovierequest.php?reqid=$row[0]&movie=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved movie</button></a></td>";
                 $table.="<td><a href='approvemovierequest.php?reqid=$row[0]&movie=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved</button></a></td>";
                // $table.="<td><a href='deletemovie_dashboard.php?deletemovieid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

 



<!--issue movie -->
<div class="rightinnerdiv">   
            <div id="issuemovie" class="innerright portion" style="display:none">
            <Button class="redbtn" >ISSUE MOVIE</Button>
            <form action="issuemovie_server.php" method="post" enctype="multipart/form-data">
            <label for="movie">Choose Movie:</label>
           
            <select name="movie" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getmovieissue();
            $recordset=$u->getmovieissue();
            foreach($recordset as $row){

                echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
        
            }            
            ?>
            </select>
<br>
            <label for="Select Student">Select Student:</label>
            <select name="userselect" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();
            foreach($recordset as $row){
               $id= $row[0];
                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
            }            
            ?>
            </select>
<br>
           <label>Days</label> <input type="number" name="days"/>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>


 <!--issue movie report portion-->

 <div class="rightinnerdiv">   
            <div id="issuemoviereport" class="innerright portion" style="display:none">
            <Button class="redbtn" >Issue Movie Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
            padding: 8px;'>Issue Name</th><th>Movie Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

             
<!--movie report portion-->

<div class="rightinnerdiv">   
            <div id="moviereport" class="innerright portion" style="display:none">
            <Button class="redbtn" >MOVIE RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->getmovie();
            $recordset=$u->getmovie();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style=' 
            padding: 8px;'> Movie Name</th><th>IMDB Rating</th><th>Qnt</th><th>Available</th><th>Rent</th><th>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'>VIEW MOVIE</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>
<!--movie detail portion-->
<div class="rightinnerdiv">   
<div id="moviedetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            <Button class="redbtn" >MOVIE DETAIL</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->getmoviedetail($viewid);
            $recordset=$u->getmoviedetail($viewid);

            foreach($recordset as $row){
               
                $movieid=$row[0];
                $movieimg=$row[1];
                $moviename=$row[2];
                $moviedetail=$row[3];
                $moviedirector=$row[4];
                $movieprod=$row[5];
                $country=$row[6];
                $movierating=$row[7];
                $moviequantity=$row[8];
                $movieavail=$row[9];
                $movierent=$row[10];
               
            }
            ?>

            <img width='400px' height='300px' style='border:1px solid #333333; float:left;margin-left:50px' src="uploads/<?php echo $movieimg?> "/>
            </br>
            <p style="color:white"><u>Movie Name:</u> &nbsp&nbsp<?php echo $moviename ?></p>
            <p style="color:white"><u>Movie Detail:</u> &nbsp&nbsp<?php echo $moviedetail ?></p>
            <p style="color:white"><u>Movie Director:</u> &nbsp&nbsp<?php echo $moviedirector ?></p>
            <p style="color:white"><u>Movie Producer:</u> &nbsp&nbsp<?php echo $movieprod ?></p>
            <p style="color:white"><u>Movie Country:</u> &nbsp&nbsp<?php echo  $country ?></p>
            <p style="color:white"><u>Movie Rating:</u> &nbsp&nbsp<?php echo $movierating ?></p>
            <p style="color:white"><u>Movie Available:</u> &nbsp&nbsp<?php echo $movieavail ?></p>
            <p style="color:white"><u>Movie Rent:</u> &nbsp&nbsp<?php echo $movierent ?></p>


            </div>
            </div>

  


<!--student report portion-->
<div class="rightinnerdiv">   
            <div id="studentrecord" class="innerright portion" style="display:none">
            <Button class="redbtn" >Student RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style=' 
            padding: 8px;'> Name</th><th>Email</th><th>Type</th><th>Delete</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>


              <!--add movie portion-->
              <div class="rightinnerdiv">   
            <div id="addmovie" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="redbtn" >ADD NEW MOVIE</Button>
            <br>
            <form action="addmovieserver_page.php" method="post" enctype="multipart/form-data">
                
            <label>Movie :</label><input type="text" name="moviename"/>
            </br>
            <label>Detail :</label><input  type="text" name="moviedetail"/></br>
            <label>Director:</label><input type="text" name="moviedirector"/></br>
            <label>Producer:</label><input type="text" name="movieprod"/></br>
            <div><label>country:</label><input type="radio" name="country" value="other"/>Other<input type="radio" name="country" value="bollywood"/>BOLLYWOOD<div style="margin-left:80px"><input type="radio" name="country" value="hollywood"/>HOLLYWOOD<input type="radio" name="country" value="foreign"/>FOREIGN</div>
            </div>   
            <label>IMDB Rating(/10):</label><input  type="number" name="movierating"/></br>
            <label>Quantity:</label><input type="number" name="moviequantity"/></br>
            <label>Movie Photo</label><input  type="file" name="moviephoto"/></br>
            </br>
   
            <input type="submit" value="SUBMIT"/>
            </br>
            </br>

            </form>
            </div>
            </div>


           


    </div>
    </div>
    </div>
    <script>
    function openpart(portion){
        var i;
        var x= document.getElementsByClassName("portion");
        for(i=0;i<x.length; i++){
            x[i].style.display ="none";

        }
        document.getElementById(portion).style.display = "block";

    }
    </script>
    </body>
</html>



 