<?php
	session_start();
	
	if(!isset($_POST['submit_login_form'])){
		header('Location: ../index.php');
	} else {
		$login = htmlentities($_POST['login']);
		$haslo = htmlentities($_POST['password']);
		require('conn.php');
		
		$conn = new mysqli($server, $user, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else{
			mysqli_set_charset($conn,"utf8");
			mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');

			$result = $conn->query("SELECT haslo FROM Pacjenci WHERE login = '$login'");
			$row = $result->fetch_assoc();
			$password = $row['haslo'];
		
			if(password_verify($haslo, $password)){
				
				$result = $conn->query("SELECT idPacjenta, nazwisko, imie, email, nr_tel, data_urodzenia, pesel FROM Pacjenci WHERE login = '$login'");
			 
				if($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$_SESSION['id_pacjenta'] = $row['idPacjenta'];
					$_SESSION['nazwisko'] = $row['nazwisko'];
					$_SESSION['imie'] = $row['imie'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['nr_tel'] = $row['nr_tel'];
					$_SESSION['data_urodzenia'] = $row['data_urodzenia'];
					$_SESSION['pesel'] = $row['pesel'];
					
					$_SESSION['logged'] = true;
					header('Location: ../profile.php');
				} else {

					$_SESSION['login_error'] = '<span class="logn_error">Niepoprawny login lub email';
					header('Location: ../index.php');
				
				}
			} else {
				$_SESSION['login_error'] = '<span class="logn_error">Niepoprawne haslo';
				header('Location: ../index.php');
				
			}
		}
	}

?>