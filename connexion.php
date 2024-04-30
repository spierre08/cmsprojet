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
	if (isset($_POST["connexion"])){
		$email = htmlspecialchars($_POST["email"]);
		$mdp = htmlspecialchars($_POST["mdp"]);
		//========== Protection de l'email contre les injections sql
		$email = addslashes($email);
		//========== Vérifier si les champs ne sont pas vides
		if (!empty($email) and !empty($mdp)){
			//==== Préparation de la requête de selection
			$req = $pdo->prepare("SELECT * FROM utilisateur WHERE email=?");
			//==== Exécution de la requête
			$req->execute(array($email));
			//==== Vérifier l'authenticité
			if ($req->rowCount() > 0){
				$row = $req->fetch();
				//====== Vérifier si le mot passe est correcte
				if (password_verify($mdp,$row["mot_de_passe"])){
					$_SESSION["email"] = $email;
					//===== Détruire la session de message de modification du mot de passe
					unset($_SESSION["succes"]);
					//===== Redirection sur la page de chat
					header("Location:chat.php");
				}else{
					$erreur = "<p id='Erreur'>Mot de passe incorrecte</p>";
				}
			}else{
				$erreur = "<p id='Erreur'>Email incorrecte</p>";
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
	<title>CMS APP/Connexion</title>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
</head>
<body>
	<form action="<?= $_SERVER["PHP_SELF"] ?>" id="inscription" method="POST">
		<h1>Authentification</h1>
		<?php if (isset($erreur)) echo $erreur; ?>
		<span id="Succes"><?php if (isset($_SESSION["succes"])) echo $_SESSION["succes"]; ?></span>
		<input type="email" name="email" id="mail" placeholder="Adresse mail*">
		<input type="password" name="mdp" id="mdp" placeholder="Mot de passe*">
		<input type="submit" value="Connexion" name="connexion">
		<p><a href="inscription.php">Créer un compte !</a></p>
		<p><a href="mdp_oublier.php">Mot de passe oublié ?</a></p>
	</form>
</body>
</html>