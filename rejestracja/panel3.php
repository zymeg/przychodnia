<?php
$lekarz = $_GET['lekarz'];
$pacjent = $_GET['id_uzytkownika'];
$data = date('Y-m-d');
echo<<<ENDL
<form action='#' method='get' style='margin-top: 50px;'>
<input type='hidden' name='lekarz' value='$lekarz'>
<input type='hidden' name='pacjent' value='$pacjent'>
<label for='data_wizyty' id='label_data_wizyty'>Wybierz datę wizyty:</label>
<input type='date' name='data_wizyty' id='data_wizyty' min='$data'>
<input type='submit' name='submit' id='submit' value='Dalej'>
</form>
<span id='error'></span>
ENDL;
?>


<script>
var submit = document.getElementById('submit');
var data_wizyty = document.getElementById('data_wizyty');
data_wizyty.addEventListener('change', sprawdz_date);
submit.setAttribute('disabled', 'disabled');
var error = document.getElementById('error');

function sprawdz_date() {
	var lekarz = <?php echo $_GET['lekarz'];?>;
    
		<?php 
			$lekarz = $_GET['lekarz'];
			$sql = 'SELECT g.data_lekarza FROM Godziny g WHERE g.idlekarza = '.$lekarz;
			$result = $conn->query($sql);
			
			if($result->num_rows > 0 ){
				echo "if(";
				$row_count = $result->num_rows;
				for($i = 1; $i < $row_count; $i++) {
					$row = $result->fetch_assoc();
					
					
					if($i == ($row_count -1)) {
						echo 'data_wizyty.value == "'.$row["data_lekarza"].'")';
					}
					else echo 'data_wizyty.value == "'.$row["data_lekarza"].'" || ';
					
				}
				
				echo<<<ENDL
{
                    submit.removeAttribute('disabled');
					error.innerHTML = '';
						
					} else{
						submit.setAttribute('disabled', 'disabled');
						error.innerHTML = 'Lekarz nie przyjmuje tego dnia';
					}
				
ENDL;
				
			}
			
			
			if($result->num_rows < 1) {
				echo<<<ENDL
					error.innerHTML = 'Lekarz nie przyjmuje tego dnia';
				
ENDL;
				
			} 		
		
		?>

}

</script>