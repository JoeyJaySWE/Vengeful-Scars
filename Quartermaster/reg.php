<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" type="image/png" href="/img/favicon.png"/>
    <meta charset="utf-8">
    <title>New Blood</title>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link href="/style.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
    <div id="wrapper">
      <div id="top">
        <a href=""><img src="logo.png" /></a>
        <nav>
          <li>
            <a>Start</a>
          </li>
          <li>
            <a>News</a>
          </li>
          <li>
            <a>Crew</a>
          </li>
          <li>
            <a>Gallery</a>
          </li>
          <li>
            <a>About</a>
          </li>
          <li>
            <a>Join</a>
            <div id="SignIn">
              <form action="signin.php" method="post">
                <h3>Sign In</h3>
                <input type="text" id="username" />
                <input type="password" id="password" />
                <input type="submit" />
              </form>
              <br/>
              <a>Forgotten Password?</a><br/><br />
              <a>Join the crew!</a>
            </div>
          </li>
          <li>
            <a class="sign-in">Sign in</a>
          </li>
        </nav>
      </div>
      <div id="contentWrapper">

        <h1>Join the Vengeful Scars!</h1>
        <p>
          So, yar thirsti'n for some blood, matey? Are yar dreams filled to the brim with booty and adventures?
          Then skim through the contract and leave you mark in the fields below, we'll make a fierce pirate out of ya yet!
        </p>
        <input type="text" id="userpassword" />
        <span>Try</span>
      </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script>
      var startHero = $("#start-hero");
      $("#start-hero-txt").css("padding-top", startHero.height()/2+"px");
      var imgMargin = parseInt($("#start-hero img").css("left"));
      imgMargin = imgMargin/2
      $("#start-hero-txt").css("left", imgMargin+"px");
      console.log(imgMargin);
      $("#top").css("padding-top","60px");

    </script>
    <script>
    // When the user scrolls the page, execute myFunction
      window.onscroll = function() {myFunction()};

      // Get the navbar
      var stickyStart = document.getElementById("contentWrapper");

      // Get the offset position of the navbar
      var sticky = stickyStart.offsetTop-10;

      var navbar = document.getElementById("top");
      // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function myFunction() {
      if (window.pageYOffset >= sticky) {
        $(navbar).addClass("sticky");
        $(navbar).css("padding-top", "0px");
      } else if(window.pageYOffset < sticky) {
        navbar.classList.remove("sticky");
        $(navbar).css("padding-top", "60px");
      }
      }
    </script>
    <script>

      $(".sign-in").click(function(){
        if($("#SignIn").css("max-height") == "0px"){
          $("#SignIn").css("max-height", "20000px");
          $("#SignIn").css("padding", "25px");
          $("#SignIn").css("border", "3px solid #1c59ca");
          $("#SignIn").css("box-shadow", "-1px 4px 4px 3px rgba(0,0,0,0.2)");
        }
        else{
          $("#SignIn").css("max-height", "0px");
          $("#SignIn").css("padding", "0px");
          $("#SignIn").css("border", "none");
          $("#SignIn").css("box-shadow", "none");
        }

      })


    </script>
    <!-- Security try out -->
    <script>

      $("span").click(function(){
        let cleand = $("#userpassword").val();
        var cryptonite = [""];
        for(var i = 0; i < cleand.length;i++){
          cleand[i] = cleand.charAt(i);
          console.log("Character: "+cleand[i]);
          var test1 = cleand.charCodeAt(i)*3;
          console.log("Multiplied: "+test1);
          test1 = test1.toString(2);
          console.log("Binary: "+test1);
          test1 = test1.split("").reverse().join("");
          console.log("Reverse binary: "+test1);
          cryptonite.push(test1);
        }
        console.log("loop finished: "+cryptonite);
        cryptonite = cryptonite.toString();
        console.log("Data type: "+cryptonite.type);
        cryptonite = cryptonite.replace(",", '');
        console.log("Blended: "+cryptonite);
      })

    </script>
  </body>
</html>