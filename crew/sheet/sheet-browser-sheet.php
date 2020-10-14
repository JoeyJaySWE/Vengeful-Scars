<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <link rel="icon" type="image/png" href="img/favicon.png"/>
      <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
      <link href="sheet-style.css" type="text/css" rel="stylesheet"/>
      <meta charset="utf-8">
      <title>Sheet Reader</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
      <style id="color">
        input, textarea, select{
            color: #00c7f8;
        }
      </style>
        <div id="wrapper">
<?php

  session_start();
  $_SESSION['message'] = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // $_SESSION['message'] = '';
    // var_dump($_POST['password']);
    // var_dump($_POST['username']);
    $user = $_POST['username'];

    $pass = $_POST['password'];
    $passs = $pass."sqrd";
    $pass = md5($passs);

    $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
    if(mysqli_connect_errno()){
      $_SESSION['message'] = "Couldn't conect to db!";
    }
    $passCheck = "SELECT * FROM Users WHERE PASSWORD='".$pass."' AND USER='".$user."' LIMIT 1";
    $result = mysqli_query($mysqli, $passCheck);

    if(mysqli_num_rows($result) > 0){
      $row = $result->fetch_assoc();
      $_SESSION['user'] = $user;
      $_SESSION['message'] = "Welcome ".$_SESSION['user']."!";
      $_SESSION['id'] = $row['USERiD'];


        header("refresh:5");
    }
    else{
      $_SESSION['message'] = "Couldn't find username or password. Try again. ";


    }


  }

  $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
  if(mysqli_connect_errno()){
    $_SESSION['message'] = "Couldn't conect to db!";
  }
  $_SESSION['sheetId'] = intval($_GET['dk']);
      // add user status

      $statusCheck = "SELECT ADMIN, MedbayAccess, ArmoryAccess, SecurityAccess, EngineeringAccess FROM Users WHERE USER='".$user."'";
      $result = mysqli_query($mysqli, $statusCheck);

      if(mysqli_num_rows($result) > 0){
        $rowSheet = $result->fetch_assoc();
        $userAdmin = $rowSheet['ADMIN'];

        $userMedical = $rowSheet['MedbayAccess'];

        $userArmory = $rowSheet['ArmoryAccess'];

        $userSecurity = $rowSheet['SecurityAccess'];

        $userEngi = $rowSheet['EngineeringAccess'];


        $userPermissions = array($userAdmin, $userMedical, $userArmory, $userSecurity, $userEngi);
        $_SESSION['permissions'] = $userPermissions;
      }
      $permissionCheck = "SELECT SHARING, PERMISSIONS, USERiD FROM Sheet WHERE SHEETiD='".$_SESSION['sheetId']."'";
      $result = mysqli_query($mysqli, $permissionCheck);

      if(mysqli_num_rows($result) > 0){
        $rowSheet = $result->fetch_assoc();


      $rowSheet['SHARING'] = substr($rowSheet['SHARING'], 1, -1);
      $sheetShare = json_encode($rowSheet['SHARING']);
      $sheetShare = substr($sheetShare, 1, -1);
      $rowSheet['PERMISSIONS'] = substr($rowSheet['PERMISSIONS'], 1, -1);
      $sheetPermissions = json_encode($rowSheet['PERMISSIONS']);
      $sheetPermissions = substr($sheetPermissions, 1, -1);
      $sheetCreator = $rowSheet['USERiD'];
  }
if (!$_SESSION['user'] && $sheetShare != "url") {

    ?>

          <div id="sign-in" style="display:flex;height:330px;">
            <h1 style="color:#ff4b4b">Sign-in to access sheet</h1>

            <form action="" method="POST">
              <input type="text" id="username" name="username" class="border" placeholder="Username"/>
              <input type="password" id="password" name="password" class="border" placeholder="Password"/></br>
              <input type="submit" id="submitBtn" value="Sign in!" />
            </form>
            <a href="sheet-reg.php">Sign up!</a>
            <br />
            <span><?php echo $_SESSION['message'];?></span>
          </div>
        </div>
      </div>
      </body>
    </html>
    <?php
    die();
  }

  // foreach($_SESSION['permissions'] as $key=>$value)
  //     {
  //     // and print out the values
  //     echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
  //     }
if($sheetShare != "url"){
  if($sheetShare == "private" && $_SESSION['id'] != $sheetCreator){
    if($_SESSION['permissions'][0] != 1){
      $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

      header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


    }
    if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1 ){
      ?>

      <script>
      // keep viewrs from edit
        $("#updateDelete").empty();
        $("#updateDelete").appened("<a href='sheet-browser.hp'>To your sheets</a>");
      </script>
      <?php
    }
    ?>
    <script>
        // set the permission and share
        $("#sharing").css("display", "none");
    </script>
    <?php
    }
  else if($sheetShare == "private" && $_SESSION['id'] == $sheetCreator){
    ?>
    <script>
        // set the permission and share
        $("#sharing").val("<?php echo $sheetShare; ?>");
        $('[name=sharing] option').filter(function() {
       return ($(this).text() == '<?php echo $sheetShare; ?>'); //To select Blue
   }).prop('selected', true);
    </script>
    <?php
  }
  else if($sheetShare == "engi" && $_SESSION['id'] != $sheetCreator){
    if($_SESSION['permissions'][0] != 1 || $_SESSION['permissions'][4] != 1 && $_SESSION['permissions'][0] != 1){
      $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

      header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


    }
    if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1 ){
      ?>
      <!-- keep viewrs from edit -->
      <script>
        $("#updateDelete").empty();
        $("#updateDelete").appened("<a href='sheet-browser.hp'>To your sheets</a>");
      </script>
      <?php
    }
    ?>
    <script>
        // set the permission and share
        $("#sharing").css("display", "none");
    </script>
    <?php
  }


  else if($sheetShare == "medic" && $_SESSION['id'] != $sheetCreator){
    if($_SESSION['permissions'][0] != 1 || $_SESSION['permissions'][1] != 1 && $_SESSION['permissions'][0] != 1){
      $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

      header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


    }
    if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1){
      ?>
      <!-- keep viewrs from edit -->
      <script>
        $("#updateDelete").empty();
        $("#updateDelete").appened("<a href='sheet-browser.hp'>To your sheets</a>");
      </script>
      <?php
    }
    ?>
    <script>
        // set the permission and share
        $("#sharing").css("display", "none");
    </script>
    <?php
  }
  else if($sheetShare == "medic" && $_SESSION['id'] == $sheetCreator){
    ?>
    <script>
        // set the permission and share
        $("#sharing").val("<?php echo $sheetShare; ?>");
        <?php if($sheetPermissions == "edit"){?>
          $("#shareEdit").prop("checked", true);<?php
        }
        else{?>
          $("#shareView").prop("checked", true);<?php
        }?>
    </script>
    <?php
  }
  else if($sheetShare == "arms" && $_SESSION['id'] != $sheetCreator){
    if($_SESSION['permissions'][0] != 1 || $_SESSION['permissions'][2] != 1 && $_SESSION['permissions'][0] != 1 && $_SESSION['permissions'][3] != 1){
      $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

      header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


    }
    if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1){
      ?>
      <!-- keep viewrs from edit -->
      <script>
        $("#updateDelete").empty();
        $("#updateDelete").appened("<a href='sheet-browser.hp'>To your sheets</a>");
      </script>
      <?php
    }
    ?>
    <script>
        // set the permission and share
        $("#sharing").css("display", "none");
    </script>
    <?php
  }
  else if($sheetShare == "arms" && $_SESSION['id'] == $sheetCreator){
    ?>
    <script>
        // set the permission and share
        $("#sharing").val("<?php echo $sheetShare; ?>");
        <?php if($sheetPermissions == "edit"){?>
          $("#shareEdit").prop("checked", true);<?php
        }
        else{?>
          $("#shareView").prop("checked", true);<?php
        }?>
    </script>
    <?php
  }
  else if($sheetShare == "gally" && $_SESSION['id'] != $sheetCreator){
    if($_SESSION['permissions'][0] != 1 || $_SESSION['permissions'][5] != 1 && $_SESSION['permissions'][0] != 1){
      $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

      header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


    }
    if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1){
      ?>
      <!-- keep viewrs from edit -->
      <script>
        $("#updateDelete").empty();
        $("#updateDelete").appened("<a href='sheet-browser.hp'>To your sheets</a>");
      </script>
      <?php
    }
    ?>
    <script>
        // set the permission and share
        $("#sharing").css("display", "none");
    </script>
    <?php
  }

  else if($sheetShare == "gally" && $_SESSION['id'] == $sheetCreator){
    ?>
    <script>
        // set the permission and share
        $("#sharing").val("<?php echo $sheetShare; ?>");
        <?php if($sheetPermissions == "edit"){?>
          $("#shareEdit").prop("checked", true);<?php
        }
        else{?>
          $("#shareView").prop("checked", true);<?php
        }?>
    </script>
    <?php
  }
}
else if($sheetShare == "url" && $_SESSION['id'] != $sheetCreator){
  if(!$_SESSION['user']){

    ?>
    <script>

      $(window).ready(function(){
      $("#user-section").empty();
      $("#user-section").append("<span>Guest</span><a href='sheet-browser.php'>Log in</a><a href='sheet-reg.php'>Sign up!</a>");
      $("select#sharing").hide();
      $("#uploadBtn").prop("disabled", true);
      $("#deleteBtn").prop("disabled", true);
    });


    </script><?php
  }
  if($sheetPermissions != "edit" && $_SESSION['permissions'][0] != 1){
    ?>
    <!-- keep viewrs from edit -->
    <script>
      $("#updateDelete").empty();
      $("#updateDelete").appened("<a href='sheet-browser.php'>To your sheets</a>");
    </script>
    <?php
  }
  ?>
  <script>
      // set the permission and share
      $("#sharing").css("display", "none");
  </script>
  <?php
}

