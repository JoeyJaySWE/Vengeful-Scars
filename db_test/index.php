<?php
session_start();


if (isset($_GET["page"])){
    if ($_GET["page"]=="logout"){
        session_destroy();
        header("Location:view/login.html");
    }
}
else{
    header("Location:view/login.html");
}