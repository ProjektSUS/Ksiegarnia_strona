<?php
include_once 'Naglowek.php';
require_once 'Zalacznik/db.inc.php';
?>
    <script src="../Js/funkcje.js"></script>
<?php
if (!isset($_SESSION['uID'])) {
    header("location: ../Index.php");
}

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'ZlaIlosc') {
        echo '
            <script> alert("Zbyt mała ilość książek na stanie!"); </script>
        ';
    }

    if ($_GET['error'] == 'IloscSieNieZgadza') {
        $czytelnik = $_SESSION['uID'];
        $query5 = "SELECT ko.Ilosc as IloscKoszyk, ks.Tytul, ks.Ilosc as IloscKsiazka 
                    FROM koszyk as ko 
                    INNER JOIN ksiazka as ks ON ks.ID = ko.ID_ksiazka 
                    WHERE ID_czytelnik = $czytelnik AND ks.Ilosc < ko.Ilosc;";
        $cos5 = mysqli_query($mysqli, $query5);
        $j = 1;
        echo '
            <script>
            var wiadomosc = "Ups! Ktoś Cię ubiegł i kupił już książki:\n';
            while ($tytulKsiazka = mysqli_fetch_array($cos5)) {
                echo   $j .'. '. $tytulKsiazka['Tytul'].
                    '\nAktualna ilosć na stanie: '
                    . $tytulKsiazka['IloscKsiazka'] .
                    '\nUsuń książkę z koszyka i dodaj ją ponownie z poprawną ilością!';
                    $j = $j + 1;
                }

                echo ' ";
                alert(wiadomosc);
            </script>
        ';
    }
}

?>

<!----Główna zawartość strony-->

<div class="koszyk_produkty">

    <?php
        if (isset($_GET['info'])) {
            if ($_GET['info'] == 'UdaloSie') {
                ?>
                <div class = "ZlozoneZamowienieInfo">
                    <h2>Dziękujemy za złożenie zamówienia! </h2>
                    <br>
                    <h2>Dane do przelewu:</h2>
                    <p>Bank: ASDF</p>
                    <p>Numer rachunku: 12341231231313</p>

                    <br>
                    <p>Status swojego zamówienia, możesz sprawdzić na swoim profilu w zakładce "Zamówienia"</p>
                </div>
                <?php
            }
        }
        else{
    ?>
    <table class="tabela_koszyk">
        <tr class="tabela_koszyk_naglowek">
            <td colspan="2"><b>Książka</b></td>
            <td><b>Ilość</b></td>
            <td><b>Cena za sztk</b></td>
            <td><b>Usuwanie</b></td>
        </tr>

        <?php
        $id_uzytkownik = $_SESSION['uID'];
        $query = "SELECT ks.ID, ks.Zdjecie, ks.Tytul, ks.Autor, ks.Cena, ko.Ilosc
                FROM koszyk as ko INNER JOIN ksiazka as ks ON ID_ksiazka = ks.ID
                WHERE ID_czytelnik = $id_uzytkownik;";
        $cos = mysqli_query($mysqli, $query);
        $liczba = 0;

        while ($produkt = mysqli_fetch_array($cos)) {
            $liczba = count($produkt);
            echo '<tr>
                        <td>
                            <img src="data:image/jpeg;base64,' . base64_encode($produkt['Zdjecie']) . '" class = "koszyk_zdjecie">
                        </td> 
                        <td class = "tytuly_koszyk">    
                            <p>Tytuł: ' . $produkt['Tytul'] . '</p>
                            <p>Autor: ' . $produkt['Autor'] . '</p>
                        </td> 
                        <td class = "koszyk_tytul">' . $produkt['Ilosc'] . '</td>
                        <td>' . $produkt['Cena'] . ' zł</td>
                        <td>
                            <form method = "POST" action = "Zalacznik/KoszykUsuwanie.inc.php">
                                <input type = "hidden" name = "usun_pozycje" value = "' . $produkt['ID'] . '">
                                <button type="submit" class = "usun_pozycje">Usuń pozycję</button>
                            </form>
                        </td>
                    </tr>';
        }

        echo '
        </table>
        <p>+12zł wysyłka</p>

        <div class = "podsumowanie_koszyk">';

        $query2 = "SELECT SUM(ko.Ilosc*ks.Cena) as Cena_Koncowa, COUNT(ko.ID_ksiazka) as CzyPusta FROM `koszyk` as ko 
                INNER JOIN ksiazka as ks ON ko.ID_ksiazka = ks.ID WHERE ID_czytelnik = $id_uzytkownik;";
        $cos2 = mysqli_query($mysqli, $query2);
        $suma = mysqli_fetch_array($cos2);
        $kod_rabatu = "";
        

        if ($suma['CzyPusta'] != 0) {
            echo '<form method = "POST" action = "./Koszyk.php">
                            <p><input type = "text" name = "oblicz_rabat" placeholder = "Wpisz kod rabatowy">
                            <button type="submit" name = "zlozonko" class = "zloz_zamowienie">Zatwierdź kod</button></p>
                        </form>';

            $podsumowanie = $suma['Cena_Koncowa'];
            

            if (isset($_POST['zlozonko'])) {
                $kod_rabatu = $_POST['oblicz_rabat'];
                $query3 = "SELECT * FROM rabat WHERE Nazwa_rabat = '$kod_rabatu'";
                $cos3 = mysqli_query($mysqli, $query3);
                $wynik = mysqli_fetch_array($cos3);

                if (!empty($wynik)) {
                    if($wynik['StatusZnizki'] == "Nieaktywny"){
                        echo '<div id = "babel">
                                Podany kod jest nieaktywny! Wpisz inny!
                            </div>';
                            $kod_rabatu = "";
                    }
                    else{
                        $podsumowanie = $podsumowanie - ($wynik['Wartosc'] / 100) * $podsumowanie;
                        $podsumowanie = round($podsumowanie, 2);
                    }
                }
            }

            $podsumowanie = $podsumowanie + 12;
            echo '<p><b>Suma zamówienia:</b> 
                        ' . $podsumowanie . ' zł
            
            </p>

            <form method = "POST" action = "Zalacznik/Zamowienie.inc.php">';

        echo '<input type = "hidden" name = "podsumowanie_cena" value = "'.$podsumowanie.'">
            <input type = "hidden" name = "podsumowanie_rabat" value = "'.$kod_rabatu.'">
            <button type="submit" class="zloz_zamowienie">Złóż zamówienie</button>
            </form>';
        } else {
            echo '<p>Nic tutaj nie ma :(</p>
                <p>Dodaj coś do koszyka!</p>';
        }
    }    
        ?>

</div>
</div>


</div>
</div>


<!----Stopka-->
<?php
include 'Stopka.php';
?>


