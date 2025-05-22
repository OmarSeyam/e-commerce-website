
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <?php
    $pc_name=exec('getmac');
    $pc_name=strtok($pc_name,' ');
    include_once('../../script.php');
    include_once('../../boots.php');
    include_once('../../connection.php');
    
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
        
        if(!empty($_POST['search'])){
            $search=$_POST['search'];
        }else{
            $search="_";
        }
        if(isset($_POST['id'])){
        $id=$_POST['id']; 
        $query="select * from category where id=" . $id;
        $r=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($r);
        $query1="select * from stores where category_id='$id'
        and name like '%$search%'";
        $r1=mysqli_query($connection,$query1);
    }

       
    }
        
    
    

    ?>
    <section class="wrapper">
    <div class="container-fostrap">
    <div>
    <br>
    <h2 style="display:inline;" >Category Name: </h2 >
    <p style="display:inline;font-size:25px;"><?php echo " ".$row['name']; ?> </p><br><br>
    <h2 >Category Description: </h2 >
    <p style="display:inline;font-size:25px;"><?php echo " ".$row['about']; ?> </p><br><br>
      <h2 style="display:inline;">Category Rate: </h2>
      <div  style="display:flex;display:inline; ">
       
       <?php 
       $numCat=0;
       $theRate=0; 
    if(mysqli_num_rows($r1)>0){
        while($row1=mysqli_fetch_assoc($r1)){
            $query6="select * from rate where store_id=" . $row1['id'];
            $r6=mysqli_query($connection,$query6);
            if(mysqli_num_rows($r6)==0){
                $query5="insert into rate(store_id,sum_rate,num_rate) values('".$row1['id']."',0,0) ";
                $r5=mysqli_query($connection,$query5);
            }
            $r7=mysqli_query($connection,$query6);
            $row6=mysqli_fetch_assoc($r7);
            if($row6['num_rate'] !=0){
                $numCat+=1;
                $theRate +=($row6['sum_rate']/$row6['num_rate']);
            }
        }}
        if($numCat !=0){
        $theRate /=$numCat;
        $theRateS=strval($theRate);
        echo substr($theRateS,0,strpos($theRateS,".")+2);
        }else{
            echo '0';
        }
            ?>
        <img  width=22px src=<?php echo $proj_path . 'star1.png'; ?> >
       </div>
        <br><br><br>

      <h1 class="heading">
        Stores
      </h1>
    </div>
    
    <div class="content">
      <div class="container">
        <div class="row"> 
        <form action="" method="post">
        <div style="display:flex;margin-left:13px;" >
        <div class="form-outline">
        <input type="hidden" name="id" value=<?php echo  $id;?>>
        <input  class="form-control" type="text" name="search" placeholder="Search" aria-label="Search" style="width: 400px; height: 50px; max-width: 400px;">
        </div>
        <button style="width:60px;height:50px;" type="submit" class="btn btn-primary">
            <i class="fa fa-search"></i>
        </button>
        </div>
        </form>
</div>
<br>
    <?php 
    $r8=mysqli_query($connection,$query1);
    if(mysqli_num_rows($r8)>0){
        while($row1=mysqli_fetch_assoc($r8)){
    
   echo  '<div class="col-xs-12 col-sm-4">
   <div class="card">
     <a class="img-card" href="#"  style="height:200px; Max-height: 200px;  overflow: hidden;" >
       <img src="'.$proj_path . $row1["image"].'" />
     </a>
     <div class="card-content" >
       <h4 class="card-title">
         <a href="#">'. $row1['name'] .'
         </a>
       </h4>
       <p  style="height: 40px; max-height: 40px; overflow: hidden;">
       '. $row1['about'] .'
       </p>
     </div>
   <form class="myForm" method="post" style="display: inline;text-align: center;" action="../view store/viewstore.php">
   <input type="hidden" name="id" value='.  $row1['id'].'>
   <div style="height: 40px; max-height: 40px;">
   <div class="card-read-more" >
   <button class="btn btn-link btn-block" type="submit">
     Read More
   </button>
  </div>
  </div>
  </div>
  </div>
   </form>';
        }}
        
    ?>
    </div></div></div>
</body>
</html>

