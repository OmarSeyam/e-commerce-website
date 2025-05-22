<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php  include_once('../header/header.php'); ?>
<div class="container">
    <?php
    include_once('../../script.php');
    include_once('../../boots.php');
    include_once('../../connection.php');
    if(isset($_GET['id1']))
    $id=$_GET['id1'];
    $errors=[];
    $success=false;
    $query="select * from stores where id=" . $id;
           $r=mysqli_query($connection,$query);
           $row=mysqli_fetch_assoc($r);
           $query2="select * from rate where store_id=" . $id;
           $r2=mysqli_query($connection,$query2);
           $row2=mysqli_fetch_assoc($r2);
           $upload_path1=$row['image'];
        if(isset($_POST['id'])){
         $id=$_POST['id'];
         if($_SERVER["REQUEST_METHOD"] ==='POST'){
            $file_name=$_FILES['store-image']['name'];
            $file_size=$_FILES['store-image']['size'];
            $file_tmp=$_FILES['store-image']['tmp_name'];
            $file_type=$_FILES['store-image']['type'];
            $file_ex=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $file_newName=strval(time()+rand(1,10000000))  . ".$file_ex";
            $upload_path='../../upload/' . $file_newName;
            move_uploaded_file($file_tmp,$upload_path);
            $upload_path=str_replace("../../","",$upload_path);
            if($upload_path == $upload_path . $file_ex){
             $upload_path=$upload_path1;
            }
            if(!file_exists("../../" . $upload_path)){
                $errors['image']="Errors in files!";
            }

          
            $name=$_POST['name'];
            $about=$_POST['about'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $category_id=$_POST['op'];
            if(empty($name)){
                $errors['name']="Fill Name of store!";
            }
            if(empty($about)){
                $errors['about']="Fill Description of store!";
            }
            if(empty($address)){
                $errors['address']="Fill Address of store!";
            }
            if(empty($phone)){
                $errors['phone']="Fill Phone of store!";
            }

            if($category_id =="0"){
                $errors['category']="Select Category of store!";
            }
             
            
            
            

            if(count($errors )>0){
                $errors['gen']="Complete information!";
               }else{
                $query3="update stores
                set name='$name' , about='$about' , address='$address', phone='$phone', image='$upload_path' , category_id='$category_id'
                where id='$id'";
               $r= mysqli_query($connection,$query3);
                
                if($r){
                    $errors=[];
                    $success=true;
                }else{
                    $errors['gen']=mysqli_error($connection);
                }
        
               }
        
               if($success){
                echo'<div class="row">
                        <div class="col-12">
                        <div class="alert alert-success">Update Successful</div></div></div>';
                }else{
                    echo'<div class="row">
                            <div class="col-12">
                            <div class="alert alert-danger">'.$errors['gen'].'</div></div></div>';
                }
                
            }
        }
    ?>
    <div class="row">
    <div class="col-12" >
    <form action="" method="Post" id="myForm" enctype="multipart/form-data">
    <?php 
     if(mysqli_num_rows($r2)>0){
        if($row2['num_rate'] !=0){
            $rates=$row2['sum_rate']/$row2['num_rate'];
            $strRates=strval($rates);
            }else{
                $strRates="0"; 
            }
        }else{
            $strRates="0"; 
        }
        
             echo 'Rate :<div style="display:flex; "> '.substr($strRates,0,strpos($strRates,'.')+2) .' <img style="margin:5px;"  width=15px src='. $proj_path . 'star1.png ></div>
             <div class="form-group">
             <label>Name</label><br>
             <input type="text" name="name" value="'.$row['name'] .'" class="form-control">';
             if(!empty($errors['name'])){
                echo '<span class="text-danger">'.$errors['name'].'</span>';
            }
             echo '</div> 
             <div class="form-group">
             <label>About</label><br>
             <input type="text" name="about" value="'. $row['about'] .'" class="form-control" >';
             if(!empty($errors['about'])){
                echo '<span class="text-danger">'.$errors['about'].'</span>';
               }
             echo '</div>
             <div class="form-group">
             <label>Address</label><br>
             <input  class="form-control" type="text" name="address"  value="'. $row['address'] .'">';
             if(!empty($errors['address'])){
                echo '<span class="text-danger">'.$errors['address'].'</span>';
            }
             echo '</div>
             <div class="form-group">
             <label>phone</label><br>
             <input  class="form-control" type="number" name="phone" value="'. $row['phone'] . '">';
             if(!empty($errors['phone'])){
                echo '<span class="text-danger">'.$errors['phone'].'</span>';
               }
             echo '</div>  
             <div class="form-groub">
             <input type="file" name="store-image" class="form-control">';
             echo '</div> <br>
             <div class="form-groub" >
             <img class="img-thumbnail" width="250px" src="' . $proj_path .$row['image'] .'">';
             if(!empty($errors['image'])){
                echo '<span class="text-danger">'.$errors['image'].'</span>';
            }
             echo  '</div>';
        
         $query1="select * from category";
         $r1=mysqli_query($connection,$query1);
         echo "<div class=form-group>
         <label>Naionality</label><br>
         <select name=op class=form-control >
         <option value=0>....</option>";
            if(mysqli_num_rows($r1)>0){
              while($row1=mysqli_fetch_assoc($r1)){
               echo "<option ";
                if($row1['id']==$row['category_id']){
                 echo 'selected ';
                }
                echo "value=".$row1['id'].">". $row1['name'] ."</option>";
                    
                   }

         echo '</select>';
         if(!empty($errors['category'])){
            echo '<span class="text-danger">'.$errors['category'].'</span>';
           }
        echo '</div>
                         
         <br>
         <form id="myFormdel" method="post" action=""><input type="hidden" name="id" value="'. $row['id'] .'">
         <button class="btn btn-primary" type="BUTTON" id="btn-save">Update</button> <br><br>
         </form></form>';
         
}

?>
 
</body>
</html>

<script>
    $("#btn-save").click(function (event){
        event.preventDefault();
        var result=confirm("Are you sure!");
        if(result ==true){
            $("#myForm").submit();
        }
    });
</script>