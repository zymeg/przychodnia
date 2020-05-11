<?php
echo<<<ENDL
				
    <div id='rejestracja_online'>
        <h5>Aby umówić się na wizytę musisz być zalogowany: </h5>
        <button id='zaloguj_brak_konta''>Zaloguj się <i class="fas fa-sign-in-alt"></i></button>
        <h5>Nie masz jeszcze konta? </h5>
        <a href='$dot/zarejestruj.php'><button id='zarejestruj_brak_konta'>Zarejestruj się <i class="fas fa-user-plus"></i></button></a>

    </div>	
    <div id='logowanie' style='display: none'>
        <form action='$dot/skrypty/login.php' method='post'>
            <input type='text' name='login' placeholder='Podaj login' maxlength='20'>
            <input type='password' name='password' placeholder='Podaj Hasło' maxlegth='20'>
            <input type='submit' name='submit_login_form' value='Zaloguj'>
    
        </form>
        
    </div>
ENDL;

?>