<!-- tämä sivun alkuun ennen < !doctype... hässäkkää -->

<?php
//Muokkaa tähän hevosesi VH-tunnus
$vh = 'VH19-053-0048';

//Muokkaa tähän hevosen painotuslajit
$osaaminen = array("VVJ", "KRJ");

// ei tarvittavia muokkauksia paitsi jos tulee joku uusi laji, laitoin nämä neljä esimerkiksi
$taivutus = array("VVJ" => "Valjakkoajossa", "KRJ" => "Kouluratsastuksessa", "ERJ" => "Esteratsastuksessa", "KERJ" => "Kenttäratsastuksessa");
$url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/' . $vh;
$obj = json_decode(file_get_contents($url), true);

if (isset($obj['error']) && $obj['error'] == 0) {
    $data = $obj['porrastetut'];
    $info = $data['info'];
    $hevonen = $data['hevonen'];
}
?>

<!-- tämä tablen ensimmäisen td:n sisään, jälkimmäistä td:tä muokataan käsin -->

<?php
$ominaisuustaulukko = array();
foreach ($hevonen['ominaisuudet'] as $id => $ominaisuus) {
    $ominaisuusnimi = $info['ominaisuudet'][$id];
    $ominaisuuspisteet = $ominaisuus['pisteet'];

    //Tulostus
    if ($ominaisuuspisteet != "0") {
        $ominaisuustaulukko += array($ominaisuusnimi => $ominaisuuspisteet);
    }
}
arsort($ominaisuustaulukko);
foreach ($ominaisuustaulukko as $key => $value) {
    echo "&#187; <i>" . $key . "</i> " . $value . " p.<br>";
}
?>
<br>
<?php
// jos hevonen on haettu onnistuneesti, tulosta virhe
if ($hevonen['error'] == 1) {

    echo $hevonen['error_message'];
} else {

    // Luodaan numeromuuttuja joka kertoo monesko taulukon solu on menossa, tarvitaan tulostusvaiheessa
    $solu = 1;

    // loopataan jokaisen jaoksen ympäri
    foreach ($hevonen['tasot'] as $jaos => $tasoinfo) {
        // summan alustus jaoksen ominaisuuspisteille
        $summa = 0;

        // haetaan tiedot rajapinnasta muuttujiin
        $jaosnimi = $info['jaokset'][$jaos]['jaos_nimi'];
        $jaoslyhenne = $info['jaokset'][$jaos]['jaos_lyhenne'];
        $jaoksenominaisuudet = $info['jaokset'][$jaos]['ominaisuudet'];
        $taso = $tasoinfo['taso'];
        $max_taso_per_ika = $hevonen['info']['max_taso_per_ika'];
        $max_taso_per_pisteet = $tasoinfo['max_taso_per_pisteet'];
        $max_taso_rajoitus = $tasoinfo['taso_rajoitus'];

        // loopataan jokaisen jaoksen ominaisuuden läpi
        foreach ($jaoksenominaisuudet as $id) {
            $ominaisuusnimi = $info['ominaisuudet'][$id];
            $ominaisuuspisteet = $hevonen['ominaisuudet'][$id]['pisteet'];

            //summaa ominaisuuden pisteet summamuuttujaan
            $summa += $ominaisuuspisteet;
        }

        //Tulostus, jos jaos kuuluu hevosen osaamiseen
        if (in_array($jaoslyhenne, $osaaminen)) {

            echo "&diams; <b>" . $taivutus[$jaoslyhenne] . " " . $summa . " op ";
            echo "(vt " . $taso . "/" . $max_taso_rajoitus . ")</b><br>";
        }
    }
}
?>
