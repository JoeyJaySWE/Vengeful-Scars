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
    ?>
</script>
<!-- Hoover for anchor -->
<script>

    $('img.anchor').hover(function(){
        $(this).attr("src", "/img/blue-text-glow.png");
    }, function(){
        $(this).attr("src", "/img/blue-text.png");
    })

    


</script>
</body>
</html>