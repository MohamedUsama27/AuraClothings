<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['submit_btn'])){
    $f_name = $_POST['f_name'];
    $f_email = $_POST['f_email'];
    $f_subject = $_POST['f_subject'];
    $f_message = $_POST['f_message'];

    $insert_query = mysqli_query($con, "INSERT INTO `feedback`(name, email, subject, message) VALUES('$f_name', '$f_email', '$f_subject', '$f_message')") or die('query failed');


    if($insert_query){
        $message[] ='Feedback message Sent';
     }else{
        $message[] ='Feedback message sending fail';
     };
  };


  $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
  $row_count = mysqli_num_rows($select_rows);

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

    if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> 
        <i class="x" onclick="this.parentElement.style.display = `none`;">
            <i class="fa-solid fa-circle-xmark" style="color: #f0334f;"></i></i>
    </div>';
    };
    };

?>

    <section id="header">
        <a href="#"><img src="image/logo.PNG" class="logo" alt="" height=48px></a>

        <div>
            <ul id="navbar">
                <li><a  href="mainpage.php">Home</a></li>
                <li><a  href="shop.php">Shop</a></li>
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
                <li><a class="active" href="contact.php">Contact</a></li>
                <li><a href="cart.php"><span><?php echo $row_count; ?></span><lord-icon src="https://cdn.lordicon.com/odavpkmb.json" trigger="hover" stroke="bold" colors="primary:#121331,secondary:#c8b6ff" style="width:50px;height:50px"></lord-icon></a></li>
            </ul>
        </div>
    </section>

    <section id="page-header1">
        <h2>Let's Talk</h2>
        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our store locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>No 36 De Kretser Pl, Colombo 04</p>
                </li>
                <li>
                    <i class="fa-solid fa-message"></i>
                    <p>icbt@education.lk</p>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>071 7878 014</p>
                </li>
                <li>
                    <i class="fa-solid fa-clock"></i>
                    <p>Monday to Saturday: 09:00am to 04:00pm</p>
                </li>
            
            </div> 
        </div>

        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0416932208564!2d79.8577683751338!3d6.885609518849211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25bc4fdc4eac3%3A0xfde7cffd35d72eb9!2sICBT%20Campus!5e0!3m2!1sen!2slk!4v1710459752170!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="" method="post">
            <span>LEAVE A MESSAGE</span>
            <h2>We Love To Hear From You</h2>
            <input type="text" name="f_name" placeholder="Your Name" required>
            <input type="text" name="f_email" placeholder="E-Mail" required>
            <input type="text" name="f_subject" placeholder="Subject" required>
            <textarea name="f_message" id="" cols="30" rows="10" placeholder="Your Message" required></textarea> 
            <button name="submit_btn">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="image/people/tony.png" alt="">
                <p><Span>Tony Stark </Span>Senior Marketing Manager <br> Phone: 071 7878 014 <br>Email: icbt@education.lk</p>
            </div>

            <div>
                <img src="image/people/evans.png" alt="">
                <p><Span>Chris Evans </Span>Senior Marketing Manager <br> Phone: 075 7878 014 <br>Email: icbt@education.lk</p>
            </div>

            <div>
                <img src="image/people/hemsworth.jpg" alt="">
                <p><Span>Chris Hemsworth </Span>Senior Marketing Manager <br> Phone: 077 7878 014 <br>Email: icbt@education.lk</p>
            </div>
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



    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script scr="script.js"></script>
    
</body>
</html>