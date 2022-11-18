<?php
include_once 'Naglowek_zal.php';
?>

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

    <div class="menu_prawo">
        <h3> Zamówienia </h3>

                <?php

                $query = "SELECT ID, Data_zlozenia, Cena_koncowa, StatusZam
                        FROM zamowienie 
                        WHERE ID_czytelnik = $idUz;";
                $cos = mysqli_query($mysqli, $query);
                
                while ($liczba_zamowien = mysqli_fetch_array($cos)){
                    echo '
                    <p>Zamówienie numer: '.$liczba_zamowien['ID'].' z dnia: '.$liczba_zamowien['Data_zlozenia'].', cena: '.$liczba_zamowien['Cena_koncowa'].', status: '.$liczba_zamowien['StatusZam'].'</p>
                    
                    <table>
                    <tr>
                        <td colspan = "2">Książka</td>
                        <td>Ilość</td>
                        <td>Cena za sztukę</td>
                    </tr>
                    ';
                    
                    $idZamowionka = $liczba_zamowien['ID'];

                    $query2 = "SELECT zk.Ilosc, ks.Tytul, ks.Zdjecie, ks.Cena
                    FROM zamowienie_ksiazka as zk
                    INNER JOIN ksiazka as ks ON zk.ID_ksiazka = ks.ID
                    WHERE ID_zamowienie = $idZamowionka;";
                    $cos2 = mysqli_query($mysqli, $query2);

                    while ($zamowienie = mysqli_fetch_array($cos2)) {
                        echo '
                    <tr>
                        <td><img src="data:image/jpeg;base64,' . base64_encode($zamowienie['Zdjecie']) . '" class = "zamowienie_zdjecie"></td>
                        <td>' . $zamowienie['Tytul'] . '</td>
                        <td>' . $zamowienie['Ilosc'] . '</td>
                        <td>' . $zamowienie['Cena'] . '</td>
                    </tr>
                    
                    ';
                    }
                    echo '</table>
                    <hr>';
                }

                ?>



            
    </div>
</div>

</div>
</div>


<!----Stopka-->
<?php
include 'Stopka_zal.php';
?>