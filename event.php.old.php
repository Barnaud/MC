<link href="style.css" rel="stylesheet" type="text/css">

<?php
function event(){
	$db= new PDO("mysql:host=localhost;dbname=Minecraft",'root','root');
	$req=$db->query('SELECT nom,UNIX_TIMESTAMP(date)-UNIX_TIMESTAMP(NOW()) as temps FROM Event WHERE date>NOW() and UNIX_TIMESTAMP(date)-UNIX_TIMESTAMP(NOW())<86400 ORDER BY date LIMIT 1');
	return($req->fetch());

}

?>
<div id="event">
	<p id="compteur"></p>
	<img src="img/croix.svg" id="croix">
	<script type="text/javascript">
	var croix=document.getElementById("croix");
	var event = document.getElementById('event');
	croix.addEventListener('click', function(){
		event.style.display = "none";
	})
	</script>
	<script type="text/javascript">
	var compteur = document.getElementById("compteur");
	var event = document.getElementById("event");
	var t=<?php 
	if(event()!=FALSE){
	echo event()["temps"];
	
	}
	else{
		echo 0;
	}
	?>;
	
	console.log(t);
	var timer = function(){
  t--;
  
  
  var h = parseInt(t/3600);
  var m = parseInt((t-(h*3600))/60);
  var s = t-((60*m)+(3600*h));
  
  console.log([s,m,h]);
  compteur.innerHTML ="Prochain évènement: "+'<?php echo event()["nom"];?>'+ " dans " +digit(h)+" : "+digit(m)+" : "+digit(s);
  if(t<3600){
  	event.style.backgroundColor="rgb("+parseInt(255-(t*255/3600)).toString()+",130,"+parseInt(t*255/3600).toString()+")";
  }
  if(s ===0 && m===0 && h ===0){
    clearInterval(launch);
    console.log("C'est fini!");
  }
};
if(t!=0){
	var launch= setInterval(timer,1000);
}
else{
	compteur.innerHTML="Aucun évènement prévu."
}

var digit = function(n){
  if(n<10){
    return("0"+n.toString());
  }
  return(n.toString());
};
</script>
</div>