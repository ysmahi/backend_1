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
			case 'Logout' : 
				session_destroy();
				$qs = "?view=login&msg=" . urlencode("Au revoir !");
			break; 

			// Connexion //////////////////////////////////////////////////
			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, et on cr�e des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (!verifUser($login,$passe)) 
						 $qs = "?view=login&msg=" . urlencode("Identifiants incorrects");
					// On redirigera vers la page index automatiquement
				}

				
			break;

			// TODO : pr�voir les cas Interdire et Autoriser
			// TODO: res�lectionner la vue 'users'
			// apr�s chaque traitement
			// => redirection vers la page index 
			// AVEC un parametre VIEW correpondant � la BONNE VUE 

			case 'Interdire' : 
				if ($idUser = valider("idUser")) {
					interdireUtilisateur($idUser); 
				}

				// Pr�voir un parametre Vue lors la redirection 
				$qs = "?view=users&idLastUser=" . $idUser;
			break; 

			case 'Autoriser':
				if ($idUser = valider("idUser")) {
					autoriserUtilisateur($idUser);
				}
				$qs = "?view=users&idLastUser=" . $idUser;
			break;

			case 'Archiver':
				if ($idConv = valider("idConv")) {
					archiverConversation($idConv);
				}
				$qs = "?view=conversations&idLastConv=" . $idConv;
			break;

			case 'Activer':
				if ($idConv = valider("idConv")) {
					reactiverConversation($idConv);
				}
				$qs = "?view=conversations&idLastConv=" . $idConv;
			break;

			case 'Supprimer':
				if ($idConv = valider("idConv")) {
					supprimerConversation($idConv);
				}
				$qs = "?view=conversations&idLastConv=" . $idConv;
			break;

			case 'Cr�er conversation':
				$idConv = 0;
				if ($theme = valider("theme")) {
					$idConv = creerConversation($theme);
				}
				$qs = "?view=conversations&idLastConv=" . $idConv;
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










