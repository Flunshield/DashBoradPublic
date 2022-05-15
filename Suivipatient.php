<?php 

session_start();

if(!empty($_POST['numpatient']))
{
	// Je stock la variable numpatient reçu dans la variable $numpatient.
	$_SESSION['numPatient'] = $_POST['numpatient'];
}
	// Si ma Session OU ma variable "numpatient" est vide, je n'entre pas dans le IF.
	if(!empty($_SESSION['ID']) OR !empty($_SESSION['numPatient'])) 
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
			
			// Je déclare les variables avec comme valeur rien.
			$ptitdej = " ";
			$pticola = " ";
			$dej = " ";
			$gouter = " ";
			$dinner = " ";
			$collasoir = " ";
			$objectif1 = " ";
			$objectif2 = " ";
			$objectif3 = " ";
			$objectif4 = " ";
			
			$numpatient = $_SESSION['numPatient'];
			
			// Préparation de la requête pour afficher les champs lié au plan alimentaire. 2*
			$Planalimentaire = $pdo->prepare('SELECT * FROM planalimentaire WHERE Numero_Client = ?');
			$ExecuteIsOK = $Planalimentaire->execute(array($numpatient));
			$Aliments = $Planalimentaire->FetchAll();
			foreach ($Aliments as $plan)
			{ 
				$ptitdej = $plan['PetitDejeuner'];
				$pticola = $plan['CollationMatin'];
				$dej = $plan['Dejeuner'];
				$gouter = $plan['Gouter'];
				$dinner = $plan['Dinner'];
				$collasoir = $plan['CollationSoir'];
			}

			// Préparation de la requête pour afficher les champs lié à l'objectif. 2*
			$PlanObjectif = $pdo->prepare('SELECT * FROM objectifs WHERE Numero_Client = ?');
			$ExecuteObjIsOK = $PlanObjectif->execute(array($numpatient));
			$Objectif = $PlanObjectif->FetchAll();
			foreach ($Objectif as $plan)
			{ 
				$objectif1 = $plan['Objectif_1'];
				$objectif2 = $plan['Objectif_2'];
				$objectif3 = $plan['Objectif_3'];
				$objectif4 = $plan['Objectif_4'];
			}

			// Préparation de la requête pour check si le numéro client existe. 1*
			$sth = $pdo->prepare('SELECT Numero_Client FROM comptepatient WHERE Numero_Client = ?');
			$sth->execute(array($numpatient));
			// Je test ma requête SQL 1*
			if ($sth->fetch(PDO::FETCH_ASSOC)) 
				{
?>

<html lang="fr-FR">

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="CSS/Styleheader.css" />
		<META NAME="robots" CONTENT="noindex,nofollow">
		<script src="test.js" async></script>
		<title>Tableau de bord</title>
	</head>
					
	<body>
					
		<?php include 'header.php'; ?>
		<section>

			<div id="Planalim"> 
			
				<table class="PlanView">
					<caption>Plan actuel</caption>
					<tr>
						<td><strong>Petit déjeuner </strong>:</td>
						<td><?php echo $ptitdej;?></td>
					</tr>
					<tr>
						<td><strong>Collation du Matin </strong>:</td>
						<td><?php echo $pticola;?></td>
					</tr>
					<tr>
						<td><strong>Déjeuner</strong> :</td>
						<td><?php echo $dej;?></td>
					</tr>
					<tr>
						<td><strong>Goûter</strong> :</td>
						<td><?php echo $gouter;?></td>
					</tr>
					<tr>
						<td><strong>Dinner</strong> :</td>
						<td><?php echo $dinner;?></td>
					</tr>
					<tr>
						<td><strong>Collation du Soir</strong> :</td>
						<td><?php echo $collasoir;?></td>
					</tr>
				</table>

				<div id="planajout">
					<h2> Pour ajout</h2>
					<form method="post" action="suivipatient2.php">
						<label for="text">Petit déjeuner :</label></br> 
						<input type="text" name="petitdej" id="petitdej" /></br></br>
						<label for="text">Collation du Matin :</label></br> 
						<input type="text" name="CollationMatin" id="CollationMatin" /></br></br>
						<label for="text">Déjeuner :</label></br> 
						<input type="text" name="Dejeuner" id="Dejeuner" /></br></br>
						<label for="text">Goûter :</label></br> 
						<input type="text" name="Gouter" id="Gouter" /></br></br>
						<label for="text">Dinner :</label></br> 
						<input type="text" name="Dinner" id="Dinner" /></br></br>
						<label for="text">Collation du Soir :</label></br> 
						<input type="text" name="CollationSoir" id="CollationSoir" /></br></br>
						<input type="submit" value="Envoyer" />
					</form>
				</div>
				
			</div>

			<div class="objectif">
			<table class="PlanObjectif">
					<caption>Objectif Actuel</caption>
					<tr>
						<td><strong>Objectif 1 </strong>:</td>
						<td><?php echo $objectif1;?></td>
					</tr>
					<tr>
						<td><strong>Objectif 2 </strong>:</td>
						<td><?php echo $objectif2;?></td>
					</tr>
					<tr>
						<td><strong>Objectif 3</strong> :</td>
						<td><?php echo $objectif3;?></td>
					</tr>
					<tr>
						<td><strong>Objectif 4</strong> :</td>
						<td><?php echo $objectif4;?></td>
					</tr>
				</table>

				<div id="Objectifajout">
					<h2> Pour ajout</h2>
					<form method="post" action="objectif.php">
						<label for="text">Objectif 1 :</label></br> 
						<input type="text" name="Obj1" id="Obj1" /></br></br>
						<label for="text">Objectif 2 :</label></br> 
						<input type="text" name="Obj2" id="Obj2" /></br></br>
						<label for="text">Objectif 3 :</label></br> 
						<input type="text" name="Obj3" id="Obj3" /></br></br>
						<label for="text">Objectif 4 :</label></br> 
						<input type="text" name="Obj4" id="Obj4" /></br></br>
						<input type="submit" value="Envoyer" />
					</form>
				</div>
				
			</div>
			
			
		</section>
		
		<?php include 'footer.php'; ?>
		
	</body>
	
</html>

<?php 			
				}	
			// Si le numéro patient n'existe pas, un message s'affiche.
			else
				{
					echo "<script> alert('Le Numéro client n'existe pas');</script>";
					header('Location: http://localhost/PageInternet/Tableau.php');
					exit;
				}
		}
	// Si ma Session OU ma variable "numpatient" est vide, retour sur al page d'acceuil.
	else 
		{
			echo "<script> alert('Le Numéro client n'existe pas');</script>";
			header('Location: http://localhost/PageInternet/Tableau.php');
			exit;
		}
?>