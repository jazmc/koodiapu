<!-- tämä sivun alkuun ennen < !doctype... hässäkkää -->

<?php
    //Muokkaa tähän hevosesi VH-tunnus
    $vh = 'VH19-053-0048';

    //Muokkaa tähän hevosen painotuslajit
    $osaaminen = array("KRJ", "ERJ");

    // ei tarvittavia muokkauksia paitsi jos tulee joku uusi laji, laitoin nämä neljä esimerkiksi
    $taivutus = array("VVJ" => "Valjakkoajossa", "KRJ" => "Kouluratsastuksessa", "ERJ" => "Esteratsastuksessa", "KERJ" => "Kenttäratsastuksessa");
    $url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/'.$vh;
    $obj = json_decode(file_get_contents($url), true);
    
    if(isset($obj['error']) && $obj['error'] == 0){        
        $data = $obj['porrastetut'];
        $info = $data['info'];
        $hevonen = $data['hevonen'];
    }
?>


<!-- tämä siihen kohtaan mihin haluut että jutut tulostuu -->
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
			if (in_array($jaoslyhenne, $osaaminen)) {
                echo "<h4>" . $taivutus[$jaoslyhenne] . " " . $summa . " op. ";
                echo "(vaikeustasolla " . $taso . "/" . $max_taso_rajoitus . ")</h4>";
			}

		}
	}

    $ominaisuustaulukko = array();
    foreach ($hevonen['ominaisuudet'] as $id=>$ominaisuus){
        $ominaisuusnimi = $info['ominaisuudet'][$id];
        $ominaisuuspisteet = $ominaisuus ['pisteet'];
        
        //Tulostus
        if ($ominaisuuspisteet != "0"){
            $ominaisuustaulukko += array($ominaisuusnimi => $ominaisuuspisteet);
        }
    }
    arsort($ominaisuustaulukko);
    echo "<p>";
    foreach($ominaisuustaulukko as $key => $value) {
            echo ucfirst($key) . " " . $value . " p.<br>";
    }
    echo "</p>"
?>
