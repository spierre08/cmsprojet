<?php	
	//========== Coonexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=chatcms;charset=utf8","root","");
	}catch(PDOException $e){
		die("Erreur de connexion....");
	}
	//========== Variable de message d'erreur 
	$erreur = "";
      //========== Si on reçoit une requête de type POST
	
	if (isset($_POST["ajouter"])){
		$nom = htmlspecialchars($_POST["nom"]);
		$email = htmlspecialchars($_POST["email"]);
		$mdp = htmlspecialchars($_POST["mdp"]);
		//========= Vérifier si les champs ne sont pas vides
		if (!empty($nom) and !empty($email) and !empty($mdp)){
			//=== Vérifier l'existence de l'email dans la base de données
			$req = $pdo->prepare("SELECT email FROM utilisateur WHERE email=?");
			//=== Exécution de la requête
			$req -> execute(array($email));
			//=== Vérifier l'existence
			if ($req->rowCount() == 1){
				$erreur = "<p id='Erreur'>Cet email existe</p>";
			}else{
				//========== Crypter le mot mode passe
				$cryptage = password_hash($mdp,PASSWORD_DEFAULT);
				//========== Préparation de la requête d'insertion
				$insertion = $pdo->prepare("INSERT INTO utilisateur(nom,email,mot_de_passe,token) VALUES(?,?,?,?)");
				//========== Exécution de la requête
				$insertion->execute(array($nom,$email,$cryptage,NULL));
				//========== Redirection à la page de connexion
				header("Location:connexion.php");
			}
		}else{
			$erreur = "<p id='Erreur'>Complétez ces informations</p>";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS APP/Inscription</title>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
</head>
<body>
	<form action="<?= $_SERVER["PHP_SELF"] ?>" id="inscription" method="POST">
		<h1>Inscription</h1>
		<?php if (isset($erreur)) echo $erreur; ?>
		<input type="text" name="nom" id="nom" placeholder="Prénom et nom*">
		<input type="email" name="email" id="mail" placeholder="Adresse mail*">
		<input type="password" name="mdp" id="mdp" placeholder="Mot de passe*">
		<input type="submit" value="S'inscrire" name="ajouter" id="compte" >
		<p>Vous avez un compte ? <a href="connexion.php">Se connecter</a></p>
	</form>
</body>
</html>