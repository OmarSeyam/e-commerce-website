<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css1/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css1/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css1/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css1/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css1/style.css"/>
    <title>Document</title>
</head>
<body>
    <?php
    include_once('../../connection.php');
    $query10="select * from product";
    $r10=mysqli_query($connection,$query10);
   ?>
    <!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
						</div>
					</div>

					<!-- product -->
                    <?php
                    while($row10=mysqli_fetch_assoc($r10)){
                        $query11="select * from img_product where product_id=". $row10['id'] ." Limit 1";
                        $r11=mysqli_query($connection,$query11);
                        $row11=mysqli_fetch_assoc($r11);
                        echo '
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img" style="height:200px; max-height:200px;overflow:hidden;">
								<img src="'.$proj_path . $row11['img'].'" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<h3 class="product-name"><a href="#">'. $row10['name'] .'</a></h3>
								<h4 class="product-price">'. $row10['price'] .'<del class="product-old-price">'. $row10['fprice'] .'</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>';
                    }
                
                    ?>
               </div>
               </div>
               </div>
                     
</body>
</html>