<?php
session_start();

if(isset($_GET['deco']) and $_SESSION['sortie'][0] == 1){
	session_destroy();
	echo '<script type="text/javascript">location.reload();</script>';
}
if($_SESSION['sortie'][0] == 1){

	echo '<script type="text/javascript">var connecté = 1;</script>';
}
else{
	echo '<script type="text/javascript">var connecté = 0;</script>';
}

if($_SESSION["ecrire"]==2){
	$_SESSION["ecrire"] =0 ;
	echo '<script type="text/javascript">alert(\'Erreur liée à la connexion\');</script>';
}
elseif ($_SESSION["ecrire"]==3) {
	$_SESSION["ecrire"] =0; 
	echo '<script type="text/javascript">alert("Il est impossible de publier des messages trop fréquemment. Vous ne pouvez publier que cinq minutes après votre message précedent ou lorsque quelqu\'un d\'autre aura publié quelque-chose.");</script>';
}

?>
<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<META charset="utf-8"/>


</head>
<header>
<?php
if($_SESSION["sortie"][0] == 1){
	echo '<p id="connexion">'.$_SESSION["sortie"][2]."</p>";
	echo '<div id="deco"><a href="page2.php?deco=1"><img src="img/deco.png"/></a></div>';
}
else{
	echo "<p id='connexion'>Connexion</p>";
}

?>



<div id = 'logo'></div>

</header>
<nav>
	<p><a href="Home.php">Etat du serveur</a></p>
	<p><a href="#">Annonces</a></p>
	<p><a href="Rcon.php">Accès à la RCON</a></p>
</nav>
<section>
	<h1>Annonces</h1>

	<h2>Écrire quelque-chose</h2>
	<form action="Ecrire.php" method='POST'>
		<textarea name="message"></textarea>
		<input id= "submit" type="submit"/>
	</form>
	
	<h2>Derniers messages publiés</h2>
	<div id='query'>
	<?php
	include "message.php";
	?>

	</div>
</section>
<!-- Partie Connexion --> 
<div id = 'overlay'>
<div id = 'fond'></div>
<div id = 'formulaire'>
<h2 style="
    text-align: center;">
    Identification
</h2>
<form action = "Identification.php" method="POST">
	<label>Pseudo:</label>
	<input type="text" id="pseudo" name="pseudo"/>
	<label>Mot de passe :</label>
	<input type="password" name = "mdp"/>
<input type="submit"/>
</form>
</div>

</div>
<?php
if( $_SESSION["sortie"][0] !=1){
	echo "<script type=\"text/javascript\" src=\"connexion.js\"></script>";
}
else{
	echo "<script type=\"text/javascript\" src=\"deconnexion.js\"></script>";
}

?>

<!--Barre d'event-->
<?php
include("event.php");
?>

	<script type="text/javascript">
	if(connecté == 0){
		submit = document.getElementById("submit");
		submit.addEventListener('click',function(e)
			{
				e.preventDefault();
				alert("Connexion requise pour publier");
			},false);
	}

	</script>

<?php
if($_SESSION['sortie'][0]==2){
	echo'<script type="text/javascript">alert("Erreur interne... désolé :-(");</script>';
}
if($_SESSION['sortie'][0]==3){
	echo'<script type="text/javascript">alert("Le compte a été banni. Date de fin:'.$_SESSION['sortie'][1].'");</script>';
	session_destroy();
}
if($_SESSION['sortie'][0]==4){
	echo'<script type="text/javascript">
	alert("Nom de compte ou mot de passe incorrect");
	overlay.style.display = \'block\';
	input.focus();
	</script>';
	session_destroy();
}
?>