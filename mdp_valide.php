<?php
	//========== Démarrage de la session
	session_start();
	//========== Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=chatcms;charset=utf8","root","");
	}catch(PDOException $e){
		die("Erreur de connexion....");
	}
	//========== Variable de message d'erreur 
	$erreur = "";
	//========== Si on reçoit une requête de type POST
	if (isset($_POST["modifier"])){
		$nouveau = htmlspecialchars($_POST["nouveau"]);
		$confirmation = htmlspecialchars($_POST["confirmation"]);
		//=== Vérifier si les deux champs ne sont pas vides
		if (!empty($nouveau) and !empty($confirmation)){
			//======== Vérifier si les deux mots de passes ne sont pas conformes
			if ($nouveau != $confirmation){
				$erreur = "<p id='Erreur'>Les mots de passes sont différents</p>";
			}else{
				//=== Cryptage du mot de passe
				$crypter = password_hash($confirmation, PASSWORD_DEFAULT);
				//=== Préparation de la requête de mise à jour
				$req = $pdo->prepare("UPDATE utilisateur SET mot_de_passe=? WHERE email=? LIMIT 1");
				//=== Exécution de la requête de mise à jour
				$req->execute(array($crypter,$_SESSION["md_email"]));
				$_SESSION["succes"] = "Mot de passe changé avec succès";
				//=== Rédirection vers la page de connexion
				header("Location:connexion.php");
			}
		}else{
			$erreur = "<p id='Erreur'>Saisies obligatoires</p>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS APP/Nouveau mot de passe</title>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
</head>
<body>
	<form action="<?= $_SERVER["PHP_SELF"] ?>" id="inscription" method="POST">
		<h1>Modifier le mot de passe</h1>
		<?php if (isset($erreur)) echo $erreur; ?>
		<input type="password" name="nouveau" id="mail" placeholder="Nouveau mot de passe*">
		<input type="password" name="confirmation" id="confirmation" placeholder="Confirmer votre mot de passe*">
		<input type="submit" value="Modifier" name="modifier">
		<p>Retour connexion ! <a href="connexion.php">Cliquez ici</a></p>
	</form>
</body>
</html>