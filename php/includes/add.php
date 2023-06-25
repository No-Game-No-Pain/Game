<!DOCTYPE html>
    
	    <head>
		    <title>Add player and class</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <link rel="stylesheet" type="text/css" href="./CSS/add.css" />
        </head>
    <body class="page1">
        <div class="container-add">
            <div class="mute">
             <img src="./images/mute.jpg" alt="mute">
                </div>
            <div class="input-name">
                <form method="post" action="/index.php" enctype="multipart/form-data">
            
                <label for="inputField" class="borders"> Nom du joueur :  </label>
                 <input type="text" id="inputField" name="name" placeholder="Ajouter votre nom">



            </div>
            <div class="input-class">
                <label for="inputclass" class="borders"> Choisissez votre classe :  </label>
                <select name="inputclass" id="class" class="selectperso">
                    <option value="Mage">Mage</option>
                    <option value="Gunner">Gunner</option>
                    <option value="Cowboy">Cowboy</option>
                    <option value="Hazel">Hazel</option>
                    <option value="Cyber">Cyber</option>
                </select>
            </div>
            <div class ='button1'>
                        <button type="submit" class="add borders" >Ajouter</button>
                        <button type="submit" class="remove borders">Supprimer</button>
                        </div>
            </form>
            <div class="description1 ">
                <div class="list borders">
                    <h3>Liste des classes : </h3>
                        <ul>
                            <li>Buccaneer : 75 HP / 55 ATK</li>
                            <li>Mage : 80 HP / 60 ATK</li>
                            <li>Gunner : 50 HP / 100 ATK</li>
                            <li>Cowboy : 70 HP / 60 ATK</li>
                            <li>Hazel : 100 HP / 45 ATK</li>
                            <li>Cyber : 150 HP / 30 ATK</li>

                        </ul>
                        <p style="font-size: 10px;font-weight: 100;font-family: initial;">Chaque lvl up donne +10 HP et + 5 ATK</p>
                </div>
            </div>
            
            <div class="input-fraction">
                <form method="post" action="/index.php" enctype="multipart/form-data">
            
                <label for="inputFaction" class="borders">  Nom de la faction :  </label>
                <input type="text" id="inputFaction" name="faction" placeholder="Ajouter nom de la faction">
            </div>
            <div class="gridfaction">
                <div class="borderfaction">
                    <div class="factionimg factionimg1">
                        <img id="f1" style="width: 45px;margin-left: -30px;" src="./images/f1.png" alt="faction">
                        <div class="text-overlay text-overlay1">
                        <p>Les chevaliers de l’aube<br>Buff +5 ATK  et +5 HP</p>
                        </div>
                    </div>  
                    <div class="factionimg factionimg2">
                        <img id="f2"style="width: 45px;margin-left: -30px;" src="./images/f2.png" alt="faction">
                        <div class="text-overlay text-overlay2">
                        <p>Chevaliers des ténébres<br>Buff +8 ATK et +2 HP</p>
                        </div>
                    </div>  
                    <div class="factionimg factionimg3">
                        <img id="f3"style="width: 45px;margin-left: -30px;" src="./images/f3.png" alt="faction">
                        <div class="text-overlay text-overlay3">
                        <p>Sentinelles de la lumières<br>Buff +8 HP et + 2 ATK</p>
                        </div>
                    </div>
                </div>  
                
                
            </div>
          
            <div class="grid8" style="grid-area: area8;">
                <div class="optionfaction">
                    <select name="inputclass" id="faction" class="">
                    <option value="Les chevaliers de l’aube">Les chevaliers de l’aube</option>
                    <option value="Chevaliers des ténébres">Chevaliers des ténébres</option>
                    <option value="Sentinelles de la lumières">Sentinelles de la lumières</option>
                    </select>
                </div>

            </div>
            
            <div class="grid10">
                <div class="background">
                    <h3>Choix de l'Arène :</h3>
                    <img class="bg"src="./images/castle bridge.png" alt="background">

                </div>
            </div>
    
           
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
                $(document).ready(function(){
                $('.carousel').click({
                slidesToShow: 3,
                dots:true,
                centerMode: true,
                });
                });
        </script>
        
    </body>
   
    </html>
