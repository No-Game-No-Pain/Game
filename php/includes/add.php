<html>
	<head>
		<title>Add player and class</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./CSS/add.css" />
        
        
        </head>
	<body>

    <body class="page1">
        <div class="container">
            <header>
                <br>
            </header>
            <div class="row justify-content-center">
                <div class="col-md-6 mt-3">
                    <form>
                    <div class="form-group row">
                        <label for="inputname" class="col-sm-4 col-form-label border text-center">Nom du joueur :</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputname" placeholder="Ajouter votre nom">
                    </div>
                    </div>
                    <div class="dropdown ">
                    <label for="dropdownMenu2" class="col-sm-4 col-form-label border text-center">Choisissez votre classe :</label>
                    <button class="btn btn-primary dropdown-toggle dropd offset-md-1" type="button" id="dropdownMenu2" data-mdb-toggle="dropdown" aria-expanded="false">
                     Choix de Carectere
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><button class="dropdown-item" type="button">Mage</button></li>
                        <li><button class="dropdown-item" type="button">Gunner</button></li>
                        <li><button class="dropdown-item" type="button">Cowboy</button></li>
                        <li><button class="dropdown-item" type="button">Hazel</button></li>
                        <li><button class="dropdown-item" type="button">Cyber</button></li>
                        </ul>
                        </div>
                        <br><br>
                        <div class ='mt-3 offset-6 mar'>
                        <button type="button" class="btn btn-primary button-color" >Ajouter</button>
                        <button type="button" class="btn btn-primary button-color">Supprimer</button>
                        </div>

                    </form>



                </div>
                <div class="col-md-6">



                </div>

            </div>
        </div>



       
<script>
 $(document).ready(function(){
  $(".dropdown-toggle").dropdown();
});
</script>

    </body>
</html>