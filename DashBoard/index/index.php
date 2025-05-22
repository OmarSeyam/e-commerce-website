<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    

</head>

<body id="page-top" style="overflow:hidden;">
<?php 
include_once("../header/header.php");
#$query="select * from admin";
#$r=mysqli_query($connection,$query);
 ?>
    <!-- Page Wrapper -->
   
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" >

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        #if(mysqli_num_rows($r2)>0){
                        #echo '<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$row2['name'].'</span>
                        #<img class="img-profile rounded-circle" src="'. $proj_path . $row2['image'] .'">';
                        #}
                        ?>
                        
                    </a>

                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../profile/profile.php">
                            Profile
                        </a>
                   
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../login/login.php">
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <div class="container">
        <div class="row">
        <div class="col-12" style="margin-top:100px;">
        <?php
include_once('../../connection.php');
    
/*if($_SERVER["REQUEST_METHOD"] ==='POST'){
    $id=$_GET['id'];
    $status=0;
   if(!empty($_POST['status']) && $_POST['status'] =="1"){
       $status=1;
   }else{
    $status=0;
   }
   $query1="select * from admin where id=". $id;
   $r1=mysqli_query($connection,$query1);
   $row1=mysqli_fetch_assoc($r1);
   $query3="update admin
			set status='$status'
			where id=".$id;
   $r3=mysqli_query($connection,$query3);
   if($r3){
    echo'<div class="row">
    <div class="col-12">
    <div style="position:relative;left:-140px;" class="alert alert-success">Edit Successful</div></div></div>';
    }else{
    echo'<div class="row">
    <div class="col-12">
    <div style="position:relative;left:-140px;" class="alert alert-danger">'.mysqli_error($connection) .'</div></div></div>';
    }
}*/
?>
        
      <!--  <table class="table table-dark" style="position:relative;left:-140px;">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Description</th>
                <th scope="col">ِAdress</th>
                <th scope="col">Phone</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Edit Status</th>
                <th scope="col">Save Edit</th>
            </tr>
            </thead>
            <tbody>
         <?php
             /*  if(mysqli_num_rows($r)>0){
                while($row=mysqli_fetch_assoc($r)){
            echo '<tr>
            <th scope="row">'.$row['id'].'</th>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['about'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['phone'].'</td>
            <td><div class="d-flex flex-column align-items-center text-center">
            <img src='. $proj_path . $row['image'] .' alt="Admin" class="rounded-circle" width="115"></div></td>';
            if($row['status']==1){
                echo '<td><span class="text-success">Active</span></td>
                <td><div class="form-check form-switch"><form class="myForm"   action="?id='.$row['id'].'" method="post">
                <input name="status" value="1" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked  ';
                if($row['id'] ==$row2['id']){
                    echo "disabled>";
                    echo '<td><button class="btn btn-primary btn-edit" type="submit" id="btn-save">Save</button></td></form></div></td></tr>';
                }else{
                    echo ">";
                    echo '<td><button class="btn btn-primary btn-edit" type="submit" id="btn-save">Save</button></td></form></div></td></tr>';
                }      
              
                }else{
                    echo '<td><span class="text-danger">Not Active</span></td>
                    <td><div class="form-check form-switch"><form class="myForm"  action="?id='.$row['id'].'" method="post">
                    <input name="status" value="1" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"  ';
                    if($row['id'] ==$row2['id']){
                        echo "disabled>";
                        echo '<td><button class="btn btn-primary btn-edit" type="submit" >Save</button></td></form></div></td></tr>';
                    }else{
                        echo ">";
                        echo '<td><button class="btn btn-primary btn-edit" type="submit" >Save</button></td></form></div></td></tr>';
                    } 
                   
                }
           
                }
            }
*/

            ?>
            </tbody> -->
</div></div>
</div></div>     

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
