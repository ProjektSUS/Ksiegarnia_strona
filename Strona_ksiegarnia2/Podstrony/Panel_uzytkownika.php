<?php
include_once 'Naglowek.php';
?>

<script src="../Js/przekaz_danych.js"></script>

<!----Główna zawartość strony-->

<div class="zawartosc_panel">
    <div class="menu_lewo">
        <ul>
            <h3>Dane użytkownika</h3>
            <ul>
                <li><a href="Panel_uzytkownika.php">Dane</a></li>

            </ul>
            <h3>Moje konto</h3>
            <ul>
                <li><a href="Zalogowany/Zamowienia.php">Zamówienia</a></li>
                <li><a href="Zalogowany/Ulubione.php">Ulubione</a></li>
            </ul>

            <?php
            $idUz = $_SESSION['uID'];
            $uTyp = $_SESSION["uTyp"];
            
            if ($uTyp === "Admin") {
                echo "<h3>Panel admina</h3>
                        <ul>
                            <li><a href='Zalogowany/Menadzer_kategorii.php'>Menadżer kategorii</a></li>
                            <li><a href='Zalogowany/Menadzer_ksiazek.php'>Menadżer książek</a></li>
                            <li><a href='Zalogowany/Menadzer_zamowien.php'>Menadżer zamówień</a></li>
                            <li><a href='Zalogowany/Menadzer_znizek.php'>Menadżer zniżek</a></li>
                        </ul>";
            }
            ?>
        </ul>
    </div>

    <div class="menu_prawo">
        <h2> Moje dane </h2>

        <div class="panel_moje_dane">
            <?php

            $idUz = $_SESSION['uID'];
            $uzytkownik = mysqli_query($mysqli, "SELECT * FROM czytelnik WHERE id = $idUz;");
            $res = mysqli_fetch_array($uzytkownik);
            echo '

            <div class = "div_dane_wysylkowe">
                <form method = "POST" action = "Zalacznik/Edytowanie.inc.php?uID=' . $idUz . '">
                    <div class = "panel_dane">
                        <h3><b>Imię: </b></h3>
                        <input type = "text" id = "dane_imie" name = "dane_imie" value = "' . $res['Imie'] . '" disabled>
                    </div>

                    <div class = "panel_dane">
                        <h3><b>Nazwisko: </b></h3>
                        <input type = "text" id = "dane_nazwisko" name = "dane_nazwisko" value = "' . $res['Nazwisko'] . '" disabled> 
                    </div>

                    <div class = "panel_dane">
                    <h3><b>Rok urodzenia: </b></h3>
                        <input type = "text" id = "dane_rok" name = "dane_rok" value = "' . $res['Rok_urodzenia'] . '" disabled>
                    </div>
                    
                    <div class = "panel_dane">
                        <h3><b>Adres: </b></h3>
                        <input type = "text" id = "dane_adres" name = "dane_adres" value = "' . $res['Adres'] . '" disabled>
                    </div>


                    <div class = "panel_dane">
                        <h3><b>Kod pocztowy: </b></h3>
                        <input type = "text" id = "dane_kodPocztowy" name = "dane_kodPocztowy" value = "' . $res['Kod_pocztowy'] . '" disabled>
                    </div>

                    <div class = "panel_dane">
                        <h3><b>Miejscowość: </b></h3>
                        <input type = "text" id = "dane_miejscowosc" name = "dane_miejscowosc" value = "' . $res['Miejscowosc'] . '" disabled>
                    </div>

                    <div class = "panel_dane">
                        <h3><b>Kraj: </b></h3>
                        <input type = "text" id = "dane_kraj" name = "dane_kraj" value = "' . $res['Kraj'] . '" disabled>
                    </div>
                    
                    <div class = "panel_dane">
                        <h3><b>Telefon: </b></h3>
                        <input type = "text" id = "dane_Telefon" name = "dane_Telefon" value = "' . $res['Telefon'] . '" disabled>

                        <button type="button" id = "zmien_dane_wysylkowe" onclick = "odblokowanie_pol()">Zmień dane</button>

                        <button id = "zatwierdz_dane_wysylkowe" type = "submit">Zatwierdź dane</button>
                    </div>
                </form>
            </div>

        <hr>

        <div class = "dane_email">
            <form method = "POST" action = "Zalacznik/Edytowanie_email.inc.php?uID=' . $idUz . '">
                <div class = "panel_dane"><h3><b>E-mail: </b></h3>
                    <input type = "text" id = "dane_email" name = "dane_email" value = "'. $res['Mail'] . '" disabled>

                
                    <button type="button" id = "zmien_dane_email" onclick = "odblokowanie_polEmail()">Zmień dane</button>
                    <button id = "zatwierdz_dane_email" type = "submit">Zatwierdź dane</button>
                </div>
            </form>
        </div>
        
        <hr>
    
        <div class = "dane_haslo">
            <form method = "POST" action = "Zalacznik/Edytowanie_hasla.inc.php?uID=' . $idUz . '">
                <div class = "panel_dane"><h3><b>Haslo: </b></h3>
                <input type = "password" id = "dane_haslo" name = "dane_haslo"  required disabled>
                </div>

                <h3><b>Powtórz hasło: </b></h3>
                <input type = "password" id = "dane_hasloPowtorz" name = "dane_hasloPowtorz" required disabled>
                            
                <button type="button" id = "zmien_dane_haslo" onclick = "odblokowanie_polHaslo()">Zmień dane</button>
                <button id = "zatwierdz_dane_haslo" type = "submit">Zatwierdź dane</button>
            </form> 
        </div>  
            ';
            if(isset($_GET["error"])){
                if($_GET["error"] == "RozneHasla"){
                    echo "<p>Wprowadzone hasła nie są takie same!</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

</div>
</div>


<!----Stopka-->
<?php
include 'Stopka.php';
?>