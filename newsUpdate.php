<?php

    if(isset($_POST['submit'])){

        $_SESSION['message'] = "";
        $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
        if(mysqli_connect_errno()){
        $_SESSION['message'] = "Couldn't conect to db!";
        }

        $title = $_POST['newsTitle'];
        $news = $_POST['newsTxt'];
        $img = $_POST['newsImg'];
        $cap = $_POST['newsCap'];
        $date = date('ymd');

        // Prepare Secure DB entries
        $sqlNewNews = "INSERT INTO `News`(`title`, `news`, `url`, `caption`, `date`) VALUES ('".$title."', '".$news."', '".$img."', '".$cap."', '".$date."');";
        $newNewsResult = mysqli_query($mysqli, $sqlNewNews);

        if(!$newNewsResult){
            $_SESSION["message"] = "Error: <br>" . $mysqli->error;
            echo $_SESSION['message'];
           
            
                      
        }
        else{
            $_SESSION["message"] = "New sheet successfully created!";
            header("Location: index.php");
        }

        

    }

?>