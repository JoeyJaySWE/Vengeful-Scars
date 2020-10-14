<?php
session_start();
session_destroy();
unset($_SESSION['user']);



$_SESSION['message'] = "You have been signed out!";
  echo $_SESSION['message'];
  header( "refresh:5; url=http://vengefulscars.com/" );

?>