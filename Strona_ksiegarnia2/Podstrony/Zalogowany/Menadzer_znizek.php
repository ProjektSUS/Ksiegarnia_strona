<?php
include_once 'Naglowek_zal.php';

?>

<script src="../../Js/funkcje.js"></script>

<!----Główna zawartość strony-->
<div class="zawartosc_panel">
    <div class="menu_lewo">
        <ul>
            <h3>Dane użytkownika</h3>
            <ul>
                <li><a href="../Panel_uzytkownika.php">Dane</a></li>

            </ul>
            <h3>Moje konto</h3>
            <ul>
                <li><a href="Zamowienia.php">Zamówienia</a></li>
                <li><a href="Ulubione.php">Ulubione</a></li>
            </ul>

            <?php
            $idUz = $_SESSION['uID'];
            $uTyp = $_SESSION["uTyp"];

            if ($uTyp === "Admin") {
                echo "<h3>Panel admina</h3>
                    <ul>
                        <li><a href='Menadzer_kategorii.php'>Menadżer kategorii</a></li>
                        <li><a href='Menadzer_ksiazek.php'>Menadżer książek</a></li>
                        <li><a href='Menadzer_zamowien.php'>Menadżer zamówień</a></li>
                        <li><a href='Menadzer_znizek.php'>Menadżer zniżek</a></li>
                    </ul>";
            }
            ?>
        </ul>
    </div>

    <div class="menu_prawa_strona">

    <h2>Menadżer zniżek</h2>
        <div class = "menu_prawo_dodawanie">
            
            <h3>Dodawanie nowej zniżki</h3>
            <p>*Dodawane zniżki dodają się z statusem "Nieaktywny". Skorzystaj z menu poniżej, aby aktywować zniżkę</p>
                <?php
                    if (isset($_GET['znizka'])) {
                        echo '<div id="babel">';
                        if ($_GET['znizka'] == 'IstniejeZnizka') {
                            echo 'Zniżka o podanej nazwie istnieje już w systemie!';
                        }
                        if ($_GET['znizka'] == 'DodanoZnizke') {
                            echo 'Zniżka została dodana do bazy danych';
                        }
                        echo '</div>';
                    }
                ?>
            <div class = "dodawanko_znizek">
                <form method = "POST" action = "../Zalacznik/Dodawanie_znizki.inc.php">
                    <table>
                        <tr>
                            <td>Nazwa</td>
                            <td><input type = "text" name = "dodaj_znizke"></td>
                        </tr>
                    <tr>
                        <td>Wartość</td>
                        <td><input type = "number" min= "1" max ="99" name = "dodaj_wartosc"></td>
                    </tr>
                    </table>
                    <button type="submit" class = "dodaj_znizke">Dodaj zniżkę</button>
                    
                </form>
            </div>
        </div>
        <div class = "menu_prawo_wyswietlania">
            <h3>Wyświetlanie wszystkich zniżek</h3>
            <table class="tabelka_znizki">
                <tr>
                    <th>Nazwa</th>
                    <th>Wartość</th>
                    <th>Status</th>
                    <th>Modyfikacja</th>
                </tr>
                <!---Wczytaj i wyświetl wszystkie kategorie-->
            <?php
                $id_czytelnika = $_SESSION["uID"];
                $query = "SELECT * FROM rabat ORDER BY Nazwa_rabat ASC;";
                $cos = mysqli_query($mysqli, $query);

                while ($wynik = mysqli_fetch_array($cos)) {
                    $nazwaRabatu = $wynik['Nazwa_rabat'];
                    echo
                    '
                    <form method = "POST" action = "../Zalacznik/Modyfikacja_znizek.inc.php?nazwa='.$wynik['Nazwa_rabat'].'">
                        <tr>
                            <td>'.$wynik['Nazwa_rabat'] . '</td>
                            <td>'.$wynik['Wartosc'].'</td>
                            <td>'.$wynik['StatusZnizki'].'</td>
                            <td>
                                <button type="submit" class = "Dezaktywuj_Aktywuj">Modyfikuj</button>
                            </td>
                        </tr>
                    </form>';
                }

                ?>
            </table>

        </div>
    </div>
</div>
</div>
</div>


<!----Stopka-->
<?php
    include 'Stopka_zal.php';
?>