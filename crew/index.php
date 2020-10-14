<?php

  
session_start();
 
$mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');

if(mysqli_connect_errno()){
$_SESSION['message'] = "Couldn't conect to db!";
}

require __DIR__ . "/assets/crew-header.php";


?>

    <h1>Welcome <?php echo $_SESSION['user'];?></h1>
    <span class="subtitle">What do you wanna do today?</span><div class="break"></div>
    <ul class="admin-nav">
        <li><a href="http://vengefulscars.com/" target="_blank">Edit PR site</a></li>
        <li><a class="disabled" href="">Manage crew Sheets</a></li>
        <li><a href="Tools/sharesCalc.php">Calculate Booty</a></li>
        <li><a href="sheet/sheet-browser.php">Go over own sheet</a></li>
        <li><a href="https://webbmail.binero.se/" target="_blank">Check Mail</a></li>
        <li><a href="log-out.php">Sign out</a>
    </ul>

    <script>
        $("#wrapepr a.disabled").hoover(function(){
            $(this).text("Temporary down");
        }, function(){

        })
    </script>
<?php

require __DIR__ . "/assets/crew-footer.php";

?>