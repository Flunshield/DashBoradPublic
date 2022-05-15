<?php

// Je récupère les identifiants renseigné par l'utilisateur.
$nomdecompte = $_POST['nomdecompte'];
$motdepasse =  $_POST['motdepasse'];
$numpatient = $_POST['numpatient'];

// Je test si les champs reçu sont non vide.
if(empty($nomdecompte) OR empty($motdepasse) OR empty($numpatient)) 
{
	header('Location: http://localhost/Pageinternet/Tableau.php');
}
else
{
	try
	{
		$pdo = new PDO('mysql:host=localhost;dbname=applimag;charset=utf8', 'root', 'root');	//Je me connecte à la BDD
	}
	catch (Exception $e)
	{
			die('Erreur de connexion' );
	}
	
	//Création du compte
	// Requête SQL pour ajouter un nouveau compte patient.
	$creationCompte  = 'INSERT INTO `comptepatient` (`Numero_Client`, `Nom_de_compte`, `Password`) VALUES (:Numero_Client, :Nom_de_compte, :Password)';
	// Préparation
	$insertPatient = $pdo->prepare($creationCompte);	
	// Initialisation du compte
	$insertPatient->execute([
		'Numero_Client' => $numpatient,
		'Nom_de_compte' => $nomdecompte,
		'Password' => $motdepasse,]);

	//Initialisation du plan alimentaire
	// Requête SQL pour ajouter un plan alimentaire au nouveau patient.
	$creationPlanAlim  = "INSERT INTO `planalimentaire` (`Numero_Client`, `PetitDejeuner`, `CollationMatin`, `Dejeuner`, `Gouter`, `Dinner`, `CollationSoir`) VALUES (:Numero_Client, 'définir', 'a définir', 'a définir', 'a définir', 'a définir', 'a définir')";
	// Préparation
	$insertPlan = $pdo->prepare($creationPlanAlim);
	// Initialisation du plan alimentaire
	$insertPlan->execute([
		'Numero_Client' => $numpatient,]);

	//Initialisation des objectifs
	// Requête SQL pour ajouter les objectifs au nouveau patient.
	$objectifs  = "INSERT INTO `objectifs` (`Numero_Client`, `Objectif_1`, `Objectif_2`, `Objectif_3`, `Objectif_4`) VALUES (:Numero_Client, 'a définir', 'a définir', 'a définir', 'a définir')";
	// Préparation
	$insertObjectif = $pdo->prepare($objectifs);
	// Création des objtectifs
	$insertObjectif->execute([
		'Numero_Client' => $numpatient,]);

	

	session_start();
	$_SESSION['compte'] = 'ok';
	header('Location: http://localhost/Pageinternet/Tableau.php');
	exit();	
 }
?>
