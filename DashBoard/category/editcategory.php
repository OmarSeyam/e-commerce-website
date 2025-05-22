
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include_once('../header/header.php'); ?>
<div class="container">
    <?php
    include_once('../../script.php');
    include_once('../../boots.php');
    include_once('../../connection.php');
    $id=$_GET['id'];
    $query="select * from category where id=" . $id;
    $r=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($r);
    $query1="select * from stores where category_id=" . $id;
    $r1=mysqli_query($connection,$query1);
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
        $erorrs=[];
        $success=false;
        $name=$_POST['name'];
        $about=$_POST['about'];
        if(empty($name)){
            $erorrs['name']="Fill Name Of Category!";
        }
        if(empty($about)){
            $erorrs['about']="Fill Description of Category!";
        }
        if(count($erorrs)>0){
            $erorrs['gen']="Complete information";
        }else{
            $query="update  category
            set name ='$name', about='$about'
            where id =$id";
           $r=mysqli_query($connection,$query);
           if($r){
               $erorrs=[];
               $success=true;
           }else{
               $erorrs['gen']=mysqli_error($connection);

           }
        }
        if($success){
            echo'<div class="row">
            <div class="col-12">
            <div class="alert alert-success">Update Successful</div></div></div>';

        }else{
            echo'<div class="row">
            <div class="col-12">
            <div class="alert alert-danger">'.$erorrs['gen'].'</div></div></div>';
        }
    }
    

        
    
    

    ?>
    <div class="row">
    <div class="col-12">
    <form action="" method="Post" id="myForm" enctype="multipart/form-data">
    <div class="form-group">
        <label>Category Name</label><br>
        <input type="text" value="<?php echo $row['name']; ?>" name="name" class="form-control">
        <?php
        if(!empty($erorrs['name'])){
            echo '<span class="text-danger"> '.$erorrs['name'].'</span><br>';
        }
        ?>
        </div>
        <div class="form-group">
        <label>Category Description</label><br>
        <input type="text" value="<?php echo $row['about']; ?>" name="about" class="form-control">
        <?php
        if(!empty($erorrs['about'])){
            echo '<span class="text-danger"> '.$erorrs['about'].'</span><br>';
        }
        ?>
         <br>
        Rate :<div style="display:flex;  "> 
        
        <?php 
       $numCat=0;
       $theRate=0; 
    if(mysqli_num_rows($r1)>0){
        while($row4=mysqli_fetch_assoc($r1)){
            $query2="select * from rate where store_id=".$row4['id'];
            $r2=mysqli_query($connection,$query2);
            $row2=mysqli_fetch_assoc($r2);
            if($row2['num_rate'] !=0){
                $numCat+=1;
                $theRate +=($row2['sum_rate']/$row2['num_rate']);
            }
        }
        if($numCat !=0){
        $theRate /=$numCat;
        $theRateS=strval($theRate);
        echo  substr($theRateS,0,strpos($theRateS,'.')+2);
        }else{
            echo '0 '; 
        }
    }else {
        echo '0 ';
    }
            ?>
            &nbsp<img  width=22px src=<?php echo $proj_path . 'star1.png'; ?> >
    </div> </div>
        
   
   

    
    <button class="btn btn-primary" type="BUTTON" id="btn-save">Update</button></form><br><br>
    <h1 style="WIDTH:17PX">Stores: </h1><br></div>
    <div class="container"><div class="row row-cols-1 row-cols-md-3 g-4" style="display:flex;">
    <?php 
     $r5=mysqli_query($connection,$query2);

     if(mysqli_num_rows($r1)>0){
        while($row1=mysqli_fetch_assoc($r1)){
          $query3="select * from rate where store_id=" . $row1['id'];
          $r3=mysqli_query($connection,$query3);
          if(mysqli_num_rows($r3)>0){
          $row3=mysqli_fetch_assoc($r3);
          if($row3['num_rate'] !=0){
            $rates=$row3['sum_rate']/$row3['num_rate'];
            $strRates=strval($rates);
            }else{
                $strRates="0"; 
            }
        }else{
            $strRates="0"; 
        }
   
    
            
   echo  '<div class="card" style="margin:5px; overflow:auto;width: 250px;height: 250px;">
   <div style="text-align: center;"><img class="rounded mx-auto d-block" width=210px src='.$proj_path . $row1["image"].'></div>
   Name : '.$row1['name'].'<br>
   About : '.$row1['about'].'<br>
   Rate : '.substr($strRates,0,strpos($strRates,'.')+2) .' 

   <form  method="POST" action="../store/editstore.php?id1='. $row1['id'] .'">
     <button class="btn btn-primary" type="Submit" >View</button> </form>
   </div><br><br>';
        
    
}}
    ?>
    </div></div></div></div>
</body>
</html>

<script type="text/javascript">

    $("#btn-save").click(function (event){
        event.preventDefault();
        var result=confirm("Are you sure!");
        if(result ==true){
            $("#myForm").submit();
        }
    });

</script>