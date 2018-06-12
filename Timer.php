<!DOCTYPE html>
<!--
Created using JS Bin
http://jsbin.com

Copyright (c) 2016 by Barnaud (http://jsbin.com/fecefugemi/1/edit)

Released under the MIT license: http://jsbin.mit-license.org
-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Timer</title>
</head>
<body>
  <p id="compteur" style="font-size: 300%;"></p>
  
  <script id="jsbin-javascript">
compteur = document.getElementById('compteur');
bip = document.getElementById("bip");
console.log(compteur);
t = <?php 
if(mktime(19,0,0)>time()){
	echo strval(mktime(19,0,0)-time());
}
else{
	echo '1';
}
?>;
var timer = function(){
  t--;
  bip.currentTime = 0;
  bip.play();
  var d = parseInt(t/86400);
  var h = parseInt((t-(86400*d))/3600);
  var m = parseInt((t-(d*86400)-(h*3600))/60);
  var s = t-((60*m)+(3600*h)+(86400*d));
  
  console.log([s,m,h,d]);
  compteur.innerHTML = digit(d)+" : "+digit(h)+" : "+digit(m)+" : "+digit(s);
  if(s ===0 && m===0 && h ===0 && d === 0){
    clearInterval(launch);
    console.log("C'est fini!");
  }
};
var launch= setInterval(timer,1000);

var digit = function(n){
  if(n<10){
    return("0"+n.toString());
  }
  return(n.toString());
};
</script>
</body>
</html>