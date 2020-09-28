<?php

    $title = "About";
    $metaImg = "favicon.png";
    $favicon = "img/favicon.png";


    require __DIR__ . "/assets/header.php";
    // require __DIR__ . "/assets/restrict-ip.php";

?>
    <h1>About us</h1>

    <em class="story">
        <p>
            &quot;The empire is forever clutching for power, seeking to gain any advantage they so deem worthy of their efforts,
            mean while the Republic pacifist will never lift a finger without a political squabble to last until they're
            all wiped out. Prime example of this, is the sacking of Courscant. A galaxy in chaos, in twisted conflicts
            and unrest, seeing all this makes me... Rich!
        </p>
            While other people dance to the tune of the Senate and the Emperor... or was it Empress? Doesn't matter!<br>
            Haven't been in long enough to care anyway. While other are stuck in chaos, not knowing what to do,
            me and my crew seizes the opportunities. We emerge from the shadows and take what we want!
            With our Chiss Captain at the helm, our mute quartermaster and somewhat twisted Sawbones,
            they never see us coming until it's too late. We come from all walks of life, taking Vengeance on all
            those who've wronged us... or just have a descent enough hull of booty or rum. My name is Jace, and I'm
            just one of the many psychos you get to meet as we board your shi-
    </em>
        Ouch! What was that for? I was trying to give a cool intro! After all, ain't that what we all signed up for?
        A world of adventures, treasures, unforgettable legendary stories?&quot;

        <p>
            Yes, but the bantha poodo you just wrote? Save that for boarding. My name is Jessi,
            I'm the Sawbone and First Mate of the Vengeful Scars. We're a crew with allegiance to no one but each other.
            Imps, Pubs, they're all fair game to us. We may be in it for ourselves, but we can only do it together.
            When you join our crew, you join our family. All we care about is that you remain loyal to us,
            the captain and your fellow brothers and sisters in the crew, and either can prove your worth onboard the ship, or in a fight. 
            We accept all walks of life, doesn't matter if your Ex-military, a Mando, or some wash-out Xantha player like Jace.
        </p>
        <section class="o-r-u textImg">
            <h2>Who do we think we are?</h2><div class="break"></div>
            <div class="txtWrapper">
                <p>
                    Aye, that'd be a fair question laddie, we are but a crew of hard working people enjoying the freedom that comes with serving no-one but ourselves.
                    Our captain Zalanin takes care of us in battle and makes sure we find some good prices to keep these pleasure cruise of rum and booty going.
                    Our quartermaster Neoplotian Styx takes care of your mental health, while I as a Sawbones take care of your physical one. We may be pirates,
                    but it doesn't mean that we are savages. A loyal merry bunch, unlike the barbarians the Empire and Senate make us out to be. Sure, we board
                    and kill people to get their booty, but that's just our version of going trick or treating.
                </p>
            </div>
            <figure>
                <img src="img/Jessi-Profile.png" alt="Jessi Jay" /><div class="break"></div>
                <figcaption>Jessi Jay - Sawbone & First Mate</figcaption>
            </figure>
        </section>

        
        <section class="achivements textImg">
            <h2>Achievements & Current Goal</h2>
            <figure>
                <img src="img/Zal-cranky.jpg" alt="Zalanin - Captain"/>
                <figcaption>Zalanin - Captain</figcaption>
            </figure>
            <div class="txtWrapper">
                <p>
                    In the Vengeful, our goal as a crew is to present a safe heaven for our family while using others means to do so.
                    Here's a short list of our earlier accomplishments:

                    <ul>
                        <li>Restore a Gage-class cruiser to working order</li>
                        <li>Hunt down and maroon a traitor to the crew</li>
                        <li>Influencing Hutt dealings on Shadaa</li>
                        <li>Fought countless of mystical monstrosities.</li>
                        <li>Gone to war against power grabbing crews</li>
                        <li>Established new base on Rishi</li>
                        <li>Assault on a Imperial Space station in support of an allied crew.</li>
                        <li>Raided countless of Transport ships</li>
                    </ul>

                    On our list of more recent events, we have managed to break out of a computer enforced simulation threatening
                    to keep us for all eternity and we have just build our third base, this time in the midst of the Felucian Jungle.
                    The local fauna is a constant threat as our crew has to fight against both the elements and the nature as well as
                    erecting barricades and protective walls.
                </p>
            </div>
        </section>

<!-- manual adding images -->
<script>
    $("main figure:first-child img:first-child").remove();
    $("main figure:first-child").addClass("herarchyContainer");
    $("main figure:first-child img").css("border", "unset");
    $("<img src='img/Forum/Zalanin.png' alt='Zalanin - Captain' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Jessi-Jay.png' alt='Jessi Jay - Sawbones' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Tal.png' alt='Tal - Engineer' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Seras.png' alt='Seras - Engineer' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Zin.png' alt='Zin - Engineer' />").appendTo("main figure:first-child");
    $("<div class='break'></div>").appendTo("main figure:first-child");
    
    $("<img src='img/Forum/Neo.png' alt='Neo Styx - Quartermaster' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Joya-Maar.png' alt='Joya Maar - Pilot' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Daryn.png' alt='Daryn - Hunter' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Hestia.png' alt='Hestia - Hunter' />").appendTo("main figure:first-child");
    $("<img src='img/Forum/Jace.png' alt='Jace - Deckhand' />").appendTo("main figure:first-child");
</script>
<?php
    
require __DIR__ . "/assets/footer.php";

?>