<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Net'Gallery - Galerie</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
  <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
  <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="css/style.css">

  
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
	<h1>Galerie<br> <span>Exposition</span></h1>
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

$sql1 = "SELECT oeu_id, oeu_intit, oeu_desc, oeu_pathimg FROM t_oeuvre_oeu;"; // Sélectionne les informations utiles d'une oeuvre
$result1 = $mysqli->query($sql1);

if ($result1 == false) 
{ 
  echo "Error: La requête a echoué \n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
  exit();
}
else 
{       
  while($oeu = $result1->fetch_assoc())
  {
    if($oeu == 0) 
    {
      echo("Aucune œuvre pour le moment !");
    }
    else 
    {
      $id = $oeu["oeu_id"];
      echo("<div class='gallery-image'>");
      echo("<div class='img-box'>");
      echo("<a href='oeuvre.php?id=".$id."'>" . "<img src='images/".$oeu['oeu_pathimg']."'>" . "</a>"); 
      echo("</div>");
      echo("</div>");
    }
  }
}

$mysqli->close();
?>

</div>
  <footer class="tm-site-footer">
    <p class="mb-0">Copyright 2022 Combot Evan | Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-text-link">TemplateMo</a></p>
  </footer>
</div>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>
