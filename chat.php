<?php
	//======== Démarrage de la session
	session_start();
	//========== Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=chatcms;charset=utf8","root","");
	}catch(PDOException $e){
		die("Erreur de connexion....");
	}
	//========== Si on reçoit une requête de type POST
	if (isset($_POST["envoyer"])){
		$contenu = htmlspecialchars($_POST["contenu"]);
		//======= Requête d'insertion
		$insertion = $pdo->prepare("INSERT INTO message(id_email,contenu,date_envoi) VALUES(?,?,NOW())");
		//======= Exécution de la requête
		$insertion->execute(array($_SESSION["email"],$contenu));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS APP/Chat</title>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
</head>
<body>

	<div class="container">
		<div class="profil">
			<?php
				if (!isset($_SESSION["email"])){
					header("Location:connexion.php");
				}
			?>
			<span><?= $_SESSION["email"] ?></span>
			<a href="deconnexion.php">Déconnexion</a>
		</div>
		<div class="message">
			<p id="chargement"><img style="text-align:center;" src="img/spinner.gif" alt="" width="40"></p>
		</div>
		<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
			<textarea name="contenu" id="" cols="30" rows="2" placeholder="Votre message"></textarea>
			<input type="submit" value="Envoyer" name="envoyer">
		</form>
		<!-- <span id="email">simonpierresagno08gmail.com</span> -->
	</div>
	
	<!-- ========== Code source Javascript ========= -->
	<script src="js/app.js"></script>
	
</body>
</html>