<?php
include_once('../../connection.php');
include_once('../../script.php');
$errors=[];
$success=false;
if(!empty($_GET['x'])){
if($_SERVER["REQUEST_METHOD"] ==='POST'){
    if(isset($_FILES['image-person'])){
    $file_name=$_FILES['image-person']['name'];
    $file_size=$_FILES['image-person']['size'];
    $file_tmp=$_FILES['image-person']['tmp_name'];
    $file_type=$_FILES['image-person']['type'];
    $file_ex=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $file_newName=strval(time()+rand(1,10000000))  . ".$file_ex";
    $upload_path='../../upload/' . $file_newName;
    move_uploaded_file($file_tmp,$upload_path);
    $upload_path=str_replace("../../","",$upload_path);
    if(!file_exists("../../" . $upload_path)){
        $errors['image']="Add Your Image !";
    }
    }else{
        $errors['image']="Add Your Image !";
    }
    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $email=$_POST['email'];
    $about=$_POST['about'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];

    if(empty($name)){
        $errors['name']="Fill Your Name !";
    }
    if(empty($email)){
        $errors['email']="Fill Your Email !";
    }
    if(empty($pass)){
        $errors['pass']="Fill Your Password !";
    }
    if(empty($about)){
        $errors['about']="Fill Your Description !";
     }
    if(empty($address)){
        $errors['address']="Fill Your Address !";
    }
    if(empty($phone)){
        $errors['phone']="Fill  Your Phone!";
    }
    
    if(count($errors )>0){
        $errors['gen']="Complete information!";
       }else{
        $num_pass=strlen($pass);
        $pass =md5(strval($pass));
        $query="insert into admin(name,password_,num_pass,email,image,phone,about,status,address) values('$name','$pass','$num_pass','$email','$upload_path','$phone','$about',1,'$address')";
        $r=mysqli_query($connection,$query);
        
        if($r){
            $errors=[];
            $success=true;
            $query2="select * from admin order by id desc limit 1";
            $r2=mysqli_query($connection,$query2);
            $row2=mysqli_fetch_assoc($r2);
            setcookie('id',$row2['id'],time() +(86400 *30), "/");
            header('REFRESH: 0 ; URL =../index/index.php');
            
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Sign Up</title>

    <!-- Custom fonts for this template-->
    <link href="../index/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../index/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5" >
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="myForm" action="?x=1" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Your Name...">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['name'])){
                                                echo '<span class="text-danger">'.$errors['name'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['email'])){
                                                echo '<span class="text-danger">'.$errors['email'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['pass'])){
                                                echo '<span class="text-danger">'.$errors['pass'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group" >
                                            <input type="file" name="image-person" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Photo">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['image'])){
                                                echo '<span class="text-danger">'.$errors['image'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Phone">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['phone'])){
                                                echo '<span class="text-danger">'.$errors['phone'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="about" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Description">&nbsp&nbsp
                                                <?php
                                                if(!empty($errors['about'])){
                                                echo '<span class="text-danger">'.$errors['about'].'</span>';
                                                }
                                                ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control form-control-user"
                                                 placeholder="Address">&nbsp&nbsp
                                                 <?php
                                                if(!empty($errors['address'])){
                                                echo '<span class="text-danger">'.$errors['address'].'</span>';
                                                }
                                                ?>
                                        </div>
                  
                                        <button type="submit" id="btn-sign" class="btn btn-primary btn-user btn-block">
                                            Sign Up
                                        </button>
                            &nbsp&nbsp&nbsp<a href="login.php">have account?</a>

                                       
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<script type="text/javascript">
    $("#btn-sign").click(function (event){
        event.preventDefault();
        var result=confirm("Are you sure!");
        if(result ==true){
            $("#myForm").submit();
        }
    });
   
</script>