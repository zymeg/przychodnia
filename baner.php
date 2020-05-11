<div id="navigation">
  <a href="<?php echo $dot; ?>/">
    <img id='banner' src='<?php echo $dot; ?>/pliki/logo_duze.png'>
  </a>
  <div>
    <span class='banner_span'><i class="fas fa-map-marker-alt"></i> Łódź ul. Fizyczna 12</span>
    <span class='banner_span'><i class="fas fa-phone-alt"></i> +42 663 32 01</span>

    <a class='social' href="https://www.facebook.pl">
      <i class="fab fa-facebook"></i>
    </a>
    <a class='social' href="https://www.instagram.com/zymeg">
      <i class="fab fa-instagram"></i>
    </a>
    <a class='social' href="https://www.twitter.com/zymeg">
    <i class="fab fa-twitter-square"></i>
    </a>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light"> 
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style='margin-left: 20px;'>
      <span class="navbar-toggler-icon"></span>
    </button>
    
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" style='font-weight: bold'>
        <li class="nav-item <?php if(isset($strona_glowna)) echo $strona_glowna;?>">
          <a class="nav-link" href="<?php echo $dot; ?>/">Strona Główna </a>
        </li>
        <li class="nav-item <?php if(isset($dla_pacjenta)) echo $dla_pacjenta;?>">
          <a class="nav-link" href="<?php echo $dot; ?>/dla_pacjenta/">Dla pacjenta</a>
        </li>
        <li class="nav-item <?php if(isset($galeria)) echo $galeria;?>">
          <a class="nav-link" href="<?php echo $dot; ?>/galeria/">Galeria</a>
        </li>
      <li class="nav-item <?php if(isset($kontakt)) echo $kontakt;?>">
          <a class="nav-link" href="<?php echo $dot; ?>/kontakt/">Kontakt</a>
        </li>
      <li class="nav-item <?php if(isset($rejestracja_online)) echo $rejestracja_online;?>">
          <a class="nav-link" href="<?php echo $dot; ?>/rejestracja/">Rejestracja online</a>
        </li>
      </ul>

    <?php
      if(!isset($_SESSION['logged'])){
        echo <<<END
          <button id='zaloguj_button'>Zaloguj się <i class="fas fa-sign-in-alt"></i></button>
            <a href='$dot/zarejestruj.php'><button id='zarejestruj_button'>Zarejestruj się <i class="fas fa-user-plus"></i></button></a>
          
          <form action='$dot/skrypty/login.php' method='post' id='login_form' style='display: none;'>
            <input type='text' name='login' placeholder='Podaj login' maxlength='20'>
            <input type='password' name='password' placeholder='Podaj Hasło' maxlegth='20'>
            <button type='submit' name='submit_login_form'>Zaloguj <i class="fas fa-sign-in-alt"></i></button>
            <a style='font-size: 1rem; font-weight: bold; display: block; letter-spacing: 1px; color: #262626' href='$dot/zarejestruj.php'>Nie masz konta?</a>
          </form>
END;
      } else if(isset($_SESSION['logged'])){
        echo '<a href="'.$dot.'/profile.php" id="logged_user"><i class="fas fa-user-circle"></i> '.$_SESSION['imie'].' '.$_SESSION['nazwisko'].'</a><a href="'.$dot.'/skrypty/logout.php"><button id="logout_button">Wyloguj się <i class="fas fa-door-open"></i> </button></a>';	
      }
  ?>
    </div>
  </nav>
</div>