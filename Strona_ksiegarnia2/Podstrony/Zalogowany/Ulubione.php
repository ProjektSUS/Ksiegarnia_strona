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

    <div class="menu_prawa_strona">
        <h3> Ulubione książki </h3>

        <?php
            $id_czytelnika = $_SESSION["uID"];
            $query = "SELECT * FROM ulubione INNER JOIN ksiazka as ks ON ID_ksiazka = ks.ID WHERE ID_czytelnik = $id_czytelnika;";
            
            $cos = mysqli_query($mysqli, $query);

            while ($wynik = mysqli_fetch_array($cos)) {
                echo '<div class="hity_tekst">';
            ?>
                <a href = "../Produkt.php?id=<?php echo $wynik['ID'] ?>">
            <?php
                echo '<div class="okladka">
                <li><img src="data:image/jpeg;base64,'.base64_encode($wynik['Zdjecie']).'" width = "150px"/></li>
                </div>   
                <div class = "podpis">
                    <p class = "podpis_tytul"> <b>'.$wynik['Tytul'].' </b></p>
                    <p> '.$wynik['Autor'].'</p>
                    
                    <p> '.$wynik['Cena'].' zł</p>
                </div>
                </a>   
            </div>';
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