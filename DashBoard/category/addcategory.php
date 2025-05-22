
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
   
    $errors=[];
    $success=false;
    
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
       $name=$_POST['name'];
       $about=$_POST['about'];
       if(empty($name)){
           $errors['name']="Fill Name of category!";
       }
       if(empty($about)){
        $errors['about']="Fill Description of category!";
    }


       if(count($errors )>0){
        $errors['gen']="Complete information!";
       }else{
        $query="insert into category(name,about) values('$name','$about')";
        $r=mysqli_query($connection,$query);
        
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
                <div class="alert alert-success">Add Successful</div></div></div>';
        }else{
            echo'<div class="row">
                    <div class="col-12">
                    <div class="alert alert-danger">'.$errors['gen'].'</div></div></div>';
        }
}


    ?>
    <div class="row">
    <div class="col-12">
    <form action="" method="Post" id="myForm" enctype="multipart/form-data">
    <div class="form-group">
        <label>Category Name</label><br>
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
        
       
   

    
    <button class="btn btn-primary" type="BUTTON" id="btn-save">save</button><br><br>
    
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