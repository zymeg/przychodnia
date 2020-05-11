<?php
	session_start();
	if(!isset($_SESSION['logged'])) header('Location: index.php');
	else {
		$dot = '.';
		require($dot.'/skrypty/conn.php');
		
		$conn = new mysqli($server, $user, $password, $database);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else{
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');
		
			if(isset($_POST['usun_wizyte']) && isset($_SESSION['usuniecie'])){
				$id_wizyty = $_POST['id_wizyty'];
				$conn->query("DELETE FROM Wizyty WHERE idwizyty ='$id_wizyty'");
				unset($_POST['usun_wizyte']);
				unset($_POST['id_wizyty']);
				unset($_SESSION['usuniecie']);
				
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php 
	require($dot.'/head.php'); ?>
	<title>Przeglądaj swój profil</title>

	
</head>
<body>
<?php require($dot.'/baner.php');
	$id = $_SESSION['id_pacjenta'];
	$imie = $_SESSION['imie'];
	$nazwisko = $_SESSION['nazwisko'];
	$email = $_SESSION['email'];
	$nr_tel = $_SESSION['nr_tel'];
	$pesel = $_SESSION['pesel'];
	$data_urodzenia = $_SESSION['data_urodzenia'];
	?>
<div class="profil_pacjenta">	
	<div class='profile-panel' style='display: inline-block'>
		<h1>Dane pacjenta: </h1>
		<ul style='list-style: none'>
			<li><i class="far fa-id-card"></i> <?php echo $imie.' '.$nazwisko; ?>,</li>
			<li><i class="fas fa-phone-alt"></i>  <?php echo $nr_tel?>,</li>
			<li><i class="fas fa-fingerprint"></i> <?php echo $pesel?>,</li>
			<li><i class="fas fa-calendar-day"></i> <?php echo $data_urodzenia?>,</li>
			<li><i class="far fa-envelope"></i> <?php echo $email; ?></li>
		</ul>
		<form method='post' action='edytuj_profil.php' style='text-align: center;'>
			<input type='hidden' name='id' value='<?php echo $id; ?>'>
			<input type='submit' name='submit_edycja' value='Edytuj dane!'>
		</form>
	
	</div>
	
	<div class='wizyty'>
	<?php 
	$id = $_SESSION['id_pacjenta'];
	$result = $conn->query("Select w.idwizyty, w.idlekarza, w.idpacjenta, w.data_wizyty, w.godzina_wizyty, l.imie, l.nazwisko from lekarze l, wizyty w where idpacjenta = $id and l.idlekarza = w.idlekarza");
	if($result->num_rows < 1) {
		echo '<h4>Brak zaplanowanych wizyt</h4>'; 
		
	} else{
		echo '<h2>Zaplanowane wizyty: </h2>';
		$row_count = $result->num_rows;
		 for($i = 0; $i < $row_count; $i++) {
			$row = $result->fetch_assoc();
			$id_wizyty = $row['idwizyty'];
			$lekarz_dane = $row['imie'].' '.$row['nazwisko'];
			$data = $row['data_wizyty'];
			$godzina = substr($row['godzina_wizyty'], 0, 5);
			
			echo<<<ENDL
				<h5 style='margin-top: 20px;'><i class="far fa-calendar-alt"></i> $data</h5>
				<h6><i class="far fa-clock"></i> $godzina</h6>
				<span><i class="fas fa-user-md"></i> $lekarz_dane</span>
				<form action='#' method='post' style='text-align: center;'>
					<input type='hidden' name='id_wizyty' value='$id_wizyty'></input>
					<input type='submit' name='usun_wizyte' id='usun_wizyte' value='Usuń' onclick='var potwierdzenie = confirm("Czy napewno chcesz usunąć wizytę?"); if(potwierdzenie == true) {
ENDL;
$_SESSION['usuniecie']	= true;
			echo<<<ENDL
					}'>
				
				</form>
		 
ENDL;
		 }
	}
	
	?>
	
	</div>
</div>	

<?php require($dot.'/footer.php'); ?>
</body>
</html>