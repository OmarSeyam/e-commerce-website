<?php
$pc_name=exec('getmac');
$pc_name=strtok($pc_name,' ');
include_once('../../script.php');
include_once('../../boots.php');
include_once('../../connection.php');

if($_SERVER["REQUEST_METHOD"] ==='POST'){

    if(isset($_POST['id'])){
    $id=$_POST['id']; 
    $query1="select * from stores where id='$id'";
    $r1=mysqli_query($connection,$query1);
    $row1=mysqli_fetch_assoc($r1);
    }


        $query4="select * from rate where store_id=" . $id;
        $r4=mysqli_query($connection,$query4);
        $row4=mysqli_fetch_assoc($r4);  
        if(!empty($_POST['star-rating-1'])){   
        if($_POST['star-rating-1'] !=0){
            $query12="select * 
            from is_rated r inner join stores s on(r.store_id=s.id)
            where s.id=" . $row1['id'] ." and r.pc_name='".$pc_name."' " ;
            $r12=mysqli_query($connection,$query12);
            $is_rated =0;
            if(mysqli_num_rows($r12)>0){
                while($row12=mysqli_fetch_assoc($r12)){
                    if($pc_name == $row12['pc_name']){
                        $is_rated =1;
                    }
                }}
                if($is_rated ==0){
            $rate=floatval($_POST['star-rating-1']);
            $sum_rate=$row4['sum_rate'];
            $num_rate=$row4['num_rate'];
            $sum_rate +=$rate;
            $num_rate+=1;
            $query3="update rate
            set sum_rate = '$sum_rate' , num_rate= '$num_rate' 
            where store_id = $id ";
        mysqli_query($connection,$query3);
        $query11="insert  into is_rated(pc_name,rate,store_id) values('$pc_name','$rate','$id') ";
        $r11=mysqli_query($connection,$query11);
         }
        }
    }       
   
}
    



?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title><?php echo $row1['name'];?></title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header class="section">
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <?php
                          echo '<div class="logo"><h1 style="color: #ffffff;font-size:35px;font-family: URW Chancery L, cursive;">'.$row1['name'].'</h1></div>';
                           ?>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
         <!-- end header inner -->
      </header>
      <!-- end header -->
      <section >
         <div id="main_slider" class="section carousel slide banner-main" data-ride="carousel">
          
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="carousel-caption ">
                              <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                              <?php
                              echo '<div style="width: 500px; max-width:500px;max-height:300px; overflow:hidden;word-wrap: break-word;"><p>'.$row1['about'].'</p></div>';
                              ?>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                           <div class="img-box">
                              <?php
                              echo '<figure><img src='.$proj_path . $row1['image'] .' alt="img"/></figure>';
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>         
         </div>
      </section>
      <!-- plant -->
      <div id="plant" class="section  product">
         <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="titlepage">
                     <h2><strong class="black">Our</strong>Products</h2>
                     <div class="section">
                     <?php
                     include_once('../product/viewproduct.php');
                     ?>
                  </div>
                </div>
             </div>
         </div>
      </div>

      <div id="plant" class="section  product">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage">
                     <h2 ><strong class="black"> Rate</strong>  Us</h2>
                     <div  style="display:flex; ">
                     <?php
                     if($row4['num_rate'] !=0){
                        $theRateS =$row4['sum_rate']/$row4['num_rate'];
                     }else{
                        $theRateS=0;
                     }
                     echo  substr($theRateS,0,strpos($theRateS,'.')+2);
                     ?>
                     <img  width=22px src=<?php echo $proj_path . 'star1.png'; ?> >
                     </div>
                     <?php
                     $query13="select * 
                     from is_rated r inner join stores s on(r.store_id=s.id)
                     where s.id=" . $row1['id'] ." and r.pc_name='".$pc_name."' ";
                     $r13=mysqli_query($connection,$query13);
                     $is_rated =0;
                     if(mysqli_num_rows($r13)>0){
                      while($row13=mysqli_fetch_assoc($r13)){
                          if($pc_name == $row13['pc_name']){
                              $is_rated =1;
                              $ra=$row13['rate'];
                          }
                      }}
                     if($is_rated ==0){
                     echo '
                        <label for="star-rating-1" class="control-label">Rate store:</label>
                        <form method="post" action="">
                        <input type="hidden" name="id" value='.  $row1['id'] .'>
                        <input id="star-rating-1" name="star-rating-1" class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="0.5" data-size="xs">
                        <button class="btn btn-primary" style="width: 143px;" type="submit">Send rate</button> </form></div><br><br>';
                     }else{
                        echo '<input id="star-rating-1" name="star-rating-1" class="rating rating-loading" value="'. $ra .'" data-min="0" data-max="5" data-step="0.5" data-size="xs"></div>';
                     }
                          
                      ?>
                        
                  </div>
               </div>
            </div>
         </div>
      </div>
        
      <!-- end plant -->
      <!--about -->
      <div class="section about ">
         <div class="container">
             <div class="row">
                <div class="col-12">
                    <div class="titlepage">
                     <h2><strong class="black"> About</strong>  Us</h2>
                     
                     <?php
                     echo '<span style="width:750px; word-wrap: break-word;">'.$row1['about'].'</span>';
                     ?>
                  </div>
                </div>
             </div>
         </div>
      </div>


      <div id="plant" class="contact_us layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage">
                    <h2><strong class="black"> Contact</strong>  Us</h2>
                    <div id="footer" class="Address layout_padding" syle="text-align:center;">
                    <div class="address_2">
                    <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="site_info" >
                          <span class="info_icon"><img src="images/map-icon.png" /></span>
                          <span style="margin-top: 10px;color:ffffff;"><?php echo $row1['address']; ?></span></div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                     <div class="site_info">
                          <span class="info_icon"><img src="images/phone-icon.png" /></span>
                          <span style="margin-top: 21px;color:ffffff;">( <?php echo $row1['phone']; ?> )</span></div>
                     </div></div></div></div></div></div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      
      
      
      
      
      
      
      
      

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
   </body>
</html>