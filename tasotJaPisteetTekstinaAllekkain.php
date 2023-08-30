<!-- Ulkoiseen tiedostoon (suositus) tai hevosen sivun alkuun -->
<?php
function tulostaOminaisuuspisteet($vh, $painotuslajit)
{
    $url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/' . $vh;
    $obj = json_decode(file_get_contents($url), true);

    if (isset($obj['error']) && $obj['error'] == 0) {
        $data = $obj['porrastetut'];
        $info = $data['info'];
        $hevonen = $data['hevonen'];
    }

    // jos hevonen on haettu epäonnistuneesti, tulosta virhe
    if ($hevonen['error'] == 1) {
        echo $hevonen['error_message'];
    } else {
        foreach ($hevonen['tasot'] as $jaos => $tasoinfo) {
            // summan alustus jaoksen ominaisuuspisteille
            $summa = 0;

            // haetaan tiedot rajapinnasta muuttujiin
            $jaoslyhenne = $info['jaokset'][$jaos]['jaos_lyhenne'];
            $jaoksenominaisuudet = $info['jaokset'][$jaos]['ominaisuudet'];
            $taso = $tasoinfo['taso'];
            $max_taso_rajoitus = $tasoinfo['taso_rajoitus'];

            // loopataan jokaisen jaoksen ominaisuuden läpi
            foreach ($jaoksenominaisuudet as $id) {
                $ominaisuusnimi = $info['ominaisuudet'][$id];
                $ominaisuuspisteet = $hevonen['ominaisuudet'][$id]['pisteet'];

                //summaa ominaisuuden pisteet summamuuttujaan
                $summa += $ominaisuuspisteet;
            }

            // tulostus, jos jaos kuuluu hevosen osaamiseen
            if (in_array($jaoslyhenne, $painotuslajit)) {
                echo $jaoslyhenne . ":n porrastetuissa tasolla <b>" . $taso . "/" . $max_taso_rajoitus . "</b> (" . $summa . " p.)<br>";
            }
        }
    }
}
?>
<!-- hevosen sivuille siihen kohtaan mihin haluat ominaisuuspisteiden tulostuvan -->
<?php
// muokkaa VH ja halutut jaokset
// jos ylempi funktio on ulkoisessa tiedostossa, poista // seuraavalta riviltä ja vaihda osoite:
// include '../kansiopolku/ulkoinentiedosto.php';
tulostaOminaisuuspisteet('VH00-000-0000', ['VVJ', 'KRJ']); ?>
