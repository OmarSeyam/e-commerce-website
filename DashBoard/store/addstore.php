
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
    $query="select * from category";
    $r=mysqli_query($connection,$query);
    $errors=[];
    $success=false;
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
           $file_name=$_FILES['store-image']['name'];
            $file_size=$_FILES['store-image']['size'];
            $file_tmp=$_FILES['store-image']['tmp_name'];
            $file_type=$_FILES['store-image']['type'];
            $file_ex=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $file_newName=strval(time()+rand(1,10000000))  . ".$file_ex";
            $upload_path='../../upload/' . $file_newName;
            move_uploaded_file($file_tmp,$upload_path);
            $name=$_POST['name'];
            $about=$_POST['about'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $upload_path=str_replace("../../","",$upload_path);
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
            if(!file_exists("../../" . $upload_path)){
                $errors['image']="Add Image of store!";
            }
            if($category_id =="0"){
                $errors['category']="Select Category of store!";
            }

            if(count($errors )>0){
                $errors['gen']="Complete information!";
               }else{
                $query1="insert into stores(name,about,image,phone,address,category_id) values('$name','$about','$upload_path','$phone','$address','$category_id')";
               $r= mysqli_query($connection,$query1);
                
                if($r){
                    $errors=[];
                    $success=true;
                }else{
                    $errors['gen']=mysqli_error($connection);
                }
        
               }
        
               if($success){
                echo'<div class="alert alert-success">Add Successful</div>';
                }else{
                    echo' <div class="alert alert-danger">'.$errors['gen'].'</div>';
                }
       
    }
    
    

    ?>
    <div class="row">
    <div class="col-12">
    <form action="" method="Post" id="myForm" enctype="multipart/form-data">
    <div class="form-group">
        <label>Name</label><br>
        <input type="text" name="name" class="form-control">
        <?php
        if(!empty($errors['name'])){
         echo '<span class="text-danger">'.$errors['name'].'</span>';
        }
         ?>
    </div>
        
        <div class="form-group">
        <label>Description</label><br>
        <input type="text" name="about" class="form-control">
        <?php
        if(!empty($errors['about'])){
         echo '<span class="text-danger">'.$errors['about'].'</span>';
        }
         ?>
    </div>
    <div class="form-group">
        <label>Address</label><br>
        <input type="text" name="address" class="form-control">
        <?php
        if(!empty($errors['address'])){
         echo '<span class="text-danger">'.$errors['address'].'</span>';
        }
         ?>
    </div>
    <div class="form-group">
        <label>phone</label><br>
        <input type="number" name="phone" class="form-control">
        <?php
        if(!empty($errors['phone'])){
         echo '<span class="text-danger">'.$errors['phone'].'</span>';
        }
         ?>
        
    </div>

    <div class="form-groub">
        <input type="file" name="store-image" class="form-control">
        <?php
        if(!empty($errors['image'])){
            echo '<span class="text-danger">'.$errors['image'].'</span>';
           }
         ?>
    </div>
    <br>
   
   

        <div class="form-group">
        <label>Naionality</label><br>
        <select  name="op" class="form-control" >
        <option value="0">....</option>
        <?php 
           $r1=mysqli_query($connection,$query);
           if(mysqli_num_rows($r1)>0){
             while($row=mysqli_fetch_assoc($r1)){
              echo "<option value=".$row['id'].">". $row['name'] ."</option>";
                   }
                  }
              ?>
        </select>
        <?php
         if(!empty($errors['category'])){
            echo '<span class="text-danger">'.$errors['category'].'</span>';
           }
           ?>
           </div>
            <br>
    <button class="btn btn-primary" type="BUTTON" id="btn-save">Save</button></form> <br><br>
    </div>
    </div>
    </div>
    
        
   
   
    
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