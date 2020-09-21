<?php
session_start();
$_SESSION['message'] = "";
$mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
if(mysqli_connect_errno()){
  $_SESSION['message'] = "Couldn't conect to db!";
}



$sqlSheetId = "DELETE FROM Sheet WHERE `SHEETiD`='".$_SESSION['sheetId']."'";
    $sqlSheetIdResult = mysqli_query($mysqli, $sqlSheetId);
var_dump($_SESSION['sheetId']);

$sheetId = $_SESSION['sheetId'];

$sql = "DELETE FROM SheetArmor WHERE `SHEETiD`='".$sheetId ."';";
if ($mysqli->query($sql) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql1 = "DELETE FROM SheetBasicInfo WHERE `SHEETiD`='".$sheetId ."';";
if ($mysqli->query($sql1) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql2 = "DELETE FROM SheetOther WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql2) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql3 = "DELETE FROM `SheetSkillsDex` WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql3) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql4 = "DELETE FROM SheetSkillsForce WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql4) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql5 = "DELETE FROM SheetSkillsKnow WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql5) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql6 = "DELETE FROM SheetSkillsMech WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql6) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql7 = "DELETE FROM SheetSkillsPerc WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql7) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql8 = "DELETE FROM SheetSkillsStr WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql8) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql9 = "DELETE FROM SheetSkillsTech WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql9) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql10 = "DELETE FROM SheetSpecialsMisc WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql10) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql11 = "DELETE FROM SheetSpecialsTextareas WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql11) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql12 = "DELETE FROM SheetSpecialWounds WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql12) === TRUE) {
    $_SESSION["message"] = "New sheet successfully deleted!";
} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}
$sql13 = "DELETE FROM SheetWeapons WHERE `SHEETiD`='".$sheetId."';";
if ($mysqli->query($sql13) === TRUE) {
    $_SESSION["message"] = "Sheet successfully deleted!";
    // header('Location: '.$newURL);

} else {
    $_SESSION["message"] = "Error: <br>" . $conn->error;
}





$mysqli->close();

$_SESSION["message"] = "Sheet successfully deleted!";
header('Location: https://vengefulscarsonline.joeyjaydigital.com/sheet-browser.php');

?>