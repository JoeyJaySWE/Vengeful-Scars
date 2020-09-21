<?php  
    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  

if (/*$ip != "83.185.86.65"*/ $ip != "92.33.158.58") {
 
   
    header('Location: under-construction.html');

 exit();
}

//.... rest of your code goes here ....
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="<?php echo $title;?>" />
    <meta property="og:image" content="<?php echo $metaImg;?>"/>
    <meta propety="og:url" content="http://vengefulscars.joeyjaydigital.com/img/"/>
    <link rel="stylesheet" href="site-style.css">
    <link rel='icon' type='image/png' href='<?php echo $favicon;?>'>
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=' crossorigin='anonymous'></script>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div id="wrapper">


        <nav class="paper">

        </nav>
        <main class="paper">



   


