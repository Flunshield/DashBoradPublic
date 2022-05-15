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
			$ndcm = $_SESSION['numPatient'];
			$Obj1 = $_POST['Obj1'];
			$Obj2 = $_POST['Obj2'];
			$Obj3 = $_POST['Obj3'];
			$Obj4 = $_POST['Obj4'];
	
			//UPDATE de l'Objectif 1
			$updateObj1 = $pdo->prepare('UPDATE `objectifs` SET `Objectif_1` = :Obj1 WHERE Numero_Client = :Numero_Client');	

			//UPDATE de l'Objectif 2
			$updateObj2 = $pdo->prepare('UPDATE `objectifs` SET `Objectif_2` = :Obj2 WHERE Numero_Client = :Numero_Client');	

			//UPDATE de l'Objectif 3
			$updateObj3 = $pdo->prepare('UPDATE `objectifs` SET `Objectif_3` = :Obj3 WHERE Numero_Client = :Numero_Client');	

			//UPDATE de l'Objectif 4
			$updateObj4 = $pdo->prepare('UPDATE `objectifs` SET `Objectif_4` = :Obj4 WHERE Numero_Client = :Numero_Client');
			

			//Je prépare ma requet SQL pour allez vérifier les identifiants utilisateurs.
			$sthObj = $pdo->prepare('SELECT Numero_Client FROM objectifs WHERE Numero_Client = ?'); 
			$sthObj->execute(array($ndcm)); 			
			
            if ($sthObj->fetch(PDO::FETCH_ASSOC)) 
			{ 
				if (!empty($Obj1))
				{
					$updateObj1->execute(array('Obj1' => $Obj1, 'Numero_Client' => $ndcm,)); 
				}	 
				if (!empty($Obj2))
				{
					$updateObj2->execute(array('Obj2' => $Obj2, 'Numero_Client' => $ndcm,)); 
				}	 
				if (!empty($Obj3))
				{
					$updateObj3->execute(array('Obj3' => $Obj3, 'Numero_Client' => $ndcm,)); 
				}	 
				if (!empty($Obj4))
				{
					$updateObj4->execute(array('Obj4' => $Obj4, 'Numero_Client' => $ndcm,)); 
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
