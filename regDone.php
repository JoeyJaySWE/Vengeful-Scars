<?php
  session_start();
  $_SESSION['message'] = '';
  $mysqli = new mysqli('my142b.sqlserver.se','207231_ys28235','CJKa3aMht!','207231-vengeful-scars');

  function cryptonite($pass){
    echo $pass;
    $encrypted = "";
    $passLength = strlen($pass);
    echo $passLength;
    for($i = 0; $i < $passLength; $i++){
      echo $i;
    }
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Pass word equals
    if($_POST['userpassword'] == $_POST['userrepassword']){

      $username = $mysqli->real_escape_string($_POST['username']);
      echo $_POST['userpassword'];
      $password = $_POST['userpassword'];
      $mail = $mysqli->real_escape_string($_POST['usermail']);

      $sql = "INSERT INTO 'Users' ('username', 'password', 'email', 'status')"
            . "VALUES ($username, $password, $mail, '1')";

            //If true, redircet and make user.
        if($mysqli->query($sql) == "true"){
        //   $_SESSION['message'] = "Success! Added $username to the database.";
        //   header("location: <file>.php");
        echo "Succes!";
        }
        else{
          echo $mysqli->error;
        }
    }

  }

 ?>