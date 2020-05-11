<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<?php 
	$kontakt = 'active';
	$dot = '..';
	require($dot.'/head.php'); ?>
	<title>Kontakt z naszą przychodnią</title>

	
</head>
<body>
<?php require($dot.'/baner.php'); ?>
<div class='kontakt'>

<h1>Nasza placówka</h1>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2467.712767253006!2d19.366654516058436!3d51.79313567968311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471bb53984d79c49%3A0x1ee3309c4e47e515!2zRml6eWN6bmEgMTIsIDkxLTE2MyDFgcOzZMW6!5e0!3m2!1spl!2spl!4v1556052975616!5m2!1spl!2spl" height="450" frameborder="0" style="border:0; display: block; margin: 20px auto; width: 80%" allowfullscreen></iframe>
	
	<h2>Kiedy przyjmujemy?</h2>
		<ul style='list-style: none'>
			<li>pon – pt: 10:00-18:00</li>
			<li>sob: 8:00-14:00</li>
	</ul>
	<h2>Umów się na wizytę</h2>
		<ul style='list-style: none'>
			<li>Zadzwoń pod numer recepcji: 42 663 32 01</li>
			<li><a href='rejestracja.php' style='color: #0d7c37'><b>Umów się online!</b></a></li>
		</ul>


	<h2>Godziny otwarcia:</h2>
		<ul style='list-style: none'>
			<li>od pon. do pt. w godz. 7:00-20:00</li>
			<li>w sob. w godz. 8:00-14:00</li>
		</ul>
</div>


<?php require($dot.'/footer.php'); ?>
</body>
</html>