</main>
</div>
<!-- make current page marked in bold on the menu -->
<script>
    <?php
        if($title == "Vengeful Scars"){
            ?>

            $("nav li:nth-child(2)").css({'font-weight' : 'bold',
                                        'border-bottom' : '2px solid'});

            <?php
        }
        else if($title == "About"){
            ?>

            $("nav li:nth-child(3)").css({'font-weight' : 'bold',
                                        'border-bottom' : '2px solid'});

            <?php
        }
        else if($title == "Story"){
            ?>

            $("nav li:nth-child(4)").css({'font-weight' : 'bold',
                                        'border-bottom' : '2px solid'});

            <?php
        }

    ?>
</script>
<!-- Hoover for anchor -->
<script>

    $('img.anchor').hover(function(){
        $(this).attr("src", "/img/blue-text-glow.png");
    }, function(){
        $(this).attr("src", "/img/blue-text.png");
    });
    
</script>
<!-- scale image in acordance with text mass -->
<script>

    let amount = $(".textImg p").length;

    console.log("There are "+ amount +" elemnts on this page.");
    $(document).ready(function(){

        --amount;
        for(let i=0;i<amount; i++){
            
            let newHeight = $(".textImg .txtWrapper:eq("+i+")").innerHeight();
            newHeight -= 124;
            if(newHeight < 325){
                console.log("test value: "+newHeight);
            $(".textImg figure:eq("+i+") img").css("max-height", newHeight+"px");
            $(document).ready(function(){
                let newWidth = $(".textImg figure:eq("+i+") img").width();
                console.log("new width: "+newWidth);
                $(".textImg figure:eq("+i+")").css("max-width", newWidth+"px");

            })

            }
         


        }

    })

</script>
 <!-- smooth scroll (local) -->
<script>
      $(document).ready(function(){
        // Add smooth scrolling to all links
        $("nav a").on('click', function(event) {

          // Make sure this.hash has a value before overriding default behavior
          if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
              scrollTop: $(hash).offset().top-1100
            }, 800, function(){

              // Add hash (#) to URL when done scrolling (default click behavior)

              window.history.pushState(null, null, hash);
            });
          } // End if
        });
      });
</script>
</body>
</html>