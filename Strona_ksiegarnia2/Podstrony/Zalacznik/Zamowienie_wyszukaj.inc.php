<?php
require_once 'db.inc.php';

$status = $_GET['zam'];

    $sql = "SELECT ID, Data_zlozenia, Cena_koncowa, StatusZam
    FROM zamowienie WHERE StatusZam = ?;";
    $stmt = mysqli_stmt_init($mysqli);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $status);
    mysqli_stmt_execute($stmt);
    $cos = mysqli_stmt_get_result($stmt);

    while ($liczba_zamowien = mysqli_fetch_array($cos)) {
        echo '
            <p>Zamówienie numer: '.$liczba_zamowien['ID'].' z dnia: ' . $liczba_zamowien['Data_zlozenia'] . ', cena: ' . $liczba_zamowien['Cena_koncowa'] . ', status: ' . $liczba_zamowien['StatusZam'] . '</p>

            <ul>
                <nav class="menu_status_zamowienia">
                    <select id="zmien_status_zamowienia'.$liczba_zamowien['ID'].'">
                        <option value = "Nowe">Nowe</option>
                        <option value = "Zaksiegowane">Zaksięgowane</option>
                        <option value = "Wyslane">Wysłane</option>
                        <option value = "Anulowane">Anulowane</option>
                    </select>
                </nav>
            </ul>

        <button id = "numer_zamowionka'.$liczba_zamowien['ID'].'" value = "'.$liczba_zamowien['ID'].'" onclick="zmienianie_zamowien(this.value); return false;">Zmień status</button>
        ';
        echo '
        <div class = "tabelaKsiazki_div">
            <table class = "tabelaKsiazki">
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
        </div>
        <span class = "zamowienia_info">
        <b>Zamówienie dla:</b>';
        
        $query3 = "SELECT czyt.Imie, czyt.Nazwisko, czyt.Kod_pocztowy, czyt.Miejscowosc, czyt.Adres, czyt.Telefon 
                FROM czytelnik as czyt 
                INNER JOIN zamowienie as zam ON zam.ID_czytelnik = czyt.ID 
                WHERE zam.ID = $idZamowionka;";
        $cos3 = mysqli_query($mysqli, $query3);

        while ($dane_czytelnika = mysqli_fetch_array($cos3)) {
            echo '
            <table class = "dane_zamawiajacego">
                <tr>
                    <td><b>Imie</b></td>
                    <td><b>Nazwisko</b></td>
                    <td><b>Adres</b></td>
                    <td><b>Kod pocztowy</b></td>
                    <td><b>Miejscowość</b></td>
                    <td><b>Nr. telefonu</b></td>
                </tr>
                <tr>
                    <td>' . $dane_czytelnika['Imie'] . '</td>
                    <td>' . $dane_czytelnika['Nazwisko'] . '</td>
                    <td>' . $dane_czytelnika['Adres'] . '</td>
                    <td>' . $dane_czytelnika['Kod_pocztowy'] . '</td>
                    <td>' . $dane_czytelnika['Miejscowosc'] . '</td>
                    <td>' . $dane_czytelnika['Telefon'] . '</td>
                </tr>
            </table>
            <hr>
                ';
        }

        echo '</span>
       
        ';

    }