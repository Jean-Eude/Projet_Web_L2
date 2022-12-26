<?php   
session_start();
$loginAcc = $_SESSION['login'];
if(!isset($loginAcc)) //A COMPLETER pour tester aussi le rôle...
{
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
    header("Location:session.php");
}
session_destroy(); 
header("Location:session.php");
exit();
?>