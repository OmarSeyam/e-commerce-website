<?php
    include_once('../../connection.php');
   if($_SERVER["REQUEST_METHOD"] ==='POST'){
    $id=$_POST['id'];
    $query7="delete from category 
    where id ='$id'";
    $r=mysqli_query($connection,$query7);
   if($r){
    header("Location:viewcategory.php");
   }
}

?>
