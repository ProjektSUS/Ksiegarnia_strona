<?php
    include_once 'Naglowek_index.php';
?>
        
<!----Główna zawartość strony-->
        <div id="obrazki_oferta">
            <a href="Podstrony/Kategorie.php"><img src ="Grafiki/1.png"></a>
            <a href="Podstrony/Kody_rabatowe.php"><img src ="Grafiki/2.png"></a>
            <a href="Podstrony/FAQ.php"><img src ="Grafiki/3.png"></a>
            <a href="Podstrony/O_sklepie.php"><img src ="Grafiki/4.png"></a>
        </div>

        <div id="hity_miesiaca">
            <H2>Ostatnie sztuki!</H2>
            <hr id="linia">
                <div id="ksiazki_calosc">
                    <ul class="ksiazki_hity_lista">
                        <?php
                            $sth = mysqli_query($mysqli, "CALL Ostatnie_sztuki();");
                                while ($res = mysqli_fetch_array($sth)) {
                                echo '<div class="hity_tekst">';
                        ?>
                                <a href = "Podstrony/Produkt.php?id=<?php echo $res['ID'] ?>">
                        <?php
                                    echo '<div class="okladka">
                                    <li><img src="data:image/jpeg;base64,'.base64_encode($res['Zdjecie']).'" width = "150px"/></li>
                                    </div>   
                                    <div class = "podpis">
                                        <p class = "podpis_tytul"> <b>'.$res['Tytul'].' </b></p>
                                        <p> '.$res['Autor'].'</p>
                                        
                                        <p> '.$res['Cena'].' zł</p>
                                    </div>
                                    </a>   
                                </div>';
                                }
                        ?>
                    </ul>
                </div>
        </div>
            
    </div>        
</div>


<!----Stopka-->
<?php
    include_once 'Stopka_index.php';
?>