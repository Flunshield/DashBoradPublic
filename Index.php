<?php
	// J'initialise la session pour récupérer les éléments de sessions.
	session_start();
	// Si ma session est active, j'entre dans le IF.
	if(!empty($_SESSION['refus'])) 
		{
			echo "<script> alert('Nom de compte et/ou mot de passe inccorect');</script>";
			unset($_SESSION['refus']);
		}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="CSS/Styleheader.css" />
		<META NAME="robots" CONTENT="noindex,nofollow">
        <title>Page de connexion</title>
    </head>
    
    <body>

	
	
		<?php include 'header.php'; ?>
	
		<div id="Blockpageacceuil">
				<h2>Bonjour, merci de vous connecter </h2>
				<form method="post" action="traitement.php">
					<label for="pseudo">Nom de compte</label></br> 
					<input type="text" name="ndcm" id="ndcm" /></br></br>
					<label for="pseudo">Mot de passe  </label></br>
					<input type="password" name="mdpm" id="mdpm" /></br></br>
					<input type="submit" value="Envoyer" id="cliick"/>
				</form>
		</div>

		<?php include 'footer.php'; ?>
		
	</body>
	
</html>