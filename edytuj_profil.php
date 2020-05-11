<?php
	session_start();
	if(!isset($_SESSION['logged'])) header('Location: index.php');
	else if(!isset($_POST['submit_edycja'])) header('Location: profile.php');
	else {
		$id = $_POST['id'];
		$imie = $_SESSION['imie'];
		$nazwisko = $_SESSION['nazwisko'];
		$email = $_SESSION['email'];
		$nr_tel = $_SESSION['nr_tel'];
		$pesel = $_SESSION['pesel'];
		$data_urodzenia = $_SESSION['data_urodzenia'];
		
		if(!isset($_POST['submit_edycja'])){
			$mail = htmlentities($_POST['email']);
			$imie = htmlentities(ucwords(strtolower($_POST['imie'])));
			$nazwisko = htmlentities(ucwords(strtolower($_POST['nazwisko'])));
			$nr_tel= htmlentities($_POST['nr_tel']);
			$data_urodzenia = htmlentities($_POST['data_urodzenia']);
			$pesel = htmlentities($_POST['pesel']);	
			$haslo = htmlentities($_POST['haslo']);
			
			if($mail == '' || $imie == '' || $nazwisko == '' || $nr_tel == '' || $pesel == ''){
				$error = '<span class="error">Coś poszło nie tak</span>';
				
			} else {
				require('skrypty/conn.php');
			
				$conn = new mysqli($server, $user, $password, $database);
			
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} else{
					mysqli_query($conn, 'SET NAMES utf8');
					mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');
				
					if(strlen($haslo) > 4) {
						$haslo = PASSWORD_HASH($haslo, PASSWORD_DEFAULT);
						$sql = 'UPDATE pacjenci SET email = "'.$mail.'", imie = "'.$imie.'", nazwisko = "'.$nazwisko.'", nr_tel = "'.$nr_tel.'", data_urodzenia = "'.$data_urodzenia.'", pesel = "'.$pesel.'", haslo = "'.$haslo.'" WHERE idpacjenta = "'.$id.'"';
						if($conn->query($sql)){
							header('Location: profile.php');
							
						} else {
							$error = '<span class="error">Coś poszło nie tak</span>';;
							
						}
				
					}
					if(strlen($haslo) < 5) {
						$sql = 'UPDATE pacjenci SET email = "'.$mail.'", imie = "'.$imie.'", nazwisko = "'.$nazwisko.'", nr_tel = "'.$nr_tel.'", data_urodzenia = "'.$data_urodzenia.'", pesel = "'.$pesel.'" WHERE idpacjenta = "'.$id.'"';
						if($conn->query($sql)){
							header('Location: profile.php');
							
						} else {
							$error = '<span class="error">Coś poszło nie tak</span>';;
							
						}
				
					}
				}
			}
		}
	}	
?>
<!doctype html>
<html>
<head>
	<?php 
	require('head.html'); ?>
	<title>Edytuj swój profil</title>

	
</head>
<body>
<?php require('baner.php');?>

<div class='container-fluid'>
<div class='row'>
	<div class='content col-10 offset-1 register-panel'>
	<h2>Edytuj Profil</h2>
	
	<form action='#' method='post'>
		<input type='hidden'name='id' value='<?php echo $id; ?>'>
		<input type='text' name='imie' value='<?php echo $imie;?>' placeholder='Podaj imię'>
		<input type='text' name='nazwisko' value='<?php echo $nazwisko;?>' placeholder='Podaj nazwisko'>
		<input type='text' name='email' value='<?php echo $email;?>' placeholder='Podaj email'>
		<input type='number' name='nr_tel' value='<?php echo $nr_tel;?>' placeholder='Podaj nr telefonu'>
		<input type='text' name='pesel' value='<?php echo $pesel;?>' placeholder='Podaj pesel'>
		<input type='date' name='data_urodzenia' value='<?php echo $data_urodzenia;?>' placeholder='Zmień datę urodzenia'>
		<input type='password' name='haslo' placeholder='Podaj nowe hasło' minlength='5' maxlength='20'>
		<?php if(isset($error))echo $error; ?>
		<input type='submit' name='submit_edycja' value='Edytuj'>	
			
	</form>
	
	</div>
</div></div>
<?php require('footer.php'); ?>
</body>
</html>