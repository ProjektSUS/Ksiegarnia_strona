<?php
include_once 'Naglowek.php';
?>
<script src = "../Js/funkcje.js"></script>

<!---Wracanko UwU-->
<div id="przycisk_wracanka">
    <button onclick="history.back()" class="przycisk_powrotu">
        << Powrót</button>
</div>

<!----Główna zawartość strony-->
<div class="kategorie_calosc">
    <div id="kategorie_strona_lewa">
        <ul>
            <nav class="menu_kategorie">
                <select id="kategorie" onchange="ladowanie_kategorii()">
                    <option value = "0">Wszystkie pozycje</option>
                    <?php
                    $sth = mysqli_query($mysqli, "SELECT * From kategoria ORDER BY Nazwa ASC");
                    while ($res = mysqli_fetch_array($sth)) {
                        echo '<option value="'.$res['ID'].'">'.$res['Nazwa'].'</option>';
                    }
                    ?>
                </select>
            </nav>
        </ul>
    </div>

    <div class="kategorie_strona_prawa">

        <div class="kategorie_produkty" id = "kategorie_produkty">
            <?php 
                include_once 'Zalacznik/Kategorie.inc.php';
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

