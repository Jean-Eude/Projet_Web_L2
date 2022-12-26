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


$anmdp=$_POST['anmdp'];
$mdp=$_POST['mdp'];
$cfmdp=$_POST['cfmdp'];

if (($anmdp && $mdp && $cfmdp))
{ 
    $anmdp= htmlspecialchars(addslashes($_POST['anmdp']));
    $mdp= htmlspecialchars(addslashes($_POST['mdp']));
    $cfmdp= htmlspecialchars(addslashes($_POST['cfmdp']));
}
else{
    echo "Problème de remplissage du formulaire !    --->    ";
    echo("<a href='admin_accueil.php'>" . "Retourner sur sur la page de gestion" . "</a>");
    exit();
}


$sql1 = "SELECT cpt_mdp FROM t_compte_cpt where cpt_pseudo='" .$loginAcc. "';"; // Sélectionne le mot de passe de compte ou le pseudo = cpt_pseudo
$sql2 = "UPDATE t_compte_cpt SET cpt_mdp = MD5('" .$mdp. "') WHERE cpt_pseudo = '" .$loginAcc. "';"; // Met à jour le mot de passe du compte de pseudo cpt_pseudo

$cmps=strcmp($mdp, $cfmdp);


$result1 = $mysqli->query($sql1);
$mdp = $result1->fetch_assoc();

if(md5($anmdp) == $mdp['cpt_mdp']){
    if($cmps != 0)
    {
        echo("Les mots de passes ne correspondent pas !    --->    ");
        echo("<a href='admin_accueil.php'>" . "Retourner sur sur la page de gestion" . "</a>");
    }
    else
    {
        $result2 = $mysqli->query($sql2);
        if ($result2 == false)
        {
            echo("La 1ère requête à échoué!");
            echo("<br>");
            echo("<a href='admin_accueil.php'>" . "Retourner sur sur la page de gestion" . "</a>");
            exit();
        }
        else
        {
            header("Location:admin_accueil.php");            
        }
    }
}
else{
    echo("L'ancien mot de passe est incorrect !    --->    ");
    echo("<a href='admin_accueil.php'>" . "Retourner sur sur la page de gestion" . "</a>"); 
}

?>