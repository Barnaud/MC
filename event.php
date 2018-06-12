<link href="style.css" rel="stylesheet" type="text/css">

<?php
function event(){
	$db= new PDO("mysql:host=localhost;dbname=Minecraft",'root','root');
	$req=$db->query('SELECT nom,
CASE 
WHEN UNIX_TIMESTAMP(date)-UNIX_TIMESTAMP(now())<86400 THEN UNIX_TIMESTAMP(date)-UNIX_TIMESTAMP(now())
ELSE DAYOFWEEK(date)+100000
END as \'temps\'
FROM Event ORDER BY UNIX_TIMESTAMP(date) LIMIT 1');

	return($req->fetch());

}
var_dump(event());
?>
<div id="event">
	<p id="compteur"></p>
	<img src="Img/croix.svg" id="croix">
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
	var nom = "<?php echo event()["nom"];?>";
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
  compteur.innerHTML ="Prochain évènement: "+nom+ " dans " +digit(h)+" : "+digit(m)+" : "+digit(s);
  if(t<3600){
  	event.style.backgroundColor="rgb("+parseInt(255-(t*255/3600)).toString()+",130,"+parseInt(t*255/3600).toString()+")";
  }
  if(s ===0 && m===0 && h ===0){
    clearInterval(launch);
    console.log("C'est fini!");
  }
};
var jour = function(t){
	switch (new Date().getDay()) {
    case 0:
        day = "Dimanche";
        break;
    case 1:
        day = "Lundi";
        break;
    case 2:
        day = "Mardi";
        break;
    case 3:
        day = "Mercredi";
        break;
    case 4:
        day = "Jeudi";
        break;
    case 5:
        day = "Vendredi";
        break;
    case 6:
        day = "Samedi";
} 
return(day);
};
if(t!=0 && t<100000){
	var launch= setInterval(timer,1000);
}

else if (t !=0){
	console.log("oui");
	compteur.innerHTML= "Prochain event: "+ jour(t)+ " "+ nom;
}
else{
	compteur.innerHTML="Aucun évènement prévu.";
}

var digit = function(n){
  if(n<10){
    return("0"+n.toString());
  }
  return(n.toString());
};

</script>
</div>