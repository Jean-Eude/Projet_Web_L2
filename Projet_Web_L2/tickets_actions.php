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

$id=$_POST['visit'];

$sql3="DELETE FROM t_commentaire_com WHERE visit_id = '".$id."';"; // Suppression du commentaire d'id id
$sql4="DELETE FROM t_visiteur_visit WHERE visit_id = '".$id."';"; // Suppression du visiteur d'id id

$result3 = $mysqli->query($sql3);


if ($result3 == false) 
{
    // La requête a echoué
    echo "Error: Problème d'accès à la base \n";
    exit();
}
else
{
   $result4 = $mysqli->query($sql4);
   if ($result4 == false) 
   {
      // La requête a echoué
      echo "Error: Problème d'accès à la base \n";
      exit();
   }
   else
   {
      header("Location:admin_tickets.php");
   }
}
?>



