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
    $query="select * from product where id=" . $id;
           $r=mysqli_query($connection,$query);
           $row=mysqli_fetch_assoc($r);
           $query2="select * from img_product where product_id=" . $id;
           $r2=mysqli_query($connection,$query2);
        if(isset($_POST['id'])){
         $id=$_POST['id'];
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
                $query3="update product
                set name='$name' , about='$about' , fprice='$fprice', price='$price',
                qty='$qty', status='$status',store_id='$store_id'
                where id='$id'";
               $r= mysqli_query($connection,$query3);
                
                if($r){
                    $errors=[];
                    $success=true;
                    $e=0;
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
                    if($upload_path == $upload_path . $file_ex){

                       }else{
                        if(!file_exists("../../" . $upload_path)){
                            $errors['image']="Add Image of Product!";
                            $success=false;
                        } 
                        if($e==0){
                        $query4="delete from img_product where product_id=".$id;
                        $r4= mysqli_query($connection,$query4);
                        $e=1;
                        }
                        $query5="insert into img_product(product_id,img) values('$id','$upload_path')";
                        $r5= mysqli_query($connection,$query5);
                        if($r5&&$r4){
                            $errors=[];
                            $success=true;
                        }else{
                            $success=false;
                            $errors['gen']=mysqli_error($connection);
                        }
                    }
                }
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
            echo '<div class="form-group">
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
             <label>F_price</label><br>
             <input  class="form-control" type="text" name="fprice"  value="'. $row['fprice'] .'">';
             if(!empty($errors['fprice'])){
                echo '<span class="text-danger">'.$errors['fprice'].'</span>';
            }
             echo '</div>
             <div class="form-group">
             <label>Price</label><br>
             <input  class="form-control" type="number" name="price" value="'. $row['price'] . '">';
             if(!empty($errors['price'])){
                echo '<span class="text-danger">'.$errors['price'].'</span>';
               }
               echo '</div>
             <div class="form-group">
             <label>Qantity</label><br>
             <input  class="form-control" type="number" name="qty" value="'. $row['qty'] . '">';
             if(!empty($errors['qty'])){
                echo '<span class="text-danger">'.$errors['qty'].'</span>';
               }
             echo '<br><div class="form-group">&nbsp
             &nbsp&nbsp';
             if($row['status']==1){
            echo '<input type="checkbox" class="form-check-input" name="status" value="1" cheaked> <label class="form-check-label">Status</label>';
            }else{
            echo '<input type="checkbox" class="form-check-input" name="status" value="1"> <label class="form-check-label">Status</label>';
            }
            echo '<br>
             </div></div>  
             <div class="form-groub">
             <input type="file" name="store-image[]" class="form-control" multiple>';
             echo '</div> <br>
             <div class="form-groub" >';
             while($row2=mysqli_fetch_assoc($r2)){
             echo '<img class="img-thumbnail" width="120px" src="' . $proj_path .$row2['img'] .' ">';
            }
             if(!empty($errors['image'])){
                echo '<span class="text-danger">'.$errors['image'].'</span>';
            }
             echo  '</div>';
        
         $query1="select * from stores";
         $r1=mysqli_query($connection,$query1);
         echo "<div class=form-group>
         <label>Store</label><br>
         <select name=op class=form-control >
         <option value=0>....</option>";
            if(mysqli_num_rows($r1)>0){
              while($row1=mysqli_fetch_assoc($r1)){
               echo "<option ";
                if($row1['id']==$row['store_id']){
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