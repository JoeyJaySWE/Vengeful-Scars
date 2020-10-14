<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" type="image/png" href="img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link href="sheet-style.css" type="text/css" rel="stylesheet"/>
    <meta charset="utf-8">
    <title>Sheet Reader</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="google-signin-client_id" content="126135015836-6nk8hv2jp0a5ae7ub4khtkdlv4qbnvjh.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

  </head>
  <body>
    <style id="color">
      ::placeholder{
        opacity: 0.7;
      }
    </style>
    <div id="wrapper">

<?php
session_start();

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
    $_SESSION['admin'] = $row['ADMIN'];

      if($_SESSION['admin'] == 0){
        header("Location: http://crew.vengefulscars.com/sheet-broswer.php");
      }
      header('Location: http://vengefulscars.com/');
  }
  else{
    $_SESSION['message'] = "Couldn't find username or password. Try again. ";


  }


}


if($_SESSION['admin'] != null){
  
  if($_SESSION['admin'] == 0){
    header("Location: http://vengefulscars.com/crew/sheet/sheet-broswer.php");
  }
  header('Location: http://vengefulscars.com/crew/index.php');

}




?>
      <div id="sign-in" style="display:flex;height:330px;">
        <h1>Sign-in to your sheet</h1>

        <form action="crew.php" method="POST">
          <input type="text" id="username" name="username" class="border" placeholder="Username"/>
          <input type="password" id="password" name="password" class="border" placeholder="Password"/></br>
          <input type="submit" id="submitBtn" value="Sign in!" />
        </form>
        <br />
        <span><?php if($_SERVER['REQUEST_METHOD'] == 'POST'){echo $_SESSION['message'];}?></span>
      </div>
    </div>
  </body>
</html>
<?php



 ?>
