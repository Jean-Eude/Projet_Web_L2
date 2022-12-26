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


$id=$_POST['id'];
$mdp=$_POST['mdp'];
$name=$_POST['name'];
$forname=$_POST['forname'];
$email=$_POST['mail'];
$message=$_POST['msg'];

if (($id && $mdp && $name && $forname && $email && $message))
{ 
    $id= htmlspecialchars(addslashes($_POST[('id')]));
    $mdp=htmlspecialchars(addslashes($_POST[('mdp')]));
    $name=htmlspecialchars(addslashes($_POST[('name')]));
    $forname=htmlspecialchars(addslashes($_POST[('forname')]));
    $email=htmlspecialchars(addslashes($_POST[('mail')]));
    $message=htmlspecialchars(addslashes($_POST[('msg')]));
}
else{
    echo "Problème de remplissage du formulaire !    --->    ";
    echo("<a href='livredor.php'>" . "Retourner sur le livre d'or" . "</a>");
    exit();
}


$sql1="SELECT * FROM t_visiteur_visit WHERE TIMESTAMPDIFF(HOUR, visit_date ,NOW())<=3 AND visit_mdp=MD5('".$mdp."') AND visit_id NOT IN (SELECT visit_id FROM t_commentaire_com);"; // Vérifie si le visiteur peut ou pas poster un commentaire
$sql2="INSERT INTO t_commentaire_com VALUES (NULL, NOW(), '".$message."', '".$id."', 'P');"; // Insére un nouveau commentaire
$sql3="UPDATE t_visiteur_visit SET visit_nom = '".$name."', visit_prenom = '".$forname."', visit_email = '".$email."' WHERE visit_id = '".$id."';"; // Met à jour les infos du visiteur

$result1 = $mysqli->query($sql1);

if ($result1 == false) 
{ 
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit();
}
else
{
    $nbvisid = $result1->fetch_assoc();

    if($nbvisid['visit_id'] == $id)
    {
        $result3 = $mysqli->query($sql3);
        $result2 = $mysqli->query($sql2);
        
        if ($result2 == false) 
        { 
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit();
        }
        else
        {
            header("Location:livredor.php");   
        }        
    }
    else
    {
        header("Location:livredor.php");           
    }
}

?>