// var_dump($_SESSION['id']);
// var_dump($sheetCreator);
if($_SESSION['id'] == $sheetCreator){
  ?>
    <script>
        $(window).ready(function(){
          // set the permission and share

          // $("#sharing").val("<?php echo $sheetShare; ?>");
          // if($("#sharing").val() == "private"){
          //   $("#permissions").css("display", "none");
          //   $("#shareView").prop("checked", false);
          //   $("#shareEdite").prop("checked", false);
          <?php
          if ($sheetShare == "engi"){
                ?>$("#sharing option[value='engi']").prop('selected', true);<?php
              }
              else if($sheetShare == "medic"){
                ?>$("#sharing option[value='medic']").prop('selected', true);<?php
              }
              else if($sheetShare == "arms"){
                ?>$("#sharing option[value='arms']").prop('selected', true);<?php
              }
              else if($sheetShare == "gally"){
                ?>$("#sharing option[value='gally']").prop('selected', true);<?php
              }
              else if($sheetShare == "url"){
                ?>$("#sharing option[value='url']").prop('selected', true);<?php
              }?>
          // $("#sharing option")
     //      $('#sharing option').filter(function() {
     //     return ($(this).text() == '<?php
     //
     //
     //
     //
     //      ?>');
     // }).prop('selected', true);
     if($("#sharing option:selected").val() != "private"){
          <?php if($sheetPermissions == "edit"){?>
                    $("#shareEdit").prop("checked", true);<?php
                  }
                  else{?>
                    $("#shareView").prop("checked", true);<?php
                  }?>

          $("#permissions").css("display", "flex");
        }

          else{
            $("#permissions").css("display", "none");
            $("#shareView").prop("checked", false);
            $("#shareEdite").prop("checked", false);
          }
          $("#sharing").change(function(){
            if($(this).val() == "private"){
              $("#permissions").css("display", "none");
              $("#shareView").prop("checked", false);
              $("#shareEdite").prop("checked", false);
            }
          })
        })

    </script>
  <?php
}
if($_SESSION['permissions'][0] != 1 && $_SESSION['id'] != $sheetCreator && $sheetShare != "url"){
  $_SESSION['message']="Sorry, but you do not have permissions to access that sheet.";

  header('Location: '."https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php");


}
else{
  ?>
  <script>

  </script>
  <?php

}



