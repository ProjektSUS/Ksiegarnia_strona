<?php
    include_once 'Naglowek.php';
?>

<!---Wracanko UwU-->
<div id="przycisk_wracanka">
        <button onclick="history.back()" class="przycisk_powrotu"> << Powrót</button>
</div>

<!----Główna zawartość strony-->
        <div class="Zaloguj_sie">

        <div class="Zaloguj_sie_komunikat">
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "pustepola"){
                        echo "<p>Wypełnił wszystkie pola!</p>";
                    }
                    else if($_GET["error"] == "emailnieistnieje"){
                        echo "<p>Wprowadzony email jest niepoprawny</p>";
                    }
                    else if($_GET["error"] == "cosposzlonietak"){
                        echo "<p>Coś poszło nie tak. Spróbuj ponownie później</p>";
                    }
                    else if($_GET["error"] == "zlehaslo"){
                        echo "<p>Wprowadzone hasło jest nieprawidłowe</p>";
                    }
                }

            ?>
        </div>

            <h2 class="naglowek_logowanie">Zaloguj się</h2>
            <form action="Zalacznik/Logowanie.inc.php" method="post">
                <h4>E-mail</h4>
                    <input name="email" placeholder="E-mail" class="input_logowanie">
                <h4>Hasło</h4>
                    <input type="password" name="haslo" placeholder="Hasło" class="input_logowanie">
                
        </div>
        <div id="przycisk_centruj_sie">
                <button type="submit" name="submit" class="zatwierdz_logowanie">Zaloguj się</button>
            </form>
        </div>
        <div id="logowanie_przejscie">
            <h3>Nie masz konta? To żaden problem!</h3>
            <h4><a href="Rejestracja.php">Zarejestruj się za darmo!</a></h4>
        </div> 
        
        
    </div>        
</div>


<!----Stopka-->
<?php
    include 'Stopka.php';
?>