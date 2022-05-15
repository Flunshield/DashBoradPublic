<?php 
	// J'initialise la session pour récupérer les éléments de sessions.
	session_start();
	if(!empty($_SESSION['compte'])) 
	{
		echo "<script> alert('Le compte a bien été créé');</script>";
		unset($_SESSION['compte']);
	}

	if(empty($_SESSION['numPatient'])) 
	{
		echo "<script> alert('Le Numéro client n'existe pas');</script>";
		unset($_SESSION['numPatient']);
	}
	// Si ma session est active, j'entre dans le IF.
	if(!empty($_SESSION['ID'])) 
		{
?>

			<html lang="fr-FR">
			 
				<head>
					<meta charset="utf-8" />
					<link rel="stylesheet" type="text/css" href="CSS/Styleheader.css" />
					<META NAME="robots" CONTENT="noindex,nofollow">
					<title>Tableau de bord</title>
				</head>
				
				<body>
					<?php include 'header.php'; ?>
					<div id="Blockpagetableau">
						<div id="choixun">
							<h2> Créer un compte patient</h2>
							<form method="post" action="creercomptepatient.php">
								<label for="pseudo">Nom de compte</label></br> 
									<input type="text" name="nomdecompte" id="nomdecompte" /></br></br>
									<label for="pseudo">Mot de passe </label></br>
									<input type="password" name="motdepasse" id="motdepasse" /></br></br>
									<label for="pseudo">Numéro patient</label></br> 
									<input type="password" name="numpatient" id="numpatient" /></br></br>
									<input type="submit" value="Envoyer" />
							</form>
						</div>
									
							<div id="choixdeux">
								<h2> Ouvrir un dossier patient</h2>
								<form method="post" action="Suivipatient.php">
									<label for="pseudo">Numéro patient</label></br>
									<input type="password" name="numpatient" id="numpatient" /></br></br>
									<input type="submit" value="Envoyer" />
								</form>
						</div>
					</div>
					<?php include 'footer.php'; ?>	
				</body>
			</html>

<?php 
		}
	// Sinon je retour sur ma page d'acceuil.
	else 
		{
			header('Location: http://localhost/PageInternet/Index.php');
		}				
?>