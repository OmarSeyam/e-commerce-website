<?php
 include_once('../../script.php');
 include_once('../../boots.php');
 include_once('../../connection.php');
 if(count($_COOKIE)>0){
	if(isset($_COOKIE['id'])){
	$id= $_COOKIE['id'];
	}}
  $query="select * from admin where id=". $id ;
  $r=mysqli_query($connection,$query);
  $row=mysqli_fetch_assoc($r);
  $upload_path1=$row['image'];
  $pass1=$row['password_'];
  $errors=[];
  $success=false; 
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
	if($upload_path == $upload_path .$file_ex) 
	$upload_path=$upload_path1;
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
        if(empty($pass)){
            $pass=$pass1;
            $num_pass=$row['num_pass'];
        }else{
        $num_pass=strlen($pass);
        $pass=md5(strval($pass));
        }
        $query2="update admin
			set name='$name',email='$email',password_ ='$pass',num_pass ='$num_pass',image='$upload_path',about='$about',address='$address',phone='$phone'
			where id=".$id;
            $r2=mysqli_query($connection,$query2);
        
        if($r2){
            $errors=[];
            $success=true;
            header('REFRESH: 0 ; URL =../profile/profile.php');
            
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
                    <div class="alert alert-danger">'. $errors['gen'] .'</div></div></div>';
        }
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
        body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
    </style>
 </head>
 <body>
 <form  id="myForm"  method="POST" enctype="multipart/form-data"> 
<br>     
 <div class="container">
 <div class="main-body">
 <div class="row">				

    <div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								
								<div class="col-sm-9 text-secondary">
									<input type="text" name="name" class="form-control" value="<?php echo $row['name'];  ?>">
									<?php
                                        if(!empty($errors['name'])){
                                        echo '<span class="text-danger">'.$errors['name'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" name="email" class="form-control" value="<?php echo $row['email'];  ?>">
									<?php
                                        if(!empty($errors['email'])){
                                        echo '<span class="text-danger">'.$errors['email'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Password</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="password" name="pass" class="form-control"
                                     placeholder="<?php 
                                    for($i=0;$i<$row['num_pass'];$i++){
                                    echo "*";
                                    }  ?>">
									<?php
                                        if(!empty($errors['password_'])){
                                        echo '<span class="text-danger">'.$errors['pass'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Image</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="file" name="image-person" class="form-control" >
									<div class="d-flex flex-column align-items-center text-center"><br>
									<img src="<?php echo $proj_path . $row['image'];  ?>" alt="Admin" class="rounded-circle" width="120">
									<?php
                                        if(!empty($errors['image'])){
                                        echo '<span class="text-danger">'.$errors['image'].'</span>';
                                        }
                                    ?>
								</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];  ?>">
									<?php
                                        if(!empty($errors['phone'])){
                                        echo '<span class="text-danger">'.$errors['phone'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="address"  class="form-control" value="<?php echo $row['address'];  ?>">
									<?php
                                        if(!empty($errors['address'])){
                                        echo '<span class="text-danger">'.$errors['address'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">About</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="about" class="form-control" value="<?php echo $row['about'] ; ?>">
									<?php
                                        if(!empty($errors['about'])){
                                        echo '<span class="text-danger">'.$errors['about'].'</span>';
                                        }
                                    ?>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="button" id="btn-update" class="btn btn-primary px-4" value="Save Changes">
								</div>
							</div>
						</div>
					</div>
                    </div>
                    </div>
                    </div>
					</form>
 </body>
 </html>
 <script type="text/javascript">
    $("#btn-update").click(function (event){
        event.preventDefault();
        var result=confirm("Are you sure!");
        if(result ==true){
            $("#myForm").submit();
        }
    });
   
</script>