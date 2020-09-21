<?php
session_start();

use model\db\UserDao;
use model\User;

function __autoload ($class){
    $class="..\\".$class;
    require_once str_replace("\\","/",$class).".php";
}


if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = new User("",sha1($password),$email);

    UserDao::getInstance()->loginUser($user);
    $_SESSION["user_id"] = $user->getId();
    $_SESSION["username"] =  $user->getUsername();
    $_SESSION["password"] =  $user->getPassword();
    $_SESSION["email"] =  $user->getEmail();
    $_SESSION["profile_pic"] =  $user->getProfilePic();
    header("Location:../index.php");
}
