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


      header("refresh:5");
  }
  else{
    $_SESSION['message'] = "Couldn't find username or password. Try again. ";


  }


}

if (!$_SESSION['user']) {





?>
      <div id="sign-in" style="display:flex;height:330px;">
        <h1>Sign-in to your sheet</h1>

        <form action="sheet-browser.php" method="POST">
          <input type="text" id="username" name="username" class="border" placeholder="Username"/>
          <input type="password" id="password" name="password" class="border" placeholder="Password"/></br>
          <input type="submit" id="submitBtn" value="Sign in!" />
        </form>
        <a href="sheet-reg.php">Sign up!</a>
        <br />
        <span><?php echo $_SESSION['message'];?></span>
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
<?php

}
else{


      $mysqli =  new mysqli('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
      if(!$mysqli){
        $_SESSION['message'] = "Couldn't conect to db!";
      }

      // $passCheck = "SELECT NAME, AVATAR FROM Sheet WHERE PASSWORD = ".$pass."AND USERNAME = ".$user."";
      // $result = $mysqli->query($passCheck);
      // if(!$result){
      //   $_SESSION['message'] = "Couldn't find username or password. Try again.";
      // }
      // else if($result){
      //   $_SESSION['user'] = $user;
      // }



      if($_SESSION['message']){

      ?>

      <div id="pop-up-msg" style="position:fixed; z-index:7">
        <p>
          <?php echo $_SESSION["message"]; ?>
          <button id="deleteBtn">Close</button>
        </p>
      </div>
    <?php } ?>
      <div id="signed-in" style="display:flex;top:20%;">
        <h1>Welcome <?php echo $_SESSION['user'];?></h1>
        <br/>
        User ID: <?php echo $_SESSION['id']; ?>
        <br />
        <p>
          <h2>Character Sheets</h2>
          <ul>


          <?php

              $mysqli =  mysqli_connect('my142b.sqlserver.se', '207231_im12896', 'VengefulScarsDb', '207231-vengeful-sheet');
              if(mysqli_connect_errno()){
                $_SESSION['message'] = "Couldn't conect to db!";
              }
              $sheetCheck = "SELECT * FROM Sheet WHERE USERiD='".$_SESSION['id']."'";
              $sheetResult = mysqli_query($mysqli, $sheetCheck);

              if(mysqli_num_rows($sheetResult) > 0){


              // print out all sheets
              while($rowSheet = $sheetResult->fetch_assoc()){
                        $avatarUrl = json_decode($rowSheet['AVATAR']);
                        // $avatarUrl = json_encode($rowSheet['AVATAR']);
                        // $avatarUrl = substr($avatarUrl, 1, -1);
                        $rowSheet['NAME'] = substr($rowSheet['NAME'], 1, -1);
                        $sheetName = json_encode($rowSheet['NAME']);
                        $sheetName = substr($sheetName, 1, -1);

                  ?>
                  <li>
                    <div class="thumb">
                      <img class="avatar" src="<?php echo $avatarUrl; ?>" />
                      <strong><?php echo $sheetName; ?></strong>
                      <input type="hidden" value="<?php echo $rowSheet['SHEETiD']; ?>" />

                          <!-- CORS fix -->
                          <script>

                              let imageUrl = "<?php echo $avatarUrl;?>";
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
                    </div>
                  </li>
                  <?php
              }
            }

          ?>
            <li>
              <div class="thumbNew thumb">
                <img src="img/vengefull-chiss.jpg"/>
                <strong>New Sheet</strong>
                <input type="hidden" value="empty sheet" />
              </div>
            </li>
          </ul>
        </p>

      <a href="log-out.php">Log out</a>
      </div>

      <!-- Selecting a sheet -->
      <script>

        $(".thumb").click(function(){

            let sheetId = $(this).find("input").val();
            console.log(sheetId);

            sessionStorage.setItem("sheetId", "89");
            // console.log(sessionStorage.getItem("sheetId"));
            // if new sheet

            if(sheetId == "empty sheet"){


              console.log("Click");
              window.location.href = "create-sheet.php";
            }
            else{

              window.location.href = "sheet-browser-sheet.php?dk="+sheetId;




            }
            // Sending data over GET no need to store files on server.
        });

      </script>

      <!-- close popup -->
      <script>


        $("#pop-up-msg button").click(function(){

          $("#pop-up-msg").css("display", "none");
          sessionStorage.removeItem("message");

        })

      </script>
    </body>
  </html>
      <?php


    }
 ?>
