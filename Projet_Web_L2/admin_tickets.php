<?php 
/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */

session_start();

$loginAcc = $_SESSION['login'];
$valAcc = $_SESSION['role'];

if(!isset($loginAcc)) //A COMPLETER pour tester aussi le rôle...
{
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
    header("Location:session.php");
}
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Net'Gallery - Administration</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/admin_ticket.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>

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
                            <a class="nav-b nav-link tm-nav-link" href="admin_accueil.php">Gestion du profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-b nav-link tm-nav-link" href="admin_tickets.php">Gestion des tickets visiteurs</a>
                        </li>                            
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="">Gestion des actualités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="">Gestion des exposants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="">Gestion des oeuvres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tm-nav-link" href="">Gestion de la configuration</a>
                        </li>
                    </ul>                            
                </div>                        
            </nav>
        </div>
    </header>
    <h1 class="title">ESPACE ADMINISTRATION</h1>
    <br>
    <br>
    <br>


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



$sql1="SELECT * FROM t_visiteur_visit LEFT JOIN t_commentaire_com USING(visit_id);"; // Sélectionne les visiteurs associés à leur commentaire si il y en a un
$sql2="SELECT * FROM t_visiteur_visit;"; // Sélectionne les visiteurs


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

    echo("<center>");
    echo("<p class='pfl'>" . "Gestion des tickets visiteurs" ."</p>");
    echo("<center>" . "<hr class='underline'>" . "</center>");
	echo("<table class='table table-bordered'>");
    echo("</center>");
    echo("<br>");
    echo("<br>");
    echo("<br>");   
        echo("<thead>
                <tr>
                    <th class = 'actuTitle'> ID </th>
                    <th class = 'actuTitle'> Nom </th>
                    <th class = 'actuTitle'> Prénom </th>
                    <th class = 'actuTitle'> Email </th>
                    <th class = 'actuTitle'> Commentaire </th>
                    <th class = 'actuTitle'> Etat </th>
                    <th class = 'actuTitle'> Date </th>    
                    <th class = 'actuTitle'> Créé par </th>         
                </tr>
                </thead>
            <tbody>");

	    while($tickets = $result1->fetch_assoc())
	    {
            echo("<td class = 'actuCol'>" . $tickets["visit_id"] . "</td>");

            if(!empty($tickets["visit_nom"])){
                echo("<td class = 'actuCol'>" . $tickets["visit_nom"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
            }

            if(!empty($tickets["visit_prenom"])){
                echo("<td class = 'actuCol'>" . $tickets["visit_prenom"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
            }

            if(!empty($tickets["visit_email"])){
                echo("<td class = 'actuCol'>" . $tickets["visit_email"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
            }

            if(!empty($tickets["com_texte"])){
                echo("<td class = 'actuCol'>" . $tickets["com_texte"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
            }

            if(!empty($tickets["com_texte"])){
                echo("<td class = 'actuCol'>" . $tickets["com_etat"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "C" . "</td>");
            }

            if(!empty($tickets["visit_date"])){
                echo("<td class = 'actuCol'>" . $tickets["visit_date"] . "</td>");
            }
            else{
                echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
            }

            echo("<td class = 'actuCol'>" . $tickets["cpt_pseudo"]);
            echo("</td>");
            echo("</tr>");
	    }
	    echo("</tbody></table>");
        echo("<br>");
        echo("<br>");

        echo("<center>");
        echo("<div>");
        echo("<form action='tickets_actions.php' method='post'>");
            echo("<div class='form-group col-md-4'>");
                echo("<select name='visit' class='custom-select mr-sm-2'>");
                while($visit = $result2->fetch_assoc())
                {
                    echo("<option value='".$visit['visit_id']."'>"."<b>" .$visit['visit_nom']."    ".$visit['visit_prenom']. "</b>"."</option>");
                }
            echo("</select>");
        echo("</div>");

    echo("<br>");
    echo("<br>");   

    echo("<p>" . "<input type='submit' value='Valider'>" . "</p>");
    echo("</form>");

    echo("<br>");
    echo("<br>");
    echo("<br>");

    echo("<center>");
    echo("<p class='pfl'>" . "Génération d'un ticket visiteur" ."</p>");
    echo("<hr class='underline_ticket'>"); 
    echo("</center>");

    echo("<section class='tm-content tm-contact'>            
        <form id='contact-form' action='gen_tickets.php' method='POST' novalidate>
            <div class='form-group mb-4'>
                <input type='password' name='mdp' class='form-control' placeholder='Mot de passe' required='' />
            </div>
            <br>
            <br>
            <center>
            <div>
            <button type='submit' class='btn btn-big btn-primary'>Générer un ticket</button>
            </div>
            </center>
        </form>
    </section>");

    echo("<br>");
    echo("<br>");
    echo("<br>");

    echo("<center>");
        echo("<form action='logout.php' method='post'>");
            echo("<div>");
                echo("<button type='submit' class='btn btn-big btn-primary'>Déconnexion</button>");
            echo("</div>");
        echo("</form>");
    echo("</center>");}
?>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>