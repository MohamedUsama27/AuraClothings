<?php
include("../connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" herf="auralogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Clothings</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <section id="header">
        <a href="#"><img src="image/logo.PNG" class="logo" alt="" height=48px></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="mainpage.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="#">Category <i class="fa-solid fa-caret-down fa-fade"></i></a></li>

                    <div class="dropdown_menu">
                        <ul>
                            <li class="hover-me"><a href="#">Men <i class="fa-solid fa-caret-right"></i></a>
                                    <div class="dropdown_menu1">
                                        <ul>
                                            <li><a href="#">T-Shirt</a></li>
                                            <li><a href="#">Shirt</a></li>
                                            <li><a href="#">Trouser</a></li>
                                        </ul>
                                    </div>
                             </li>

                            <li class="hover-me"><a href="#">Women <i class="fa-solid fa-caret-right"></i></a>

                                    <div class="dropdown_menu1">
                                        <ul>
                                            <li><a href="#">T-Shirt</a></li>
                                            <li><a href="#">Tops</a></li>
                                            <li><a href="#">Skirt</a></li>
                                            <li><a href="#">Jeans</a></li>
                                            <li><a href="#">Blouses</a></li>
                                        </ul>
                                    </div>
                                </li>

                            <li><a href="#">Kids </a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </div>

                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php"><lord-icon src="https://cdn.lordicon.com/odavpkmb.json" trigger="hover" stroke="bold" colors="primary:#121331,secondary:#c8b6ff" style="width:50px;height:50px"></lord-icon></a></li>
            </ul>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Mens Collection</h2>
        <p>Women > Shirts</p>

        <div class="pro-container">

        <?php
      
            $select_products = mysqli_query($con, "SELECT * FROM `products` WHERE category ='Men-Shirt'");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>

            <div class="pro">
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
                <a href="#"><lord-icon src="https://cdn.lordicon.com/eiekfffz.json" class="cart" trigger="hover" delay="1500" colors="primary:#121331,secondary:#ebe6ef tertiary:#e5d1fa"> </lord-icon></a>
            </div>

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

        <div class="form">
            <input type="text" placeholder="Your email address">
            <button>Sign Up</button>
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
    <script scr="script.js"></script>
    
</body>
</html>