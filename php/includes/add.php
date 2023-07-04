<?php
include "./includes/connect.php";
?>
    <div class="page2">
        <div class="container-add">
                <div class="mute">
                    <br><br><br>
                    <br><br><br>
                    <br><br><br>
                </div>
    <div class="formcontainer">
        <form method="post" action="includes/action.php" enctype="multipart/form-data">
        
                <div class="input-name">
                    <label for="inputField" class="borders"> Nom du joueur :  </label>
                    <input type="text" id="inputField" name="name" placeholder="Ajouter votre nom" require>
                </div>
                <div class="input-class">
                    <label for="class" class="borders"> Choisissez votre classe : </label>
                        <select name="inputclass" style="width: 25%;" id="class" class="selectperso">
                            <option value="1">Buccaneer</option>
                            <option value="2">Mage</option>
                            <option value="3">Gunner</option>
                            <option value="4">Cowboy</option>
                            <option value="5">Hazel</option>
                            <option value="6">Cyber</option>
                        </select>
                </div>
                <div class="grid14">
                    <div class="list-users">
                        <select name="users" style="width: 32%;" id="users" class="selectperso">
                        <?php
                        $reponse = $conn->query('SELECT * FROM `User`;');
                        while ($donnees = $reponse->fetch())
                        {
                                echo '<option value="' . $donnees['ID_User'] . '">' . $donnees['Name']  . '</option>'; 
                        }
                        $reponse->closeCursor(); 
                        ?>
                        </select>
                    </div>
                </div>
                <div class ='button1'>
                        <button type="submit" value="add" id="adduser" class="add borders" name="ADD" >Ajouter</button>
                        <button type="submit" value="remove" id="removeuser" class="remove borders" name="REMOVE">Supprimer</button>
                </div>
            </form>
</div>        
            
            <div class="description1 ">
                <div class="list borders" style= "height: 100%; font-size: 30px;" >
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
            <div class="form2"style= "margin-right: 86px;">
                <form method="post" action="includes/action.php" enctype="multipart/form-data">
                    <div class="input-fraction">
                        <label for="inputFaction" class="borders"> Nom de la faction :  </label>
                        <input type="text" id="inputFaction" name="factionpersonalized" placeholder="Ajouter nom de la faction">
                    </div>
                    <div class="gridfaction">
                        <div style="width:280px" class="borderfaction">
                            <div class="factionimg1 text-overlay1 f">
                                <img width="50" id="f1" style="margin-right: 20px;" src="./images/f1.png" alt="faction">
                                <p style="">Les chevaliers de l’aube<br>Buff +5 ATK  et +5 HP</p>
                            </div>
                            <br>
                            <div class="factionimg2 text-overlay2 f">
                                <img width="50" id="f2" style="margin-right: 20px;" src="./images/f2.png" alt="faction">
                                <p style="">Chevaliers des ténébres<br>Buff +8 ATK et +2 HP</p>
                            </div>
                            <br>
                            <div class="factionimg3 text-overlay3 f">
                                <img width="50" id="f3" style="margin-right: 20px;" src="./images/f3.png" alt="faction"> 
                                <p style="">Sentinelles de la lumières<br>Buff +8 HP et + 2 ATK</p> 
                            </div> 
                         </div> 
                   
                           
                    
                    <div class="optionfaction">
                        <select name="inputfaction" id="faction" class="selectperso" style="width: 268px;">
                            <option value="1">Les chevaliers de l’aube</option>
                            <option value="2">Chevaliers des ténébres</option>
                            <option value="3">Sentinelles de la lumières</option>
                        </select>
                    </div>
                    </div>
                    <div class="grid8" style="grid-area: area8;">
                    <div class ='button' style ="margin-top: 113px;">
                        <button type="submit" value="addfaction" name="addfaction" id="addfraction" class="add borders" >Ajouter</button>
                        <button type="submit" value="removefaction" name="removefaction" id="removefraction" class="remove borders">Supprimer</button>
                    </div>
                        
                    </div>
                </form>
            </div>
            
            <div class="grid10">
                <div class="background">
                    <h3>Choix de l'Arène :</h3>
                            <div class="slider">
                                <div class="slider__slides">
                                <div class="slider__slide active">
                                    <img id="bg1" src="./images/castlebridge.png" alt="background castle" />
                                </div>
                                <div class="slider__slide">
                                    <img id="bg2" src="./images/forestbridge.png" alt="background forest" />
                                </div>
                                <div class="slider__slide">
                                    <img id="bg3" src="./images/skybridge.png"alt="background sky"  />
                                </div>
                                </div>
                                <div id="nav-button--prev" class="slider__nav-button"></div>
                                <div id="nav-button--next" class="slider__nav-button"></div>
                                <div class="slider__nav">
                                <div class="slider__navlink active"></div>
                                <div class="slider__navlink"></div>
                                <div class="slider__navlink"></div>
                                </div>
                            </div>
                            

                </div>
            </div>
            <div class="grid11">
                <a href="index.php?select">
                <img class="nextpage" id="next" src="./images/nextpage.png" alt="next">
                </a>
            </div>
            <div class="grid13">
                
                <a href="http://localhost:8000/">
                <img class="previouspage" id="previous" src="./images/previouspage.png" alt="previous">
                </a>
            </div>
            
    
           
        </div>
        <script>
            

//choix slide
let slides = document.getElementsByClassName("slider__slide");
let navlinks = document.getElementsByClassName("slider__navlink");
let currentSlide = 0;

document.getElementById("nav-button--next").addEventListener("click", () => {
  changeSlide(currentSlide + 1);
});

document.getElementById("nav-button--prev").addEventListener("click", () => {
  changeSlide(currentSlide - 1);
});

function changeSlide(moveTo) {
  if (moveTo >= slides.length) {
    moveTo = 0;
  }
  if (moveTo < 0) {
    moveTo = slides.length - 1;
  }

  slides[currentSlide].classList.toggle("active");
  navlinks[currentSlide].classList.toggle("active");
  slides[moveTo].classList.toggle("active");
  navlinks[moveTo].classList.toggle("active");

  currentSlide = moveTo;

  changeBackground(slides[currentSlide]);
}

function changeBackground(slide) {
  let imageUrl = slide.querySelector("img").src;
  //document.getElementById("game").style.backgroundImage = `url('${imageUrl}')`;

  // Stocker le choix de background dans le stockage local
  localStorage.setItem('backgroundChoice', imageUrl);
}

document.querySelectorAll('.slider__navlink').forEach((bullet, bulletIndex) => {
  bullet.addEventListener('click', () => {
    if (currentSlide !== bulletIndex) {
      changeSlide(bulletIndex);
    }
  });
});




        </script>
        
        
        </div>
