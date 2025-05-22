
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
    $query="select * from stores";
    $r=mysqli_query($connection,$query);
    $errors=[];
    $success=false;
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
        $name=$_POST['name'];
        $about=$_POST['about'];
        $fprice=$_POST['fprice'];
        $price=$_POST['price'];
        $qty=$_POST['qty'];
        if(isset($_POST['status'])){
        $status=1;
        }else{
            $status=0;
        }
        $store_id=$_POST['op'];
        $date=date("Y-m-d h:i:s");
        
            
        if(empty($name)){
            $errors['name']="Fill Name of store!";
        }
        if(empty($about)){
            $errors['about']="Fill Description of store!";
        }
        if(empty($fprice)){
            $errors['fprice']="Fill F_price of store!";
        }
        if(empty($price)){
            $errors['price']="Fill Price of store!";
        }
        if(empty($qty)){
            $errors['qty']="Fill Qantity of store!";
        }
        
        if($store_id =="0"){
            $errors['category']="Select Store of Product!";
        }

        if(count($errors )>0){
            $errors['gen']="Complete information!";
           }else{
            $query1="insert into product(name,about,fprice,price,qty,in_create,status,store_id) values('$name','$about','$fprice','$price','$qty','$date','$status','$store_id')";
           $r= mysqli_query($connection,$query1);
           $query3="SELECT * FROM product ORDER BY id DESC LIMIT 1";
           $r3=mysqli_query($connection,$query3);
           $row3=mysqli_fetch_assoc($r3);
           $product_id=$row3['id'];
            if($r){
                $coun=count($_FILES['store-image']['name']);
                for($i=0;$i<$coun;$i++){
                    $file_name=$_FILES['store-image']['name'][$i];
                    $file_size=$_FILES['store-image']['size'][$i];
                    $file_tmp=$_FILES['store-image']['tmp_name'][$i];
                    $file_type=$_FILES['store-image']['type'][$i];
                    $file_ex=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
                    $file_newName=strval(time()+rand(1,10000000))  . ".$file_ex";
                    $upload_path='../../upload/' . $file_newName;
                    move_uploaded_file($file_tmp,$upload_path);
                    $upload_path=str_replace("../../","",$upload_path);
                    if(!file_exists("../../" . $upload_path)){
                        $errors['image']="Add Image of Product!";
                    }
                    $query2="insert into img_product(product_id,img) values('$product_id','$upload_path')";
                    $r2= mysqli_query($connection,$query2);
                    if($r2){
                        $errors=[];
                        $success=true;
                    }else{
                    $errors['gen']=mysqli_error($connection);
                    }
                    }
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
        <label>F_price</label><br>
        <input type="number" name="fprice" class="form-control">
        <?php
        if(!empty($errors['fprice'])){
         echo '<span class="text-danger">'.$errors['fprice'].'</span>';
        }
         ?>
    </div>
    <div class="form-group">
        <label>Price</label><br>
        <input type="number" name="price" class="form-control">
        <?php
        if(!empty($errors['price'])){
         echo '<span class="text-danger">'.$errors['price'].'</span>';
        }
         ?>
        
    </div>
    <div class="form-group">
        <label>Qantity</label><br>
        <input type="number" name="qty" class="form-control">
        <?php
        if(!empty($errors['qty'])){
         echo '<span class="text-danger">'.$errors['qty'].'</span>';
        }
         ?>
    </div>

    <div class="form-groub">
        <input type="file" name="store-image[]" class="form-control" multiple>
        <?php
        if(!empty($errors['image'])){
            echo '<span class="text-danger">'.$errors['image'].'</span>';
           }
         ?>
    </div>
    <br>
    <div class="form-group">&nbsp
    &nbsp&nbsp<input type="checkbox" class="form-check-input" name="status" value="1"> <label class="form-check-label">Status</label>
    </div>
   

        <div class="form-group">
        <label>Stores</label><br>
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