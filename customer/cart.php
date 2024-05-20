<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];  
   mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};


        $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
        $row_count = mysqli_num_rows($select_rows);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="auralogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Clothings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="b1">

<section id="header">
    <a href="#"><img src="image/logo.PNG" class="logo" alt="" height=48px></a>
    <div>
        <ul id="navbar">
            <li><a href="mainpage.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php"><span><?php echo $row_count; ?></span><lord-icon src="https://cdn.lordicon.com/odavpkmb.json" trigger="hover" stroke="bold" colors="primary:#121331,secondary:#c8b6ff" style="width:50px;height:50px"></lord-icon></a></li>
        </ul>
    </div>
</section>

<section id="page-header2">
    <h2>Cart</h2>
    <p>Fill your cart; your happiness is just a checkout away</p>
</section>

<section id="cart">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>
                    <tr>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"><i class="fa-solid fa-circle-xmark" style="color: #e81111;"></i></a></td>

                        <td><img src="../uploads/<?php echo $fetch_cart['image1']; ?>" alt="error"></td>

                        <td><?php echo $fetch_cart['name'] . ' (' . $fetch_cart['size'] . ')'; ?></td>

                        <td>LKR <?php echo number_format($fetch_cart['price']); ?></td>
                        
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>" >
                                
                                <input type="submit" value="Update"class="update-btn" name="update_update_btn">
                                
                            </form> 
                        </td>

                        <td>LKR <?php echo number_format($sub_total = $fetch_cart['price'] * $fetch_cart['quantity'], 2); ?></td>
                    </tr>
                    <?php
                    $grand_total += $sub_total; 
                }
            }
                ?>
        </tbody>
    </table>
</section>

        

<section id="cart-add" class="section-p1">
    <div id="shopmore">
       

        <h2><a href="mainpage.php">Shop More!</a></h2>
        <h4>New Arrivals</h4>

        
        <div class="im">
            <img src="./image/c1.png" alt="">
            <img src="./image/c2.jpg" alt="">
            <img src="./image/c3.jpg" alt="">
            <img src="./image/c4.jpg" alt="">
        </div>
    </div>
   

    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td><?php echo 'LKR ' . number_format($grand_total, 2); ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?php echo 'LKR ' . number_format($grand_total, 2); ?></strong></td>
            </tr>
        </table>
        <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>

    </div>
</section>

         

    <footer class="section-p1">

        <div class="col">
            <img calss="logo" src="image/logo.png" height="65px" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>No:1, 1st Cross Street, Dehivala</p>
            <p><strong>Phone: </strong>071 7878 014 / 075 7878 014</p>
            <p><strong>Hours: </strong>09:00 - 05:00, Mon - Sat</p>

            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-pinterest-p"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign in</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="image/appstore_logo/appstore.png" width="125px" alt="">
                <img src="image/appstore_logo/googleplay.png" width="111px" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="image/appstore_logo/payment.png" width="230px" alt="">
        </div>

        <div class="copyright">
            <p>©️ 2024 Mohamed Usama. All rights reserved.</p>
        </div>
    </footer>

<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script src="script.js"></script>
    
</body>
</html>
