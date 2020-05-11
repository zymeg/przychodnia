<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<?php 
  $dla_pacjenta = 'active';
  $dot = '..';
	require($dot.'/head.php'); ?>
	<title>Vademecum wiedzy pacjenta</title>

	
</head>
<body>
<?php require($dot.'/baner.php'); ?>
<div class='dla_pacjenta'>
  <div>
    <h1>O nas: </h1>
      <p>Jesteśmy przychodnią starającą się kompleksowo otoczyć opieką pacjentów z chorobami narządu ruchu, wymagających multidyscyplinarnego podejścia do swojego problemu.<p>

      <p>Nasza przychodnia oferuje pacjentom najbardziej profesjonalne podejście do pracy. Posiadamy najlepsze warunki jak i najlepszych lekarzy, którzy dbają o to by nasi pacjenci czuli się jak najlepiej pod ich opieką. </p>

      <p>Naszą misją jest kompleksowa pomoc pacjentowi w diagnostyce, skutecznym leczeniu i efektywnej rehabilitacji.</p>
  </div>
  <div>
    <h2>Nasi lekarze</h2>
      <?php 
        require($dot.'/skrypty/conn.php');

        $conn = new mysqli($server, $user, $password, $database);
        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } else{
          mysqli_query($conn, 'SET NAMES utf8');
          mysqli_query($conn, 'SET CHARACTER_SET utf8_unicode_ci');
        
          $result = $conn->query('SELECT DISTINCT l.Imie, l.Nazwisko, l.Data_urodzenia, l.NIP, l.NrEwid, s.NazwaSpecjalizacji FROM Lekarze l, Specjalizacje s WHERE l.idspecjalizacji = s.idspecjalizacji');
          

          $row_count = $result->num_rows;

          for($i = 0; $i < $row_count; $i++){
            $row = $result->fetch_assoc();
            echo '<h3><i class="fas fa-user-md"></i> '.$row['Imie'].' '.$row['Nazwisko'].', '.$row['NazwaSpecjalizacji'].'</h3>';
            echo '<h4><i class="fas fa-calendar-day"></i> '.$row['Data_urodzenia'].'</h4>';
            echo '<h4>NIP: '.$row['NIP'].'</h4><h4>Numer ewidencji: '.$row['NrEwid'].'</h4>';
            
          }

        }
      ?>
  </div>
  <div>
    <h2>Cennik naszych usług</h2>
      <table class="tg">
        <tr>
          <th class="tg-80o0"> MEDYCYNA SPORTOWA</th>
          <th class="tg-80o0">CENA </th>
        </tr>
        <tr>
          <td class="tg-84g4">LEKARZ MEDYCYNY SPORTOWEJ<br></td>
          <td class="tg-84g4">50 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">OKULISTA</td>
          <td class="tg-v8dz">50 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">LARYGOLOG</td>
          <td class="tg-v8dz">60 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-84g4">TEST WYSIŁKOWY NA CYKLOERGOMETRZE</td>
          <td class="tg-84g4">70 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">NEUROLOG</td>
          <td class="tg-v8dz">50 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">ZESTAW BADAŃ DODATKOWYCH</td>
          <td class="tg-v8dz">30 ZŁ</td>
        </tr>
      </table>
      <table class="tg">
        <tr>
          <th class="tg-80o0">REHABILITACJA</th>
          <th class="tg-80o0">CENA </th>
        </tr>
        <tr>
          <td class="tg-84g4">PIERWSZA SESJA REHABILITACYJNA<br></td>
          <td class="tg-84g4">150 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">TRENING PRIOPROCEPCJI</td>
          <td class="tg-v8dz">120 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">TRENINGZ WYKORZYSTANIEM EMG</td>
          <td class="tg-v8dz">90 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-84g4">IGŁOTERAPIA</td>
          <td class="tg-84g4">70 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">ĆWICZENIA INDYWIDULANE</td>
          <td class="tg-v8dz">80 ZŁ</td>
        </tr>
        <tr>
          <td class="tg-v8dz">TERAPIA MANUALNA</td>
          <td class="tg-v8dz">40 ZŁ</td>
        </tr>
      </table>
  </div>
</div>
<?php require($dot.'/footer.php'); ?>
</body>
</html>