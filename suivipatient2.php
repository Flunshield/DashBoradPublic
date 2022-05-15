<?php
// Si ma Session OU ma variable "numpatient" est vide, je n'entre pas dans le IF.
session_start();
	if(!empty($_SESSION['ID']) AND !empty($_SESSION['numPatient'])) 
		{
			try
				{
					//Je me connecte à la BDD
					$pdo = new PDO('mysql:host=localhost;dbname=applimag;charset=utf8', 'root', 'root');	//Je me connecte à la BDD
				}
			catch (Exception $e)
				{
					// Si la connexion n'est pas possible, un message d'erreur s'affiche.
					die('Erreur de connexion' );
				}
			// Je stock mes retours dans les variables.
			$petitdej = $_POST['petitdej'];
			$CollationMatin = $_POST['CollationMatin'];
			$Dejeuner = $_POST['Dejeuner'];
			$Gouter = $_POST['Gouter'];
			$Dinner = $_POST['Dinner'];
			$CollationSoir = $_POST['CollationSoir'];
			$ndcm = $_SESSION['numPatient'];

			//UPDATE du petit déjeuner
			$updateptidej = $pdo->prepare('UPDATE `planalimentaire` SET `PetitDejeuner` = :petitdej WHERE Numero_Client = :Numero_Client');
			
			//UPDATE de la collation du matin
			$updatecollamatin = $pdo->prepare('UPDATE `planalimentaire` SET `CollationMatin` = :CollationMatin WHERE Numero_Client = :Numero_Client');
			
			//UPDATE du Déjeuné Dejeuner
			$updateDejeuner = $pdo->prepare('UPDATE `planalimentaire` SET `Dejeuner` = :Dejeuner WHERE Numero_Client = :Numero_Client');
			
			//UPDATE du Déjeuné
			$updateGouter = $pdo->prepare('UPDATE `planalimentaire` SET `Gouter` = :Gouter WHERE Numero_Client = :Numero_Client');
			
			//UPDATE du Dinner
			$updateDinner = $pdo->prepare('UPDATE `planalimentaire` SET `Dinner` = :Dinner WHERE Numero_Client = :Numero_Client');
			
			//UPDATE de la Collation du soir 
			$updateCollationSoir = $pdo->prepare('UPDATE `planalimentaire` SET `CollationSoir` = :CollationSoir WHERE Numero_Client = :Numero_Client');

			//Je prépare ma requet SQL pour allez vérifier les identifiants utilisateurs.
			$sth = $pdo->prepare('SELECT Numero_Client FROM planalimentaire WHERE Numero_Client = ?'); 
			$sth->execute(array($ndcm)); 

			//Je prépare ma requet SQL pour allez vérifier les identifiants utilisateurs.
			$sthObj = $pdo->prepare('SELECT Numero_Client FROM objectifs WHERE Numero_Client = ?'); 
			$sthObj->execute(array($ndcm)); 			
			
			// Je fais une recherche en fonction de ma requête.
			// Si les éléments match, je rentre dans le if.
			if ($sth->fetch(PDO::FETCH_ASSOC)) 
			{ 
				if (!empty($petitdej))
				{
					$updateptidej->execute(array('petitdej' => $petitdej, 'Numero_Client' => $ndcm,)); 
				}	
				if (!empty($CollationMatin))
				{
					$updatecollamatin->execute(array('CollationMatin' => $CollationMatin, 'Numero_Client' => $ndcm,)); 
				}
				if (!empty($Dejeuner))
				{
					$updateDejeuner->execute(array('Dejeuner' => $Dejeuner, 'Numero_Client' => $ndcm,)); 
				}
				if (!empty($Gouter))
				{
					$updateGouter->execute(array('Gouter' => $Gouter, 'Numero_Client' => $ndcm,)); 
				}
				if (!empty($Dinner))
				{
					$updateDinner->execute(array('Dinner' => $Dinner, 'Numero_Client' => $ndcm,)); 
				}
				if (!empty($CollationSoir))
				{
					$updateCollationSoir->execute(array('CollationSoir' => $CollationSoir, 'Numero_Client' => $ndcm,)); 
				}
				header('Location: http://localhost/PageInternet/Suivipatient.php');
				exit;
			}
			else
			{
				echo 'non reussi';
			}
		}
		
	// Si ma Session OU ma variable "numpatient" est vide, retour sur al page d'acceuil.
	else 
		{
			echo 'bug if    ';
			echo $_SESSION['ID'];
			echo '    ';
			echo $_SESSION['numPatient'];
		}
?>
