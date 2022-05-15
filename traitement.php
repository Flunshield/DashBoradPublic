<?php
	
	//J'initialise une session pour envoyer des informations tout au long de ma session.
	session_start(); 
	
	// Je récupère les identifiants renseigné par l'utilisateur.
	$ndcm = $_POST['ndcm'];
	$mdpm =  $_POST['mdpm'];

	// Je test si les champs reçu sont non vide.
	//Si les champs ne sont pas remplit, je reviens sur la page d'acceuil
	if(empty($ndcm) OR empty($mdpm)) 
	{
		$_SESSION['refus'] = 'Combinaison Nom de compte et/ou Mot de passe inccorect.';
		header('Location: http://localhost/PageInternet/Index.php');
		exit();
	}
	// Sinon je continu......
	else
		{
			try
				{
					//Je me connecte à la BDD
					$pdo = new PDO('mysql:host=localhost;dbname=applimag;charset=utf8', 'root', 'root');	
				}
			catch (Exception $e)
				{
					// Si la connexion n'est pas possible, un message d'erreur s'affiche.
					die('Erreur de connexion' );
				}
			
			//Je prépare ma requet SQL pour allez vérifier les identifiants utilisateurs.
			$sth = $pdo->prepare('SELECT login FROM users WHERE login = ? and password = ?'); 
			$sth->execute(array($_POST['ndcm'], $_POST['mdpm'])); 
			
			$recupname = $pdo->prepare('SELECT ID FROM users WHERE login = ? and password = ?');
			$recupname->execute(array($_POST['ndcm'], $_POST['mdpm']));
			
			// Je fais une recherche en fonction de ma requête.
			// Si les éléments match, je rentre dans le if.
			if ($sth->fetch(PDO::FETCH_ASSOC)) 
				{ 
					// Je fais une recherche en fonction de ma requête SQL $recupname et la stock dans la variable $oui.
					while($oui = $recupname->fetch())
						{
							//Je met ma donnée requêté dans ma variable session[''] et je redirige vers la page Tableau.php
							$_SESSION['ID'] = $oui['ID'];
							header('Location: http://localhost/Pageinternet/Tableau.php');
							exit();
						}
				}
			// Si les éléments ne match pas, je retourne sur la page d'acceuil.
			else
				{
					$_SESSION['refus'] = 'Nom de compte et/ou mot de passe erroné';
					header('Location: http://localhost/PageInternet/Index.php');
					exit();
				}
		}
?>
