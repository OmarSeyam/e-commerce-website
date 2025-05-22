<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../index/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../index/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index/index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>


    <!-- Heading -->
    <?php

     include_once('../../connection.php'); 
     include_once('../../boots.php'); 
     if(count($_COOKIE)>0){
     if(isset($_COOKIE['id'])){
     $id= $_COOKIE['id'];
     }}
$query2="select * from admin where id=". $id ;
$r2=mysqli_query($connection,$query2);
$row2=mysqli_fetch_assoc($r2);
?>
<div class="sidebar-heading">
        Dashboard
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <span>Category</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Add Category:</h6>
            <a class="collapse-item" href="../category/addcategory.php">ADD </a>
                <h6 class="collapse-header">View Categorys :</h6>
                <a class="collapse-item" href="../category/viewcategory.php"> View </a>
                

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            
            <span>Stores</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Add Store:</h6>
            <a class="collapse-item" href="../store/addstore.php"> ADD </a>
                <h6 class="collapse-header">View Stores:</h6>
                
              <a class="collapse-item" href="../store/viewstore.php"> View </a>
               

            </div>
        </div>
    </li>
    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <span>Product</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Add Product:</h6>
                        <a class="collapse-item" href="../product/addproduct.php"> ADD </a>
                        <h6 class="collapse-header">View Product:</h6>
                
              <a class="collapse-item" href="../product/viewproduct.php"> View </a>
                    </div>
                </div>
            </li>

</ul>
</body>
</html>