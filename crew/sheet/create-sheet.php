<?php
session_start();
$_SESSION['message'] = "";
$mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
if(mysqli_connect_errno()){
  $_SESSION['message'] = "Couldn't conect to db!";
}

$sheetCheck = "SELECT * FROM Sheet WHERE USERiD='".$_SESSION['id']."' AND NAME='Empty Sheet'";
$sheetResult = mysqli_query($mysqli, $sheetCheck);

$rows_affected = $mysqli->affected_rows;

if(mysqli_num_rows($sheetResult) > 0){
  $newURL = "https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php";
  $_SESSION['message'] = "You already got an Empty Sheet. Rename it first.";
  header('Location: '.$newURL);

}
else{
  echo "No sheet with matching user";
  $uid = $_SESSION['id'];
  $avatar = "https://cdn.discordapp.com/attachments/488482156704825348/616677351442350116/vengefull-chiss.jpg";
  $avatar  = json_encode($avatar, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
  $sheetName = "Empty Sheet";
  $sheetName  = json_encode($sheetName, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
  $date = date("Y-m-d-h-i");

  var_dump($_SESSION['id']);
  var_dump($avatar);
  var_dump($sheetName);
  var_dump($date);


// Prepare Secure DB entries
 $sqlNewSheet = "INSERT INTO `Sheet`(`USERiD`, `AVATAR`, `NAME`, `CREATED`) VALUES ('".$uid."', '".$avatar."', '".$sheetName."', '".$date."');";
   $newSheetResult = mysqli_query($mysqli, $sqlNewSheet);



}

$sqlSheetId = "SELECT * FROM Sheet WHERE `NAME`='Empty Sheet' AND `USERiD`='".$uid."' LIMIT 1";
    $sqlSheetIdResult = mysqli_query($mysqli, $sqlSheetId);

if(mysqli_num_rows($sqlSheetIdResult) > 0){

  while($rowSheetId = $sqlSheetIdResult->fetch_assoc()){

        $sheetId = $rowSheetId['SHEETiD'];

  }


}

$sql = "INSERT INTO SheetArmor (`SHEETiD`) VALUES ('".$sheetId ."');";
if ($mysqli->query($sql) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql1 = "INSERT INTO SheetBasicInfo (`SHEETiD`,`GENDER`,`NAME`) VALUES ('".$sheetId ."', '', '".$sheetName."');";
if ($mysqli->query($sql1) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql2 = "INSERT INTO SheetOther (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql2) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql3 = "INSERT INTO SheetSkillsDex (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql3) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql4 = "INSERT INTO SheetSkillsForce (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql4) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql5 = "INSERT INTO SheetSkillsKnow (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql5) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql6 = "INSERT INTO SheetSkillsMech (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql6) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql7 = "INSERT INTO SheetSkillsPerc (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql7) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql8 = "INSERT INTO SheetSkillsStr (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql8) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql9 = "INSERT INTO SheetSkillsTech (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql9) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql10 = "INSERT INTO SheetSpecialsMisc (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql10) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql11 = "INSERT INTO SheetSpecialsTextareas (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql11) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql12 = "INSERT INTO SheetSpecialWounds (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql12) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql13 = "INSERT INTO SheetWeapons (`SHEETiD`) VALUES ('".$sheetId."');";
if ($mysqli->query($sql13) === TRUE) {
    $_SESSION["message"] = "New sheet successfully created!";
    header('Location: '.$newURL);

} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}





$mysqli->close();

$_SESSION["message"] = "New sheet successfully created!";


header('Location: https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php');

?>