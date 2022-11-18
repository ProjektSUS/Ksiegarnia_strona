<!----Wczytaj ten produkt, który został wybrany-->
<?php

include_once 'Naglowek.php';

$id_ksiazka = $_GET['id'];
$query = "SELECT ks.ID, ks.Tytul, ks.Autor, ks.Rok_wydania, ks.Ilosc, ks.Wydawnictwo, ks.Cena, ks.Zdjecie, ks.Opis, ks.ID_kategoria, kat.Nazwa 
        FROM ksiazka AS ks INNER JOIN kategoria AS kat ON ks.ID_kategoria = kat.ID WHERE ks.ID = $id_ksiazka";

$cos = mysqli_query($mysqli, $query);
$produkt = mysqli_fetch_array($cos);


$id_kategorii_domyslny = $produkt['ID_kategoria'];

?>

<script src="../Js/przekaz_danych.js">

    var ilosc = document.getElementById;
</script>

<!---Wracanko UwU-->
<div id="przycisk_wracanka">
    <button onclick="history.back()" class="przycisk_powrotu">
        << Powrót</button>
</div>


<div id="produkt_gora">
    <div id="produkt_zdjecie">
        <!----Wczytaj zdjęcie podanego produktu-->
        <?php
        echo '<img src="data:image/jpeg;base64,' . base64_encode($produkt['Zdjecie']) . '" width = "250px"/>';
        ?>

    </div>
    <div id="produkt_mini_opis">
        <div>
            <!----Wczytaj podstawowe dane podanego produktu-->
            <?php
            echo '<h2>' . $produkt['Tytul'] . '</h2>
                    <p> <b>Autor: </b>' . $produkt['Autor'] . '</p>
                    <p> <b>Wydawnictwo: </b>' . $produkt['Wydawnictwo'] . '</p>
                    <p> <b>Rok wydania: </b>' . $produkt['Rok_wydania'] . '</p>
                    <p> <b>Kategoria: </b>' . $produkt['Nazwa'] . '</p>
                    <p> <b>Ilość dostępnych sztuk: </b>' . $produkt['Ilosc'] . '</p>';

            $id_produktu = $produkt['ID'];

        echo '</div>
    </div>';


    if (isset($_SESSION["uID"])) {
    echo '<div class="dodaj_do_koszyka">
        <p>Cena</p>';
        echo '<h2>' . $produkt['Cena'] . ' zł </h2>';

        $id_czytelnika = $_SESSION["uID"];
        $query = "SELECT ID_ksiazka FROM koszyk WHERE ID_ksiazka = $id_produktu AND ID_czytelnik = $id_czytelnika;";

        $cos = mysqli_query($mysqli, $query);
        $sprawdzKoszyk = mysqli_fetch_array($cos);

        if($produkt['Ilosc'] > 0){
            if (!empty($sprawdzKoszyk)) {
                echo 'Produkt już jest w koszyku';
            } else {
                echo ' <form method="POST" action = "Zalacznik/Koszyk.inc.php">
                            <p>Ilość<input type = "number" min="1" max="'.$produkt['Ilosc'].'" name = "ilosc_ksiazek" class = "text_sztuki" value = "1"></p>
                            <p><button type = "submit" class="button_dodaj" name="przycisk_dodaj">Dodaj do koszyka</button></p>
                            <input type = "hidden" name="produkt_id" value =' . $id_produktu . '>
                        </form>';
            }
        }
        else{
            echo '<p>Niedostępne</p>';
        }

       // Dodawanie do ulubionych
        
            echo '<div class="ulubione_div">
                <h4>Dodaj do ulubionych</h4>';

            $id_ksiazka = $_GET['id'];
            $id_czytelnika = $_SESSION["uID"];
            $zapytanie = "SELECT * FROM ulubione WHERE ID_czytelnik = $id_czytelnika AND ID_ksiazka = $id_ksiazka";
            $cos = mysqli_query($mysqli, $zapytanie);
            $numer = mysqli_fetch_array($cos);

            if (empty($numer)) {
                echo '<button type = "submit" onclick = "przekazanie_danych_ulubione(' . $id_ksiazka . ',' . $id_czytelnika . ')"  name = "dodaj_do_ulu">
                            <img src = "../Grafiki/Ikonki/serce.svg">
                    </button>';
            } else {
                echo '<button type = "submit"  onclick = "usuwanie_danych_ulubione(' . $id_ksiazka . ',' . $id_czytelnika . ')"  name = "usun_z_ulu">
                            <img src = "../Grafiki/Ikonki/serce-pelne.svg">
                    </button>';
            }

            echo '</div>
            </div>
        ';
    }

    echo '</div><div id="produkt_dol">
            <h2>Opis</h2>
                '.$produkt['Opis'].'
        </div>';

if(isset($_SESSION["uID"]) && $_SESSION['uTyp'] === "Admin"){
    echo '
    <div id="wybierz_ksiazke_modyfikacja">
    <hr>
    <h3>Modyfikacja informacji o książce</h3>
        <form method="POST" action="Zalacznik/Menadzer_modyfikujKsiazke.inc.php" enctype="multipart/form-data">
            <div class="panel_dane">
                <input type="hidden" id="id_modyfikacja" name="id_modyfikacja" value = "'.$_GET['id'].'">
                <h3><b>Zdjęcie: </b></h3>
                    <input type="file" id="zdjecie_modyfikuj" name="zdjecie_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Tytuł: </b></h3>
                    <input type="text" id="tytul_modyfikuj" name="tytul_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Autor: </b></h3>
                    <input type="text" id="autor_modyfikuj" name="autor_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Rok wydania: </b></h3>
                    <input type="text" id="rok_wydania_modyfikuj" name="rok_wydania_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Ilość: </b></h3>
                    <input type="text" id="ilosc_modyfikuj" name="ilosc_modyfikuj">
            </div>

        <div class="panel_dane">
            <h3><b>Kategoria: </b></h3>
            <ul>
                <nav class="menu_kategorie_modyfikuj">
                    <select id="kategorie_modyfikuj" name = "kategorie_modyfikuj">
                        ';
                        $sth = mysqli_query($mysqli, "SELECT * From kategoria");
                        while ($res = mysqli_fetch_array($sth)) {
                            echo '<option value="'.$res['ID'].'" 
                            ';
                            if($res['ID'] == $id_kategorii_domyslny){
                                echo 'selected = "selected"';
                            }
                            echo '
                            >' . $res['Nazwa'] . '</option>';
                        }

        echo ' </select>
                </nav>
            </ul>
        </div>
            <div class="panel_dane">
            <h3><b>Wydawnictwo: </b></h3>
                <input type="text" id="wydawnictwo_modyfikuj" name="wydawnictwo_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Cena: </b></h3>
                    <input type="text" id="cena_modyfikuj" name="cena_modyfikuj">
            </div>

            <div class="panel_dane">
                <h3><b>Opis: </b></h3>
                    <textarea class="textarea_modyfikuj" name="textarea_modyfikuj"></textarea>
            </div>

            <div class="panel_dane">
                <button type="submit">Modyfikuj książkę</button>
            </div>
        </form>
            
    </div>';

}
?>


<!------ Tutaj się kończą divy strona całość i zawartość strony ---->
</div>
</div>


<!----Stopka-->
<?php
include 'Stopka.php';
?>