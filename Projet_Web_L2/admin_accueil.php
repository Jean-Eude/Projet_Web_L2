<?php 
/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */

session_start();

$loginAcc = $_SESSION['login'];
$valAcc = $_SESSION['role'];

if(!isset($loginAcc)) 
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
    <link href="css/admin_acceuil.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>

<html>
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

<?php
/* Code PHP permettant de souhaiter la bienvenue à l’utilisateur connecté et
d’afficher le détail de son profil. */

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


$sql1="SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo) WHERE cpt_pseudo = '".$_SESSION['login']."';"; // //Sélectionne les comptes qui ont un profil associé avec le pseudo de l'administrateur ou du modérateur
$sql2="SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo);"; //Sélectionne les comptes qui ont un profil associé
$sql3="SELECT count(*) as nbAcc FROM t_compte_cpt;"; // Permet de voir le nombre total de comptes
$sql4="SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo);"; //Sélectionne les comptes qui ont un profil associé


$result1 = $mysqli->query($sql1);
$result2 = $mysqli->query($sql2);
$result3 = $mysqli->query($sql3);
$result4 = $mysqli->query($sql4);


if ($result1 == false) 
{ 
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit();
}
else 
{
    $adm_id = $result1->fetch_assoc();
    $nbacc = $result3->fetch_assoc();


    if($valAcc == 'A')
    {
        echo("<br>");
        echo("<p class='textundertitle'>" .  "Bonjour administrateur   :   "  . $adm_id['pfl_prenom'] . "    " . $adm_id['pfl_nom'] . "</p>");
        echo("<br>");
        echo("<center>");
        echo("<p class='pfl'>" . "Gestion du profil" ."</p>");
        echo("<center>" . "<hr class='underline'>" . "</center>");
        echo("<br>");
        echo("<br>");
        echo("<p>" . "Pseudo:" . "  " . $adm_id["cpt_pseudo"] . "</p>");  
        echo("<br>");   
        echo("<p>" . "Nom:" . "  " . $adm_id["pfl_nom"] . "</p>");
        echo("<br>");
        echo("<p>" . "Prénom:" . "  " . $adm_id["pfl_prenom"] . "</p>");    
        echo("<br>");
        echo("<p>" . "Email:" . "  " . $adm_id["pfl_email"] . "</p>");
        echo("<br>");
        echo("<p>" . "Rôle:" . "  " . $adm_id["pfl_role"] . "</p>");
        echo("<br>");
        echo("<p>" . "Validité:" . "  " . $adm_id["pfl_validite"] . "</p>");
        echo("<br>");
        echo("<p>" . "Date de création du compte:" . "  " . $adm_id["pfl_date"] . "</p>");
        echo("</center>");


        echo("<br>");
        echo("<br>");
        echo("<p class='cpt_gest'>" . "Gestion des comptes" ."</p>");
        echo("<center>" . "<hr class='underline_cpt'>" . "</center>");
        echo("<br>");
        echo("<br>");


        echo("<center>");
        echo("Il y a " .$nbacc['nbAcc']. " comptes administrateurs / modérateurs au total.");
        echo("</center>");
        echo("<br>");
        echo("<br>");
        echo("<br>");
        
        echo("<table class='table table-bordered'>");
        echo("<thead>
                <tr>
                    <th class = 'actuTitle'> Pseudo </th>
                    <th class = 'actuTitle'> Rôle </th>
                    <th class = 'actuTitle'> Validité </th>
                    <th class = 'actuTitle'> Email </th>
                    <th class = 'actuTitle'> Date </th> 
                    <th class = 'actuTitle'> Nom </th> 
                    <th class = 'actuTitle'> Prénom </th>                   
                </tr>
                </thead>
                <tbody>");
                while($infos = $result2->fetch_assoc())
                {
                echo("<tr>");
                    echo("<td class = 'actuCol'>" . $infos["cpt_pseudo"] . "</td>" .  "<td class = 'actuCol'>" . $infos["pfl_role"] . 
                        "</td>" .  "<td class = 'actuCol'>" . $infos["pfl_validite"] . "</td>");  

                    if(!empty($infos["pfl_email"])){
                        echo("<td class = 'actuCol'>" . $infos["pfl_email"] . "</td>");
                    }
                    else{
                        echo("<td class = 'actuCol'>" . "<i>" . "NULL". "</i>" . "</td>");
                    }

                    echo("<td class = 'actuCol'>" . $infos ["pfl_date"] . "</td>" .  "<td class = 'actuCol'>" . $infos["pfl_nom"] . "</td>" .  "<td class = 'actuCol'>" . $infos["pfl_prenom"] . "</td>");
                echo("</tr>");
                }
            echo("</tbody></table>");

            echo("<br>");
            echo("<br>");
            echo("<p class='cpt_gest'>" . "Gestion de la validité des profils (Activer / Désactiver)" ."</p>");
            echo("<center>" . "<hr class='underline_val'>" . "</center>");
            echo("<br>");
            echo("<br>");

            echo("<center>");
            echo("<div>");
                echo("<form action='comptes_action.php' method='post'>");
                    echo("<div class='form-group col-md-4'>");
                    echo("<select name='cpt' class='custom-select mr-sm-2'>");
                    while($cpt = $result4->fetch_assoc()){
                        echo("<option value='".$cpt['cpt_pseudo']."'>" . "<b>" .$cpt['cpt_pseudo']. "</b>"."</option>");
                    }
                echo("</select>");
            echo("</div>");

            echo("<br>");
            echo("<br>");

            echo("<div>");                    
                echo("<p>" . "<input type='submit' value='Valider'>" . "</p>");
            echo("</div>");
            echo("</form>");
            echo("</center>");

            echo("<br>");
            echo("<br>");

            echo("<p class='cpt_gest'>" . "Modifier les informations du profil" ."</p>");
            echo("<center>" . "<hr class='underline_ownpfl'>" . "</center>");

            echo("<section class='tm-content tm-contact'>            
                    <form id='contact-form' action='pfl_actions.php' method='POST' novalidate>
                        <div class='form-group mb-4'>
                            <input type='password' name='anmdp' class='form-control' placeholder='Ancien mot de passe' required='' />
                        </div>
                        <div class='form-group mb-4'>
                            <input type='password' name='mdp' class='form-control' placeholder='Nouveau mot de passe' required='' />
                        </div>
                        <div class='form-group mb-4'>
                            <input type='password' name='cfmdp' class='form-control' placeholder='Confirmer le mot de passe' required='' />
                        </div>
                        <br>
                        <div class='text-center'>
                            <button type='submit' class='btn btn-big btn-primary'>Envoyer</button>
                        </div>
                    </form>
            </section>");


            echo("<br>");
            echo("<br>");
            echo("<br>");

            echo("<center>");
            echo("<form action='logout.php' method='post'>");
                echo("<div class='text-center'>");
                    echo("<button type='submit' class='btn btn-big btn-primary'>Déconnexion</button>");
                echo("</div>");
            echo("</form>");
            echo("</center>");
        }

        else if($valAcc == 'O')
        {
        echo("<br>");
        echo("<p class='textundertitle'>" .  "Bonjour modérateur   :   "  . $adm_id['pfl_prenom'] . "    " . $adm_id['pfl_nom'] . "</p>");

        echo("<br>");
        echo("<br>");
        echo("<br>");
        echo("<center>");
        echo("<p class='pfl'>" . "Gestion du profil" ."</p>");
        echo("<center>" . "<hr class='underline'>" . "</center>");
        echo("<br>");
        echo("<br>");
        echo("<p>" . "Pseudo:" . "  " . $adm_id["cpt_pseudo"] . "</p>");  
        echo("<br>");   
        echo("<p>" . "Nom:" . "  " . $adm_id["pfl_nom"] . "</p>");
        echo("<br>");
        echo("<p>" . "Prénom:" . "  " . $adm_id["pfl_prenom"] . "</p>");    
        echo("<br>");
        echo("<p>" . "Email:" . "  " . $adm_id["pfl_email"] . "</p>");
        echo("<br>");
        echo("<p>" . "Rôle:" . "  " . $adm_id["pfl_role"] . "</p>");
        echo("<br>");
        echo("<p>" . "Validité:" . "  " . $adm_id["pfl_validite"] . "</p>");
        echo("<br>");
        echo("<p>" . "Date de création du compte:" . "  " . $adm_id["pfl_date"] . "</p>");
        echo("</center>"); 

        echo("<br>");
        echo("<br>");

        echo("<p class='cpt_gest'>" . "Modifier les informations du profil" ."</p>");
        echo("<center>" . "<hr class='underline_ownpfl'>" . "</center>");

        echo("<section class='tm-content tm-contact'>            
                <form id='contact-form' action='pfl_actions.php' method='POST' novalidate>
                    <div class='form-group mb-4'>
                        <input type='password' name='anmdp' class='form-control' placeholder='Ancien mot de passe' required='' />
                    </div>
                    <div class='form-group mb-4'>
                        <input type='password' name='mdp' class='form-control' placeholder='Nouveau mot de passe' required='' />
                    </div>
                    <div class='form-group mb-4'>
                        <input type='password' name='cfmdp' class='form-control' placeholder='Confirmer le mot de passe' required='' />
                    </div>
                    <br>
                    <div class='text-center'>
                        <button type='submit' class='btn btn-big btn-primary'>Envoyer</button>
                    </div>
                </form>
            </section>");

        echo("<br>");
        echo("<br>");
        echo("<br>");
            
        echo("<center>");
            echo("<form action='logout.php' method='post'>");
                echo("<div class='text-center'>");
                    echo("<button type='submit' class='btn btn-big btn-primary'>Déconnexion</button>");
                echo("</div>");
            echo("</form>");
        echo("</center>");
        }
    }
    $mysqli->close();
?>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>


