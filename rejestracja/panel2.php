<?php
echo<<<ENDL
<form action='#' method='get' style='margin-top: 50px;'>
    <input type='hidden' name='id_uzytkownika' value='$id_pacjenta'>
    <select name='lekarz' id='lekarz'>
        <option value='none'>Wybierz lekarza</option>
ENDL;
$result = $conn->query("SELECT l.imie, l.nazwisko, l.idlekarza, l.idspecjalizacji, s.idspecjalizacji, s.nazwaspecjalizacji FROM Lekarze l, Specjalizacje s WHERE l.idspecjalizacji = s.idspecjalizacji");

if($result->num_rows < 1) {

} else{
    $row_count = $result->num_rows;
     for($i = 0; $i < $row_count; $i++) {
        $row = $result->fetch_assoc();
        $dane_lekarza = ucwords($row['nazwaspecjalizacji'].': '.$row['imie']. ' '.$row['nazwisko']);
                        
        echo '<option value="'.$row["idlekarza"].'">'.$dane_lekarza.'</option>';
        
 
     }
    }
echo<<<ENDL
    </select>
    <input type='submit' name='button_dalej' id='button_dalej' value='Dalej'>
    </form>

    <script>

var error = document.getElementById('error');
var lekarz = document.getElementById('lekarz');
var submit_dalej = document.getElementById('button_dalej');
lekarz.addEventListener('change', sprawdz_lekarz);
submit_dalej.setAttribute('disabled', 'disabled');


function sprawdz_lekarz() {
	if(lekarz.value != 'none'){
		submit_dalej.removeAttribute('disabled');
		
	} else {
		submit_dalej.setAttribute('disabled', 'disabled');
		
	}
	
}
</script>
ENDL;
?>