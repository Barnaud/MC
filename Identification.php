<?php
//codes de sortie:
/*
4:Erreur de mot de passe/login
1:Bon mot de passe (sortir ID et pseudo)
2:Erreur interne
3:Compte banni (sortir date_deban)



*/

session_start();
function identification($id,$mdp){

	$db= new PDO("mysql:host=localhost;dbname=Minecraft","root","root");
	$req=$db->prepare("SELECT id from Users WHERE pseudo=? AND mdp=PASSWORD(?)");
	$req->execute(array($id ,$mdp ));
	$nb=$req->rowcount();
	$id = $req->fetch()['id'];
	
	if($nb==1){
		$req=$db->prepare('SELECT id FROM Users WHERE date_deban>NOW() AND id=?');
		$req->execute(array($id));
		$nb=$req->fetch()['id'];
		if($nb==0){
			//La personne n'est pas bannie
			$req=$db->prepare("SELECT pseudo FROM Users WHERE id=?");
			$req->execute(array($id));
			$s=$req->fetch();
			$req=$db->prepare ("INSERT INTO log (id_user,date,ip) VALUES (?,NOW(),?)");
			$req->execute(array(intval($id),$_SERVER["REMOTE_ADDR"]));
			return(array(1,intval($id),$s["pseudo"]));
		}
		else{
			//La personne est bannie
			$req=$db->prepare("SELECT date_deban FROM Users WHERE id=?");
			$req->execute(array($id));
			return(array(3,$req->fetch()["date_deban"]));
		}
	}
	elseif ($nb==0) {
		return(array(4));
	}
	else{
		return(array(2));
	}
	
	

}
header('Location: page2.php');
$_SESSION["sortie"]=identification(htmlspecialchars($_POST["pseudo"]),htmlspecialchars($_POST["mdp"]));


?>