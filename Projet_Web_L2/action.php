<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Net'Gallery - Action</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" /> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet" /> <!-- https://getbootstrap.com/ -->
    <link href="fontawesome/css/all.min.css" rel="stylesheet" /> <!-- https://fontawesome.com/ -->
    <link href="css/action.css" rel="stylesheet" />
<!--

TemplateMo 550 Diagoona

https://templatemo.com/tm-550-diagoona

-->
</head>
<body>
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
        <h1>Vérification<br></h1>
    </header>

    <div class="main">
    <div class="error">
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

    // ....................................... // 
    // .. Insertion d'un nouveau modérateur .. // 
    // ....................................... // 


    $id=$_POST['pseudo'];
    $mdp=$_POST['mdp'];
    $cfmdp=$_POST['cfmdp'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $forname=$_POST['forname'];

    if (($id && $mdp && $cfmdp && $name && $forname))
    {
        $id= htmlspecialchars(addslashes($_POST[('pseudo')]));
        $mdp=htmlspecialchars(addslashes($_POST[('mdp')]));
        $cfmdp=htmlspecialchars(addslashes($_POST[('cfmdp')]));
        $name=htmlspecialchars(addslashes($_POST[('name')]));
        $forname=htmlspecialchars(addslashes($_POST[('forname')]));
    }
    else
    {
        echo "Problème de remplissage du formulaire !    --->    ";
        echo("<a href='inscription.php'>" . "Retourner sur sur la page d'inscription" . "</a>");
        exit();
    }

    if($email)
    {
        $email=htmlspecialchars(addslashes($_POST[('email')]));
        $sql2="INSERT INTO t_profil_pfl VALUES('" .$name. "', '" .$forname. "', '" .$email. "', 'O', 'D', NOW(), '" .$id. "');"; // Permet de créer un nouveau profil
    }
    else
    {
        $email=htmlspecialchars(addslashes($_POST[('email')]));
        $sql2="INSERT INTO t_profil_pfl VALUES('" .$name. "', '" .$forname. "', NULL, 'O', 'D', NOW(), '" .$id. "');"; // Permet de créer un nouveau profil
    }   

    $sql1="INSERT INTO t_compte_cpt VALUES('" .$id. "', MD5('" .$mdp. "'));"; // Permet de créer un nouveau compte
    $sql3="DELETE FROM t_compte_cpt WHERE cpt_pseudo = '" .$id. "';"; // Permet d'effacer le compte de pseudo cpt_pseudo

    $cmps=strcmp($mdp, $cfmdp);


    if($cmps != 0)
    {
        echo "Les mots de passes ne correspondent pas !    --->    ";
        echo("<a href='inscription.php'>" . "Retourner sur sur la page d'inscription" . "</a>");
    }
    else
    {
        $result1 = $mysqli->query($sql1);
        if ($result1 == false)
        {
            echo("La 1ère requête à échoué!");
            echo("<br>");
            echo("<a href='inscription.php'>" . "Retourner sur sur la page d'inscription" . "</a>");
            exit();
        }
        else 
        {
            $result2 = $mysqli->query($sql2);
            if ($result2 == false)
            {
                echo("La 2ème requête à échoué!");
                echo("<br>");
                $result3 = $mysqli->query($sql3);
                echo("Suppression du compte :   " . $id);
                echo("<br>");
                echo("<a href='inscription.php'>" . "Retourner sur sur la page d'inscription" . "</a>");
            }
            else
            {
                echo "Insertion réussie !\n";
            }
        }
    }
    $mysqli->close();
    ?> 
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

</body>
</html>

