<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<?php 
	$galeria = 'active';
	$dot = '..';
	require($dot.'/head.php'); ?>
	<title>Przeglądaj galerię naszych zdjęć</title>


</head>
<body>
<?php require($dot.'/baner.php'); ?>

<div class="galeria">
	<h1>Galeria zdjęć</h1>
	<img src="../pliki/zdjecia_szpital/1.jpg" alt="Pierwsze zdjęcie" id='1'>
	<img src="../pliki/zdjecia_szpital/2.jpg" alt="Drugie zdjęcie" id='2'>
	<img src="../pliki/zdjecia_szpital/3.jpg" alt="Trzecie zdjęcie" id='3'>
	<img src="../pliki/zdjecia_szpital/4.jpg" alt="Czwarte zdjęcie" id='4'>
	<img src="../pliki/zdjecia_szpital/5.jpg" alt="Piąte zdjęcie" id='5'>
	<img src="../pliki/zdjecia_szpital/6.jpg" alt="Szóste zdjęcie" id='6'>
	<img src="../pliki/zdjecia_szpital/7.jpg" alt="Siódme zdjęcie" id='7'>
	<img src="../pliki/zdjecia_szpital/8.jpg" alt="Ósme zdjęcie" id='8'>
	<img src="../pliki/zdjecia_szpital/9.jpg" alt="Dziewiąte zdjęcie" id='9'>
	<img src="../pliki/zdjecia_szpital/10.jpg" alt="Dziesiąte zdjęcie" id='10'>
	<img src="../pliki/zdjecia_szpital/11.jpg" alt="Jedenaste zdjęcie" id='11'>
	<img src="../pliki/zdjecia_szpital/12.jpg" alt="Dwunaste zdjęcie" id='12'>

</div>
<div id="powiekszone" style='display: none'><i class="far fa-times-circle" id="zamknij"></i><i class="fas fa-arrow-left" id="lewo"></i><i class="fas fa-arrow-right" id="prawo"></i></div>

<?php require($dot.'/footer.php'); ?>
<script>
const images = document.getElementsByTagName('img');
const powiekszone = document.getElementById('powiekszone');

[...images].forEach(e => {
	e.addEventListener('click', el => {
		powiekszone.style.display = 'block';
		powiekszone.innerHTML = '<i class="far fa-times-circle" id="zamknij"></i>';
		if(el.path[0].attributes[2].value <= 1) powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo"></i>';
		powiekszone.innerHTML += el.path[0].outerHTML;
		if(el.path[0].attributes[2].value >= 12) powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo"></i>';

		
		
	});
});

powiekszone.addEventListener('mouseenter', () => {
	document.getElementById('lewo').addEventListener('click', ()=> {
		var zdjecie = powiekszone.getElementsByTagName('img')[0];
		
		zdjecie = zdjecie.id;
		
		zdjecie = parseInt(zdjecie) - 1;
		powiekszone.innerHTML = '<i class="far fa-times-circle" id="zamknij"></i>';
		if(zdjecie <= 1) powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo"></i>';
		powiekszone.innerHTML += `<img src="../pliki/zdjecia_szpital/${zdjecie}.jpg"  id="${zdjecie}">`;
		if(zdjecie >= 12) powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo"></i>';
		
	});

	document.getElementById('prawo').addEventListener('click', ()=> {
		var zdjecie = powiekszone.getElementsByTagName('img')[0];
		zdjecie = zdjecie.id;
		zdjecie = parseInt(zdjecie) + 1;

		powiekszone.innerHTML = '<i class="far fa-times-circle" id="zamknij"></i>';
		if(zdjecie <= 1) powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-left" id="lewo"></i>';
		powiekszone.innerHTML += `<img src="../pliki/zdjecia_szpital/${zdjecie}.jpg"  id="${zdjecie}">`;
		if(zdjecie >= 12) powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo" style="visibility: hidden"></i>';
		else powiekszone.innerHTML += '<i class="fas fa-arrow-right" id="prawo"></i>';
		
	});

	document.getElementById('zamknij').addEventListener('click', () => {
		powiekszone.style.display = 'none';
	});
});


</script>
</body>
</html>