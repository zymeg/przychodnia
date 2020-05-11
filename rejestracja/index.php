<?php
session_start();
	
$dot = '..';
require($dot.'/skrypty/conn.php');

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else{
	mysqli_query($conn, 'SET NAMES utf8');
	mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');

}
	
?>
<!doctype html>
<html>
<head>
	<?php 
	$rejestracja_online = 'active';
	require($dot.'/head.php'); ?>
	<title>Umów się na wizytę online</title>
	
</head>
<body >
<?php require($dot.'/baner.php'); ?>

<div class='register-panel'>
	<h1>Umów się na wizytę</h1>

	<div class='przykladowe_daty'>
		Przykładowe Daty:
		<ul>
		<?php
		if(isset($_SESSION['lekarze2']) && !isset($_GET['button_dalej'])){
			for($i = 0; $i < 5; $i++){
				unset($_SESSION['lekarze'.$i]);
			}
		}

		if(!isset($_SESSION['lekarze2']) && isset($_SESSION['logged'])){
			$randomowa1 = rand(1, 1000);
			$randomowa2 = rand(1, 1000);
			$randomowa3 = rand(1, 1000);
			$randomowa4 = rand(1, 1000);
			$randomowa5 = rand(1, 1000);
			$result = $conn->query("SELECT g.id_godziny, l.Imie, l.Nazwisko, g.Data_lekarza FROM Lekarze l, Godziny g WHERE g.idlekarza = l.idlekarza AND (g.id_godziny = $randomowa1 OR g.id_godziny = $randomowa2 OR g.id_godziny = $randomowa3 OR g.id_godziny = $randomowa4 OR g.id_godziny = $randomowa5)");
			for($i = 0; $i < 5; $i++){
				$row = $result->fetch_assoc();
				$_SESSION['lekarze'.$i] = $row;

				echo '<li><i class="fas fa-user-md"></i> '.$row['Imie'].' '.$row['Nazwisko'].', <i class="far fa-calendar-alt"></i> '.$row['Data_lekarza'].'</li>';
			}
		}else if(isset($_SESSION['logged'])){
			for($i = 0; $i < 5; $i++){
				echo '<li><i class="fas fa-user-md"></i> '.$_SESSION['lekarze'.$i]['Imie'].' '.$_SESSION['lekarze'.$i]['Nazwisko'].', <i class="far fa-calendar-alt"></i> '.$_SESSION['lekarze'.$i]['Data_lekarza'].'</li>';
			}
		}else echo 'Musisz być zalogowany';
		?>
		</ul>

	</div>
<?php 
	if(!isset($_SESSION['logged'])){
		require('panel1.php');
	} else{
		$id_pacjenta = $_SESSION['id_pacjenta'];
		if(!isset($_GET['button_dalej']) && !isset($_GET['submit'])){
			require('panel2.php');
		}else if(isset($_GET['button_dalej']) && !isset($_GET['submit'])){
			require('panel3.php');
		}else {
			require('panel4.php');
		}
	}
					

?>
	
</div>
<?php require($dot.'/footer.php'); ?>
</body>
</html>