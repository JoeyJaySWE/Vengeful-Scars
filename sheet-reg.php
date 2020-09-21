<?php
  session_start();
  $_SESSION['message'] = '';

  $mysqli =  new mysqli('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
  if(!$mysqli){
    $_SESSION['message'] = "Couldn't conect to db!";
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST['mail']);
    // Matching passowrds
    if($_POST['password'] == $_POST['repassword']){
      $user = $mysqli->real_escape_string($_POST['user']);
      $passwordd = $mysqli->real_escape_string($_POST['password']);
      $mail = $mysqli->real_escape_string($_POST['mail']);
      $passwordd = $passwordd."sqrd";
      $password = md5($passwordd);

      $_SESSION['user'] = $user;
      $sql = "INSERT INTO Users (USER, PASSWORD, MAIL) VALUES ('$user','$password','$mail')";

      // if successfull redirect
      if($mysqli->query($sql) === true){
        $_SESSION['message'] = "Registration successful added $user to the datatbase!";
        header("location: sheet-browser.php");
      }
      else{
        $_SESSION['message'] = "User could not be added to the database!<br/>".$mysqli->error;
      }
    }
    else{
      $_SESSION['message'] = "Password missmatch!";
    }
  }
?>
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
    <style>
        ::-moz-placeholder{
          color: lightgrey;
          opacity:0.5;
        }
        ::-webkit-input-placeholder{
          color: lightgrey;
          opacity:0.5;
        }
        :-ms-input-placeholder{
          color: lightgrey;
          opacity:0.5;
        }
        :-moz-placeholder{
          color: lightgrey;
          opacity:0.5;
        }
    </style>
    <!-- <style id="color">
      input, textarea, select{
          color: #00c7f8;
      }
    </style> -->
    <div id="wrapper">
      <div id="sign-in" style="display:flex;top:20%;left:35%;">
        <h1>Sign-in to your sheet</h1>
        <form action="sheet-reg.php" method="POST">
          <div>
            <?= $_SESSION['message'] ?>
          </div>
          <input type="text" name="user" id="username" class="border" placeholder="Username" required/>
          <input type="password" name="password" id="password" class="border" placeholder="password" required/>
          <input type="password" name="repassword" id="repassword" class="border" placeholder="repassword" required/>
          <input type="email" name="mail" id="mail" class="border" placeholder="mail@domain.com" required/>
          <p>
            By signing up I hearby agree to <a href="rules.php" target="_blank">Terms and Conditions</a> of my information
            and other rules relating to the use of this Guild site.
          </p>
          <input type="submit" id="submitBtn" value="Sign up!" />
        </form>

      </div>
    </div>

<!--
    Change colors script
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
    <!-- Add weapon -->
    <script>

      $("#add-weapon").click(function(){
        console.log("Click");
        let newWeapon =  "<div class='weapon'><span><strong>Type</strong><strong>Dmg.</strong><strong>Range: S/M/L</strong></span><span><input type='text' placeholder='Xantha'/><input type='text' placeholder='STR + 2D'/><input type='text' placeholder='melee'/></span><span style='justify-content:flex-start;align-items:baseline;'><strong>Ammo:</strong><input type='number' placeholder='25'></span></div>";

        $("#add-weapon").before(newWeapon);
        console.log("Added");
      })
    </script>
    <script>
    $('#char-physics').keypress(function(e) {
      var tval = $('#char-physics').val(),
          tlength = tval.length,
          set = 27,
          remain = parseInt(set - tlength);

      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
          $("#char-physics2").focus();

          // $('#char-physics').val((tval).substring(0, tlength - 1));
          // return false;
        }
      })

      // Allow to erase like normal
      $("#char-physics2").keydown(function(e){

        if(e.keyCode == 8 && !$("#char-physics2").val()){
          $("#char-physics").focus();
        }
      })

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
  </body>
</html>