?>


      <div id="quick-menue">
        <img src="http://via.placeholder.com/64x64">
        <nav id="burger-menu">
          <li><a href="#avatar">Avatar</a></li>
          <li><a href="#basic-info">Basic Info</a></li>
          <li><a href="#dex">Dexterity Skills</a></li>
          <li><a href="#perc">Perception Skills</a></li>
          <li><a href="#know">Knowledge Skills</a></li>
          <li><a href="#str">Strength Skills</a></li>
          <li><a href="#mech">Mechanical Skills</a></li>
          <li><a href="#tech">Technological Skills</a></li>
          <li><a href="#force">Force Skills</a></li>
          <li><a href="#advantages">Advantages</a></li>
          <li><a href="#disadvantages">Disadvantages</a></li>
          <li><a href="#special-abillities">Special Abillities</a></li>
          <li><a href="#misc">Points and Credits</a></li>
          <li><a href="#wounds">Wounds</a></li>

          <li><a href="#armor">Armor</a></li>
          <li><a href="#weapons">Weapons</a></li>
          <li><a href="#force-powers">Force & Powers</a></li>
          <li><a href="#equipment">Equipment</a></li>
          <li><a href="#personality">Personality</a></li>
          <li><a href="#objectives">Objectives</a></li>
          <li><a href="#contacts">Contacts</a></li>
        </nav>
      </div>
      <div id="menu-bar">
        <nav id="desktop-menu">
          <li><a href="#basic-info">Basic Info</a></li>
          <li><a href="#skill-list">Skills</a></li>
          <li><a href="#abillities-list">Abillities</a></li>
          <li><a href="#misc">Points and Credits</a></li>
          <li><a href="#wounds">Wounds</a></li>

          <li><a href="#armor">Armor</a></li>
          <li><a href="#weapons">Weapons</a></li>
          <li><a href="#force-powers">Force & Powers</a></li>
          <li><a href="#persona">Equipment & Misc.</a></li>
        </nav>
        <div id="user-section">
           <span><?php echo $_SESSION['user']; ?></span>
           <a href="sheet-browser.php">Sheets</a>
          <a href="">Settings</a>
          <a href="log-out.php">Log out</a>
        </div>
      </div>

      <span style="display:none;position:absolute;left:650px;">Change text color:<input type="color" id="textcolorpicker" value="#00c7f8" style="width:30px;"><button type="button" id="textcolor-reset" style="height:30px;">Reset</button></span>
      <span style="display:none;position:absolute;">Change input color:<input type="color" id="inputcolorpicker" value="#00c7f8" style="width:30px;"><button type="button" id="inputcolor-reset" style="height:30px;">Reset</button></span>

      <form action="update-sheet.php" method="POST">
      <div class="paper">
        <div class="top-right" id="avatar">
          <img src="http://via.placeholder.com/450x320" class="avatar" id="avatar-img"/>
          <input type="hidden" name="hidden-img" id="hidden-img" value="">
          <button type="button" id="img-upload">Place URL</button>
          <div id="dimmer">
          </div>
            <div id="img-popup">
              <h1>Enter the URL to your avatar</h1><br/>
              <input type="text" id="avatar-url" placeholder="https://imgur.com/YL2HtL3"><br/>
              <span>(If you don't have an url, <a href="https://imgur.com/upload" target="_Blank">try this site</a>.)</span><br/>
              <button type="button" id="cancel-upload">Cancel</button><button type="button" id="upload">Upload</button>
            </div>

        </div>
        <div class="top-left" id="basic-info">
          <h1 class="sheet-title">character sheet</h1>
          <img src="img/blue-text-cropped.png" style="width:auto;border-radius:0;" class="guild-logo" />
          <div class="basic-info">
              <strong>Character Name:</strong> <input type="text" id="char-name" name="char-name" placeholder="Jace D. Mace"/><br />
              <strong>Type:</strong> <input type="text" id="char-type" name="char-type" placeholder="Pirate Forger"/><br />
              <strong>Gender / Specie:</strong> <input type="text" id="char-gender" name="char-gender" placeholder="Male"/>/<input type="text" id="char-race" name="char-race" placeholder="Human"/><br />
                <strong>Age:</strong> <input type="text" id="char-age" name="char-age" placeholder="24"/> yo
                <strong>&emsp;Height:</strong> <input type="text" id="char-height" name="char-height" placeholder="1.79"/>m
                <strong>&emsp;Weight:</strong> <input type="text" id="char-weight" name="char-weight" placeholder="65"/>Kg<br />
              <strong>Physical Discription:</strong> <input type="text" name="char-physics" id="char-physics" placeholder="Blue hair, wields a Xantha..."/><br />
              <textarea placeholder="(Text is gonna jump here automatically once out of space.)" style="resize:none;" name="physics2" id="char-physics2" rows="2" cols="55"></textarea>
              <input type="hidden" id="hidden-physics"  value=""/>

          </div>

        </div>
        <div class="skills" id="skill-list">
          <!-- Left side column -->
          <div class="skills-column">

            <!-- Dexterity Skills -->
            <div class="attribute" id="dex">
              <h2 class="attribute">dexterity</h2><h2 class="attribute"><input type="text" class="dice" name="dex-dice" id="dex-dice" placeholder="4D" /></h2>
              <div class="skill">
              <div id="dex-skill-list">
                <span class="buttons"><button type="button" class="add-button" id="add-dex-skill">+ Add Row</button>
                <button type="button" class="remove-button" id="remove-dex-skill">- Remove Row</button></span>
                <input type="hidden" id="dex-skill-Rows" name="dex-skills" value="0"/>
              </div>
                <!-- <input type="text" id="dskill1" placeholder="Acrobtatics" />
                <input type="text" id="dskill2" placeholder="Acrobtatics" />
                <input type="text" id="dskill3" placeholder="Acrobtatics" />
                <input type="text" id="dskill4" placeholder="Acrobtatics" />
                <input type="text" id="dskill5" placeholder="Acrobtatics" />
                <input type="text" id="dskill6" placeholder="Acrobtatics" />
                <input type="text" id="dskill7" placeholder="Acrobtatics" />
                <input type="text" id="dskill8" placeholder="Acrobtatics" />
                <input type="text" id="dskill9" placeholder="Acrobtatics" />
                <input type="text" id="dskill10" placeholder="Acrobtatics" />
                <input type="text" id="dskill11" placeholder="Acrobtatics" />
              </div>
              <div class="dice">
                <input type="text" id="dskillD1" placeholder="1D" />
                <input type="text" id="dskillD2" placeholder="1D" />
                <input type="text" id="dskillD3" placeholder="1D" />
                <input type="text" id="dskillD4" placeholder="1D" />
                <input type="text" id="dskillD5" placeholder="1D" />
                <input type="text" id="dskillD6" placeholder="1D" />
                <input type="text" id="dskillD7" placeholder="1D" />
                <input type="text" id="dskillD8" placeholder="1D" />
                <input type="text" id="dskillD9" placeholder="1D" />
                <input type="text" id="dskillD10" placeholder="1D" />
                <input type="text" id="dskillD11" placeholder="1D" />
              </div> -->
            </div>
            </div>
            <!-- Knowledge Skills -->
            <div class="attribute" id="know">
              <h2 class="attribute">Knowledge</h2><h2 class="attribute"><input type="text" name="know-dice" class="dice" id="know-dice" placeholder="4D" /></h2>
              <div class="skill">
                <div id="know-skill-list">
                  <span class="buttons">
                  <button type="button" class="add-button" id="add-know-skill">+ Add Row</button>
                  <button type="button" class="remove-button" id="remove-know-skill">- Remove Row</button>
                  <input type="hidden" id="know-skill-Rows" name="know-skills" value="0"/>
                  </span>
                </div>
                <!-- <input type="text" id="kskill1" placeholder="Streetwise" />
                <input type="text" id="kskill2" placeholder="Streetwise" />
                <input type="text" id="kskill3" placeholder="Streetwise" />
                <input type="text" id="kskill4" placeholder="Streetwise" />
                <input type="text" id="kskill5" placeholder="Streetwise" />
                <input type="text" id="kskill6" placeholder="Streetwise" />
                <input type="text" id="kskill7" placeholder="Streetwise" />
                <input type="text" id="kskill8" placeholder="Streetwise" />
                <input type="text" id="kskill9" placeholder="Streetwise" />
                <input type="text" id="kskill10" placeholder="Streetwise" />
                <input type="text" id="kskill11" placeholder="Streetwise" />
              </div>
              <div class="dice">
                <input type="text" id="kskillD1" placeholder="1D" />
                <input type="text" id="kskillD2" placeholder="1D" />
                <input type="text" id="kskillD3" placeholder="1D" />
                <input type="text" id="kskillD4" placeholder="1D" />
                <input type="text" id="kskillD5" placeholder="1D" />
                <input type="text" id="kskillD6" placeholder="1D" />
                <input type="text" id="kskillD7" placeholder="1D" />
                <input type="text" id="kskillD8" placeholder="1D" />
                <input type="text" id="kskillD9" placeholder="1D" />
                <input type="text" id="kskillD10" placeholder="1D" />
                <input type="text" id="kskillD11" placeholder="1D" />
              </div> -->
            </div>
          </div>
            <!-- Mechanical Skills -->
            <div class="attribute" id="mech">
              <h2 class="attribute">Mechanical</h2><h2 class="attribute"><input type="text" name="mech-dice" class="dice" id="mech-dice" placeholder="4D" /></h2>
              <div class="skill">
                <div id="mech-skill-list">
                  <span class="buttons">
                  <button class="add-button" type="button" id="add-mech-skill">+ Add Row</button>
                  <button class="remove-button" type="button" id="remove-mech-skill">- Remove Row</button>
                  <input type="hidden" id="mech-skill-Rows" name="mech-skills" value="0"/>
                  </span>
                </div>
                </div>
                <!-- <input type="text" id="mskill1" placeholder="Speeder Piloting" />
                <input type="text" id="mskill2" placeholder="Speeder Piloting" />
                <input type="text" id="mskill3" placeholder="Speeder Piloting" />
                <input type="text" id="mskill4" placeholder="Speeder Piloting" />
                <input type="text" id="mskill5" placeholder="Speeder Piloting" />
                <input type="text" id="mskill6" placeholder="Speeder Piloting" />
                <input type="text" id="mskill7" placeholder="Speeder Piloting" />
                <input type="text" id="mskill8" placeholder="Speeder Piloting" />
                <input type="text" id="mskill9" placeholder="Speeder Piloting" />
                <input type="text" id="mskill10" placeholder="Speeder Piloting" />
                <input type="text" id="mskill11" placeholder="Speeder Piloting" />
              </div>
              <div class="dice">
                <input type="text" id="mskillD1" placeholder="1D" />
                <input type="text" id="mskillD2" placeholder="1D" />
                <input type="text" id="mskillD3" placeholder="1D" />
                <input type="text" id="mskillD4" placeholder="1D" />
                <input type="text" id="mskillD5" placeholder="1D" />
                <input type="text" id="mskillD6" placeholder="1D" />
                <input type="text" id="mskillD7" placeholder="1D" />
                <input type="text" id="mskillD8" placeholder="1D" />
                <input type="text" id="mskillD9" placeholder="1D" />
                <input type="text" id="mskillD10" placeholder="1D" />
                <input type="text" id="mskillD11" placeholder="1D" />
              </div> -->
            </div>
            <!-- Force Skills -->
            <div class="attribute" id="force">
              <h2 class="attribute">Force Atrributes</h2>
              <div class="skill">
          <!-- <span class='skillRow'>
                <input type='text' id='sskill"+strSkillCount+"' placeholder='Con' />
                <input type='text' class='skillD' id='sskillD"+strSkillDiceCount+"' placeholder='D1' />
              </span> -->
              <span class="skillRow">
                  <strong>Control</strong><input type="text" name="controll-dice" class="skillD" id="fskillD1" placeholder="0D" /><br/>
                  <strong>Sence</strong><input type="text" name="sence-dice" class="skillD" id="fskillD2" placeholder="0D" /><br/>
                  <strong>Alter</strong><input type="text" name="alter-dice" class="skillD" id="fskillD3" placeholder="0D" /><br/>
                  </span>
                </div>
            </div>
          </div>
          <!-- Right side column -->
          <div class="skills-column">

            <!-- Perception Skills -->
            <div class="attribute" id="perc">
              <h2 class="attribute">Perception</h2><h2 class="attribute"><input type="text" class="dice" id="perc-dice" name="perc-dice" placeholder="4D" /></h2>
              <div class="skill">
                <div id="perc-skill-list">
                  <span class="buttons">
                  <button type="button" class="add-button" id="add-perc-skill">+ Add Row</button>
                  <button type="button" class="remove-button" id="remove-perc-skill">- Remove Row</button>
                  <input type="hidden" id="perc-skill-Rows" name="perc-skills" value="0"/>
                  </span>
                </div>
                </div>
                <!-- <input type="text" id="pskill1" placeholder="Con" />
                <input type="text" id="pskill2" placeholder="Con" />
                <input type="text" id="pskill3" placeholder="Con" />
                <input type="text" id="pskill4" placeholder="Con" />
                <input type="text" id="pskill5" placeholder="Con" />
                <input type="text" id="pskill6" placeholder="Con" />
                <input type="text" id="pskill7" placeholder="Con" />
                <input type="text" id="pskill8" placeholder="Con" />
                <input type="text" id="pskill9" placeholder="Con" />
                <input type="text" id="pskill10" placeholder="Con" />
                <input type="text" id="pskill11" placeholder="Con" />
              </div>
              <div class="dice">
                <input type="text" id="pskillD1" placeholder="1D" />
                <input type="text" id="pskillD2" placeholder="1D" />
                <input type="text" id="pskillD3" placeholder="1D" />
                <input type="text" id="pskillD4" placeholder="1D" />
                <input type="text" id="pskillD5" placeholder="1D" />
                <input type="text" id="pskillD6" placeholder="1D" />
                <input type="text" id="pskillD7" placeholder="1D" />
                <input type="text" id="pskillD8" placeholder="1D" />
                <input type="text" id="pskillD9" placeholder="1D" />
                <input type="text" id="pskillD10" placeholder="1D" />
                <input type="text" id="pskillD11" placeholder="1D" />
              </div> -->
            </div>
            <!-- Strength Skills -->
            <div class="attribute" id="str">
              <h2 class="attribute">Strenght</h2><h2 class="attribute"><input type="text" class="dice" name="str-dice" id="str-dice" placeholder="4D" /></h2>
              <div class="skill">
                <div id="str-skill-list">
                  <span class="buttons">
                  <button type="button" class="add-button" id="add-str-skill">+ Add Row</button>
                  <button type="button" class="remove-button" id="remove-str-skill">- Remove Row</button>
                  <input type="hidden" id="str-skill-Rows" name="str-skills" value="0"/>
                  </span>
                </div>
                </div>
                <!-- <input type="text" id="sskill1" placeholder="Melee Combat" />
                <input type="text" id="sskill2" placeholder="Melee Combat" />
                <input type="text" id="sskill3" placeholder="Melee Combat" />
                <input type="text" id="sskill4" placeholder="Melee Combat" />
                <input type="text" id="sskill5" placeholder="Melee Combat" />
                <input type="text" id="sskill6" placeholder="Melee Combat" />
                <input type="text" id="sskill7" placeholder="Melee Combat" />
                <input type="text" id="sskill8" placeholder="Melee Combat" />
                <input type="text" id="sskill9" placeholder="Melee Combat" />
                <input type="text" id="sskill10" placeholder="Melee Combat" />
                <input type="text" id="sskill11" placeholder="Melee Combat" />
              </div>
              <div class="dice">
                <input type="text" id="sskillD1" placeholder="1D" />
                <input type="text" id="sskillD2" placeholder="1D" />
                <input type="text" id="sskillD3" placeholder="1D" />
                <input type="text" id="sskillD4" placeholder="1D" />
                <input type="text" id="sskillD5" placeholder="1D" />
                <input type="text" id="sskillD6" placeholder="1D" />
                <input type="text" id="sskillD7" placeholder="1D" />
                <input type="text" id="sskillD8" placeholder="1D" />
                <input type="text" id="sskillD9" placeholder="1D" />
                <input type="text" id="sskillD10" placeholder="1D" />
                <input type="text" id="sskillD11" placeholder="1D" />
              </div> -->
            </div>
            <!-- Technology Skills -->
            <div class="attribute" id="tech">
              <h2 class="attribute">Technology</h2><h2 class="attribute"><input type="text" name="tech-dice" class="dice" id="tech-dice" placeholder="4D" /></h2>
              <div class="skill">
                <div id="tech-skill-list">
                  <span class="buttons">
                  <button type="button" class="add-button" id="add-tech-skill">+ Add Row</button>
                  <button type="button" class="remove-button" id="remove-tech-skill">- Remove Row</button>
                  <input type="hidden" id="tech-skill-Rows" name="tech-skills" value="0"/>
                  </span>
                </div>
                </div>
                <!-- <input type="text" id="tskill1" placeholder="Equipment Repair" />
                <input type="text" id="tskill2" placeholder="Equipment Repair" />
                <input type="text" id="tskill3" placeholder="Equipment Repair" />
                <input type="text" id="tskill4" placeholder="Equipment Repair" />
                <input type="text" id="tskill5" placeholder="Equipment Repair" />
                <input type="text" id="tskill6" placeholder="Equipment Repair" />
                <input type="text" id="tskill7" placeholder="Equipment Repair" />
                <input type="text" id="tskill8" placeholder="Equipment Repair" />
                <input type="text" id="tskill9" placeholder="Equipment Repair" />
                <input type="text" id="tskill10" placeholder="Equipment Repair" />
                <input type="text" id="tskill11" placeholder="Equipment Repair" />
                <input type="text" id="tskill12" placeholder="Equipment Repair" />
                <input type="text" id="tskill13" placeholder="Equipment Repair" />
                <input type="text" id="tskill14" placeholder="Equipment Repair" />
                <input type="text" id="tskill15" placeholder="Equipment Repair" />
                <input type="text" id="tskill16" placeholder="Equipment Repair" />
              </div>
              <div class="dice">
                <input type="text" id="tskillD1" placeholder="1D" />
                <input type="text" id="tskillD2" placeholder="1D" />
                <input type="text" id="tskillD3" placeholder="1D" />
                <input type="text" id="tskillD4" placeholder="1D" />
                <input type="text" id="tskillD5" placeholder="1D" />
                <input type="text" id="tskillD6" placeholder="1D" />
                <input type="text" id="tskillD7" placeholder="1D" />
                <input type="text" id="tskillD8" placeholder="1D" />
                <input type="text" id="tskillD9" placeholder="1D" />
                <input type="text" id="tskillD10" placeholder="1D" />
                <input type="text" id="tskillD11" placeholder="1D" />
                <input type="text" id="tskillD12" placeholder="1D" />
                <input type="text" id="tskillD13" placeholder="1D" />
                <input type="text" id="tskillD14" placeholder="1D" />
                <input type="text" id="tskillD15" placeholder="1D" />
                <input type="text" id="tskillD16" placeholder="1D" />

              </div> -->
            </div>

          </div>


        </div>

        <div class="specials" id="abillities-list">
          <h2>Advantages:</h2>
          <textarea id="advantages" name="advantages" rows="8" placeholder="None..." cols="80"></textarea>
          <h2>Disadvantages:</h2>
          <textarea id="disadvantages" name="disadvantages" placeholder="None..." rows="8" cols="80"></textarea>
          <h2>Spcecial Abilities:</h2>
          <textarea id="spcecial-abilities" name="special-abillities" placeholder="Xantha Player" rows="8" cols="80"></textarea>
          <div class="misc" id="misc">
            <strong>Move:</strong>&emsp;<input type="text" name="char-speed" placeholder="10" id="char-speed" />&nbsp;m<br />
            <strong>Force Sensitive:</strong>&emsp;<input type="checkbox" name="char-force" id="char-force" />&nbsp; I am a Forcie!<br />
            <strong>Force Points:</strong>&emsp;<input type="text" placeholder="1" name="char-fp" id="char-fp" />&nbsp;FP<br />
            <strong>Dark Side Points:</strong>&emsp;<input type="text" placeholder="0" name="char-dsp" id="char-dsp" />&nbsp;DSP<br />
            <strong>Character Points:</strong>&emsp;<input type="text" placeholder="5" name="char-cp" id="char-cp" />&nbsp;CP<br />
            <strong>Credits:</strong>&emsp;<input type="text" placeholder="10,000" name="char-credits" id="char-credits" />&nbsp;Credits<br />
          </div>
          <h3>Wound Status</h3>
          <div id="wounds">
              <div class="wound-type">
                <strong>Stunned</strong><br />
                <strong>Wounded</strong><br />
                <strong>Incapacitated</strong><br />
                <strong>Mortally Wounded</strong><br />
              </div>
              <div class="wound-checks">
                <input name="check-stun" id="check-stun" type="checkbox" /><br />
                <input name="check-wound" id="check-wound" type="checkbox" /><input type="checkbox" name="check-double-wound" id="double-wound" /><br />
                <input type="checkbox" name="check-incap" id="check-incap" /><br />
                <input type="checkbox" name="check-mortal" id="check-mortal" /><br />
              </div>
          </div>
        </div>
      </div><br />
      <!-- Sheet 2 -->
      <div class="paper">
          <div class="left-column">
            <div class="top-left box" id="armor">
              <h2>armor</h2>
              <strong>Type</strong><br />
              <input type="text" id="armor-type" name="armor-type" placeholder="Medium Battle Armor"/><br />
              <strong>AV</strong><br />
              <select id="armor-av" name="armor-av">
                <option value="ra">Readily avilable</option>
                <option value="na">Normally avilable</option>
                <option value="si">Specialized item</option>
                <option value="ri">Rare item</option>
              </select><br />
              <strong>Notes</strong>
                <textarea id="armor-notes" name="armor-notes" placeholder="Needs repair work" rows="2" cols="55"></textarea>
            </div>

            <div class="box" id="weapons">
                <h2>weapons</h2>
                <div id="weapons-list">
                  <button type="button" class="add-button"id="add-weapon">+ Add weapon</button>
                  <button type="button" class="remove-button" id="remove-weapon">- Remove weapon</button>
                  <input type="hidden" id="weaponRows" name="weaponRows" value=""/>
                </div>
            </div>
            <div id="force-powers" class="box">
              <h2>Froce powers & other information</h2>
              <textarea name="forcepwr" placeholder="No idea what tyo type here..." rows="10" cols="55"></textarea>
            </div>
            <div class="uploadDelete">
              <h2>Save & Share</h2>
              <select name="sharing" id="sharing">
                <option value="private">
                  Private Sheet
                </option>
                <option value="engi">
                  Engineering
                </option>
                <option value="medic">
                  Medbay
                </option>
                <option value="arms">
                  Armory & Security
                </option>
                <option value="gally">
                  Gally
                </option>
                <option value="url">
                  Anyone with this URL
                </option>
              </select>
              <br />
              <section id="permissions">
                <span><label for="shareView">May View</label><br/>
                <input type="radio" name="permissions" value="view" id="shareView"></span>
                <span><label for="shareEdit">May View + Edit</label><br/>
                <input type="radio" name="permissions" value="edit" id="shareEdit"></span>
              </section>
              <br/>
              <section id="updateDelete">
                <input type="submit" id="uploadBtn" value="Update"><button type="button" id="deleteBtn">DELETE</button>
              </section>
            </div>
            <span id="resultMsg"></span>
          </div>
          <div class="top-right box" id="persona">
            <h2 id="equipment">other Equipment</h2>
            <span><strong>Type</strong><strong>Note</strong></span>
            <textarea placeholder="Utility Belt - Contains 6 medpacks, liquid cable disp..." rows="10" id="char-equip" name="char-equip" cols="55"></textarea>
            <strong id="personality">Personality:</strong>
            <textarea placeholder="A former Xantha player who turned pirate looking for..." id="char-bs" name="char-bs" rows="10" cols="55"></textarea>
            <strong id="objectives">Objectives:</strong>
            <textarea placeholder="Earn the crews respect/nGet on Zals good side." id="char-goals" name="char-goals" rows="10" cols="55"></textarea>
            <strong>Languages:</strong>
            <textarea placeholder="Minor Huttees & Basic" id="char-lang" name="char-lang" rows="10" cols="55"></textarea>
            <strong id="contacts">Contacts / Enemies:</strong>
            <textarea placeholder="Deathsticks (underworld contact)..." rows="10" id="char-contacts" name="char-contacts" cols="55"></textarea>

          </div>

      </div>
    </form>
    </div>

    <!-- Sharing permissions -->
    <script>

      $("#sharing").change(function(){
        console.log($(this).val());
        if($(this).val() != "private"){
          $("#permissions").css("display", "flex");
          console.log("Sharing changed!");
          $("#deleteBtn").prop("disabled", true);
          $("#uploadBtn").prop("disabled", true);

          $("#permissions").change(function(){
            $("#deleteBtn").prop("disabled", false);
            $("#uploadBtn").prop("disabled", false);
          })
        }
        else{
          $("#permissions").css("display", "none");
          $("#deleteBtn").prop("disabled", false);
          $("#uploadBtn").prop("disabled", false);
        }

      })

    </script>

    <!-- Color change
    <script>
      console.log("Current input color is: #00c7f8");
      console.log("Current text color is: #00c7f8");
      console.log("Current border color is: #00c7f8");


      $("#inputcolorpicker").change(function(){
        let collor = $("#inputcolorpicker").val();
        console.log("Current input color is: "+collor);
        $("#color").append("input, textarea, select{color: "+collor+";}");
      $("#inputcolor-reset").click(function(){
        $("#color").append("input, textarea, select{color: #00c7f8;}");
        $("#inputcolorpicker").val("#00c7f8");
        console.log("Current input color is: #00c7f8");
      })
      })
      $("#textcolorpicker").change(function(){
        let collor = $("#textcolorpicker").val();
        console.log("Current text color is: "+collor);
        $("#color").append("*{color: "+collor+";}");
      $("#textcolor-reset").click(function(){
        $("#color").append("*{color: #00c7f8;}");
        $("#textcolorpicker").val("#00c7f8");
        console.log("Current text color is: #00c7f8");
      })
      })
    </script> -->
    <!-- Smooth Scroll -->
    <script>
      $(document).ready(function(){
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

          // Make sure this.hash has a value before overriding default behavior
          if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
              scrollTop: $(hash).offset().top-110
            }, 800, function(){

              // Add hash (#) to URL when done scrolling (default click behavior)

              window.history.pushState(null, null, hash);
            });
          } // End if
        });
      });
      </script>
     <!-- Sheet return btn -->
     <script>

      $(".sheetBrowser").click(function(){

          window.location.href = "sheet-browser.php";

      })

     </script>
     <!-- Avatar -->
    <script>
      $("#img-upload").click(function(){
        $("#img-popup").css("display", "flex");
        $("#dimmer").css("display", "block");
      })

      // Abort
      $("#cancel-upload").click(function(){
        $("#img-popup").css("display", "none");
        $("#dimmer").css("display", "none");
      })
      $("#dimmer").click(function(){
        $("#img-popup").css("display", "none");
        $("#dimmer").css("display", "none");
      })

      // Upload
      $("#upload").click(function(){
        let imgurl = $("#avatar-url").val();
        $("#avatar-img").attr("src", imgurl);
        $("#hidden-img").val(imgurl);

        $("#img-popup").css("display", "none");
        $("#dimmer").css("display", "none");
      })

      // Debug
      $("#avtar-url").change(function(){
        console.log($("#avatar-url").val());
      })
    </script>
    <!-- Auto update FP -->
    <script>
      $("#char-force").change(function(){
        console.log("changed")
        if($(this).prop("checked") == true){
          $("#char-fp").val("2");
          console.log("checked");
        }
        else{
          $("#char-fp").val("1");
          console.log("unchecked");
        }
      })
    </script>

    <!-- Add/Remove skill -->
    <script>


      // Dexterity
      let dexSkillCount = 0;
      let dexSkillDiceCount = 0;
      $("#add-dex-skill").click(function(){
        dexSkillDiceCount++;
        dexSkillCount++;
        console.log("Dex Skills Added. Current number of dex skills: "+dexSkillCount);
        $("#dex-skill-Rows").val(dexSkillCount);

        let newDexSkill =  "<span class='skillRow'><input type='text' name='dskill"+dexSkillCount+"' id='dskill"+dexSkillCount+"' placeholder='Con' /><input type='text' class='skillD' name='dskillD"+dexSkillDiceCount+"' id='dskillD"+dexSkillDiceCount+"' placeholder='D1' /></span>";

        // Scrolls to the bottom of the list
        $("#dex-skill-list").scrollTop($("#dex-skill-list").prop("scrollHeight"));

        $("#dex-skill-list span.buttons").before(newDexSkill);
      })

      $("#remove-dex-skill").click(function(){

        if(dexSkillDiceCount >0){
          dexSkillDiceCount--;
          dexSkillCount--;
          console.log("Dex Skill Removed. Current number of dex skills: "+dexSkillCount);
        $("#dex-skill-list span.skillRow").last().remove("span");
        $("#dex-skill-Rows").val(dexSkillCount);

      }
      else{
        console.log("No more Skill Rows to remove");
      }

      })




      // Perception
      let percSkillCount = 0;
      let percSkillDiceCount = 0;
      $("#add-perc-skill").click(function(){
        percSkillDiceCount++;
        percSkillCount++;
        console.log("Perc. Skills Added. Current number of Perc skills: "+percSkillCount);
        let newPercSkill =  "<span class='skillRow'><input type='text' name='pskill"+percSkillCount+"' id='pskill"+percSkillCount+"' placeholder='Con' /><input type='text' class='skillD' name='pskillD"+percSkillDiceCount+"' id='pskillD"+percSkillDiceCount+"' placeholder='D1' /></span>";
        $("#perc-skill-Rows").val(percSkillCount);


        $("#perc-skill-list").scrollTop($("#perc-skill-list").prop("scrollHeight"));

        $("#perc-skill-list span.buttons").before(newPercSkill);
        console.log("Perc Skill Added");
      })

      $("#remove-perc-skill").click(function(){

        if(percSkillDiceCount >0){
          percSkillDiceCount--;
          percSkillCount--;
          console.log("Per Skill Removed. Current number of perc- skills: "+percSkillCount);
        $("#perc-skill-list span.skillRow").last().remove("span");
        $("#perc-skill-list").scrollTop($("#perc-skill-list").prop("scrollHeight"));
        $("#perc-skill-Rows").val(percSkillCount);

      }
      else{
        console.log("No more Skill Rows to remove");
      }

      })

      // Knowledge
      let knowSkillCount = 0;
      let knowSkillDiceCount = 0;
      $("#add-know-skill").click(function(){
        knowSkillDiceCount++;
        knowSkillCount++;
        console.log("Know. Skills Added. Current number of know skills: "+knowSkillCount);
        let newKnowSkill =  "<span class='skillRow'><input type='text' name='kskill"+knowSkillCount+"' id='kskill"+knowSkillCount+"' placeholder='Con' /><input type='text' class='skillD' name='kskillD"+knowSkillDiceCount+"' id='kskillD"+knowSkillDiceCount+"' placeholder='D1' /></span>";

        $("#know-skill-Rows").val(knowSkillCount);
        $("#know-skill-list").scrollTop($("#know-skill-list").prop("scrollHeight"));

        $("#know-skill-list span.buttons").before(newKnowSkill);

      })

      $("#remove-know-skill").click(function(){
        if(knowSkillDiceCount >0){
          knowSkillDiceCount--;
          knowSkillCount--;
          console.log("Know Skill Removed. Current number of know skills: "+knowSkillCount);
        $("#know-skill-list span.skillRow").last().remove("span");
        $("#know-skill-Rows").val(knowSkillCount);

      }
      else{
        console.log("No more Skill Rows to remove");
      }

      })

      // Strength
      let strSkillCount = 0;
      let strSkillDiceCount = 0;
      $("#add-str-skill").click(function(){
        strSkillDiceCount++;
        strSkillCount++;
        let newStrSkill =  "<span class='skillRow'><input type='text' name='sskill"+strSkillCount+"' id='sskill"+strSkillCount+"' placeholder='Con' /><input type='text' class='skillD' name='sskillD"+strSkillDiceCount+"' id='sskillD"+strSkillDiceCount+"' placeholder='D1' /></span>";


        $("#str-skill-list").scrollTop($("#str-skill-list").prop("scrollHeight"));

        $("#str-skill-list span.buttons").before(newStrSkill);
        console.log("Str. Skills Added. Current number of str skills: "+strSkillCount);
        $("#str-skill-Rows").val(strSkillCount);
      })

      $("#remove-str-skill").click(function(){
        if(strSkillDiceCount >0){
          strSkillDiceCount--;
          strSkillCount--;
        console.log("Str Skill Removed. Current number of str skills: "+strSkillCount);
        $("#str-skill-Rows").val(strSkillCount);
        $("#str-skill-list span.skillRow").last().remove("span");

      }
      else{
        console.log("No more Skill Rows to remove");
      }
      })

      // Mechanical
      let mechSkillCount = 0;
      let mechSkillDiceCount = 0;
      $("#add-mech-skill").click(function(){
        mechSkillDiceCount++;
        mechSkillCount++;

        let newMechSkill =  "<span class='skillRow'><input type='text' name='mskill"+mechSkillCount+"' id='mskill"+mechSkillCount+"' placeholder='Con' /><input type='text' class='skillD' name='mskillD"+mechSkillDiceCount+"' id='mskillD"+mechSkillDiceCount+"' placeholder='D1' /></span>";

        $("#mech-skill-list").scrollTop($("#mech-skill-list").prop("scrollHeight"));
        $("#mech-skill-Rows").val(mechSkillCount);
        $("#mech-skill-list span.buttons").before(newMechSkill);
        console.log("Mech. Skills Added. Current number of mech skills: "+mechSkillCount);
      })

      $("#remove-mech-skill").click(function(){
        if(mechSkillDiceCount >0){
          mechSkillDiceCount--;
          mechSkillCount--;
        console.log("Mech Skill Removed. Current number of mech skills: "+mechSkillCount);
        $("#mech-skill-Rows").val(mechSkillCount);
        $("#mech-skill-list span.skillRow").last().remove("span");

      }
      else{
        console.log("No more Skill Rows to remove");
      }

      })

      // Technical
      let techSkillCount = 0;
      let techSkillDiceCount = 0;
      $("#add-tech-skill").click(function(){
        techSkillDiceCount++;
        techSkillCount++;
        let newTechSkill =  "<span class='skillRow'><input type='text' id='tskill"+techSkillCount+"' name='tskill"+techSkillCount+"' placeholder='Con' /><input type='text' class='skillD' id='tskillD"+techSkillDiceCount+"' name='tskillD"+techSkillDiceCount+"' placeholder='D1' /></span>";


        $("#tech-skill-list").scrollTop($("#tech-skill-list").prop("scrollHeight"));

        $("#tech-skill-list span.buttons").before(newTechSkill);
        console.log("Tech. Skills Added. Current number of skills: "+techSkillCount);
        $("#tech-skill-Rows").val(techSkillCount);
      })

      $("#remove-tech-skill").click(function(){
        if(techSkillDiceCount >0){
          techSkillDiceCount--;
          techSkillCount--;
        console.log("Tech. Skill Removed. Current number of tech skills: "+techSkillCount);

        $("#tech-skill-list span.skillRow").last().remove("span");
        $("#tech-skill-Rows").val(techSkillCount);

      }
      else{
        console.log("No more Skill Rows to remove");
      }

      })

    </script>

    <!-- Add weapon -->
    <script>
      let weaponCount = 0;
      $("#add-weapon").click(function(){
        weaponCount++;
        let newWeapon =  "<div class='weaponRow'><span><strong>Type</strong><strong>Melee</strong><strong>Dmg.</strong><strong id='range-dc"+weaponCount+"'>Range: S/M/L</strong></span><span><input type='text' name='weaponType"+weaponCount+"' id='weapon-type"+weaponCount+"' placeholder='Xantha'/><input type='checkbox' name='melee-weapon"+weaponCount+"' class='"+weaponCount+"' id='melee-weapon"+weaponCount+"' /><input type='text'name='weaponDmg"+weaponCount+"' id='weapon-dmg"+weaponCount+"' placeholder='STR + 2D'/><input type='text' name='weaponRange"+weaponCount+"' id='weapon-range"+weaponCount+"' placeholder='melee'/></span><br/><strong>Notes</strong><br/><textarea name='weapon-notes"+weaponCount+"' id='weapon-notes"+weaponCount+"' rows='5'></textarea></div>";

        $("#add-weapon").before(newWeapon);
        $("#weaponRows").val(weaponCount);
        console.log("Added weapon. Current number of weapons: "+weaponCount);

        $("#melee-weapon"+weaponCount+"").change(function(){
          console.log("Changed");
          let weaponRow = this.className;
          let checked = $(this).is(":checked");
           if (checked) {
             console.log(weaponRow);

              $("#range-dc"+weaponRow+"").text("Difficulty");
              console.log("Checked");
              console.log($("#range-dc"+weaponRow+"").text());
           }
           else{
             $("#range-dc"+weaponRow+"").text("Range: S/M/L");
             console.log("unchecked");
           }



        })

      })


      $("#remove-weapon").click(function(){
        if(weaponCount >0){
          weaponCount--;
        console.log("Weapon Removed. Current number of weapons: "+weaponCount);

        $("#weapons-list div.weaponRow").last().remove("div");
        $("#weaponRows").val(weaponCount);

      }
      else{
        console.log("No more Weapons to remove");
      }

      })


    </script>
    <!-- Fix image replacement on smaller screen -->
    <script>
      $(document).ready(function(){
        if($(".sheet-title").css("display") == "none"){
          console.log("test gone");
          // $("#avatar").after($("#basic-info"));
          // $("div.top-right").first().css("background-color", "red");
          console.log("test moved");
        }
      })
    </script>
    <!-- Switch input box for physical discription -->
    <script>




    $('#char-physics').keypress(function(e) {
      var tval = $('#char-physics').val(),
          tlength = tval.length,
          set = 35,
          remain = parseInt(set - tlength);






      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
          $("#char-physics2").focus();

          // $('#char-physics').val((tval).substring(0, tlength - 1));
          // return false;


        }





      })





      // Allow to erase like normal
      $("#char-physics2").keydown(function(e){


        $("#hidden-physics").val(physics.toString());


        if(e.keyCode == 8 && !$("#char-physics2").val()){
          $("#char-physics").focus();


        }

      })




    </script>
    <!-- Save to Form to Database  -->
    <script>

      let sheetId = "<?php echo $_SESSION['sheetId'];?>";
      console.log(sheetId);

        <?php

          $sheetId = $SESSION['sheetId'];

          $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');

              if(mysqli_connect_errno()){
                $_SESSION['message'] = "Couldn't conect to db!";
              }

              // Fetching data

                // Fetching Basic data


              $sql = "SELECT * FROM Sheet WHERE SHEETiD=".$_SESSION['sheetId'].";";
              $sheetResult = mysqli_query($mysqli, $sql);



                  if(mysqli_num_rows($sheetResult) > 0){


                      while($rowSheet = $sheetResult->fetch_assoc()){

                        $charAvatar = json_decode($rowSheet['AVATAR']);
                        if($rowSheet['FORCEPOWERS'] != null){
                          $rowSheet['FORCEPOWERS'] = substr($rowSheet['FORCEPOWERS'], 1, -1);
                          $charPwrs = json_encode($rowSheet['FORCEPOWERS']);
                          $charPwrs = substr($charPwrs, 1, -1);
                        }
                        else{
                          $charPwrs = $rowSheet['FORCEPOWERS'];
                        }

                        $rowSheet['NAME'] = substr($rowSheet['NAME'], 1, -1);
                        $charName = json_encode($rowSheet['NAME']);
                        $charName = substr($charName, 1, -1);

                          $avatar = $charAvatar;
                          $forcepwr = $charPwrs;
                          $charName = $charName;

                      }

                  }
                  $sqlBasicInfo = "SELECT * FROM SheetBasicInfo WHERE SHEETiD=".$_SESSION['sheetId'].";";
                  $sheetBasicInfoResult = mysqli_query($mysqli, $sqlBasicInfo);

                  if(mysqli_num_rows($sheetBasicInfoResult) > 0){


                      while($rowSheetBasicInfo = $sheetBasicInfoResult->fetch_assoc()){

                        $rowSheetBasicInfo['GENDER'] = substr($rowSheetBasicInfo['GENDER'], 1, -1);
                        $charGender = json_encode($rowSheetBasicInfo['GENDER']);
                        $charGender = substr($charGender, 1, -1);
                        $rowSheetBasicInfo['RACE'] = substr($rowSheetBasicInfo['RACE'], 1, -1);
                        $charRace = json_encode($rowSheetBasicInfo['RACE']);
                        $charRace = substr($charRace, 1, -1);
                        $rowSheetBasicInfo['AGE'] = substr($rowSheetBasicInfo['AGE'], 1, -1);
                        $charAge = json_encode($rowSheetBasicInfo['AGE']);
                        $charAge = substr($charAge, 1, -1);
                        $rowSheetBasicInfo['HEIGHT'] = substr($rowSheetBasicInfo['HEIGHT'], 1, -1);
                        $charHeight = json_encode($rowSheetBasicInfo['HEIGHT']);
                        $charHeight = substr($charHeight, 1, -1);
                        $rowSheetBasicInfo['WEIGHT'] = substr($rowSheetBasicInfo['WEIGHT'], 1, -1);
                        $charWeight = json_encode($rowSheetBasicInfo['WEIGHT']);
                        $charWeight = substr($charWeight, 1, -1);
                        $rowSheetBasicInfo['TYPE'] = substr($rowSheetBasicInfo['TYPE'], 1, -1);
                        $charType = json_encode($rowSheetBasicInfo['TYPE']);
                        $charType = substr($charType, 1, -1);
                        $rowSheetBasicInfo['PHYSICAL'] = substr($rowSheetBasicInfo['PHYSICAL'], 1, -1);
                        $charPhysics = json_encode($rowSheetBasicInfo['PHYSICAL']);
                        $charPhysics = substr($charPhysics, 1, -1);
                        if($rowSheetBasicInfo['PHYSICAL2'] != null){
                          $rowSheetBasicInfo['PHYSICAL2'] = substr($rowSheetBasicInfo['PHYSICAL2'], 1, -1);
                          $charPhysics2 = json_encode($rowSheetBasicInfo['PHYSICAL2']);
                          $charPhysics2 = substr($charPhysics2, 1, -1);
                        }
                        else{
                          $charPhysics2 = $rowSheetBasicInfo['PHYSICAL2'];
                        }


                          $gender = $charGender;
                          $race = $charRace;
                          $age = $charAge;
                          $height = $charHeight;
                          $weight = $charWeight;
                          $charType = $charType;
                          $physical = $charPhysics;
                          $physical2 = $charPhysics2;


                      }

                  }

                  // Fetch data from Dex table
                  $sqlSkillDex = "SELECT `DICES` FROM SheetSkillsDex WHERE SHEETiD=".$_SESSION['sheetId']." AND `SKILL`='DEXTERITY';";
                  $sheetSkillDexResult = mysqli_query($mysqli, $sqlSkillDex);

                  if(mysqli_num_rows($sheetSkillDexResult) > 0){


                      while($rowSheetSkillDex = $sheetSkillDexResult->fetch_assoc()){

                        $rowSheetSkillDex['DICES'] = substr($rowSheetSkillDex['DICES'], 1, -1);
                        $dexskill = json_encode($rowSheetSkillDex['DICES']);
                        $dexskill = substr($dexskill, 1, -1);

                          $dex = $dexskill;


                      }

                  }


                  $sqlSkillsDex = "SELECT * FROM SheetSkillsDex WHERE NOT `SKILL`='DEXTERITY' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsDexResult = mysqli_query($mysqli, $sqlSkillsDex);

                  if(mysqli_num_rows($sheetSkillsDexResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsDex = $sheetSkillsDexResult->fetch_assoc()){

                        $rowSheetSkillsDex['SKILL'] = substr($rowSheetSkillsDex['SKILL'], 1, -1);
                        $dskill = json_encode($rowSheetSkillsDex['SKILL']);
                        $dskill = substr($dskill, 1, -1);
                        $rowSheetSkillsDex['DICES'] = substr($rowSheetSkillsDex['DICES'], 1, -1);
                        $dskillD = json_encode($rowSheetSkillsDex['DICES']);
                        $dskillD = substr($dskillD, 1, -1);

                          echo "$('#add-dex-skill').click();";
                          echo "$('#dskill".$skillRow."').val('".$dskill."');";
                          echo "$('#dskillD".$skillRow."').val('".$dskillD."');";
                          $skillRow++;


                      }

                  }
                  // Fetch data from Perc table
                  $sqlSkillPerc = "SELECT `DICES` FROM SheetSkillsPerc WHERE SHEETiD=".$_SESSION['sheetId']." AND `SKILL`='PERCEPTION';";
                  $sheetSkillPercResult = mysqli_query($mysqli, $sqlSkillPerc);

                  if(mysqli_num_rows($sheetSkillPercResult) > 0){


                      while($rowSheetSkillPerc = $sheetSkillPercResult->fetch_assoc()){

                        $rowSheetSkillPerc['DICES'] = substr($rowSheetSkillPerc['DICES'], 1, -1);
                        $percskill = json_encode($rowSheetSkillPerc['DICES']);
                        $percskill = substr($percskill, 1, -1);

                        $perc = $percskill;


                      }

                  }


                  $sqlSkillsPerc = "SELECT * FROM SheetSkillsPerc WHERE NOT `SKILL`='PERCEPTION' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsPercResult = mysqli_query($mysqli, $sqlSkillsPerc);

                  if(mysqli_num_rows($sheetSkillsPercResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsPerc = $sheetSkillsPercResult->fetch_assoc()){

                        $rowSheetSkillsPerc['SKILL'] = substr($rowSheetSkillsPerc['SKILL'], 1, -1);
                        $pskill = json_encode($rowSheetSkillsPerc['SKILL']);
                        $pskill = substr($pskill, 1, -1);
                        $rowSheetSkillsPerc['DICES'] = substr($rowSheetSkillsPerc['DICES'], 1, -1);
                        $pskillD = json_encode($rowSheetSkillsPerc['DICES']);
                        $pskillD = substr($pskillD, 1, -1);

                          echo "$('#add-perc-skill').click();";
                          echo "$('#pskill".$skillRow."').val('".$pskill."');";
                          echo "$('#pskillD".$skillRow."').val('".$pskillD."');";
                          $skillRow++;


                      }

                  }

                  // Fetch data from Know table
                  $sqlSkillKnow = "SELECT `DICES` FROM SheetSkillsKnow WHERE SHEETiD=".$_SESSION['sheetId']." AND `SKILL`='KNOWLEDGE';";
                  $sheetSkillKnowResult = mysqli_query($mysqli, $sqlSkillKnow);

                  if(mysqli_num_rows($sheetSkillKnowResult) > 0){


                      while($rowSheetSkillKnow = $sheetSkillKnowResult->fetch_assoc()){

                        $rowSheetSkillKnow['DICES'] = substr($rowSheetSkillKnow['DICES'], 1, -1);
                        $knowskill = json_encode($rowSheetSkillKnow['DICES']);
                        $knowskill = substr($knowskill, 1, -1);
                        $know = $knowskill;


                      }

                  }


                  $sqlSkillsKnow = "SELECT * FROM SheetSkillsKnow WHERE NOT `SKILL`='KNOWLEDGE' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsKnowResult = mysqli_query($mysqli, $sqlSkillsKnow);

                  if(mysqli_num_rows($sheetSkillsKnowResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsKnow = $sheetSkillsKnowResult->fetch_assoc()){

                        $rowSheetSkillsKnow['SKILL'] = substr($rowSheetSkillsKnow['SKILL'], 1, -1);
                        $kskill = json_encode($rowSheetSkillsKnow['SKILL']);
                        $kskill = substr($kskill, 1, -1);
                        $rowSheetSkillsKnow['DICES'] = substr($rowSheetSkillsKnow['DICES'], 1, -1);
                        $kskillD = json_encode($rowSheetSkillsKnow['DICES']);
                        $kskillD = substr($kskillD, 1, -1);


                          echo "$('#add-know-skill').click();";
                          echo "$('#kskill".$skillRow."').val('".$kskill."');";
                          echo "$('#kskillD".$skillRow."').val('".$kskillD."');";
                          $skillRow++;


                      }

                  }

                  // Fetch data from Str table
                  $sqlSkillStr = "SELECT `DICES` FROM SheetSkillsStr WHERE SHEETiD=".$_SESSION['sheetId']." AND `SKILL`='STRENGTH';";
                  $sheetSkillStrResult = mysqli_query($mysqli, $sqlSkillStr);

                  if(mysqli_num_rows($sheetSkillStrResult) > 0){


                      while($rowSheetSkillStr = $sheetSkillStrResult->fetch_assoc()){


                        $rowSheetSkillStr['DICES'] = substr($rowSheetSkillStr['DICES'], 1, -1);
                        $strskill = json_encode($rowSheetSkillStr['DICES']);
                        $strskill = substr($strskill, 1, -1);
                        $str = $strskill;


                      }

                  }


                  $sqlSkillsStr = "SELECT * FROM SheetSkillsStr WHERE NOT `SKILL`='STRENGTH' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsStrResult = mysqli_query($mysqli, $sqlSkillsStr);

                  if(mysqli_num_rows($sheetSkillsStrResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsStr = $sheetSkillsStrResult->fetch_assoc()){

                        $rowSheetSkillsStr['SKILL'] = substr($rowSheetSkillsStr['SKILL'], 1, -1);
                        $sskill = json_encode($rowSheetSkillsStr['SKILL']);
                        $sskill = substr($sskill, 1, -1);
                        $rowSheetSkillsStr['DICES'] = substr($rowSheetSkillsStr['DICES'], 1, -1);
                        $sskillD = json_encode($rowSheetSkillsStr['DICES']);
                        $sskillD = substr($sskillD, 1, -1);


                          echo "$('#add-str-skill').click();";
                          echo "$('#sskill".$skillRow."').val('".$sskill."');";
                          echo "$('#sskillD".$skillRow."').val('".$sskillD."');";
                          $skillRow++;


                      }

                  }

                  // Fetch data from Mech table
                  $sqlSkillMech = "SELECT `DICES` FROM SheetSkillsMech WHERE SHEETiD=".$_SESSION['sheetId']." AND `SKILL`='MECHANICAL';";
                  $sheetSkillMechResult = mysqli_query($mysqli, $sqlSkillMech);

                  if(mysqli_num_rows($sheetSkillMechResult) > 0){


                      while($rowSheetSkillMech = $sheetSkillMechResult->fetch_assoc()){

                        $rowSheetSkillMech['DICES'] = substr($rowSheetSkillMech['DICES'], 1, -1);
                        $mechskill = json_encode($rowSheetSkillMech['DICES']);
                        $mechskill = substr($mechskill, 1, -1);
                        $mech = $mechskill;


                      }

                  }


                  $sqlSkillsMech = "SELECT * FROM SheetSkillsMech WHERE NOT `SKILL`='MECHANICAL' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsMechResult = mysqli_query($mysqli, $sqlSkillsMech);

                  if(mysqli_num_rows($sheetSkillsMechResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsMech = $sheetSkillsMechResult->fetch_assoc()){
                        $rowSheetSkillsMech['SKILL'] = substr($rowSheetSkillsMech['SKILL'], 1, -1);
                        $mskill = json_encode($rowSheetSkillsMech['SKILL']);
                        $mskill = substr($mskill, 1, -1);
                        $rowSheetSkillsMech['DICES'] = substr($rowSheetSkillsMech['DICES'], 1, -1);
                        $mskillD = json_encode($rowSheetSkillsMech['DICES']);
                        $mskillD = substr($mskillD, 1, -1);

                          echo "$('#add-mech-skill').click();";
                          echo "$('#mskill".$skillRow."').val('".$mskill."');";
                          echo "$('#mskillD".$skillRow."').val('".$mskillD."');";
                          $skillRow++;


                      }

                  }

                  // Fetch data from Tech table
                  $sqlSkillTech = "SELECT `DICES` FROM SheetSkillsTech WHERE `SHEETiD`='".$_SESSION['sheetId']."' AND `SKILL`='TECHNICAL';";
                  $sheetSkillTechResult = mysqli_query($mysqli, $sqlSkillTech);

                  if(mysqli_num_rows($sheetSkillTechResult) > 0){


                      while($rowSheetSkillTech = $sheetSkillTechResult->fetch_assoc()){

                          $rowSheetSkillTech['DICES'] = substr($rowSheetSkillTech['DICES'], 1, -1);
                          $techskill = json_encode($rowSheetSkillTech['DICES']);
                          $techskill = substr($techskill, 1, -1);
                          $tech = $techskill;
                          echo "console.log('".$tech."');";

                      }

                  }


                  $sqlSkillsTech = "SELECT * FROM SheetSkillsTech WHERE NOT `SKILL`='TECHNICAL' AND SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsTechResult = mysqli_query($mysqli, $sqlSkillsTech);

                  if(mysqli_num_rows($sheetSkillsTechResult) > 0){
                    $skillRow = 1;

                      while($rowSheetSkillsTech = $sheetSkillsTechResult->fetch_assoc()){

                        $rowSheetSkillsTech['SKILL'] = substr($rowSheetSkillsTech['SKILL'], 1, -1);
                        $tskill = json_encode($rowSheetSkillsTech['SKILL']);
                        $tskill = substr($tskill, 1, -1);
                        $rowSheetSkillsTech['DICES'] = substr($rowSheetSkillsTech['DICES'], 1, -1);
                        $tskillD = json_encode($rowSheetSkillsTech['DICES']);
                        $tskillD = substr($tskillD, 1, -1);

                          echo "$('#add-tech-skill').click();";
                          echo "$('#tskill".$skillRow."').val('".$tskill."');";
                          echo "$('#tskillD".$skillRow."').val('".$tskillD."');";
                          $skillRow++;


                      }

                  }

                  // Force skills
                  $sqlSkillsForce = "SELECT * FROM SheetSkillsForce WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSkillsForceResult = mysqli_query($mysqli, $sqlSkillsForce);

                  if(mysqli_num_rows($sheetSkillsForceResult) > 0){


                      while($rowSheetSkillsForce = $sheetSkillsForceResult->fetch_assoc()){

                          $rowSheetSkillsForce['CONTROLd'] = substr($rowSheetSkillsForce['CONTROLd'], 1, -1);
                          $controllD = json_encode($rowSheetSkillsForce['CONTROLd']);
                          $controllD = substr($controllD, 1, -1);
                          $rowSheetSkillsForce['ALTERd'] = substr($rowSheetSkillsForce['ALTERd'], 1, -1);
                          $alterD = json_encode($rowSheetSkillsForce['ALTERd']);
                          $alterD = substr($alterD, 1, -1);
                          $rowSheetSkillsForce['SENCEd'] = substr($rowSheetSkillsForce['SENCEd'], 1, -1);
                          $senceD = json_encode($rowSheetSkillsForce['SENCEd']);
                          $senceD = substr($senceD, 1, -1);


                          echo "$('#fskillD1').val('".$controllD."');";
                          echo "$('#fskillD2').val('".$senceD."');";
                          echo "$('#fskillD3').val('".$alterD."');";



                      }

                  }

                  // Special Text Areas
                  $sqlSpecialsTextareas = "SELECT * FROM SheetSpecialsTextareas WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSpecialsTextareasResult = mysqli_query($mysqli, $sqlSpecialsTextareas);

                  if(mysqli_num_rows($sheetSpecialsTextareasResult) > 0){


                      while($rowSheetSpecialsTextareas = $sheetSpecialsTextareasResult->fetch_assoc()){
                          if($rowSheetSpecialsTextareas['ADVANTAGES'] != null){
                            $rowSheetSpecialsTextareas['ADVANTAGES'] = substr($rowSheetSpecialsTextareas['ADVANTAGES'], 1, -1);
                            $advantages = json_encode($rowSheetSpecialsTextareas['ADVANTAGES']);
                            $advantages = substr($advantages, 1, -1);
                          }
                          else{
                            $advantages = $rowSheetSpecialsTextareas['ADVANTAGES'];
                          }
                          if($rowSheetSpecialsTextareas['DISADVANTAGES'] != null){
                            $rowSheetSpecialsTextareas['DISADVANTAGES'] = substr($rowSheetSpecialsTextareas['DISADVANTAGES'], 1, -1);
                            $disadvantages = json_encode($rowSheetSpecialsTextareas['DISADVANTAGES']);
                            $disadvantages = substr($disadvantages, 1, -1);
                          }
                          else{
                            $disadvantages = $rowSheetSpecialsTextareas['DISADVANTAGES'];
                          }

                          if($rowSheetSpecialsTextareas['SPECIALaBILLITIES'] != null){
                            $rowSheetSpecialsTextareas['SPECIALaBILLITIES'] = substr($rowSheetSpecialsTextareas['SPECIALaBILLITIES'], 1, -1);
                            $specialAbillities = json_encode($rowSheetSpecialsTextareas['SPECIALaBILLITIES']);
                            $specialAbillities = substr($specialAbillities, 1, -1);
                          }
                          else{
                              $specialAbillities = $rowSheetSpecialsTextareas['SPECIALaBILLITIES'];
                          }

                          echo "$('#advantages').val('".$advantages."');";
                          echo "$('#disadvantages').val('".$disadvantages."');";
                          echo "$('#spcecial-abilities').val('".$specialAbillities."');";



                      }

                  }

                  // Special Miscs
                  $sqlSpecialsMisc = "SELECT * FROM SheetSpecialsMisc WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSpecialsMiscResult = mysqli_query($mysqli, $sqlSpecialsMisc);

                  if(mysqli_num_rows($sheetSpecialsMiscResult) > 0){


                      while($rowSheetSpecialsMisc = $sheetSpecialsMiscResult->fetch_assoc()){

                          $rowSheetSpecialsMisc['MOVE'] = substr($rowSheetSpecialsMisc['MOVE'], 1, -1);
                          $charMove= json_encode($rowSheetSpecialsMisc['MOVE']);
                          $charMove = substr($charMove, 1, -1);

                          echo "$('#char-speed').val('".$charMove."');";

                          if($rowSheetSpecialsMisc['FORCIE'] == "on"){
                            echo "$('#char-force').prop('checked', true);";
                          }
                          else{
                            echo "$('#char-force').prop('checked', false);";
                          }

                          $rowSheetSpecialsMisc['FP'] = substr($rowSheetSpecialsMisc['FP'], 1, -1);
                          $charFp= json_encode($rowSheetSpecialsMisc['FP']);
                          $charFp = substr($charFp, 1, -1);
                          echo "$('#char-fp').val('".$charFp."');";
                          $rowSheetSpecialsMisc['DSP'] = substr($rowSheetSpecialsMisc['DSP'], 1, -1);
                          $charDsp= json_encode($rowSheetSpecialsMisc['DSP']);
                          $charDsp = substr($charDsp, 1, -1);
                          echo "$('#char-dsp').val('".$charDsp."');";
                          $rowSheetSpecialsMisc['CP'] = substr($rowSheetSpecialsMisc['CP'], 1, -1);
                          $charCp= json_encode($rowSheetSpecialsMisc['CP']);
                          $charCp = substr($charCp, 1, -1);
                          echo "$('#char-cp').val('".$charCp."');";
                          $rowSheetSpecialsMisc['CREDITS'] = substr($rowSheetSpecialsMisc['CREDITS'], 1, -1);
                          $charCredits= json_encode($rowSheetSpecialsMisc['CREDITS']);
                          $charCredits = substr($charCredits, 1, -1);
                          echo "$('#char-credits').val('".$charCredits."');";



                      }

                  }

                  // Wounds
                  $sqlSpecialWounds = "SELECT * FROM SheetSpecialWounds WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetSpecialWoundsResult = mysqli_query($mysqli, $sqlSpecialWounds);

                  if(mysqli_num_rows($sheetSpecialWoundsResult) > 0){


                      while($rowSheetSpecialWounds = $sheetSpecialWoundsResult->fetch_assoc()){

                        if($rowSheetSpecialWounds['STUNNED'] == "on"){
                          echo "$('#check-stun').prop('checked', true);";
                        }
                        else{
                          echo "$('#check-stun').prop('checked', false);";
                        }
                        if($rowSheetSpecialWounds['WOUNDED'] == "on"){
                          echo "$('#check-wound').prop('checked', true);";
                        }
                        else{
                          echo "$('#check-wound').prop('checked', false);";
                        }
                        if($rowSheetSpecialWounds['WOUNDEDx2'] == "on"){
                          echo "$('#double-wound').prop('checked', true);";
                        }
                        else{
                          echo "$('#double-wound').prop('checked', false);";
                        }
                        if($rowSheetSpecialWounds['INCAPACITATED'] == "on"){
                          echo "$('#check-incap').prop('checked', true);";
                        }
                        else{
                          echo "$('#check-incap').prop('checked', false);";
                        }
                        if($rowSheetSpecialWounds['MORTALLY'] == "on"){
                          echo "$('#check-mortal').prop('checked', true);";
                        }
                        else{
                          echo "$('#check-mortal').prop('checked', false);";
                        }


                      }

                  }



        // Page 2



                  // Armor
                  $sqlArmor = "SELECT * FROM SheetArmor WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetArmorResult = mysqli_query($mysqli, $sqlArmor);

                  if(mysqli_num_rows($sheetArmorResult) > 0){


                      while($rowSheetArmor = $sheetArmorResult->fetch_assoc()){


                          $rowSheetArmor['TYPE'] = substr($rowSheetArmor['TYPE'], 1, -1);
                          $armorType = json_encode($rowSheetArmor['TYPE']);
                          $armorType = substr($armorType, 1, -1);
                          echo "$('#armor-type').val('".$armorType."');";
                          $rowSheetArmor['AV'] = substr($rowSheetArmor['AV'], 1, -1);
                          $armorAv = json_encode($rowSheetArmor['AV']);
                          $armorAv = substr($armorAv, 1, -1);
                          echo "$('#armor-av').val('".$rowSheetArmor['AV']."');";
                          $rowSheetArmor['NOTES'] = substr($rowSheetArmor['NOTES'], 1, -1);
                          $armorNotes = json_encode($rowSheetArmor['NOTES']);
                          $armorNotes = substr($armorNotes, 1, -1);
                          echo "$('#armor-notes').val('".$armorNotes."');";



                      }

                  }

                  // Weapons
                  $sheetId = $_SESSION['sheetId'];


                  $sqlWeapons = "SELECT * FROM SheetWeapons WHERE SHEETiD=".$sheetId." ;";
                  $sheetWeaponsResult = mysqli_query($mysqli, $sqlWeapons);


                  if(mysqli_num_rows($sheetWeaponsResult) > 0){

                    $i = 1;
                      while($rowSheetWeapons = $sheetWeaponsResult->fetch_assoc()){
                          echo "$('#add-weapon').click();";

                          $rowSheetWeapons['TYPE'] = substr($rowSheetWeapons['TYPE'], 1, -1);
                          $weaponType = json_encode($rowSheetWeapons['TYPE']);
                          $weaponType = substr($weaponType, 1, -1);
                          echo "$('#weapon-type".$i."').val('".$weaponType."');";


                          if($rowSheetWeapons['MELEE'] == "on"){
                            echo "$('#melee-weapon".$i."').prop('checked', true);";
                            echo "$('#range-dc".$i."').text('Difficulty');";
                          }
                          else{
                            echo "$('#melee-weapon".$i."').prop('checked', false);";
                          }

                          $rowSheetWeapons['DMG'] = substr($rowSheetWeapons['DMG'], 1, -1);
                          $weaponDmg = json_encode($rowSheetWeapons['DMG']);
                          $weaponDmg = substr($weaponDmg, 1, -1);
                          echo "$('#weapon-dmg".$i."').val('".$weaponDmg."');";
                          $rowSheetWeapons['RANGE'] = substr($rowSheetWeapons['RANGE'], 1, -1);
                          $weaponRange = json_encode($rowSheetWeapons['RANGE']);
                          $weaponRange= substr($weaponRange, 1, -1);
                          echo "$('#weapon-range".$i."').val('".$weaponRange."');";
                          $rowSheetWeapons['NOTES'] = substr($rowSheetWeapons['NOTES'], 1, -1);
                          $weaponNotes = json_encode($rowSheetWeapons['NOTES']);
                          $weaponNotes = substr($weaponNotes, 1, -1);
                          echo "$('#weapon-notes".$i."').val('".$weaponNotes."');";

                          $i++;

                      }

                  }

                  // Others
                  $sqlOther = "SELECT * FROM SheetOther WHERE SHEETiD=".$_SESSION['sheetId']." ;";
                  $sheetOtherResult = mysqli_query($mysqli, $sqlOther);

                  if(mysqli_num_rows($sheetOtherResult) > 0){


                      while($rowSheetOther = $sheetOtherResult->fetch_assoc()){

                          if($rowSheetOther['EQUIPMENT'] != null){
                            $rowSheetOther['EQUIPMENT'] = substr($rowSheetOther['EQUIPMENT'], 1, -1);
                            $equipment = json_encode($rowSheetOther['EQUIPMENT']);
                            $equipment = substr($equipment, 1, -1);
                            $equipment = str_replace("u0027", "\'", $equipment);
                          }
                          else{
                            $equipment = $rowSheetOther['EQUIPMENT'];
                          }
                          if($rowSheetOther['PERSONALITY'] != null){
                            $rowSheetOther['PERSONALITY'] = substr($rowSheetOther['PERSONALITY'], 1, -1);
                            $charBS = json_encode($rowSheetOther['PERSONALITY']);
                            $charBS = substr($charBS, 1, -1);
                            $charBS = str_replace("u0027", "\'", $charBS);
                          }
                          else{
                            $charBS = $rowSheetOther['PERSONALITY'];
                          }

                          if($rowSheetOther['OBJECTIVES'] != null){
                            $rowSheetOther['OBJECTIVES'] = substr($rowSheetOther['OBJECTIVES'], 1, -1);
                            $charGoals = json_encode($rowSheetOther['OBJECTIVES']);
                            $charGoals = substr($charGoals, 1, -1);
                            $charGoals = str_replace("u0027", "\'", $charGoals);
                          }
                          else{
                            $charGoals = $rowSheetOther['OBJECTIVES'];
                          }

                          if($rowSheetOther['LANGUAGES'] != null){
                            $rowSheetOther['LANGUAGES'] = substr($rowSheetOther['LANGUAGES'], 1, -1);
                            $charLang = json_encode($rowSheetOther['LANGUAGES']);
                            $charLang = substr($charLang, 1, -1);
                            $charLang = str_replace("u0027", "\'", $charLang);
                          }
                          else{
                            $charLang = $rowSheetOther['LANGUAGES'];
                          }

                          if($rowSheetOther['CONTACTS'] != null){
                            $rowSheetOther['CONTACTS'] = substr($rowSheetOther['CONTACTS'], 1, -1);
                            $charContacts = json_encode($rowSheetOther['CONTACTS']);
                            $charContacts = substr($charContacts, 1, -1);
                            $charContacts = str_replace("u0027", "\'", $charContacts);
                          }
                          else{
                            $charContacts = $rowSheetOther['CONTACTS'];
                          }


                          echo "$('#char-equip').val('".$equipment."');";
                          echo "$('#char-bs').val('".$charBS."');";
                          echo "$('#char-goals').val('".$charGoals."');";
                          echo "$('#char-lang').val('".$charLang."');";
                          echo "$('#char-contacts').val('".$charContacts."');";



                      }

                  }
              ?>
               let avatarDB = "<?php echo $avatar; ?>";
               let charNameDB = "<?php echo $charName; ?>";
               let forcepwrDB = "<?php echo $forcepwr; ?>";

               let genderDB = "<?php echo $gender; ?>";
               let raceDB = "<?php echo $race; ?>";
               let ageDB = "<?php echo $age; ?>";
               let heightDB = "<?php echo $height; ?>";
               let weightDB = "<?php echo $weight; ?>";
               let charTypeDB = "<?php echo $charType; ?>";
               let physical1DB = "<?php echo $physical; ?>";
               let physical2DB = "<?php echo $physical2; ?>";
               console.log("Physics 1: "+physical1DB);
               $("#char-physics").val(physical1DB);
               $("#char-physics2").val(physical2DB);


               // Data for skills
               let dex = "<?php echo $dex; ?>";
               let perc = "<?php echo $perc; ?>";
               let know = "<?php echo $know; ?>";
               let str = "<?php echo $str; ?>";
               let mech = "<?php echo $mech; ?>";
               let tech = "<?php echo $tech; ?>";


               console.log("pre check avatar src: "+$("#avatar-img").attr("src"));

               if(avatarDB != "http://via.placeholder.com/450x320" || avatarDB != "https://cdn.discordapp.com/attachments/488482156704825348/616677351442350116/vengefull-chiss.jpg"){
                 $("#avatar-img").attr("src", avatarDB);
                 $("#hidden-img").val(avatarDB);
                 console.log("check avatar src: "+$("#avatar-img").attr("src"));
               }

               $("#hidden-img").change(function(){
                 if(avatarDB != "http://via.placeholder.com/450x320" || avatarDB != "https://cdn.discordapp.com/attachments/488482156704825348/616677351442350116/vengefull-chiss.jpg"){
                   $("#avatar-img").attr("src", avatarDB);
                   $("#hidden-img").val(avatarDB);
                   console.log("check avatar src: "+$("#avatar-img").attr("src"));
                 }
               })




              if(charNameDB != "" ){
                $("#char-name").val(charNameDB);
              }

              if(forcepwrDB != "" ){
                $("#force-powers textarea").val(forcepwrDB);
              }

              $("#char-type").val(charTypeDB);
              $("#char-gender").val(genderDB);
              $("#char-race").val(raceDB);
              $("#char-age").val(ageDB);
              $("#char-height").val(heightDB);
              $("#char-weight").val(weightDB);
              // $("#char-physics").val(physicalDB);

              $("#dex-dice").val(dex);
              $("#perc-dice").val(perc);
              $("#know-dice").val(know);
              $("#str-dice").val(str);
              $("#mech-dice").val(mech);
              $("#tech-dice").val(tech);


              $("#deleteBtn").click(function(){
              let deleeet =  confirm("Are you sure you want to delete this sheet?");

              if(deleeet == true){
                window.location.replace("https://vengefulscarsonline.joeyjaydigital.com/delete-sheet.php");
              }



              })

              <?php


            ?>


    </script>

    <!-- save -->
    <!-- <script>
      var doc = new jsPDF();
      var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
      };

      $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
      });
    </script> -->

    <!-- CORS fix -->
    <script>

        let imageUrl = "<?php echo $rowSheet['AVATAR'];?>";
        let container = document.querySelector(".avatar");

        function loadImage(url) {
        let image = new Image(200, 200);
        image.addEventListener("load", event => {
          container.insertBefore(image, container.firstChild);
        });

        image.addEventListener("error", event => {
          const errMsg = document.createElement("div");
          errMsg.innerText = `*** Error loading image ${url}`;
          errMsg.style.width = "95%";
          errMsg.className = "error";
          container.appendChild(errMsg);
        });

        image.crossOrigin = "use-credentials";
        image.alt = "avatar";
        image.className = "imageLeft";
        image.src = url;
        }

        loadImage(imageUrl);

    </script>

    <!-- DElete -->
    <script>


    </script>

  </body>
</html>
