<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=' crossorigin='anonymous'></script>
    <title>Shares Calculator</title>
</head>
<body>
    <div id="wrapper">
        <section id="groupShares">
            <h1>Booty Calculator</h1>

            <p class="subHeading">Let's see how fortunate you were, you magget!</p>

            <strong>Booty haull</strong>
            <br>
            <input type="number" id="booty">
            <br>
            <strong>Shares to the Ship</strong>
            <br>
            <input type="number" id="bootyShip" placeholder="8">
            <br>
            <strong>Shares to the Captain</strong>
            <br>
            <input type="number" id="sharesCaptain" placeholder="2">
            <br>
            <strong>Shares to the QM</strong>
            <br>
            <input type="number" id="sharesQm" placeholder="2">
            <br>
            <strong>No. of Officers</strong>
            <br>
            <input type="number" id="bootyOfficers" placeholder="2">
            <br>
            <strong>No. of Pirates</strong>
            <br>
            <input type="number" id="bootyPirates" placeholder="8">
            <br>
            <strong>No. of New Bloods & None-combatants</strong>
            <br>
            <input type="number" id="bootyNewBloods" placeholder="4">
            <p><button id="calculate">Get shares!</button></p>
            
        </section>
        <section id="sharesDistributed">
            <h2>Results</h2>
            <strong>Ship: <span id="shipResult"></span></strong>
            <strong>Captain: <span id="captainResult"></span></strong>
            <strong>Quartermaster: <span id="qmResult"></span></strong>
            <strong>Officers: <span id="officersResult"></span></strong>
            <strong>Pirates: <span id="piratesResult"></span></strong>
            <strong>New Bloods: <span id="newBloodsResult"></span></strong>
            <strong>Total: <span id="totalResult"></span></strong>
            <select name="settings" id="settings" disabled>
                <option value="single">Crew view</option>
                <option value="group">Department view</option>
            </select>
            
        </section>
    </div>
    <script>

        $("#calculate").click(function(){
            $("#settings").val("single");
            let booty = $("#booty").val();
            console.log("Total booty: "+booty);

            $("#settings").removeAttr("disabled");

            // default shares
            let ship = 8;
            let captain = 2;
            let qm = 2;
            let officers = 1.5;
            let pirates = 1;
            let newBloods = 0.5;

            // default members (cap, ship and Qm is only 1)
            let noOfficers = 2;
            let noPirates = 8;
            let noNewBloods = 4; //Corra, Coran, Sussen, New guy


            let totalShares = 
            ship+captain+qm+officers*noOfficers+pirates*noPirates+newBloods*noNewBloods;

            let splitBooty = booty/totalShares;
            console.log(splitBooty);

            let noChanged = false;

            if($("#bootyShip").val()){
                console.log("bootyShip is not null!");
                console.log("test: "+$("#bootyShip").val());
                ship = $("#bootyShip").val();
                ship = parseInt(ship);
                noChanged = true;
            }
            console.log("Ships number of shares: "+ship+"");

            let shipBooty = ship*splitBooty;
            console.log("Ships Booty: "+shipBooty);
            $("#shipResult").text(shipBooty);

            if($("#sharesCaptain").val()){
                captain = $("#sharesCaptain").val();
                captain = parseInt(captain);
                noChanged = true;
            }
            console.log("Captains number of shares: "+captain);

            let captainBooty = captain*splitBooty;
            console.log("Captains Booty: "+captainBooty);
            $("#captainResult").text(captainBooty);

            if($("#sharesQm").val()){
                qm = $("#sharesQm").val();
                qm = parseInt(qm);
                noChanged = true;
            }
            console.log("QMs number of shares: "+qm);

            let qmBooty = qm*splitBooty;
            console.log("QMs Booty: "+qmBooty);
            $("#qmResult").text(qmBooty);

            if($("#bootyOfficers").val()){
                noOfficers= $("#bootyOfficers").val();
                noOfficers = parseInt(noOfficers);
                noChanged = true;
            }
            console.log("Number of officers: "+noOfficers);

            let officersBooty = officers*splitBooty;
            console.log("Officers Booty: "+officersBooty);
            $("#officersResult").text(officersBooty);
            console.log("Officers combined Booty: "+officersBooty*noOfficers);

            if($("#bootyPirates").val()){
                noPirates= $("#bootyPirates").val();
                noPirates = parseInt(noPirates);
                noChanged = true;
            }
            console.log("Number of Pirates: "+noPirates);

            let piratesBooty = pirates*splitBooty;
            console.log("Pirates Booty: "+piratesBooty);
            $("#piratesResult").text(piratesBooty);
            console.log("Pirates combined Booty: "+piratesBooty*noPirates);


            if($("#bootyNewBloods").val()){
                noNewBloods= $("#bootyNewBloods").val();
                noNewBloods = parseInt(noNewBloods);
                noChanged = true;
            }
            console.log("Number of New Bloods: "+noNewBloods);

            let newBloodsBooty = newBloods*splitBooty;
            console.log("New Bloods Booty: "+newBloodsBooty);
            $("#newBloodsResult").text(newBloodsBooty);
            console.log("New Bloods combined Booty: "+newBloodsBooty*noNewBloods);

            if(noChanged == true){
                totalShares = 
                ship+
                captain+
                qm+
                officers*
                noOfficers+
                pirates*
                noPirates+
                newBloods*
                noNewBloods;

                splitBooty = booty/totalShares; 

                shipBooty = Math.round(ship*splitBooty);
            
                $("#shipResult").text(shipBooty);
                captainBooty = Math.round(captain*splitBooty);
                $("#captainResult").text(captainBooty);
                qmBooty = Math.round(qm*splitBooty);
                $("#qmResult").text(qmBooty);
                officersBooty = Math.round(officers*splitBooty);
                $("#officersResult").text(officersBooty);
                piratesBooty = Math.round(pirates*splitBooty);
                $("#piratesResult").text(piratesBooty);
                newBloodsBooty = Math.round(newBloods*splitBooty);
                $("#newBloodsResult").text(newBloodsBooty);


            }
                       

            let totalSplit =
             parseInt(shipBooty)+
             parseInt(captainBooty)+
             parseInt(qmBooty)+
             parseInt(officersBooty)+
             parseInt(piratesBooty)+
             parseInt(newBloodsBooty);
             console.log("Data of ship is: "+$.type(ship));
            $("#totalResult").text(totalSplit);




            console.log("Total number of shares: "+totalShares);

            $("#settings").change(function(){
            console.log($("#settings option:selected").val());
            if($("#settings option:selected").val() != "single"){
                
                $("#officersResult").text(officersBooty*noOfficers);
                $("#piratesResult").text(piratesBooty*noPirates);
                $("#newBloodsResult").text(newBloodsBooty*noNewBloods);
                $("#totalResult").text(totalShares*splitBooty);








            }
            else{
                $("#officersResult").text(officersBooty);
                $("#piratesResult").text(piratesBooty);
                $("#newBloodsResult").text(newBloodsBooty);
                $("#totalResult").text(totalSplit);
            }
        })

        })
        
    </script>
    
</body>
</html>