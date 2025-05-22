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
if($_SERVER["REQUEST_METHOD"] ==='POST'){
  $query="Delete from admin where id=". $id ;
  $r=mysqli_query($connection,$query);
  if($r){
    header('REFRESH: 0 ; URL =../login/login.php');
  }else{
    echo'<div class="row">
    <div class="col-12">
    <div class="alert alert-danger">'.mysqli_error($connection) .'</div></div></div>';
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
<div class="container">
    <div class="main-body">
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src=<?php echo $proj_path . $row['image']  ?> alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $row['name']  ?></h4>
                      <p class="text-secondary mb-1"><?php echo $row['about']  ?></p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['name']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['email']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php 
                    for($i=0;$i<$row['num_pass'];$i++){
                      echo "*";
                    }  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['phone']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php
                    if($row['status']==1){
                      echo '<span class="text-success">Active</span>';

                    }else{
                      echo '<span class="text-danger">Not Active</span>';
                    }
                        ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row['address']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info "  href="editprofile.php">Edit</a>
                      <form id="myForm" action="" method="post" style="display: inline;">
                     &nbsp<button class="btn btn-danger " id="btn-delete">Delete</button>
                     </form>
                    </div>
                  </div>
                </div>
              </div>

              


            </div>
          </div>

    
</body>
</html>
<script type="text/javascript">
    $("#btn-delete").click(function (event){
        event.preventDefault();
        var result=confirm("Are you sure!");
        if(result ==true){
            $("#myForm").submit();
        }
    });
   
</script>