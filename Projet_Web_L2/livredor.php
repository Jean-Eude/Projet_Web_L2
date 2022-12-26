<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Net'Gallery - Livre d'or</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/templatemo-diagoona.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>
<body>
    <div class="tm-container">
        <div>
            <div class="tm-row pt-4">
                <div class="tm-col-left">
                    <div class="tm-site-header media">
                        <div class="media-body">
                            <h1 class="tm-sitename text-uppercase">Net'Gallery</h1>
                        </div>        
                    </div>
                </div>
                <div class="tm-col-right">
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
            </div>
            

            <div class="tm-row">
                <div class="tm-col-left"></div>
                <main class="tm-col-right tm-contact-main"> <!-- Content -->
                    <section class="tm-content tm-contact">
                        <h2 class="mb-4 tm-content-title">Partagez votre avis !</h2>
                        <p class="mb-85">Laissez nous un petit message sur l'exposition !</p>
                        <form id="contact-form" action="com_actions.php" method="POST" novalidate>
                            <div class="form-group mb-4">
                                <input type="text" name="id" class="form-control" placeholder="Numéro du ticket" required="" />
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required="" />
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="name" class="form-control" placeholder="Nom" required="" />
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="forname" class="form-control" placeholder="Prénom" required="" />
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" name="mail" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div class="form-group mb-5">
                                <textarea rows="6" name="msg" class="form-control" placeholder="Commentaire" required=""></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-big btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>        

        <div class="tm-row">
            <div class="tm-col-left text-center">            
                <ul class="tm-bg-controls-wrapper">
                    <li class="tm-bg-control active" data-id="0"></li>
                    <li class="tm-bg-control" data-id="1"></li>
                    <li class="tm-bg-control" data-id="2"></li>
                </ul>            
            </div>        
            <div class="tm-col-right tm-col-footer">
                <footer class="tm-site-footer text-right">
                    <p class="mb-0">Copyright 2022 Combot Evan | Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-text-link">TemplateMo</a></p>
                </footer>
            </div>  
        </div>

        <div class="actualite" id="actu_anchor">
            <div class="actu_title">
                <h1 class="title_actu"><center>Les commentaires</center></h1>
                <br>
                <center><hr></center>
            </div>  
        <div class="actu_table">
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

        $requete="SELECT * FROM t_commentaire_com JOIN t_visiteur_visit USING (visit_id) WHERE com_etat = 'P' ORDER BY (com_date) ASC;"; //Permet d'afficher les commentaires publiés
        $result1 = $mysqli->query($requete);

        if ($result1 == false) 
        { 
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
        }
        else 
        {
        echo("<table class='table table-bordered'>");
        echo("<thead>
                <tr>
                    <th class = 'actuTitle'> De </th>
                    <th class = 'actuTitle'> Commentaire </th>
                    <th class = 'actuTitle'> Publié le </th>
                    <th class = 'actuTitle'> Email </th>
                </tr>
                </thead>
                <tbody>");
                while($com = $result1->fetch_assoc())
                {
                    echo("<tr>");
                    echo("<td class = 'actuCol'>" . $com["visit_prenom"] . "  " . $com["visit_nom"] . "</td>" . "<td class = 'actuCol'>" . $com["com_texte"] . "</td>" .  "<td class = 'actuCol'>" . $com["com_date"] . "</td>" .  "<td class = 'actuCol'>" . $com["visit_email"] . "</td>");
                    echo("</tr>");
                }
                echo("</tbody></table>");
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
<script src="js/templatemo-script.js"></script>

</body>
</html>