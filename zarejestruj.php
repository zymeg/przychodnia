<?php 
	session_start();
?>
<!doctype html>
<html>
<head>
	<?php 
	$dot = '.';
	require($dot.'/head.php');
	 ?>
	<title>Utwórz konto</title>
	
</head>
<body>
<?php require($dot.'/baner.php'); ?>

	<div class='register-panel'>
		<h1>Zarejestruj się</h1>
			
		<form action='skrypty/register.php' method='post'>
			<input type='text' name='mail' id='mail' placeholder='Podaj email' maxlength='100'>
			<?php 
		if(isset($_SESSION['mail_error'])){echo $_SESSION['mail_error']; unset($_SESSION['mail_error']);}?>
			<input type='text' name='imie' id='imie' placeholder='Podaj imię' maxlength='50'>
			<?php if(isset($_SESSION['imie_error'])){echo $_SESSION['imie_error']; unset($_SESSION['imie_error']);} ?>
			<input type='text' name='nazwisko' id='nazwisko' placeholder='Podaj nazwisko'maxlength='50'>
			<?php if(isset($_SESSION['nazwisko_error'])){echo $_SESSION['nazwisko_error']; unset($_SESSION['nazwisko_error']);}?>
			<input type='text' name='nr_tel' id='nr_tel' placeholder='Podaj numer telefonu' maxlength='11'>
			<?php if(isset($_SESSION['nr_tel_error'])){echo $_SESSION['nr_tel_error']; unset($_SESSION['nr_tel_error']);}?>
			<label for='data_urodzenia'>Podaj datę urodzenia:</label>
			<input type='date' name='data_urodzenia' id='data_urodzenia' placeholder='Podaj datę urodzenia' max='2002-12-31'>
			<?php if(isset($_SESSION['data_urodzenia_error'])){echo $_SESSION['data_urodzenia_error']; unset($_SESSION['data_urodzenia_error']);} ?>
			<input type='number' name='pesel' id='pesel' placeholder='Podaj pesel' maxlength='11'>
			<?php if(isset($_SESSION['pesel_error'])){echo $_SESSION['pesel_error']; unset($_SESSION['pesel_error']);}?>
			<input type='text' name='login' id='login' placeholder='Podaj login' maxlength='20'>
			<?php if(isset($_SESSION['login_error'])){echo $_SESSION['login_error']; unset($_SESSION['login_error']);}?>
			<input type='password' name='haslo' id='haslo' placeholder='Podaj haslo' maxlength='20'>
			<?php if(isset($_SESSION['haslo_error'])){echo $_SESSION['haslo_error']; unset($_SESSION['haslo_error']);}?>
			<input type='password' name='haslo2' id='haslo2' placeholder='Powtórz hasło' maxlength='20'>
			<?php if(isset($_SESSION['haslo2_error'])){echo $_SESSION['haslo2_error']; unset($_SESSION['haslo2_error']);}?>
			<input type='submit' name='submit' id='submit' value='Zarejestruj się'>
		
		</form>
		
	</div>



<?php require($dot.'/footer.php'); ?>
</body>
</html>