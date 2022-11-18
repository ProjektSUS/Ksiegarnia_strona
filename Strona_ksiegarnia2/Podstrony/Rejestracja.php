<?php
    include_once 'Naglowek.php';
?>

<!---Wracanko UwU-->
<div id="przycisk_wracanka">
        <button onclick="history.back()" class="przycisk_powrotu"> << Powrót</button>
</div>

<!----Główna zawartość strony-->
        <div class="Zarejestruj_sie">

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "pustepola"){
                    echo "<p>Wypełnił wszystkie pola oznaczone gwiazdką!</p>";
                }
                else if($_GET["error"] == "niepoprawnyEmail"){
                    echo "<p>Wprowadzony email jest niepoprawny</p>";
                }
                else if($_GET["error"] == "roznehasla"){
                    echo "<p>Wprowadzone hasła są różne</p>";
                }
                else if($_GET["error"] == "emailistnieje"){
                    echo "<p>Istnieje już konto z podanym e-mailem</p>";
                }   
                else if($_GET["error"] == "submitNieDziala"){
                    echo "<p>Coś poszło nie tak. Sporóbuj ponownie później</p>";
                }
                else if($_GET["error"] == "none"){
                    echo "<p>Wszystko się udało! Teraz możesz się zalogować</p>";
                }
            }
        ?>

            <h2 class="naglowek_logowanie">Zarejestruj się</h2>
                <form action="Zalacznik/Rejestracja.inc.php" method="post">
                    <h4>Imie*</h4>
                        <input name="Imie" placeholder="Imie" class="input_logowanie">
                    <h4>Nazwisko*</h4>
                        <input name="Nazwisko" placeholder="Nazwisko" class="input_logowanie">
                    <h4>Adres*</h4>    
                        <input name="Adres" placeholder="Adres" class="input_logowanie">
                    <h4>Kod pocztowy*</h4>    
                        <input name="Kod_pocztowy" placeholder="Kod_pocztowy" class="input_logowanie">
                    <h4>Miejscowość*</h4>    
                        <input name="Miejscowosc" placeholder="Miejscowość" class="input_logowanie">
                    <h4>Rok urodzenia</h4>
                        <input name="Rok_urodzenia" placeholder="Rok urodzenia" class="input_logowanie">
                    <h4>Numer telefonu*</h4>
                        <input name="Telefon" placeholder="Numer telefonu" class="input_logowanie">
                    <h4>Kraj*</h4>
                        <input name="Kraj" placeholder="Kraj pochodzenia" class="input_logowanie">
                    <h4>E-mail*</h4>
                        <input name="Mail" placeholder="E-mail" class="input_logowanie">
                    <h4>Hasło*</h4>
                        <input type="password" name="Haslo" placeholder="Haslo" class="input_logowanie">
                    <h4>Powtórz hasło*</h4>
                        <input type="password" name="Haslo_powtorz" placeholder="Powtórz haslo" class="input_logowanie">
        </div>

        <div id="przycisk_centruj_sie">
                <button type="submit" name="submit" class="zatwierdz_logowanie">Zarejestruj się</button>
            </form>
        </div>

            
    </div>        
</div>


<!----Stopka-->
<?php
    include 'Stopka.php';
?>