<?php

require_once 'db.inc.php';

$sql = "SELECT * FROM ksiazka";
$rezultat_zapytania = mysqli_query($mysqli, $sql);

while ($res = mysqli_fetch_assoc($rezultat_zapytania)) {
    ?>
        <a href = "Produkt.php?id=<?php echo $res['ID'] ?>">
    <?php

    echo '<div class="hity_tekst">
            <div class="okladka">
                <li><img src="data:image/jpeg;base64,' . base64_encode($res['Zdjecie']) . '" width = "150px"/></li>
            </div>   
            <div class = "podpis">
                <p class = "podpis_tytul"> <b>' . $res['Tytul'] . ' </b></p>
                <p> ' . $res['Autor'] . '</p>
                
                <p> ' . $res['Cena'] . ' zł</p>
            </div>
            </a>   
        </div>';
}