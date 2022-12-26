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

if (!$mysqli->set_charset("utf8")) 
{
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    exit();
}


$mdp=$_POST['mdp'];

if(($mdp))
{
    $mdp=htmlspecialchars(addslashes($_POST[('mdp')]));
}
else{
    echo "Problème de remplissage du formulaire !    --->    ";
    echo("<a href='admin_tickets.php'>" . "Retourner sur sur la page des visiteurs" . "</a>");
    exit();
}

$sql1="INSERT into t_visiteur_visit VALUES (NULL,  MD5('" .$mdp. "'), NOW(), NULL, NULL, NULL, '" .$loginAcc. "');"; // Insertion d'un nouveau ticket visiteur
$result1 = $mysqli->query($sql1);


if ($result1 == false)
{
    echo("La requête à échoué!");
    echo("<br>");
    exit();
}
else
{
    header("Location:admin_tickets.php");
}

?>