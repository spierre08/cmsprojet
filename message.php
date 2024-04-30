<?php
	//======== Démarrage de la session
	session_start();
	//========== Connexion à la base de données
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=chatcms;charset=utf8","root","");
	}catch(PDOException $e){
		die("Erreur de connexion....");
	}
?>
<?php
	//========= Requête d'affichage
	$affichage = $pdo->query("SELECT * FROM message");
	//========= Boucle de parcour
	if ($affichage->rowCount() == 0){
			echo "Aucun message";
	}else{
		while($affichages = $affichage->fetch()){ 
			if ($affichages["id_email"] == $_SESSION["email"]){ 
?>	
			<div class="message_send own_message">
				<span>Vous</span>
				<hr>
				<p><?= $affichages["contenu"] ?></p>
				<strong><?= $affichages["date_envoi"] ?></strong>
			</div>
		<?php }else{  ?>
			<div class="message_send your_message">
				<span><?= $affichages["id_email"] ?></span>
				<hr>
				<p><?= $affichages["contenu"] ?></p>
				<strong><?= $affichages["date_envoi"] ?></strong>
			</div> 
				
<?php			} 	
			
		} 
	}		
?>