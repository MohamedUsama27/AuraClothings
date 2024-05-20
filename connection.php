<?php

session_start();

$con = mysqli_connect ('localhost','root','','auradb');

if(mysqli_connect_errno()){
    die("Cannot connect to database".mysqli_connect_errno());
}

?>