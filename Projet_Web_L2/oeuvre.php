<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Net'Gallery - Oeuvre</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
  <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
  <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="css/oeuvre.css">

  
</head>

<body>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>


<header>
	<div class="nav_bar">
		<nav class="navbar navbar-expand-lg" id="tm-main-nav">
			<button class="navbar-toggler toggler-example mr-0 ml-auto" type="button" 
				data-toggle="collapse" data-target="#navbar-nav" 
				aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span><i class="fas fa-bars"></i></span>
			</button>
			<div class="collapse navbar-collapse tm-nav" id="navbar-nav">
				<ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-b nav-link tm-nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-b nav-link tm-nav-link" href="galerie.php">Galerie</a>
                    </li>                            
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="livredor.php">Livre d'or</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tm-nav-link" href="session.php">Gestion</a>
                    </li>
				</ul>                            
			</div>                        
		</nav>
	</div>
	<h1>Oeuvres<br> <span>Exposition</span></h1>
</header>

<?php

    $mysqli = new mysqli('*******','*******','*******','*******');
if ($mysqli->connect_errno)
{
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit();
}

if (!$mysqli->set_charset("utf8")) {
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
}



if(isset($_GET['id'])){
    $oeuvre_id = $_GET['id'];
}
else {
    echo ("Vous avez oublié le paramètre !");
    exit();
}

$sql1="SELECT * FROM t_oeuvre_oeu JOIN t_expose_exp USING(oeu_id) JOIN t_exposant_expo USING(expo_id) WHERE oeu_id = '" .$oeuvre_id. "';"; // Permet d'afficher les informations utiles de l'oeuvre d'id = id
$sql2="SELECT * FROM t_exposant_expo JOIN t_expose_exp USING(expo_id) WHERE oeu_id = '" .$oeuvre_id. "';"; // Permet d'afficher 1 ou plusieurs exposants 

$result1 = $mysqli->query($sql1);
$result2 = $mysqli->query($sql2);

if ($result1 == false) 
{ 
	echo "Error: La requête a echoué \n";
	echo "Errno: " . $mysqli->errno . "\n";
	echo "Error: " . $mysqli->error . "\n";
	exit();
}
else 
{
	$oeu_id = $result1->fetch_assoc();

	echo("<p class='oeu_title'>" ."Intitulé de l'oeuvre". "</p>");
    echo("<center>"."<hr>"."</center>");
    echo("<br>");
    echo("<p class='oeu_intit'>" . "<b>" .$oeu_id['oeu_intit'] . "</b>" . "</p>");


	echo("<img class='oeu_img' width='500' height='500' src='images/".$oeu_id['oeu_pathimg']."'/>");  
	echo("<br>");
	echo("<br>");  
	echo("<br>");    

	echo("<p class='oeu_desct'>" . "Description" . "</p>");
    echo("<center>"."<hr>"."</center>");
	echo("<br>");  
	echo("<p class='oeu_desc'>" . $oeu_id['oeu_desc'] . "</p>");
	echo("<br>"); 

	echo("<p class='oeu_desct'>" . "Réalisé le" . "</p>");
    echo("<center>"."<hr>"."</center>");
    echo("<br>");
	echo("<p class='oeu_crea'>" . $oeu_id['oeu_datecrea'] . "</p>"); 
	echo("<br>");

	echo("<p class='oeu_desct'>" . "Exposant(s)" . "</p>");
    echo("<center>"."<hr>"."</center>");
    echo("<br>");

    while($col = $result2->fetch_assoc())
    {
        echo("<p class='oeu_expo'>" . $col['expo_prenom'] . "    " . $col['expo_nom'] ."</p>");    
        echo("<br>");
    }                                                               
}

$mysqli->close();
?> 

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>
