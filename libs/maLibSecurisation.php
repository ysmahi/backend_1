<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file login.php
 * Fichier contenant des fonctions de v�rification de logins
 */

/**
 * Cette fonction v�rifie si le login/passe pass�s en param�tre sont l�gaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir �t� appel�...
 * Infos � enregistrer : pseudo, idUser, heureConnexion, isAdmin
 * Elle enregistre l'�tat de la connexion dans une variable de session "connecte" = true
 * L'heure de connexion doit �tre stock�e au format date("H:i:s") 
 * @pre login et passe ne doivent pas �tre vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la cr�ation de variables de session
 */
function verifUser($login,$password)
{

}




/**
 * Fonction � placer au d�but de chaque page priv�e
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur 
	et arr�te l'interpr�tation si l'utilisateur n'est pas connect�
 * Elle ne fait rien si l'utilisateur est connect�, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{

}

?>
