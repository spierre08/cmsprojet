<?php
	//======= Demarrage de la session
	session_start();
	//======= Iniatiliser la session à 0
	session_unset();
	//======= Détruire la session
	session_destroy();
	//======= Rédirection sur la page de connexion
	header("Location:connexion.php");