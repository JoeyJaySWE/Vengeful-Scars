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
            let newWidth = $(".textImg figure:eq("+i+") img").width();
            console.log("new width: "+newWidth);
            $(".textImg figure:eq("+i+")").css("max-width", newWidth+"px");

            }
         


        }

    })

</script>
</body>
</html>