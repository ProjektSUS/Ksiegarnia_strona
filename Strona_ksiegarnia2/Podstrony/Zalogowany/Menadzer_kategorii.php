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
        <h2> Menadżer kategorii </h2>
        <div class = "menu_prawo_dodawanie">
            

            <h3>Dodawanie nowej kategorii</h3>
            <form method = "POST" action = "../Zalacznik/Dodawanie_kategorii.inc.php">
                <input type = "text" name = "dodaj_kategorie">
                <button type="submit" class = "dodaj_kategorie">Dodaj pozycję</button>
            </form>

            <?php
                    if (isset($_GET['error'])) {
                        echo '<div id="babel">';
                        if ($_GET['error'] == 'IstniejeKategoria') {
                            echo 'Kategoria o podanej nazwie istnieje już w systemie!';
                        }
                        echo '</div>';
                    }
                ?>

        </div>
        <div class = "menu_prawo_wyswietlania">
            <h3>Wyświetlanie wszystkich kategorii</h3>

            <br>
                <p>*Usuwanie kategorii jest możliwe tylko w sytuacji, gdy żadna książka nie jest przypisana do niej!</p>
            <br>
            
            <table class="tabelka_kategorie">
                <tr>
                    <th>Nazwa kategorii</th>
                    <th>Liczba sztuk</th>
                    <th>Usuń*</th>
                </tr>
                <!---Wczytaj i wyświetl wszystkie kategorie-->
                <?php
                $id_czytelnika = $_SESSION["uID"];
                $query = "SELECT * FROM kategoria ORDER BY Nazwa ASC;";
                $cos = mysqli_query($mysqli, $query);

                while ($wynik = mysqli_fetch_array($cos)) {
                    $dane = $wynik['ID'];
                    $query = "SELECT COUNT(ID_kategoria) FROM ksiazka where ID_kategoria = $dane;";
                    $ilosc = mysqli_query($mysqli, $query);
                    $ilosc_ksiazek = mysqli_fetch_array($ilosc);

                    echo
                    '
                    <tr>
                        <td>' . $wynik['Nazwa'] . '</td>
                        <td>'.$ilosc_ksiazek['COUNT(ID_kategoria)'].'</td>
                        <td>';
                        
                        if($ilosc_ksiazek['COUNT(ID_kategoria)'] == 0){
                            
                        echo'
                            <form method = "POST" action = "../Zalacznik/Usuwanie_kategorii.inc.php">
                                <input type = "hidden" name = "usun_kategorie" value = "'.$dane.'">
                                <button type="submit" class = "usun_kategorie">Usuń pozycję</button>
                            </form>
                            ';
                        }
                    echo'</td></tr>';
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