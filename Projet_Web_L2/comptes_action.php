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


$id=$_POST['cpt'];

$sql1 = "SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo) WHERE cpt_pseudo = '" . $id . "';"; // Sélectionne le compte avec le pseudo correspondant

$sql4="UPDATE t_profil_pfl set pfl_validite='A' where cpt_pseudo = '".$id."';"; // Activation d'un compte
$sql5="UPDATE t_profil_pfl set pfl_validite='D' where cpt_pseudo = '".$id."';"; // Désactivation d'un compte


$result1 = $mysqli->query($sql1);


if ($result1 == false) 
{
    // La requête a echoué
    echo "Error: Problème d'accès à la base \n";
    exit();
}
else {
    $all = $result1->fetch_assoc();

    if($all['pfl_validite'] == 'A')
    {
        $result5 = $mysqli->query($sql5);
        header("Location:admin_accueil.php");
    }
    else
    {
        $result4 = $mysqli->query($sql4);
        header("Location:admin_accueil.php");
    }
}
//Fermeture de la communication avec la base MariaDB
$mysqli->close();

?>

