<?php 
 include_once('../../script.php');
 include_once('../../boots.php');
 include_once('../../connection.php');
include_once('../header/header.php'); 
$query1="select * from stores";
$r1=mysqli_query($connection,$query1);
     ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <div class="container">
    <table class="table">
  <thead class="table-dark">
  <tr>
    <th scope="col" >ID</th>
    <th scope="col">Name</th>
    <th scope="col">Description</th>
    <th scope="col">ِAdress</th>
    <th scope="col">Phone</th>
    <th scope="col">Category</th>
    <th scope="col">Image</th>
    <th scope="col">Edit</th>
    <th scope="col">Delete</th>
  </tr>
</thead>
<tbody>
<?php
if(mysqli_num_rows($r1)>0){
    while($row=mysqli_fetch_assoc($r1)){
echo '<tr>
<th scope="row">'.$row['id'].'</th>
<td>'.$row['name'].'</td>
<td style="width:50px; max-width:50px;  overflow:auto;margin-right:15px">'.$row['about'].'</td>
<td style="width:150px; max-width:150px; margin-right:25px;margin-left:15px;">'.$row['address'].'</td>
<td>'.$row['phone'].'</td>
';
$query="select * from category where id=".$row['category_id'];
$r=mysqli_query($connection,$query);
$row1=mysqli_fetch_assoc($r);
echo'
<td>'.$row1['name'].'</td>
<td><img width="90px" src=' . $proj_path .$row['image'] .'></td>
<td><a href="editstore.php?id1='.$row['id'].'">Edit</a></td>
<td>
<form  method="post" action="deletestore.php">
<input name="id" value='.$row['id'].' type="hidden" >
<button class="btn btn-danger" type="button" >DELETE</button> </form>
</td>
</tr>';
    }
}


?>


</div>
</div>
</body>
</html>
<script>
     $(".btn").click(function (){
        var result=confirm("Are you sure!");
        if(result ==true){
            $(this).parent().submit();
        }
    });
</script>