<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['checkoutbtn'])){

    $name = $_POST['name'];
    $number = $_POST['phone'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $city = $_POST['city'];

    $cart_query = mysqli_query($con, "SELECT * FROM `cart`");
    $price_total = 0;
    $product_names = [];
    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            
            $product_names[] = $product_item['name'].' - '. $product_item['size'] .' ('. $product_item['quantity'] .') ';
            
            $price_total += $product_item['price'] * $product_item['quantity'];
        }
    }

    $total_product = implode(', ', $product_names);
    
    $detail_query = mysqli_query($con, "INSERT INTO `order`(name, number, address, province, city, total_products, total_price) VALUES('$name','$number','$address','$province','$city','$total_product','$price_total')") or die('query failed');

    if($cart_query && $detail_query){
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
            <h3>Your Order Is Placed Successfully</h3>
            <div class='order-detail'>
                <span>".$total_product."</span>
                <span class='total'> Total : LKR ".number_format($price_total)."  </span>
            </div>
            <div class='customer-details'>
                <p> Name : <span>".$name."</span> </p>
                <p> Phone Number : <span>".$number."</span> </p>
                <p> Address : <span>".$address.", ".$province.", ".$city."</span> </p>
                <h4>(Cash On Delivery)</h4>
            </div>
            <a href='shop.php' class='shop-btn'>Continue Shopping</a>
        </div>
        </div>
        ";
    }
}

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
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<section id="header">
        <a href="#"><img src="image/logo.PNG" class="logo" alt="" height=48px></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="mainpage.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li class="drop" ><a href="#">Category <i class="fa-solid fa-caret-down fa-fade"></i></a></li>

                    <div class="dropdown_menu">
                        <ul>
                            <li class="hover-me"><a href="#">Men <i class="fa-solid fa-caret-right"></i></a>
                                    <div class="dropdown_menu1">
                                        <ul>
                                            <li><a href="./category/men-tshirt.php">T-Shirt</a></li>
                                            <li><a href="./category/men-shirt.php">Shirt</a></li>
                                            <li><a href="./category/men-touser.php">Trouser</a></li>
                                        </ul>
                                    </div>
                             </li>

                            <li class="hover-me"><a href="#">Women <i class="fa-solid fa-caret-right"></i></a>

                                    <div class="dropdown_menu1">
                                        <ul>
                                            <li><a href="./category/women-tshirt.php">T-Shirt</a></li>
                                            <li><a href="./category/women-skirt.php">Tops</a></li>
                                            <li><a href="./category/women-skirt.php">Skirt</a></li>
                                            <li><a href="./category/women-jeans.php">Jeans</a></li>
                                            <li><a href="./category/women-blouses.php">Blouses</a></li>
                                        </ul>
                                    </div>
                                </li>

                            <li><a href="./category/kids.php">Kids </a></li>
                            <li><a href="./category/other.php">Other</a></li>
                        </ul>
                    </div>

                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php"><span><?php echo $row_count; ?></span><lord-icon src="https://cdn.lordicon.com/odavpkmb.json" trigger="hover" stroke="bold" colors="primary:#121331,secondary:#c8b6ff" style="width:50px;height:50px"></lord-icon></a></li>
            </ul>
        </div>
</section>
    
<div class="container">
    <div class="checkoutLayout">

        <div class="returnCart">
            
            <h1>List Product in Cart</h1>
            <div class="list">
            <form action="" method="post">
            <?php
                $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
                $total = 0;
                $grand_total = 0;

                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);

                    $grand_total = $total += $total_price;
                   

            ?>



                <div class="item">
                    <img src="../uploads/<?php echo $fetch_cart['image1']; ?>">
                    <div class="info">
                        <div class="name"><?= $fetch_cart['name'] . ' - ' .$fetch_cart['size'] ; ?></div>
                        <div class="price">LKR <?= number_format($fetch_cart['price'], 2); ?> / 1-Product</div>
                    </div>
                    <div class="quantity"><?= $fetch_cart['quantity']; ?></div>
                    <div class="returnPrice">LKR <?php echo number_format($sub_total = $fetch_cart['price'] * $fetch_cart['quantity'], 2); ?></div>
                </div>

            <?php
                }
            }else{
                echo "<div class='display-order'><span>your cart is empty!</span></div>";
            }
            ?>
                

            </div>
        </div>
        


        <div class="right">
            <h1>Checkout</h1>
            <div class="form">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
    
                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" required>
                </div>
    
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>
                </div>
    
                <div class="group">
                    <label for="province">Province</label>
                    <select name="province" id="province" required>
                        <option value="">Choose..</option>
                        <option value="Western Province">Western Province</option>
                        <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                        <option value="Northern Province">Northern Province</option>
                        <option value="North Central Province">North Central Province</option>
                        <option value="North Western Province">North Western Province</option>
                        <option value="Central Province">Central Province</option>
                        <option value="Eastern Province">Eastern Province</option>
                        <option value="Uva Province">Uva Province</option>
                        <option value="Southern Province">Southern Province</option>
                    </select>
                </div>

                <div class="group">
                    <label for="city">City</label>
                    <select name="city" id="city" required>
                        <option value="">Choose..</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Galle">Galle</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Kalmunai">Kalmunai</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Dehivala">Dehivala</option>
                        <option value="Jafna">Jafna</option>
                        <option value="Negombo">Negombo</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Kolonnawa">Kolonnawa</option>
                        <option value="Dambulla">Dambulla</option>
                        <option value="Baticaloa">Baticaloa</option>
                        <option value="Vavuniya">Vavuniya</option>
                        <option value="Matale">Matale</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Gampaha">Gampaha</option>
                    </select>
                </div>




            </div>
            <div class="return">
                
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice">LKR <?= number_format($grand_total, 2); ?></div>
                </div>
            </div>
            <button name="checkoutbtn" class="buttonCheckout">CHECKOUT</button>
        </div>

    </div>
</div>

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
<script src="checkout.js"></script>

</body>
</html>