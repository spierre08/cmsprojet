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
	if (isset($_POST["envoyer"])){
		$email = htmlspecialchars($_POST["email"]);
		//========== Vérifier si le champ n'est pas vide
		if(!empty($email)){
			//==== Préparation de la requête de selection
			$req = $pdo->prepare("SELECT * FROM utilisateur WHERE email=?");
			//==== Exécution de la requête
			$req->execute(array($email));
			//==== Vérification de l'authenticité
			if ($req->rowCount() > 0){
				$_SESSION["md_email"] = $email;
				//======= Redirection vers la page de modification
				header("Location:mdp_valide.php");
			}else{
				$erreur = "<p id='Erreur'>Email incorrecte</p>";
			}
		}else{
			$erreur = "<p id='Erreur'>Entrez votre email</p>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS APP/Mot de passe oublié</title>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
</head>
<body>
	<form action="<?= $_SERVER["PHP_SELF"] ?>" id="inscription" method="POST">
		<h1>Mot de passe oublié</h1>
		<?php if (isset($erreur)) echo $erreur; ?>
		<input type="email" name="email" id="mail" placeholder="Adresse mail*">
		<input type="submit" value="Envoyer" name="envoyer">
		<p>Retour connexion ! <a href="connexion.php">Cliquez ici</a></p>
	</form>
</body>
</html>