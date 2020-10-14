<?php
session_start();
$newURL = "https://vengefulscarsonline.joeyjaydigital.com/sheet-browser-sheet.php?dk=".$_SESSION['sheetId'];
  // Fetching PHP form inputs

    // Sheet table
    $avatar  = json_encode($_POST['hidden-img'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    $charName  = json_encode($_POST['char-name'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    $forcepwr = json_encode($_POST['forcepwr'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);



    // SheetBasicInfo table


$mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');

    if(mysqli_connect_errno()){
      $_SESSION['message'] = "Couldn't conect to db!";
    }




//Sheet data update
$charType  = json_encode($_POST['char-type'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charGender = json_encode($_POST['char-gender'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charRace = json_encode($_POST['char-race'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charAge = json_encode($_POST['char-age'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charHeight = json_encode($_POST['char-height'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charWeight = json_encode($_POST['char-weight'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charPhysics1 = json_encode($_POST['char-physics'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
$charPhysics2  = json_encode($_POST['physics2'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

var_dump($_SESSION['sheetId']);
var_dump($charName);
var_dump($charGender);
var_dump($charRace);
var_dump($charAge);
var_dump($charHeight);
var_dump($charWeight);
var_dump($charType);
var_dump($charPhysics1);
var_dump($charPhysics2);

    $sqlSheet = "UPDATE `SheetBasicInfo` SET `NAME`='".$charName."', `GENDER`='".$charGender."', `RACE`='".$charRace."', `AGE`='".$charAge."', `HEIGHT`='".$charHeight."', `WEIGHT`='".$charWeight."', `TYPE`='".$charType."', `PHYSICAL`='".$charPhysics1."', `PHYSICAL2`='".$charPhysics2."' WHERE `SHEETiD`='".$_SESSION['sheetId']."';";
    $sheetResult = mysqli_query($mysqli, $sqlSheet);

    $rows_affected = $mysqli->affected_rows;

    if($rows_affected === false)
    {

      $_SESSION['message'] = "Failed to add data Please see below: <br>".mysqli_connect_errno();
      echo $_SESSION['message'];
      // header('Location: '.$newURL);

    }
    else if($rows_affected === -1)
    {

      $_SESSION['message'] = "Unkown error".mysqli_connect_errno();
      echo $_SESSION['message'];
      var_dump($rows_affected);
      var_dump($_SESSION['sheetId']);
      var_dump($avatar);
      var_dump($charName);
      var_dump($forcepwr);
      // header('Location: '.$newURL);

    }
  else{

          $_SESSION['message'] = "Successfully updated values to Database!";
          echo $_SESSION['message'];
          // header('Location: '.$newURL);
          var_dump($rows_affected);
          var_dump($_SESSION['sheetId']);
          var_dump($avatar);
          var_dump($charName);
          var_dump($forcepwr);
    }



// SheetBasicInfo Update
$charShare = json_encode($_POST['sharing'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
if($_POST['permissions'] != null){
$charPermissions = json_encode($_POST['permissions'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}
else{
   $charPermissions = null;
}

    $sqlSheetBasicInfo = "UPDATE `Sheet` SET AVATAR = '".$avatar."', NAME = '".$charName."', FORCEPOWERS = '".$forcepwr."', SHARING = '".$charShare."', PERMISSIONS = '".$charPermissions."' WHERE SHEETiD=".$_SESSION['sheetId'].";";
    $sheetBasicInfoResult = mysqli_query($mysqli, $sqlSheetBasicInfo);

    $rows_affected = $mysqli->affected_rows;

    if($rows_affected === false)
    {

      $_SESSION['message'] = "Failed to add data Please see below: <br>".mysqli_connect_errno();
      echo $_SESSION['message'];
      // header('Location: '.$newURL);

    }
    else if($rows_affected === -1)
    {

      $_SESSION['message'] = "Unkown error".mysqli_connect_errno();
      echo $_SESSION['message'];
      var_dump($rows_affected);
      var_dump($_SESSION['sheetId']);
      var_dump($avatar);
      var_dump($charName);
      var_dump($forcepwr);
      // header('Location: '.$newURL);

    }
  else{

          $_SESSION['message'] = "Successfully updated values to Database!";
          echo $_SESSION['message'];
          // header('Location: '.$newURL);
          var_dump($rows_affected);
          var_dump($_SESSION['sheetId']);
          var_dump($avatar);
          var_dump($charName);
          var_dump($forcepwr);
          var_dump($charPhysics);
    }

// Update Dex Skill

      $_POST['dex-dice'] = json_encode($_POST['dex-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
      $dex = $_POST['dex-dice'];
      $dexSkills = $_POST['dex-skills'];


      $sqlSheetSkillDex = "DELETE FROM `SheetSkillsDex` WHERE SHEETiD=".$_SESSION['sheetId'].";";
      $sheetSkillDexResult = mysqli_query($mysqli, $sqlSheetSkillDex);

      $rows_affected = $mysqli->affected_rows;

      $sqlSheetSkillDex = "INSERT INTO `SheetSkillsDex` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'DEXTERITY', '".$dex."'); ";
      $sheetSkillDexResult = mysqli_query($mysqli, $sqlSheetSkillDex);

      $rows_affected = $mysqli->affected_rows;

      $i = 1;
      while($i <= $dexSkills){

        $_POST['dskill'.$i.''] = json_encode($_POST['dskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $_POST['dskillD'.$i.''] = json_encode($_POST['dskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        $sqlSheetSkillsDex = "INSERT INTO `SheetSkillsDex` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['dskill'.$i.'']."', '".$_POST['dskillD'.$i.'']."'); ";
        $sheetSkillDexResult = mysqli_query($mysqli, $sqlSheetSkillsDex);

        $rows_affected = $mysqli->affected_rows;

        $i++;
      }


      // Update Perc Skill

            $_POST['perc-dice'] = json_encode($_POST['perc-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            $perc = $_POST['perc-dice'];
            $percSkills = $_POST['perc-skills'];


            $sqlSheetSkillPerc = "DELETE FROM `SheetSkillsPerc` WHERE SHEETiD=".$_SESSION['sheetId'].";";
            $sheetSkillPercResult = mysqli_query($mysqli, $sqlSheetSkillPerc);

            $rows_affected = $mysqli->affected_rows;

            $sqlSheetSkillPerc = "INSERT INTO `SheetSkillsPerc` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'PERCEPTION', '".$perc."'); ";
            $sheetSkillPercResult = mysqli_query($mysqli, $sqlSheetSkillPerc);

            $rows_affected = $mysqli->affected_rows;

            $i = 1;
            while($i <= $percSkills){

              $_POST['pskill'.$i.''] = json_encode($_POST['pskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $_POST['pskillD'.$i.''] = json_encode($_POST['pskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

              $sqlSheetSkillsPerc = "INSERT INTO `SheetSkillsPerc` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['pskill'.$i.'']."', '".$_POST['pskillD'.$i.'']."'); ";
              $sheetSkillPercResult = mysqli_query($mysqli, $sqlSheetSkillsPerc);

              $rows_affected = $mysqli->affected_rows;

              $i++;
            }

      // Update Know Skill

            $_POST['know-dice'] = json_encode($_POST['know-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            $know = $_POST['know-dice'];
            $knowSkills = $_POST['know-skills'];


            $sqlSheetSkillKnow = "DELETE FROM `SheetSkillsKnow` WHERE SHEETiD=".$_SESSION['sheetId'].";";
            $sheetSkillKnowResult = mysqli_query($mysqli, $sqlSheetSkillKnow);

            $rows_affected = $mysqli->affected_rows;

            $sqlSheetSkillKnow = "INSERT INTO `SheetSkillsKnow` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'KNOWLEDGE', '".$know."'); ";
            $sheetSkillKnowResult = mysqli_query($mysqli, $sqlSheetSkillKnow);

            $rows_affected = $mysqli->affected_rows;

            $i = 1;
            while($i <= $knowSkills){

              $_POST['kskill'.$i.''] = json_encode($_POST['kskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $_POST['kskillD'.$i.''] = json_encode($_POST['kskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

              $sqlSheetSkillsKnow = "INSERT INTO `SheetSkillsKnow` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['kskill'.$i.'']."', '".$_POST['kskillD'.$i.'']."'); ";
              $sheetSkillKnowResult = mysqli_query($mysqli, $sqlSheetSkillsKnow);

              $rows_affected = $mysqli->affected_rows;

              $i++;
            }

      // Update Str Skill

                  $_POST['str-dice'] = json_encode($_POST['str-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                  $str = $_POST['str-dice'];
                  $strSkills = $_POST['str-skills'];


                  $sqlSheetSkillStr = "DELETE FROM `SheetSkillsStr` WHERE SHEETiD=".$_SESSION['sheetId'].";";
                  $sheetSkillStrResult = mysqli_query($mysqli, $sqlSheetSkillStr);

                  $rows_affected = $mysqli->affected_rows;

                  $sqlSheetSkillStr = "INSERT INTO `SheetSkillsStr` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'STRENGTH', '".$str."'); ";
                  $sheetSkillStrResult = mysqli_query($mysqli, $sqlSheetSkillStr);

                  $rows_affected = $mysqli->affected_rows;

                  $i = 1;
                  while($i <= $strSkills){
                    $_POST['sskill'.$i.''] = json_encode($_POST['sskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                    $_POST['sskillD'.$i.''] = json_encode($_POST['sskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


                    $sqlSheetSkillsStr = "INSERT INTO `SheetSkillsStr` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['sskill'.$i.'']."', '".$_POST['sskillD'.$i.'']."'); ";
                    $sheetSkillStrResult = mysqli_query($mysqli, $sqlSheetSkillsStr);

                    $rows_affected = $mysqli->affected_rows;

                    $i++;
                  }

          // Update Mech Skill

                $_POST['mech-dice'] = json_encode($_POST['mech-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                $mech = $_POST['mech-dice'];
                $mechSkills = $_POST['mech-skills'];


                $sqlSheetSkillMech = "DELETE FROM `SheetSkillsMech` WHERE SHEETiD=".$_SESSION['sheetId'].";";
                $sheetSkillMechResult = mysqli_query($mysqli, $sqlSheetSkillMech);

                $rows_affected = $mysqli->affected_rows;

                $sqlSheetSkillMech = "INSERT INTO `SheetSkillsMech` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'MECHANICAL', '".$mech."'); ";
                $sheetSkillMechResult = mysqli_query($mysqli, $sqlSheetSkillMech);

                $rows_affected = $mysqli->affected_rows;

                $i = 1;
                while($i <= $mechSkills){

                  $_POST['mskill'.$i.''] = json_encode($_POST['mskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                  $_POST['mskillD'.$i.''] = json_encode($_POST['mskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

                    $sqlSheetSkillsMech = "INSERT INTO `SheetSkillsMech` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['mskill'.$i.'']."', '".$_POST['mskillD'.$i.'']."'); ";
                    $sheetSkillMechResult = mysqli_query($mysqli, $sqlSheetSkillsMech);

                    $rows_affected = $mysqli->affected_rows;

                    $i++;
                }


          // Update Tech Skill
                $_POST['tech-dice'] = json_encode($_POST['tech-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                $tech = $_POST['tech-dice'];
                $techSkills = $_POST['tech-skills'];


                $sqlSheetSkillTech = "DELETE FROM `SheetSkillsTech` WHERE SHEETiD=".$_SESSION['sheetId'].";";
                $sheetSkillTechResult = mysqli_query($mysqli, $sqlSheetSkillTech);

                $rows_affected = $mysqli->affected_rows;


                $sqlSheetSkillTech = "INSERT INTO `SheetSkillsTech` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', 'TECHNICAL', '".$tech."'); ";
                $sheetSkillTechResult = mysqli_query($mysqli, $sqlSheetSkillTech);

                $rows_affected = $mysqli->affected_rows;

                $i = 1;
                while($i <= $techSkills){

                  $_POST['tskill'.$i.''] = json_encode($_POST['tskill'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                  $_POST['tskillD'.$i.''] = json_encode($_POST['tskillD'.$i.''] , JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


                  $sqlSheetSkillsTech = "INSERT INTO `SheetSkillsTech` (`SHEETiD`,`SKILL`,`DICES`) VALUES ('".$_SESSION['sheetId']."', '".$_POST['tskill'.$i.'']."', '".$_POST['tskillD'.$i.'']."'); ";
                  $sheetSkillTechResult = mysqli_query($mysqli, $sqlSheetSkillsTech);

                  $rows_affected = $mysqli->affected_rows;

                  $i++;
                }

    // Update Force Skills

                $controlFP = json_encode($_POST['controll-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                $senceFP = json_encode($_POST['sence-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                $alterFP = json_encode($_POST['alter-dice'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


                $sqlSheetSkillForce = "DELETE FROM `SheetSkillsForce` WHERE SHEETiD=".$_SESSION['sheetId'].";";
                $sheetSkillForceResult = mysqli_query($mysqli, $sqlSheetSkillForce);

                $rows_affected = $mysqli->affected_rows;

                $sqlSheetSkillForce = "INSERT INTO `SheetSkillsForce` (`SHEETiD`,`CONTROLd`,`SENCEd`, `ALTERd`) VALUES ('".$_SESSION['sheetId']."', '".$controlFP."', '".$senceFP."', '".$alterFP."'); ";
                $sheetSkillForceResult = mysqli_query($mysqli, $sqlSheetSkillForce);






    //Advantages, Disadvantages, Special Abillities

              $advantages = json_encode($_POST['advantages'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $disadvantages = json_encode($_POST['disadvantages'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $specialAbillities = json_encode($_POST['special-abillities'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

              $sqlSheetSpecialTextareas = "UPDATE `SheetSpecialsTextareas` SET `ADVANTAGES`='".$advantages."',`DISADVANTAGES`='".$disadvantages."', `SPECIALaBILLITIES`='".$specialAbillities."' WHERE `SHEETiD`='".$_SESSION['sheetId']."'";
              $sheetSpecialTextareas = mysqli_query($mysqli, $sqlSheetSpecialTextareas);

    // CharMisc

              $charMove = json_encode($_POST['char-speed'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $charForce = json_encode($_POST['char-force'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $charFp = json_encode($_POST['char-fp'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $charDsp = json_encode($_POST['char-dsp'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $charCp = json_encode($_POST['char-cp'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
              $charCredits = json_encode($_POST['char-credits'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

              $sqlSheetSpecialMisc = "UPDATE `SheetSpecialsMisc` SET `MOVE`='".$charMove."',`FORCIE`='".$charForce."', `FP`='".$charFp."', `DSP`='".$charDsp."', `CP`='".$charCp."', `CREDITS`='".$charCredits."' WHERE `SHEETiD`='".$_SESSION['sheetId']."'; ";
              $sheetSpecialMisc = mysqli_query($mysqli, $sqlSheetSpecialMisc);

    // Char wounds
              $sqlSheetSpecialWounds = "UPDATE `SheetSpecialWounds` SET `STUNNED`='".$_POST['check-stun']."',`WOUNDED`='".$_POST['check-wound']."', `WOUNDEDx2`='".$_POST['check-double-wound']."', `INCAPACITATED`='".$_POST['check-incap']."', `MORTALLY`='".$_POST['check-mortal']."' WHERE `SHEETiD`='".$_SESSION['sheetId']."'; ";
              $sheetSpecialWounds = mysqli_query($mysqli, $sqlSheetSpecialWounds);










    // armor
    $armorType = json_encode($_POST['armor-type'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    $armorAv = json_encode($_POST['armor-av'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    $armorNotes = json_encode($_POST['armor-notes'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


    $sqlSheetArmor = "UPDATE `SheetArmor` SET `TYPE`='".$armorType."',`AV`='".$armorAv."', `NOTES`='".$armorNotes."' WHERE `SHEETiD`='".$_SESSION['sheetId']."'";
    $sheetAmor = mysqli_query($mysqli, $sqlSheetArmor);


    // Update Weapons



          $weaponNo = $_POST['weaponRows'];


          $sqlSheetWeapons = "DELETE FROM `SheetWeapons` WHERE SHEETiD=".$_SESSION['sheetId'].";";
          $sheetWeaponsResult = mysqli_query($mysqli, $sqlSheetWeapons);

          $rows_affected = $mysqli->affected_rows;


          $i = 1;
          while($i <= $weaponNo){

            $weaponType = json_encode($_POST['weaponType'.$i.''], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            $weaponDmg = json_encode($_POST['weaponDmg'.$i.''], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            $weaponRange = json_encode($_POST['weaponRange'.$i.''], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
            $weaponNotes = json_encode($_POST['weapon-notes'.$i.''], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


            $sqlSheetWeapons = "INSERT INTO `SheetWeapons` (`SHEETiD`,`WEAPONnO`,`TYPE`,`MELEE`, `DMG`, `RANGE`, `NOTES`) VALUES ('".$_SESSION['sheetId']."', '".$i."', '".$weaponType."', '".$_POST['melee-weapon'.$i.'']."', '".$weaponDmg."', '".$weaponRange."', '".$weaponNotes."'); ";
            $sheetWeaponsResult = mysqli_query($mysqli, $sqlSheetWeapons);

            $rows_affected = $mysqli->affected_rows;

            // echo "<p><strong>Wepon #".$i."</strong>";
            // var_dump($_SESSION['sheetId']);
            // var_dump($i);
            // var_dump($weaponType);
            // var_dump($_POST['melee-weapon'.$i.'']);
            // var_dump($weaponDmg);
            // var_dump($weaponRange);
            //
            // var_dump($weaponNotes);
            // echo "</p>";

            $i++;
          }

    // Others
        $charEquip = json_encode($_POST['char-equip'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $charBS = json_encode($_POST['char-bs'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $charGoals = json_encode($_POST['char-goals'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $charLang = json_encode($_POST['char-lang'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $charContacts = json_encode($_POST['char-contacts'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);


          $sqlSheetOther = "UPDATE `SheetOther` SET `EQUIPMENT`='".$charEquip."', `PERSONALITY`='".$charBS."', `OBJECTIVES`='".$charGoals."', `LANGUAGES`='".$charLang."', `CONTACTS`='".$charContacts."' WHERE `SHEETiD`='".$_SESSION['sheetId']."';";
          // var_dump($charEquip);
          // var_dump($charBS);
          // var_dump($charGoals);
          // var_dump($charLang);
          // var_dump($charContacts);
          $sheetOther = mysqli_query($mysqli, $sqlSheetOther);

        header('Location: '.$newURL);

 ?>
