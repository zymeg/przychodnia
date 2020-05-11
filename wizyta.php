<?php
	session_start();
	for($i = 0; $i < 5; $i++){
		unset($_SESSION['lekarze'.$i]);
	}
	if(!isset($_POST['wyslij'])){
		header('Location: index.php');
		
	}else {
		$lekarz = $_POST['lekarz'];
		$pacjent = $_POST['pacjent'];
		$data_wizyty = $_POST['data_wizyty'];
		$godzina_wizyty = $_POST['godzina_wizyty'];
		
		require('skrypty/conn.php');
		
		$conn = new mysqli($server, $user, $password, $database);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else{
			mysqli_query($conn, 'SET NAMES utf8');
			mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');
			$sql = 'INSERT INTO Wizyty (idlekarza, idpacjenta, data_wizyty, godzina_wizyty) VALUES ("'.$lekarz.'", "'.$pacjent.'", "'.$data_wizyty.'", "'.$godzina_wizyty.'")';
			if($conn->query($sql) === TRUE) {
				$_SESSION['umowiony'] = 'Twoja wizyta została zarezerwowana';
				header('Location: profile.php');
				
			} else {
				$_SESSION['umowiony'] = 'Coś poszło nie tak, spróbuj jeszcze raz';
				header('Location: profile.php');
				
			}
		}
		
	}

?>