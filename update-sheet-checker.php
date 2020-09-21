<?php
session_start();
$newURL = "https://vengefulscarsonline.joeyjaydigital.com/sheet-browser-sheet.php?dk=".$_SESSION['sheetId'];
  // Fetching PHP form inputs

    // Sheet table
    $avatar = $_POST['hidden-img'];
    $charName = $_POST['char-name'];
    $forcepwr = $_POST['forcepwr'];


    // PERMISSIONS
    if(isset($_POST['permissions'])){
      var_dump("This is permissions: ".$_POST['permissions']."<br/>");
      $charPermissions = json_encode($_POST['permissions'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
      var_dump("Encrypted: ".$charPermissions);

    }

    // SheetBasicInfo table
    $charType = $_POST['char-type'];
    $charGender = $_POST['char-gender'];
    $charRace = $_POST['char-race'];
    $charAge = $_POST['char-age'];
    $charHeight = $_POST['char-height'];
    $charWeight = $_POST['char-weight'];
    $charPhysics1 = $_POST['char-physics'];
    $charPhysics2 = $_POST['physics2'];
    $charPhysics = $charPhysics1.",".$charPhysics2;
    var_dump($_POST['melee-weapon']);
    // dex
    $dex = $_POST['dex-dice'];
    $dexSkills = $_POST['dex-skills'];
    echo "<p><strong>DEXTERITY ".$dex."</strong>";

    $i = 1;
    while($i <= $dexSkills){
      echo "<br>";
      echo $_POST['dskill'.$i.'']." ".$_POST['dskillD'.$i.''];

      $i++;
    }
    echo "</p>";

    // perc
    $perc = $_POST['perc-dice'];
    $percSkills = $_POST['perc-skills'];
    echo "<p><strong>PERCEPTION ".$perc."</strong>";
    $i = 1;
    while($i <= $percSkills){
      echo "<br>";
      echo $_POST['pskill'.$i.'']." ".$_POST['pskillD'.$i.''];
      $i++;
    }
    echo "</p>";

    // Know
    $know = $_POST['know-dice'];
    $knowSkills = $_POST['know-skills'];
    echo "<p><strong>KNOWLEDGE ".$know."</strong>";
    $i = 1;
    while($i <= $knowSkills){
      echo "<br>";
      echo $_POST['kskill'.$i.'']." ".$_POST['kskillD'.$i.''];
      $i++;
    }
    echo "</p>";

    // str
    $str = $_POST['str-dice'];
    $strSkills = $_POST['str-skills'];
    echo "<p><strong>STRENGTH ".$str."</strong>";
    $i = 1;
    while($i <= $strSkills){
      echo "<br>";
      echo $_POST['sskill'.$i.'']." ".$_POST['sskillD'.$i.''];
      $i++;
    }
    echo "</p>";

    // mech
    $mech = $_POST['mech-dice'];
    $mechSkills = $_POST['mech-skills'];
    echo "<p><strong>MECHANICAL ".$mech."</strong>";
    $i = 1;
    while($i <= $mechSkills){
      echo "<br>";
      echo $_POST['mskill'.$i.'']." ".$_POST['mskillD'.$i.''];
      $i++;
    }
    echo "</p>";

    // tech
    $tech = $_POST['tech-dice'];
    $techSkills = $_POST['tech-skills'];
    echo "<p><strong>DEXTERITY ".$tech."</strong>";
    $i = 1;
    while($i <= $techSkills){
      echo "<br>";
      echo $_POST['tskill'.$i.'']." ".$_POST['tskillD'.$i.''];
      $i++;
    }
    echo "</p>";

    // Force
    var_dump($_POST['control-dice']);
    var_dump($_POST['alter-dice']);
    var_dump($_POST['sence-dice']);








    // Weapons
    $weapons = $_POST['weaponRows'];

    $i = 1;
    while($i <= $weapons){
      echo "<p><strong>Wepon #".$i."</strong>";
      var_dump($_POST['weaponType'.$i.'']);
      var_dump($_POST['weaponDmg'.$i.'']);
      var_dump($_POST['weaponRange'.$i.'']);
      echo "</p>";
      $i++;
    }
    var_dump($_POST['weaponRows']);








//Sheet data update

      var_dump($_SESSION['sheetId']);
      echo "<br>";
      var_dump($avatar);
      echo "<br>";
      var_dump($charName);
      echo "<br>";
      var_dump($forcepwr);
      echo "<br>";
      // header('Location: '.$newURL);


// SheetBasicInfo Update

      var_dump($_SESSION['sheetId']);
      echo "<br>";
      var_dump($avatar);
      echo "<br>";
      var_dump($charName);
      echo "<br>";
      var_dump($forcepwr);
      echo "<br>";
      // header('Location: '.$newURL);


// Dex skills Update

    var_dump($dexSkills);
 ?>
