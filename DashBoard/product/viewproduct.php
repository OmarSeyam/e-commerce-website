<?php 
 include_once('../../script.php');
 include_once('../../boots.php');
 include_once('../../connection.php');
include_once('../header/header.php'); 
$query1="select * from product";
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
    <th scope="col">F_price</th>
    <th scope="col">Price</th>
    <th scope="col">Qantity</th>
    <th scope="col">Created_In</th>
    <th scope="col">Status</th>
    <th scope="col">Store</th>
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
<td>'.$row['fprice'].'</td>
<td>'.$row['price'].'</td>
<td>'.$row['qty'].'</td>
<td>'.$row['in_create'].'</td>';
if($row['status']==1){
    echo '<td><span class="alert text-success">Active</span></td>';
}else{
    echo '<td><span class="alert text-danger">Active</span></td>';
}
$query="select * from stores where id=".$row['store_id'];
$r=mysqli_query($connection,$query);
$row1=mysqli_fetch_assoc($r);
$query5="select * from img_product where product_id=".$row['id'];
$r5=mysqli_query($connection,$query5);

echo'
<td>'.$row1['name'].'</td><td>';
while($row5=mysqli_fetch_assoc($r5)){
echo '<img width="60px" src=' . $proj_path .$row5['img'] .'>';
}
echo '</td>
<td><a href="editproduct.php?id1='.$row['id'].'">Edit</a></td>
<td>
<form  method="post" action="deleteproduct.php">
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