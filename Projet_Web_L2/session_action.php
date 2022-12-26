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

//Ouverture d'une session
session_start();
/*Affectation dans des variables du pseudo/mot de passe s'ils existent,
affichage d'un message sinon*/

$id=$_POST['pseudo'];
$mdp=$_POST['mdp'];

if ($id && $mdp){
	$id= htmlspecialchars(addslashes($_POST[('pseudo')]));
    $mdp=htmlspecialchars(addslashes($_POST[('mdp')]));
}
else{
    echo "Problème de remplissage du formulaire !    --->    ";
    echo("<a href='session.php'>" . "Retourner sur sur la page de gestion" . "</a>");
    exit();
}


$sql1 = "SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo) WHERE cpt_pseudo = '" . $id . "' and cpt_mdp = MD5('" . $mdp . "') and pfl_validite = 'A';"; // Vérifie que le compte à bien un profil et qu'il est activé 
$result1 = $mysqli->query($sql1);


if ($result1==false) 
{
    // La requête a echoué
    echo "Error: Problème d'accès à la base \n";
    exit();
}
else 
{
	$val = $result1->fetch_assoc();

 	if($result1->num_rows == 1) 
    {
        //Mise à jour des données de la session
	    $_SESSION['login']=$id;
        $_SESSION['role']=$val['pfl_role'];
        header("Location:admin_accueil.php");
    }   
    else
    {
        // aucune ligne retournée
        // => le compte n'existe pas ou n'est pas valide
        echo "pseudo/mot de passe incorrect(s) ou profil inconnu !";
        echo "<br /><a href=\"./session.php\">Cliquez ici pour réafficher le formulaire</a>";
    }
//Fermeture de la communication avec la base MariaDB
$mysqli->close();
}
?>