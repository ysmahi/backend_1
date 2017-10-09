<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();

		echo "Action = '$action' <br />";

		// ATTENTION : le codage des caract�res peut poser PB 
		// si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de probl�matiques

		/* TODO: exercice 4
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un param�tre action a �t� soumis, on fait le boulot...
		switch($action)
		{
			
			// Connexion //////////////////////////////////////////////////


			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, et on cr�e des variables de session si tout est OK
					// Cf. maLibSecurisation
					verifUser($login,$passe); 	
				}

				// On redirigera vers la page index automatiquement
			break;
			
			case 'Interdire':
				if ($idUser = valider("idUser")){
				interdireUtilisateur($idUser);
				$qs = "?view=users";}
			break;
			
			case 'Autoriser':
				if ($idUser = valider("idUser"))
				{
					autoriserUtilisateur($idUser);
					$qs = "?view=users";
				}
			break;
		}

	}

	// On redirige toujours vers la page index, mais on ne connait pas le r�pertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $qs);
	//qs doit contenir le symbole '?'

	// On �crit seulement apr�s cette ent�te
	ob_end_flush();
	
?>










