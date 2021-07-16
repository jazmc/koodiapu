<!-- tämä sivun alkuun ennen < !doctype... hässäkkää -->

<?php
    //Muokkaa tähän hevosesi VH-tunnus
    $vh = 'VH19-053-0048';

    //Muokkaa tähän hevosen painotuslajit ja niiden tasot muodossa "JAOS" => "TASO"
    // huomaa että ei pilkkua viimeisen jaos-tason jälkeen
    $osaaminen = array("VVJ" => "vaativa", "KRJ" => "He B");

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


<!-- tässä on table kokonaisuudessaan, ei tarvi muokkauksia -->
<table width="70%"><tbody><tr><td valign="top" width="35%" style="line-height: 200%; font-size:14px">
<?php 
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
    foreach($ominaisuustaulukko as $key => $value) {
            echo "&#187; <i>" . $key . "</i> " . $value . " p.<br>";
    }
?>
</td><td width="30%" valign="top"  style="line-height: 200%; font-size:14px">
&#9733; Kilpailee 
<?php
    $i = 0;
    foreach($osaaminen as $jaos => $taso) {
        if ($i == 0) {
            echo $jaos;
        } else if ($i == (count($osaaminen)-1)) {
            echo " & " . $jaos;
        } else {
            echo ", " . $jaos;
        }
        $i+=1;
    }
?>
 porrastetuissa kilpailuissa.<br>
&#9733; Koulutustasoltaan 
<?php
    $i = 0;
    foreach($osaaminen as $jaos => $taso) {
        if ($i == 0) {
            echo $taso . " ";
        } else {
            echo "/ " . $taso;
        }
        $i+=1;
    }
?>
<br><br>
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
			
            //Tulostus, jos jaos kuuluu hevosen osaamiseen
			if (array_key_exists($jaoslyhenne, $osaaminen)) {
                echo "&diams; <b>" . $taivutus[$jaoslyhenne] . " " . $summa . " op ";
                echo "(vt " . $taso . "/" . $max_taso_rajoitus . ")</b><br>";
			}

		}
	}
?>

</td></tr></table>
