<?php

    $title = "Story";
    $metaTitle = "The Chronicles";
    $metaDesc = "Gather 'round lubbers, and let me tell you the tales of our past glories!";
    $metaImg = "http://vengefulscars.com/img/blue-text-card.png";
    $metaCard = "summary";
    $metaCardAlt = "The words Vengeful and Scars written in glowing blue, seperated by 3 bloddy scars";
    $favicon = "img/favicon.png";
    $topImgSrc = "http://via.placeholder.com/900x400";
    $topImgAlt = "tmp placeholder";


  
    session_start();
 
    $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
  
    if(mysqli_connect_errno()){
    $_SESSION['message'] = "Couldn't conect to db!";
    }

    require __DIR__ . "/assets/header.php";
    // require __DIR__ . "/assets/restrict-ip.php";


    ?>


    <h1>Vengeful Scars Chronicles</h1>
    <?php
    $sql = "SELECT * FROM Stories";
            $storyResult = mysqli_query($mysqli, $sql);
    
    if(mysqli_num_rows($storyResult) > 0){
    
        $storyNo = 1;
        while($rowStory = $storyResult->fetch_assoc()){


        $storyTitle = $rowStory['title'];
        $storyTxt = $rowStory['story'];
        $storyUrl = $rowStory['url'];
        $storyDate = $rowStory['date'];







        ?>
        <section class="stories" id="story<?php echo $storyNo;?>">
            <h2><?php echo $storyTitle;?></h2>
            <em class="story">
            <p><?php echo $storyTxt;?></p>
            
                <?php if($storyUrl != ""){
                    ?>          <figure>
                                    <img src="<?php echo $storyUrl;?>" alt=""/>
                                    <figcaption></figcaption>
                                </figure>
                    <?php
                }
                ?>
            </em>
            <span><?php echo $storyDate;?></span>
        </section>

   
            <?php
                $storyNo++;
        }
    }
    
        if($_SESSION['admin'] === 1){
           
            ?>
            <div class="break"></div>
            <form action="storyUpdate.php" method="POST" class="add-story">
                <input type="text" id="storyTitle" name="storyTitle" placeholder="Title of Story" />
                <textarea id="storyTxt" name="storyTxt" placeholder="Story goes here..."></textarea>
                <input type="text" id="storyImg" name="storyImg" placeholder="img url"/>
                <input type="text" id="storyCap" name="storyCap" placeholder="Imge Captiation"/>
                <input type="submit" id="submit" name="submit" value="Include story!" />
            </form>
    
            <?php
        }
    

    

?>


<?php

    require __DIR__ . "/assets/footer.php";

?>