var bouton = document.getElementById('connexion');
var overlay = document.getElementById('overlay');
var fond = document.getElementById('fond');
var input = document.getElementById("pseudo");

bouton.addEventListener('click', function(){
overlay.style.display = 'block';
input.focus();

}, false);

fond.addEventListener('click',function(){
	overlay.style.display = 'none';
}, false);