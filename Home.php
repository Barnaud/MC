<?php
session_start();
if(isset($_GET['deco']) and $_SESSION['sortie'][0] == 1){
	session_destroy();
	echo '<script type="text/javascript">location.reload()</script>';
}

?>
<head>
	<LINK href="style.css" rel="stylesheet" type="text/css">
	<META charset="utf-8"/>


</head>
<header>

<?php
if($_SESSION["sortie"][0] == 1){
	echo '<p id="connexion">'.$_SESSION["sortie"][2]."</p>";
	echo '<div id="deco"><a href="Home.php?deco=1"><img src="img/deco.png"/></a></div>';
}
else{
	echo "<p id='connexion'>Connexion</p>";
}

?>


<div id = 'logo'></div>

</header>
<nav>
	<p><a href="#">Etat du serveur</a></p>
	<p><a href="page2.php">Annonces</a></p>
	<p><a href="Rcon.php">Accès à la RCON</a></p>
</nav>
<section>
	<h1>État du serveur</h1>
	<h2>Liste des connexions</h2>
	<div id='query'>
	<?php
	include "query.php";
	?>
	</div>
</section>
<!-- Partie connexion --> 
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
</div>