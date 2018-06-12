<?php
/*codes sortie
1:Message prêt pour envoi
2:Erreur de connexion
3:Erreur spam
*/
session_start();
function ecrire($id, $message){
	if(!isset($id)){
		return(2);
	}
	else{
		$db= new PDO ("mysql:host=localhost;dbname=Minecraft","root","root");
		$req=$db->prepare("SELECT pseudo FROM Users WHERE id=?");
		$req->execute(array($id));
		if($req->rowcount()==0){
			return(2);
		}
		$req=$db->query("SELECT id_user,UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(date) as temps FROM Messages WHERE 1 ORDER BY id DESC LIMIT 1");
		$verif=$req->fetch();
		if($verif['id_user']==$id and $verif['temps']<300 and $id !=2){
			return(3);
		}

		$req=$db->prepare("INSERT INTO Messages (Id_user,message,date) VALUES (?,?,NOW())");
		$req->execute(array($id,$message));
		return(1);
	}



}
header('Location: page2.php');

$_SESSION["ecrire"]=ecrire($_SESSION['sortie'][1],htmlspecialchars($_POST["message"]));