<?php

if(isset($_POST["pseudo"]) AND isset($_POST["mdp"])){
	$db= new PDO("mysql:host=localhost;dbname=Minecraft","root","root");
	$req=$db->prepare("INSERT INTO Users (pseudo,mdp) VALUES(?,PASSWORD(?))");
	$req->execute(array($_POST["pseudo"],$_POST['mdp']));
}

?>


<form method="POST" action="Création.php">
	<label>pseudo:<label>
		<input name="pseudo"></input>
		<label>Mot de passe :</label>
	<input type="password" name = "mdp"/>
	<input type="submit"/>
</form>
