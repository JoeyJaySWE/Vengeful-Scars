<?php

use model\db\UserDao;
use model\User;

function __autoload ($class){
    $class="..\\".$class;
    require_once str_replace("\\","/",$class).".php";
}

if (isset($_POST["submit"])){
    $username= $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $profile_pic = "profilePics/default.png";
    $user = new User($username,sha1($password),$email);
    //DAO.insertUser($user);

    $user->setProfilePic($profile_pic);

    if (UserDao::getInstance()->existsUser($user)){
        echo "Sorry, this email is already registered";
    }
    else{
        UserDao::getInstance()->insertUser($user);
        header("Location:../view/register.html");
    }
}