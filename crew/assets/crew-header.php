

<!DOCTYPE html>
<html lang="en">
<head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:site_name" content="Vengeful Scars">
    <meta property="og:title" content="<?php echo $metaTitle;?>" />
    <meta property="og:description" content="<?php echo $metaDesc;?>" />
    <meta property="og:image" content="<?php echo $metaImg;?>"/>
    <meta name="twitter:image" content="<?php echo $metaImg;?>"/>
    <meta name="twitter:card" content="<?php echo $metaCard;?>"/>
    <meta name="twitter:image:alt" content="<?php echo $metImgAlt;?>">
    <meta propety="og:url" content="http://vengefulscars.joeyjaydigital.com/img/"/>
    <link rel="stylesheet" href="/crew/assets/css/crew-style.css">
    <link rel='icon' type='image/png' href='<?php echo $favicon;?>'>
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=' crossorigin='anonymous'></script>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div id="wrapper">


        <nav class="wrapper">
            <li><a href="index.php"><img class="anchor" src="/img/blue-text.png"/></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="story.php">Story</a></li>
            <li><a href="">Join</a></li>
            <li><a href="crew.php">Crew</a></li>
            <?php 
            if(isset($_SESSION['user'])){
                ?>
                
                <li><a href="log-out.php">Log out <?php echo " ".$_SESSION['user'];?></a></li>

                <?php
            }
            ?>
        </nav>
        <main class="wrapper">
            <figure>
                <img class="topImg" src="<?php echo $topImgSrc;?>" alt="<?php $topImgAlt;?>">
            </figure>




   


