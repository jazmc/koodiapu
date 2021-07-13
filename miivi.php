<!-- tämä sivun alkuun ennen < !doctype... hässäkkää -->
<?php
    //Muokkaa tähän hevosesi VH-tunnus
    $vh = 'VH19-053-0048';
    $url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/'.$vh;
    $obj = json_decode(file_get_contents($url), true);
    
    if(isset($obj['error']) && $obj['error'] == 0){        
        $data = $obj['porrastetut'];
        $info = $data['info'];
        $hevonen = $data['hevonen'];
    }
?>

<!-- tämä table ja /table -tagien väliin: -->
<?php 
	if($hevonen['error'] == 1){
    // jos hevosen haku ei onnistunut, tulosta virhe
		echo $hevonen['error_message'];
    
	} else {
		// Luodaan numeromuuttuja joka kertoo monesko taulukon solu on menossa, tarvitaan tulostusvaiheessa
		$solu = 1;
			
		// loopataan jokaisen jaoksen ympäri
        foreach ($hevonen['tasot'] as $jaos=>$tasoinfo){
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
            foreach ($jaoksenominaisuudet as $id){
                $ominaisuusnimi = $info['ominaisuudet'][$id];
                $ominaisuuspisteet = $hevonen['ominaisuudet'][$id]['pisteet'];
                
                //summaa ominaisuuden pisteet summamuuttujaan
                $summa += $ominaisuuspisteet;
            }
    			
            //Tulostus, jos jaos on KRJ, VVJ, ERJ tai KERJ
            if ($jaoslyhenne == "KRJ" || $jaoslyhenne == "VVJ" || $jaoslyhenne == "ERJ" || $jaoslyhenne == "KERJ") {
    				
                if ($solu == 1) {
                    // jos tulostetaan ekaa solua, tulostetaan rivin aloitus
                    echo "<tr>";
                }
    				
				// tulostetaan aina td ja sen sisälle jaoksen tiedot
				echo "<td><b>" . $jaoslyhenne . "</b>: ";
				echo $summa . " p. ";
				echo "(vt " . $taso . ")</td>";
				
				if ($solu == 2) {
					// jos tulostetaan jälkimmäistä solua, tulostetaan rivin lopetus
					echo "</tr>";
					// samalla vaihdetaan soluksi 1 kun hypätään seuraavaksi seuraavan rivin ekaan soluun
					$solu = 1;
				} else {
					// jos solu oli äsken 1, seuraavaksi se on 2
					$solu = 2;
			    }
    	    }
        }
    }
?>
