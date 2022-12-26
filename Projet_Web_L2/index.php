<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Net'Gallery - Accueil</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/templatemo-diagoona.css" rel="stylesheet" />


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
                <main class="tm-col-right">
                    <section class="tm-content">

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

                            $requete="SELECT * FROM t_configuration_cfg;"; // Permet de sélectionner toutes les colonnes de la table configuration
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
                                $cfg = $result1->fetch_assoc();
                                echo("<h2 class='mb-4 tm-content-title'>" . $cfg['cfg_intit'] . "</h2>");   
                                echo("<p class='mb-4'>" . $cfg['cfg_presentation'] . "</p>");
                                echo("<hr class='mb-4'>");
                                echo("<p class='mb-4'>" . $cfg['cfg_texte'] . "</p>");

                                echo("<h2 class='mb-4 tm-content-title'>" . "Informations" . "</h2>");
                                echo("<hr class='sline'>");  
                                echo("<br>"); 
                                echo("<p>" . "<b>" . "Date de début :" . "</b>" . "  " . $cfg['cfg_datedeb'] . "</p>");
                                echo("<br>");                                         
                                echo("<p>" . "<b>" . "Date de fin :" . "</b>" . "  " . $cfg['cfg_datefin'] . "</p>");
                                echo("<br>"); 
                                echo("<p>" . "<b>" . "Lieu de l'expositions :" . "</b>" . "  " . $cfg['cfg_lieu'] . "</p>");
                                echo("<br>"); 
                                echo("<p>" . "<b>" . "Date de vernissage :" . "</b>" . "  " . $cfg['cfg_dateverni'] . "</p>");
                                echo("<br>"); 
                                }
                                $mysqli->close();
                            ?>

                        <a href="#actu_anchor" class="btn btn-primary">Découvrez les actualités !</a>
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
        </div>



        <!-- Background -->
        <div class="tm-bg">
            <div class="tm-bg-left"></div>
            <div class="tm-bg-right"></div>
        </div>

        <div class="actualite" id="actu_anchor">
            <div class="actu_title">
                <h1 class="title_actu"><center>Quelques actualités !</center></h1>
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

                $requete="SELECT * FROM t_actualite_actu ORDER BY(actu_date);"; // Permet de sélectionner toutes les colonnes de la table des actualités rangés par ordre de publicatication
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
                    <th class = 'actuTitle'> Titre </th>
                    <th class = 'actuTitle'> Actualité </th>
                    <th class = 'actuTitle'> Date </th>
                    <th class = 'actuTitle'> De </th>
                    </tr>
                    </thead>
                    <tbody>");

                    while($actu = $result1->fetch_assoc())
                    {
                        echo("<tr>");
                        echo("<td class = 'actuCol'>".$actu["actu_titre"] . "</td>" . "<td class = 'actuCol'>" . $actu["actu_texte"] . "</td>" . "<td class = 'actuCol'>" . $actu["actu_date"] . "</td>" . "<td class = 'actuCol'>" . $actu["cpt_pseudo"] . "</td>");
                        echo("</tr>");
                    }
                echo("</tbody></table>");
                }
                $mysqli->close();
            ?>
            </div>
            <a href="galerie.php" class="btn_actu btn-primary_actu"><b>Découvrez les oeuvres !</b></a>
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