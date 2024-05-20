<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];  
    mysqli_query($con, "DELETE FROM `order` WHERE id = '$remove_id'");
    $message[] = 'Order Deleted Successfully';
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
			<li>
				<a href="addproduct.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Add Products</span>
				</a>
			</li>
            <li>
				<a href="products.php">
					<i class="fa-solid fa-bars-progress"></i>
					<span class="text">Manage Products</span>
				</a>
			</li>
			<li class="active">
				<a href="">
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
					<h1>Manage Orders</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Manage Orders</a>
						</li>
					</ul>
				</div>
			
			</div>

			


			<div class="form-details">
                <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                        <table>
                            <thead>
                                <tr>
                                    <td>Remove</td>
                                    <td>Name</td>
                                    <td>Number</td>
                                    <td>Address</td>
                                    <td>Items</td>
                                    <td>Total Price</td>
                                
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $select_products = mysqli_query($con, "SELECT * FROM `order` ORDER BY id DESC ");
                                    if(mysqli_num_rows($select_products) > 0){
                                        while($fetch_product = mysqli_fetch_assoc($select_products)){
                                ?>

                                        <tr class="mng">
                                            <td><a href="manageorder.php?remove=<?php echo $fetch_product['id']; ?>" onclick="return confirm('Remove item from Order?')" class="delete-btn"><i class="fa-solid fa-circle-xmark" style="color: #e81111;"></i></a></td>

                                            <td><?php echo $fetch_product['name']; ?></td>
                                            <td><?php echo $fetch_product['number']; ?></td>
                                            <td><?php echo $fetch_product['address'] . ', ' . $fetch_product['city'] . ', ' . $fetch_product['province']; ?></td>
                                            <td><?php echo $fetch_product['total_products']; ?></td>
                                            <td><?php echo number_format($fetch_product['total_price']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                    ?>
                            </tbody>
                        </table>
                    
                 </form>
                        
			</div>
		</main>
                <!-- ----------------- Main End ----------------- -->
    </section>

    <script src="script.js"></script>
</body>
</html>