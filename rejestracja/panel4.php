<?php
$lekarz = $_GET['lekarz'];
$pacjent = $_GET['pacjent'];
$data_wizyty = $_GET['data_wizyty'];

$sql = 'SELECT godzina_start, godzina_koniec FROM godziny WHERE idlekarza = '.$lekarz.' AND data_lekarza = "'.$data_wizyty.'"';
$result = $conn->query($sql);

    
$row = $result->fetch_assoc();

$min = substr($row['godzina_start'], 0, 5);
$max = substr($row['godzina_koniec'], 0, 5);


echo<<<ENDL
<form action='$dot/wizyta.php' method='post' style='margin-top: 50px;'>
<input type='hidden' name='lekarz' value='$lekarz'>
<input type='hidden' name='pacjent' value='$pacjent'>
<input type='hidden' name='data_wizyty' value='$data_wizyty'>
<label for='godzina_wizyty' id='label_godzina_wizyty'>Wybierz godzinę wizyty:</label>
<input type='time' name='godzina_wizyty' id='godzina_wizyty' min='$min' max='$max' step='600'>
<input type='submit' name='wyslij' id='wyslij' value='Zarezerwuj'>
<span id='error'></span>
</form>
ENDL;
?>


<script>
var wyslij = document.getElementById('wyslij');
wyslij.setAttribute('disabled', 'disabled');
var godzina_wizyty = document.getElementById('godzina_wizyty');
godzina_wizyty.addEventListener('change', sprawdz_godzine);
var error = document.getElementById('error');



function sprawdz_godzine () {
	
	godzina = godzina_wizyty.value;
	

	<?php
		$sql = 'SELECT w.data_wizyty, w.godzina_wizyty FROM Wizyty w WHERE w.idlekarza = '.$lekarz.' AND w.data_wizyty = "'.$data_wizyty.'"';
		$result = $conn->query($sql);
		
		if($result->num_rows > 0 ){
			echo "if(";
			$row_count = $result->num_rows;
			for($i = 1; $i <= $row_count; $i++) {
				$row = $result->fetch_assoc();
				
				$godzina_wizyty = substr($row["godzina_wizyty"], 0, 5);
				if($i == $row_count) {
				echo 'godzina != "'.$godzina_wizyty.'")';
				}
				else echo 'godzina != "'.$godzina_wizyty.'" && ';
				
			}
			
			echo<<<ENDL
{
					wyslij.removeAttribute('disabled');
					error.innerHTML = '';
					
				} else{
					wyslij.setAttribute('disabled', 'disabled');
					error.innerHTML = 'Lekarz jest umówiony na tą godzinę';
				}
			
ENDL;
			
		}
		
		
		if($result->num_rows < 1) {
			echo<<<ENDL
				wyslij.removeAttribute('disabled');
				error.innerHTML = '';
				
ENDL;
				
		} 		
	
	?>
	
}
</script>