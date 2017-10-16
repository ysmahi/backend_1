<?php
// Ce fichier permet de tester les fonctions d�velopp�es dans le fichier malibforms.php

// Si la page est appel�e directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php")
{
	header("Location:../index.php?view=conversations");
	die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...



?>

<h1>Conversations du site</h1>

<h2>Liste des conversations actives</h2>

<?php
$conversations = listerConversations("actives");
//mkTable($conversations, array("theme","id")); 
// Comment n'afficher que id & th�mes ?
// A remplacer par mkLiens
mkLiens($conversations, "theme","id","index.php?view=chat","idConv");
?>

<h2>Liste des conversations inactives</h2>

<?php
$conversations = listerConversations("inactives");
//mkTable($conversations, array("theme","id")); 
// A remplacer par mkLiens
mkLiens($conversations, "theme","id","index.php?view=chat","idConv");
?>

<hr />
<h2>Gestion des conversations</h2>

<?php

$conversations = listerConversations(); // toutes
//mkTable($conversations); // A remplacer par mkSelect

$idLastConv = valider("idLastConv");

mkForm("controleur.php");
mkSelect("idConv",$conversations ,"id", "theme", $idLastConv);
mkInput("submit","action","Activer"); 
mkInput("submit","action","Archiver"); 
mkInput("submit","action","Supprimer"); 
endForm();

mkForm("controleur.php");
echo "Theme:"; 
mkInput("text","theme",""); 
mkInput("submit","action","Cr�er conversation");  
endForm();
?>















