<?php
include("../connection.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!empty($_SESSION["id"])) {
    header("Location: ../customer/mainpage.php");
}


if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $img_des = handleFileUpload('user_image');
    $user_type = $_POST["user_type"];

    $duplicate = mysqli_query($con, "SELECT * FROM `user` WHERE username = '$username' OR email = '$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        $message[] = "Username or Email has already been taken.";
    } else {
        if ($password == $confirmpassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO `user` (`name`, `username`, `email`, `password`, `image`, `user_type`) VALUES ('$name', '$username', '$email', '$hashedPassword', '$img_des', '$user_type')";
            mysqli_query($con, $query);

            $message[] = 'Registration successful';
        } else {
            $message[] = 'Passwords do not match';
        }
    }
}


// Function to handle file uploads
function handleFileUpload($fileInputName)
{
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



    if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        $message[] = 'Sorry, there was an error uploading your file.';
        return "";
    }
}

if (isset($_POST["login-submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $loginpassword = $_POST["loginpassword"];

    $result = mysqli_query($con, "SELECT * FROM `user` WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if (password_verify($loginpassword, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["user_type"] = $row["user_type"];

            if ($row['user_type'] == 'customer') {
                header('Location: ../customer/mainpage.php');
            } elseif ($row['user_type'] == 'admin') {
                header('Location: ../admin/adminpage.php');
            }
        } else {
            $message[] = 'Wrong Password';
        }
    } else {
        $message[] = 'User Not Registered';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Clothings</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> 
      <i class="x" onclick="this.parentElement.style.display = `none`;">
        <i class="fa-solid fa-circle-xmark" style="color: #f0334f;"></i></i>
  </div>';
        };
    };

    ?>


    <div class="container">
        <div class="form-container">

            <div class="signin-signup">
                <form action="" class="sign-in-form" method="post" autocomplete="off">
                    <h2 class="title">Sign in</h2>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username or Email" name="usernameemail" id="usernameemail" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="loginpassword" id="loginpassword" required value="" />
                    </div>

                    <input type="submit" class="btn solid" name="login-submit" value="Login" />

                </form>
            </div>

            <div class="signup-signup">
                <form action="" class="sign-up-form" method="post" autocomplete="off" enctype="multipart/form-data">

                    <select name="user_type" required>
                        <option value=""> Select User</option>
                        <option value="customer"> Customer</option>
                        <option value="admin"> Admin</option>
                    </select>

                    <h2 class="title">Sign Up</h2>

                    <div class="input-field">
                        <i class="fa-solid fa-camera"></i>
                        <input type="file" class="userimage" name="user_image" id="image" accept="image/png, image/jpg, image/jpeg" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Name" name="name" id="name" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" id="username" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" id="email" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" id="password" required value="" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword" required value="" />
                    </div>

                    <input type="submit" class="btn solid" value="Register" name="submit" />

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New Here?</h3>
                    <p>Welcome to our world of style! Join us for exclusive offers and updates. Sign up now and start shopping!</p>
                    <button class="btn transparent" id="sign-up-button">Sign Up</button>
                </div>
                <img src="Sign-up.png" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us</h3>
                    <p>Welcome to our world of style! Join us for exclusive offers and updates. Sign up now and start shopping!</p>
                    <button class="btn transparent" id="sign-in-button">Sign in</button>
                </div>
                <img src="Sign-in.png" alt="" class="image">
            </div>

        </div>
    </div>







    <script src="app.js"></script>
</body>

</html>