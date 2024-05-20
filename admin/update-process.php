<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['addproduct'])) {
    $id = $_POST['id'];
    $name = $_POST['p_name'];
    $price = $_POST['p_price'];
    $quantity = $_POST['p_qty'];
    $keywords = $_POST['p_key'];

    $sql = "UPDATE `products` SET 
            `name`='$name',
            `price`='$price',
            `quantity`='$quantity',
            `keywords`='$keywords' WHERE id='$id'";

    if(mysqli_query($con, $sql)) {
        $message[] = 'Product Updated Successfully';
    } else {
        $message[] = 'Error updating product: ' . mysqli_error($con);
    }
}

// Fetch data 
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $select_product = mysqli_query($con, "SELECT * FROM `products` WHERE id = '$id'");
    
    if(mysqli_num_rows($select_product) > 0) {
        $fetch_product = mysqli_fetch_assoc($select_product);
    } else {
        header("Location: addproduct.php?message=Product-Doesnot-Exist");
        exit;
    }
} else {
    header("Location: products.php?message=Product-Updated-Successfully");
    exit;
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="adminstyle.css">
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
			<li class="active">
				<a href="">
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
					<i class='bx bxs-doughnut-chart' ></i>
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
					<h1>Add Products</h1>
					<ul class="breadcrumb">
						<li>
							<a href="adminpage.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a href="products.php">Manage Product</a>
						</li>
                        <li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Edit Product</a>
						</li>
					</ul>
				</div>
			
			</div>

			


			<div class="form-details">
                <form action="update-process.php" method="POST" enctype="multipart/form-data">

 
                    <input type="hidden" name="id" class="formcontrol" value="<?php echo $fetch_product['id']; ?>">

                    <p>Product Images</p>
                    <img src="../uploads/<?php echo $fetch_product['image1']; ?>" width="200px" margin="20px" alt="">

                    <img src="../uploads/<?php echo $fetch_product['image2']; ?>" width="200px" alt="">

                    <img src="../uploads/<?php echo $fetch_product['image3']; ?>" width="200px" alt="">
                    
                    <img src="../uploads/<?php echo $fetch_product['image4']; ?>" width="200px" alt="">

                    <p>Add Product Name</p>
                    <input type="text" name="p_name" class="formcontrol f1" value="<?php echo $fetch_product['name']; ?>">

                    <p>Select Product Category</p>
                    <input type="text" name="p_ctg" class="formcontrol f1"  value="<?php echo $fetch_product['category']; ?>">

                    <p>Add Product Key Words</p>
                    <input type="text" name="p_key" class="formcontrol f1"  value="<?php echo $fetch_product['keywords']; ?>">

                    <p>Add Product Price</p> 
                    <input type="number" name="p_price" min="0" class="formcontrol f1"  value="<?php echo $fetch_product['price']; ?>">

                    <p>Add Product Quantity</p>
                    <input type="number" name="p_qty" min="1" class="formcontrol f1"  value="<?php echo $fetch_product['quantity']; ?>">
            
                    <button type="submit" class="btn" name="addproduct">Submit</button>
                 </form>
                        
			</div>
		</main>
                <!-- ----------------- Main End ----------------- -->
    </section>

    <script src="script.js"></script>
</body>
</html>