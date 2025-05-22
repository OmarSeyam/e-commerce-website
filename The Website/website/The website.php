<!DOCTYPE html>
<html>
<head>
<?php
 include_once('../../script.php');
 include_once('../../boots.php');
 include_once('../../connection.php');
$query="select * from category";
$r=mysqli_query($connection,$query);
?>
<title>Zaglool</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<!-- Core theme CSS (includes Bootstrap)-->
<link href="css/styles.css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
</head>
<body class="w3-content" style="max-width:1200px">

<!-- Sidebar/menu -->

<!-- Top menu on small screens -->


<!-- !PAGE CONTENT! -->

<div class="w3-main" >

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  <!-- Top header -->
  <br>
  <h1 class="text-center  w3-container w3-xlarge" style="font-weight:bold;">Categories</h1>
  <br>
  <br>
</div>

<div class="container px-4 px-lg-5">
   <!-- Content Row-->
 <div class="row gx-4 gx-lg-5">
<?php
if(mysqli_num_rows($r)>0){
  while($row=mysqli_fetch_assoc($r)){
    $query1="select count(id) as num_stores from stores where category_id=". $row['id'];
    $r1=mysqli_query($connection,$query1);
    $row1=mysqli_fetch_assoc($r1);
 echo '

 <div class="col-md-4 mb-5">
     <div class="card h-100">
           <div class="card-body">
           <h2 class="card-title">'.$row['name'].'</h2>
           <p class="card-text">Number of stores: '.$row1['num_stores'].'</p>
           </div>
<form class="myForm" method="post" action="../store/store.php">
<input type="hidden" name="id" value='.  $row['id'].'>
<div class="card-footer"><button class="btn btn-primary btn-sm" type="submit">More Info</button></div>
</div>
</div> 

</form>
      
<br><br>';
  }}
?>
</div>
</div> 
</div>
</div>
</body>
</html>
