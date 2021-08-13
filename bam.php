<!-- tämä sivun alkuun ennen < !doctype... hässäkkää -->

<?php
    //Muokkaa tähän hevosesi VH-tunnus
    $vh = 'VH19-053-0048';

    //Muokkaa tähän hevosen PORRASTETTUJEN painotuslajit ja niiden tasot muodossa "JAOS" => "TASO", "JAOS" => "TASO"
    // huomaa että ei pilkkua viimeisen jaos-tason jälkeen
    $osaaminen = array("KRJ" => "He B", "KERJ" => "CIC1");

    // ei tarvittavia muokkauksia paitsi jos tulee joku uusi laji, laitoin nämä neljä esimerkiksi
    $taivutus = array("VVJ" => "Valjakkoajo", "KRJ" => "Kouluratsastus", "ERJ" => "Esteratsastus", "KERJ" => "Kenttäratsastus");
    $url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/'.$vh;
    $obj = json_decode(file_get_contents($url), true);
    
    if(isset($obj['error']) && $obj['error'] == 0){        
        $data = $obj['porrastetut'];
        $info = $data['info'];
        $hevonen = $data['hevonen'];
    }
?>


<!-- tämä siihen kohtaan mihin haluat että kaikkien porrastettujen jaosten jutut tulostuu -->
<?php 
	// jos hevonen on haettu epäonnistuneesti, tulosta virhe
	if($hevonen['error'] == 1){
		echo $hevonen['error_message'];
	} else {
        foreach ($hevonen['tasot'] as $jaos=>$tasoinfo){
			// summan alustus jaoksen ominaisuuspisteille
            $summa = 0;
			
			// haetaan tiedot rajapinnasta muuttujiin
            $jaosnimi = $info['jaokset'][$jaos]['jaos_nimi'];
            $jaoslyhenne = $info['jaokset'][$jaos]['jaos_lyhenne'];
            $jaoksenominaisuudet = $info['jaokset'][$jaos]['ominaisuudet'];
            $taso = $tasoinfo['taso'];
            $max_taso_rajoitus = $tasoinfo['taso_rajoitus'];

            // loopataan jokaisen jaoksen ominaisuuden läpi
            foreach ($jaoksenominaisuudet as $id){
                    $ominaisuusnimi = $info['ominaisuudet'][$id];
                    $ominaisuuspisteet = $hevonen['ominaisuudet'][$id]['pisteet'];
                    
                    //summaa ominaisuuden pisteet summamuuttujaan
                    $summa += $ominaisuuspisteet;
            }
			
            //Tulostus, jos jaos kuuluu hevosen osaamiseen
			if (array_key_exists($jaoslyhenne, $osaaminen)) {
                echo $taivutus[$jaoslyhenne] . "<br>";
                echo "&#8618; tasolla <b>" . $taso . "/" . $max_taso_rajoitus . "</b> (" . $summa . " p.)<br>";
			}

		}
	}

?>
