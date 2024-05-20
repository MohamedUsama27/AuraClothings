<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


/*  Delete Products from Database */

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($con, "DELETE FROM `products` WHERE id = $delete_id") or die('query failed');
    if($delete_query){
       $message[] ='Product has been deleted';
    }else{
       $message[] ='Product could not be delete';
    };
 };


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="Adminstyle.css">
    <title>AURA_AdminPanel</title>
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> 
      <i class="x" onclick="this.parentElement.style.display = `none`;">
        <i class="fa-solid fa-circle-xmark" style="color: #f0334f;"></i></i>
  </div>';
   };
};

?>

	<section id="sidebar">
		<a href="#" class="brand">
        <img src="image/logo.PNG" class="logo" alt="" >
			<span class="text">AdminPanel</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="addproduct.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Add Products</span>
				</a>
			</li>
            <li class="active">
				<a href="products.php">
					<i class="fa-solid fa-bars-progress"></i>
					<span class="text">Manage Products</span>
				</a>
			</li>
			<li>
				<a href="manageorder.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Manage Orders</span>
				</a>
			</li>
			<li>
				<a href="feedback.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Feedbacks</span>
				</a>
			</li>
			<li>
				<a href="newsletter.php">
					<i class='bx bxs-envelope'></i>
					<span class="text">Newsletter</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

	<section id="content">

                <!-- ----------------- Navbar start----------------- -->

		<nav>
			<i class='bx bx-menu' ></i>
			
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="image/tony.png">
			</a>
		</nav>
                <!-- ----------------- Navbar end----------------- -->

                <!-- ----------------- Main Start----------------- -->
        <main>
			<div class="head-title">
				<div class="left">
					<h1>Manage Products</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Manage Product</a>
						</li>
					</ul>
				</div>
			
			</div>

			

            <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
          while($fetch_product = mysqli_fetch_assoc($select_products)){
  ?>

			<div class="product-details">
                
                <img src="../uploads/<?php echo $fetch_product['image1']; ?>" alt="">
                    <div class="pr pr1">
                        <h2>Product Title:<span><?php echo $fetch_product['name']; ?></span></h2>
                        <h4>Category:<span><?php echo $fetch_product['category']; ?></span></h4>
                        <p><?php echo $fetch_product['description']; ?></p>
                    </div>
                    <div class='pr pr2'>
                        <h3>Price:<span>LKR <?php echo $fetch_product['price']; ?></span></h3>
                        <h3>Stock:<span><?php echo $fetch_product['quantity']; ?></span></h3>
                        <h3>Product ID: <?php echo $fetch_product["id"]; ?></h3>
                    </div>
                    <div class='pr pr3'>
                        <a class="update-btn" href="update-process.php?id=<?php echo $fetch_product["id"]; ?>">Update<i class="fa-solid fa-pen-to-square"></i></a>

						<a href="products.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('Are your sure you want to delete this?');">Delete<i class="fa-solid fa-trash"></i></a>
                    </div>
			</div>

            <?php
           };
         };
        ?>



		</main>
                <!-- ----------------- Main End ----------------- -->
    </section>

    <script src="Script.js"></script>
</body>
</html>