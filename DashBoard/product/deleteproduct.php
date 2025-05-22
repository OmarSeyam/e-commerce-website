<?php
    include_once('../../connection.php');
    if($_SERVER["REQUEST_METHOD"] ==='POST'){
        if(!empty($_POST['id'])){
        $id=$_POST['id'];
        $query8="delete from product 
         where id ='$id'";
         $r=mysqli_query($connection,$query8);
        if($r){
            header("Location:viewproduct.php");
        }
    }
}
?>
