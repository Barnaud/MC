<?php


function lire($message,$user,$date){
	echo'<div id="message" style="
    padding: 10px;
    border-style: solid;
    display: inline-block;
    width: 60%;
    margin:20px;
    max-height: 200px;
	overflow: scroll;
">
<p style="margin-bottom:0px;"><strong>'.$user.' </strong>: '.$message.'</p><p style = "margin:0px;margin-left:30px;color:gray;font-size:small;">'.$date.'</p>
</div>';
}


function get(){
	try{
		$db=new PDO('mysql:host=localhost;dbname=Minecraft;charset=utf8','root','root');
		
	}
	catch(exception $e){
		echo 'Erreur interne :-(';

	}
	
	$req= $db->query('select Users.pseudo, Messages.message, Messages.date FROM Messages JOIN Users on Messages.id_user = Users.id ORDER BY Messages.id DESC LIMIT 5');
	while($rep = $req->fetch()){
		lire($rep['message'],$rep['pseudo'],$rep['date']);
		
	}

}
get();