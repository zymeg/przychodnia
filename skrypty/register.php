<?php
	session_start();
	
	if(!isset($_POST['submit'])){
		header('Location: ../index.php');
		
	} else{		

		$mail = htmlentities($_POST['mail']);
		$imie = htmlentities(strtolower($_POST['imie']));
		$nazwisko = htmlentities(strtolower($_POST['nazwisko']));
		$nr_tel= htmlentities($_POST['nr_tel']);
		$data_urodzenia = htmlentities($_POST['data_urodzenia']);
		$pesel = htmlentities($_POST['pesel']);
		$login = htmlentities($_POST['login']);
		$haslo = htmlentities($_POST['haslo']);
		$haslo2 = htmlentities($_POST['haslo2']);

		
		if($mail != null && strlen($mail) <= 100 && strlen($mail)>5) {
			
		} else {
			$_SESSION['mail_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
			
		}
		
		if($imie != null && strlen($imie) > 0 && strlen($imie) <= 20){
			$imie = ucwords($imie);
			
		} else {
			$_SESSION['imie_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		
		if($nazwisko != null && strlen($nazwisko) > 0 && strlen($nazwisko) <= 20){
			$nazwisko = ucwords($nazwisko);
			
		} else {
			$_SESSION['nazwisko_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($nr_tel != null && strlen($nr_tel) > 8 && strlen($nr_tel) <= 9){
			
		} else {
			$_SESSION['nr_tel_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($data_urodzenia != null){
			
		} else {
			$_SESSION['data_urodzenia_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($pesel != null && strlen($pesel) != 10){
			
		} else {
			$_SESSION['pesel_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($login != null && strlen($login) > 6 && strlen($login) <= 20){
			
		} else {
			$_SESSION['login_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($haslo != null && strlen($haslo) > 6 && strlen($haslo) <= 20){
			
		} else {
			$_SESSION['haslo_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}
		
		if($haslo2 === $haslo){
			$haslo = PASSWORD_HASH($haslo, PASSWORD_DEFAULT);
			
		} else {
			$_SESSION['haslo2_error'] = '<span class="register_error">Niepoprawnie podane dane</span>';
			header('Location: ../zarejestruj.php');
		}

		
	if(!isset($_SESSION['mail_error']) && !isset($_SESSION['imie_error']) && !isset($_SESSION['nazwisko_error']) && !isset($_SESSION['nr_tel_error']) && !isset($_SESSION['data_urodzenia_error']) && !isset($_SESSION['pesel_error']) && !isset($_SESSION['login_error']) && !isset($_SESSION['haslo_error']) && !isset($_SESSION['haslo2_error'])){
		require('conn.php');
		
		$conn = new mysqli($server, $user, $password, $database);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else{
			mysqli_query($conn,'SET NAMES utf8');
			mysqli_query($conn,'SET CHARACTER_SET utf8_unicode_ci');
			
			$result = $conn->query("SELECT * FROM Pacjenci WHERE email = $mail");
			
			if($result->num_rows < 1){
				
			} else {
				$_SESSION['mail_error'] = '<span class="register_error">Podany mail już istnieje</span>';
				header('Location: ../zarejestruj.php');
			}
			
			$result = $conn->query("SELECT * FROM Pacjenci WHERE nr_tel = $nr_tel");
			
			if($result->num_rows < 1){
				
			} else {
				$_SESSION['nr_tel_error'] = '<span class="register_error">Podany numer telefonu już istnieje</span>';
				header('Location: ../zarejestruj.php');
			}
			
			$result = $conn->query("SELECT * FROM Pacjenci WHERE login = $login");
			
			if($result->num_rows < 1){
				
			} else {
				$_SESSION['login_error'] = '<span class="register_error">Podany login już istnieje</span>';
				header('Location: ../zarejestruj.php');	
			}
			
			$result = $conn->query("SELECT * FROM Pacjenci WHERE pesel = $pesel");
			
			if($result->num_rows < 1){
				
			} else {
				$_SESSION['pesel_error'] = '<span class="register_error">Podany pesel jest już zarejestrowany</span>';
				header('Location: ../zarejestruj.php');
			}
			
			if ($conn->query("INSERT INTO Pacjenci(Nazwisko, imie, login, haslo, email, nr_tel, Data_urodzenia, pesel) VALUES ('$nazwisko', '$imie', '$login', '$haslo', '$mail', '$nr_tel', '$data_urodzenia', '$pesel')") === TRUE) {
				$_SESSION['zarejestrowano'] = '<span class="zarejestrowano">Zarejestrowałeś się</span>';
			    header('Location: ../index.php');
			} else {
				header('Location: ../zarejestruj.php');
			}
			
			
			
			$conn->close();
			}
	} else {
		header('Location: ../zarejestruj.php');
		
	}	
	}


?>