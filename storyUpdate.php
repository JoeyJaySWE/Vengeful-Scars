<?php

    if(isset($_POST['submit'])){

        $_SESSION['message'] = "";
        $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
        if(mysqli_connect_errno()){
        $_SESSION['message'] = "Couldn't conect to db!";
        }

        $title = $_POST['storyTitle'];
        $story = $_POST['storyTxt'];
        $img = $_POST['storyImg'];
        $cap = $_POST['storyCap'];
        $date = date('dmy');

        // Prepare Secure DB entries
        $sqlNewStory = "INSERT INTO `Stories`(`title`, `story`, `url`, `captation`, `date`) VALUES ('".$title."', '".$story."', '".$img."', '".$cap."', '".$date."');";
        $newStoryResult = mysqli_query($mysqli, $sqlNewStory);

        if(!$newStoryResult){
            $_SESSION["message"] = "Error: <br>" . $mysqli->error;
            echo $_SESSION['message'];
           
            
                      
        }
        else{
            $_SESSION["message"] = "New sheet successfully created!";
            header("Location: story.php");
        }

        

    }

?>