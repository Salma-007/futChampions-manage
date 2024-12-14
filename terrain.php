<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUT CHampions</title>
    <link rel="stylesheet" href="./assets/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body >
    <section class="stade-content">
        <div class="stade">
            <div class="LW style-card-player"></div>
            <div class="LW-name commun-name">LW</div>
            <div class="ST style-card-player"></div>
            <div class="ST-name commun-name">ST</div>
            <div class="RW style-card-player"></div>
            <div class="RW-name commun-name">RW</div>
            <div class="CM1 CM style-card-player"></div>
            <div class="CM1-name commun-name">CM</div>
            <div class="CM2 CM style-card-player"></div>
            <div class="CM2-name commun-name">CM</div>
            <div class="CM3 CM style-card-player"></div>
            <div class="CM3-name commun-name">CM</div>
            <div class="LB style-card-player"></div>
            <div class="LB-name commun-name">LB</div>
            <div class="CB1 CB style-card-player"></div>
            <div class="CB1-name commun-name">CB</div>
            <div class="CB2 CB style-card-player"></div>
            <div class="CB2-name commun-name">CB</div>
            <div class="RB style-card-player"></div>
            <div class="RB-name commun-name">RB</div>
            <div class="GL style-card-player"></div>
            <div class="GK-name commun-name">GK</div>
            </div>   
            </div>
                <!-- pop-up de changement de joueur -->
            <div id="popup-changement" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h3>Choisir un joueur à échanger</h3>
                    <div class="popup-cards">
                        
                    </div>
                </div>
            </div>

        </div>
        <div class="backup-players">
            <div class="card card-player1 changement"></div>
            <div class="card card-player2 changement"></div>
            <div class="card card-player3 changement"></div>
            <div class="card card-player4 changement"></div>
            <div class="card card-player5 changement"></div>
            <div class="card card-player6 changement"></div>
            <div class="card card-player7 changement"></div>
            <div class="card card-player8 changement"></div>
            <div class="card card-player9 changement"></div>
            <div class="card card-player10 changement"></div>
            <div class="card card-player11 changement"></div>
        </div>
    </section>
    

    <script src="./js/script.js"></script>
    

</body>
</html>