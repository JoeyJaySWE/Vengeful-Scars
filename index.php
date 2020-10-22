<?php

    $title = "Vengeful Scars";
    $metaTitle = "The Vengeful Scars";
    $metaDesc = "Wanna live the care free life of a pirate crew... in space?! Join our Pirate RP guild in SWTOR on Malgus Server!";
    $metaImg = "http://vengefulscars.com/img/blue-text-card.png";
    $metaCard = "summary";
    $metaCardAlt = "The words Vengeful and Scars written in glowing blue, seperated by 3 bloddy scars";
    $favicon = "http://vengefulscars.com/favicon.png";
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

    

    <h1>Vengeful Scars</h1>
    <span class="subtitle">May the godess of chaos and myham forever be in your wake!</span>
    <p>
            Are you someone who loves adventures where you get to play the hero/villian?
            Do you feel every day RPG games to restrictive and linear?
            Then grab a cutlass and join in!<br>
            Join in adventure as part of a freedom loving Pirate crew hanging out in the Perlimian sector
            of the exiting universe of Star Wars! Complete with 3D avatars, custum game areas, custom shaped campagins
            and a role system that is more open than twileks legs on Nar Shadaa.
    </p>
    <h2 style="margin-right:auto;">News</h2>
    <section class="articles">
        

        <?php
    $sql = "SELECT * FROM News ORDER BY date DESC";
            $newsResult = mysqli_query($mysqli, $sql);
    
    if(mysqli_num_rows($newsResult) > 0){
    
        $newsNo = 1;
        while($rowNews = $newsResult->fetch_assoc()){


        $newsTitle = $rowNews['title'];
        $newsTxt = $rowNews['news'];
        $newsUrl = $rowNews['url'];
        $newsCap = $rowNews['caption'];
        $newsDate = $rowNews['date'];







        ?>
        <article>

            <h3><?php echo $newsTitle;?></h3><div class="break"></div>
            <p><?php echo $newsTxt;?></p>
            <?php

                if($newsUrl != ""){
                    ?>
                    <figure>
                        <img src="<?php echo $newsUrl; ?>">
                        <figcaption><?php echo $newsCap;?></figcaption>
                    </figure>
                    <?php
                }

            ?>
        </article>
        <?php
            $newsNo++;
        }
    }

?>  
            
    </section>
    <?php
        if($_SESSION['admin'] === "1"){
           
            ?>
            <div class="break"></div>
            <form action="newsUpdate.php" method="POST" class="add-story">
                <input type="text" id="newsTitle" name="newsTitle" placeholder="Title of news" />
                <textarea id="newsTxt" name="newsTxt" placeholder="news goes here..."></textarea>
                <input type="text" id="newsImg" name="newsImg" placeholder="img url"/>
                <input type="text" id="newsCap" name="newsCap" placeholder="Imge Captiation"/>
                <input type="submit" id="submit" name="submit" value="Include the news!" />
            </form>
    
            <?php
        }
            ?>



</main>

<?php

    require __DIR__ . "/assets/footer.php";

?>
