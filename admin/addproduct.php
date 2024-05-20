<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['addproduct'])){
    $NAME = $_POST['p_name'];
    $PRICE = $_POST['p_price'];
    $DESCRIPTION = $_POST['p_dsc'];
    $QUANTITY = $_POST['p_qty'];
    $CATEGORY = $_POST['p_ctg'];
    $KEYWORD = $_POST['p_key'];

    // Handle file uploads
    $img_des1 = handleFileUpload('p_image1');
    $img_des2 = handleFileUpload('p_image2');
    $img_des3 = handleFileUpload('p_image3');
    $img_des4 = handleFileUpload('p_image4');

    //Store entered data tmprrly
    $_SESSION['name'] = $NAME;
    $_SESSION['price'] = $PRICE;
    $_SESSION['description'] = $DESCRIPTION;
    $_SESSION['image1'] = $img_des1;
    $_SESSION['image2'] = $img_des2;
    $_SESSION['image3'] = $img_des3;
    $_SESSION['image4'] = $img_des4;
    $_SESSION['category'] = $CATEGORY;
    $_SESSION['quantity'] = $QUANTITY;
    $_SESSION['keywords'] = $KEYWORD;

// Insert data into database
    $query = "INSERT INTO `products`(`name`, `price`, `description`, `image1`, `image2`, `image3`, `image4`,`category`, `quantity`, `keywords`) 
              VALUES ('$NAME','$PRICE','$DESCRIPTION','$img_des1','$img_des2','$img_des3','$img_des4','$CATEGORY','$QUANTITY','$KEYWORD')";

        if (strlen($DESCRIPTION) > 255) {
        $message[] = 'Error: Description is too long. Please shorten it.';

    } else {
        if(mysqli_query($con, $query)){
        $message[] = 'Product Added Successfuly';

        //clear stored data after product inserted successfully
        unset($_SESSION['name']);
        unset($_SESSION['price']);
        unset($_SESSION['description']);
        unset($_SESSION['image1']);
        unset($_SESSION['image2']);
        unset($_SESSION['image3']);
        unset($_SESSION['image4']);
        unset($_SESSION['category']);
        unset($_SESSION['quantity']);
        unset($_SESSION['keywords']);
    } else {
        $message[] = 'Error: Failed to add product. Please try again.';
        }   
    }
}

// Function to handle file uploads
function handleFileUpload($fileInputName){
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
            return $target_file; 
        } else {
            $message[] = 'Sorry, there was an error uploading your file.';
            return ""; 

        }
    }

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
					<h1>Add Products</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Add Product</a>
						</li>
					</ul>
				</div>
			
			</div>

			


			<div class="form-details">
                <form action="addproduct.php" method="POST" enctype="multipart/form-data">

                    <p>Add Product Images ( .png .jpg .jpeg file type only)</p>
                    <input type="file" name="p_image1" accept="image/png, image/jpg, image/jpeg" class="formcontrol f2 img1" required>
                    <input type="file" name="p_image2" accept="image/png, image/jpg, image/jpeg" class="formcontrol f2" required>
                    <input type="file" name="p_image3" accept="image/png, image/jpg, image/jpeg" class="formcontrol f2" required>
                    <input type="file" name="p_image4" accept=".png,.jpg,.jpeg" class="formcontrol f2" required>

                    <p>Add Product Name</p>
                    <input type="text" name="p_name" placeholder="Product Name" class="formcontrol f1" required>

                    <p>Select Product Category</p>
                    <select name="p_ctg" id="category">
                        <option value ="category"> Select Category</option>
                        <option value ="Men-Tshirt"> Men > T-Shirt</option>
                        <option value ="Men-Shirt"> Men > Shirt</option>
                        <option value ="Men-Trouser"> Men > Trouser</option>
                        <option value ="Women-Tshirt"> Women > T-Shirt</option>
                        <option value ="Women-Tops"> Women > Tops</option>
                        <option value ="Women-Skirt"> Women > Skirt</option>
                        <option value ="Women-Jeans"> Women > Jeans</option>
                        <option value ="Women-Blouses"> Women > Blouses</option>
                        <option value ="Kids"> Kids</option>
                        <option value ="Other"> Other</option>
                    </select>

                    <p>Add Product Description</p>
                    <textarea name="p_dsc" id="" cols="30" rows="10" placeholder="Description"></textarea>

                    <p>Add Product Key Words</p>
                    <input type="text" name="p_key" placeholder="Product Key Words" class="formcontrol f1">

                    <p>Add Product Price</p> 
                    <input type="number" name="p_price" min="0" placeholder="Product Price" class="formcontrol f1" required
                    >
                    <p>Add Product Quantity</p>
                    <input type="number" name="p_qty" min="1" placeholder="Quantity" class="formcontrol f1" required>
            
                    <button type="submit" class="btn" name="addproduct">Submit</button>
                 </form>
                        
			</div>
		</main>
                <!-- ----------------- Main End ----------------- -->
    </section>

    <script src="script.js"></script>
</body>
</html>