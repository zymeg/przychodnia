<?php
require('skrypty/conn.php');
		
$conn = new mysqli($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
    mysqli_set_charset($conn,"utf8");
    mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');

    for($i = 0; $i < 1000; $i ++){
        $start = strtotime("20 November 2019");
        $end = strtotime("22 July 2025");
        $timestamp = mt_rand($start, $end);
        $data = date("Y-m-d", $timestamp);
        $godzinaStart = rand(8, 22);
        $godzinaKoniec = rand(($godzinaStart+1), 23);
        $godzinaStart = $godzinaStart.':00:00';
        $godzinaKoniec = $godzinaKoniec.':00:00';
        $lekarz = rand(1, 10);

        if($conn->query("INSERT INTO Godziny(Data_lekarza, godzina_start, godzina_koniec, idlekarza) VALUES ('$data', '$godzinaStart', '$godzinaKoniec', $lekarz)")){
            echo 'dodano gituwa';
        }else{
            mysqli_error($conn);
        }
    }
}
?>