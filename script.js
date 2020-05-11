var loginBtn = document.getElementById('zaloguj_button');

loginBtn.addEventListener('click', () => {
	loginBtn.style = 'display: none;';
	document.getElementById('zarejestruj_button').style = 'display: none;';
	document.getElementById('login_form').style = 'display: block;';	
});

document.getElementById('zaloguj_brak_konta').addEventListener('click', () => {
	document.getElementById("rejestracja_online").style = "display: none";
	document.getElementById("logowanie").style = "display: block";
});

