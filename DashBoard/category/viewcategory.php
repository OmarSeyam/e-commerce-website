<?php 
 include_once('../../script.php');
 include_once('../../boots.php');
 include_once('../../connection.php');
 include_once('../header/header.php');
$query="select * from category";
$r=mysqli_query($connection,$query);

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
    <table class="table table-dark" >
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Description</th>
    <th scope="col">Edit</th>
    <th scope="col">Delete</th>
  </tr>
</thead>
<tbody>
<?php
if(mysqli_num_rows($r)>0){
    while($row=mysqli_fetch_assoc($r)){
echo '<tr>
<th scope="row">'.$row['id'].'</th>
<td>'.$row['name'].'</td>
<td style="width:50px; max-width:50px;  overflow:auto;">'.$row['about'].'</td>
<td><a href="editcategory.php?id='.$row['id'].'">Edit</a></td>
<td>
<form  method="post" action="deletecategory.php">
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

                        