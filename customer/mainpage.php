<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: ../login/index.php");
}




if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_image = $_POST['image1'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'Product Already Added to Cart';
    }else{
       $insert_product = mysqli_query($con, "INSERT INTO `cart`(`image1`, `name`, `price`, `quantity`) VALUES('$product_image', '$product_name', '$product_price', '$product_quantity')");
       $message[] = 'Product Added to Cart Successfully';
    }
 
 }


 if(isset($_POST['send'])){

    $email = $_POST['email'];
    $select_email = mysqli_query($con, "SELECT * FROM `newsletter` WHERE email = '$email'");
 
    if(mysqli_num_rows($select_email) > 0){
       $message[] = 'Already subscribed! Stay tuned for more updates and offers';
    }else{
       $insert_email = mysqli_query($con, "INSERT INTO `newsletter`(`email`) VALUES('$email')");
       $message[] = 'Thanks for subscribing! Expect updates and deals in your inbox';
    }
 
 }
 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" herf="auralogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Clothings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php

$select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>

<div id="messageContainer">
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
</div>




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
                                            <li><a href="./category/women-tops.php">Tops</a></li>
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
                

            </ul>
        </div>

    <div class="navright">
        <li><a href="cart.php"><span><?php echo $row_count; ?></span><lord-icon src="https://cdn.lordicon.com/odavpkmb.json" trigger="hover" stroke="bold" colors="primary:#121331,secondary:#c8b6ff" style="width:50px;height:50px"></lord-icon></a></li>

                <li><img src="<?php echo $row["image"]; ?>"  class="user-pic" onclick="toggleMenu()"></li>

        </div>
        <div class="submenuwrap" id="subMenu">
            <div class="submenu">
                <div class="info">
                <ul>
                    <li><img src="<?php echo $row["image"]; ?>"></li>
                </ul>
                <h1><?php echo $row["name"]; ?></h1>
                </div>
                <hr>

                <a href="#"class="submenu-link">
                <i class="fa-solid fa-user"></i>
                <p>Edit Profile</p>
                <span><i class="fa-solid fa-caret-right"></i></span>
                </a>

                <a href="../login/logout.php"class="submenu-link">
                <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>
                <p>Logout</p>
                <span><i class="fa-solid fa-caret-right"></i></span>
                </a>

                <a href="#"class="submenu-link">
                <i class="fa-solid fa-truck-fast"></i>
                <p>My Orders</p>
                <span><i class="fa-solid fa-caret-right"></i></span>
                </a>

            </div>
    </div>

    </section>

    <section id="hero">

     <div class="hero">
        <div class="row container d-flex">
            <div class="col">
                <span class="subtitle">Limited Time Only For Winter</span>
                <h1>fash<span class="i">i</span>on</h1>
                <p>LOOK YOUR BEST ON YOUR BEST DAY</p>
                <button class="btn">Explore Now!</button>
            </div>
            <img src="image/hero.PNG" width="51%" alt="">
        </div>
     </div>    
    </section>
    
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="image/features/f1.png" width="160px" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="image/features/f2.png" width="160px" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="image/features/f3.png" width="111px" alt="">
            <h6>Save Money</h6>
        </div>

        <div class="fe-box">
            <img src="image/features/f4.png" width="125px" alt="">
            <h6>Promotions</h6>
        </div>

        <div class="fe-box">
            <img src="image/features/f5.png" width="113px" alt="">
            <h6>Happy Sell</h6>
        </div>

        <div class="fe-box">
            <img src="image/features/f6.png" width="131px" alt="">
            <h6>24/7 Support</h6>
        </div>

    </section>

<section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>

    <div class="pro-container">

        <?php
      
            $select_products = mysqli_query($con, "SELECT * FROM `products` WHERE keywords ='featured'");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>
       
        <div class="pro" onclick="window.location.href='sproduct.php?product_id=<?php echo $fetch_product['id']; ?>';">

            <form action="" method="post">
                <img src="../uploads/<?php echo $fetch_product['image1']; ?>" alt="">
                <div class="des">
                    <span>aura</span>
                    <h5><?php echo $fetch_product['name']; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>LKR <?php echo $fetch_product['price']; ?></h4>
                </div>
                

                <input type="hidden" name="name" value="<?php echo $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="image1" value="<?php echo $fetch_product['image1']; ?>">

                <a><input type="submit" class="btn" value=" " name="add_to_cart"><lord-icon src="https://cdn.lordicon.com/eiekfffz.json"  class="cart" trigger="hover" delay="1500" colors="primary:#121331,secondary:#ebe6ef tertiary:#e5d1fa"> </lord-icon></a>
            </div>
        </form>

        <?php
           };
         };
        ?>

    </div>
</section>   
    
    <section id="banner" class="section-m1">
        <h4>Black Friday</h4>
        <h2>Up to <span>70% Off</span> - All T-shirts and Shirts </h2>
        <button class="button-b" role="button">Explore More</button>
    </section>

<section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Modern Design</p>

    <div class="pro-container">

        <?php

            $select_products = mysqli_query($con, "SELECT * FROM `products` WHERE category ='women-t'");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>

        <div class="pro" onclick="window.location.href='sproduct.php?product_id=<?php echo $fetch_product['id']; ?>';">

            <form action="" method="post">
                <img src="../uploads/<?php echo $fetch_product['image1']; ?>" alt="">
                <div class="des">
                    <span>aura</span>
                    <h5><?php echo $fetch_product['name']; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>LKR <?php echo $fetch_product['price']; ?></h4>
                </div>
                

                <input type="hidden" name="name" value="<?php echo $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="image1" value="<?php echo $fetch_product['image1']; ?>">

                <a><input type="submit" class="btn" value=" " name="add_to_cart"><lord-icon src="https://cdn.lordicon.com/eiekfffz.json"  class="cart" trigger="hover" delay="1500" colors="primary:#121331,secondary:#ebe6ef tertiary:#e5d1fa"> </lord-icon></a>
            </div>
        </form>

        <?php
        };
        };
        ?>

    </div>
</section>   
     
    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>The best classic dress is on sale at AURA clothings</span>
            <button class="button2">Learn more</button>
        </div>

        <div class="banner-box banner-box2">
            <h4>Spring/Summer</h4>
            <h2>Upcoming Season</h2>
            <span>The best classic dress is on sale at AURA clothings</span>
            <button class="button2">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection 50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>MEN'S COLLLECTION</h2>
            <h3>Spring/Summer 2024</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>WOMEN'S COLLECTION</h2>
            <h3>New Trendy Designs</h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>

        <form action="" method="post">
        <div class="form">
            <input type="text" name="email" placeholder="Your email address" required>
            <button name="send">Sign Up</button>
        </div>

        </form>
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


    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu(){
        subMenu.classList.toggle("open-menu");
        }

    </script>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script scr="script.js"></script>
    
</body>
</html>