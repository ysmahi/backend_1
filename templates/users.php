<?php
// Ce fichier permet de tester les fonctions développées dans le fichier bdd.php (première partie)

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint

?>

<h1>Administration du site</h1>

<h2>Liste des utilisateurs de la base </h2>

<?php
// TODO : 1) afficher uniquement les noms des utilisateurs 
// TODO: 2) présélectionner dans le menu déroulant l'utilisateur qui vient d'être manipulé 

echo "liste des utilisateurs autorises de la base :"; 
$users = listerUtilisateurs("nbl");
//tprint($users);	// préférer un appel à mkTable($users);
foreach($users as $dataUser) {
	echo "<p>" . $dataUser["pseudo"] . "</p>";
}


echo "<hr />";
echo "liste des utilisateurs non autorises de la base :"; 
$users = listerUtilisateurs("bl");
//tprint($users);	// préférer un appel à mkTable($users);

foreach($users as $dataUser) {
	echo "<p>" . $dataUser["pseudo"] . "</p>";
}

?>
<hr />
<h2>Changement de statut des utilisateurs</h2>

<form action="controleur.php">

<select name="idUser">
<?php
$users = listerUtilisateurs();
// on récupère l'identifiant 
// du dernier utilisateur manipulé
$idLastUser = valider("idLastUser");

// préférer un appel à mkSelect("idUser",$users, ...)
// TODO: présélectionner le dernier utilisateur manipulé

foreach ($users as $dataUser)
{
	if ($idLastUser == $dataUser["id"])
		$toSel="selected";
	else $toSel ="";  

	echo "<option $toSel value=\"$dataUser[id]\">\n";
	echo  $dataUser["pseudo"];
	if ($dataUser["blacklist"] == 1) echo " (bl)"; 
	else echo " (nbl)"; 
	echo "\n</option>\n"; 
}
?>
</select>

<input type="submit" name="action" value="Interdire" />
<input type="submit" name="action" value="Autoriser" />
</form>






