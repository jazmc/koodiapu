<?php
    // muokkaa tähän tallin tunnus
    $talli = 'SHEL5878';
    
    $url = 'http://virtuaalihevoset.net/rajapinta/tallinkasvatit/'.$talli;
    $obj = json_decode(file_get_contents($url), true);
    
    if(isset($obj['error']) && $obj['error'] == 0){        
        $data = $obj['tallinkasvatit'];
    }
    
    // järjestelyfunktio
    function cmp($a, $b) {
        $apvm = DateTime::createFromFormat('d.m.Y', $a['syntymaaika'])->format('Y-m-d');
        $bpvm = DateTime::createFromFormat('d.m.Y', $b['syntymaaika'])->format('Y-m-d');
        return -strcmp($apvm, $bpvm);
    }
    
    // sukupuolille selventävät nimet
    $sukupuoli = array("1" => "tamma", "2" => "ori", "3" => "ruuna");
?>


<!DOCTYPE html>
<html>
    <head></head>
    <body>
        
        <table>
            <?php
                // pyöräytetään kasvatit järjestelyfunktion kautta
                usort($data, "cmp");
                
                // jos kasvattien haku ei onnistunut, tulosta virhe
            	if($obj['error'] == 1){
            		echo "Kasvattien hakeminen ei onnistunut";
                
            	} else {
            	    // loopataan jokainen listauksen kasvatti:
            	    foreach ($data as $heppa) {
            	        // helpommat nimet 
            	        $vh = $heppa['reknro'];
            	        $nimi = $heppa['nimi'];
            	        $rotu = $heppa['rotulyhenne'];
            	        $synt = $heppa['syntymaaika'];
            	        $url = $heppa['url'];
            	        
            	        // jos emää / isää ei oo
            	        $tyhja = array('url' => "", 'nimi' => 'ei rekisterissä', 'reknro' => 'VH00-000-0000');
            	        
            	        if (isset($heppa['e'])) {
            	            $ema = $heppa['e']; // array
            	        } else {
            	            $ema = $tyhja;
            	        }
            	        if (isset($heppa['i'])) {
            	            $isa = $heppa['i']; // array
            	        } else {
            	            $isa = $tyhja;
            	        }
            	        
            	        echo "<tr>";
            	        echo "<td>" . $synt . "</td>";
            	        echo "<td>" . $rotu . "</td>";
            	        echo "<td>" . $sukupuoli[$heppa['sukupuoli']] . "</td>";
            	        echo "<td><a href=\"" . $url . "\">" . $nimi . "</a> ";
            	        echo "(<a href=\"http://virtuaalihevoset.net/virtuaalihevoset/hevonen/" . $vh . "\">" . $vh . "</a>)</td>";
            	        // emä:
            	        echo "<td><a href=\"" . $ema['url'] . "\">" . $ema['nimi'] . "</a> ";
            	        echo "(<a href=\"http://virtuaalihevoset.net/virtuaalihevoset/hevonen/" . $ema['reknro'] . "\">" . $ema['reknro'] . "</a>)</td>";
            	        // isä:
            	        echo "<td><a href=\"" . $isa['url'] . "\">" . $isa['nimi'] . "</a> ";
            	        echo "(<a href=\"http://virtuaalihevoset.net/virtuaalihevoset/hevonen/" . $isa['reknro'] . "\">" . $isa['reknro'] . "</a>)</td>";
            	        echo "</tr>";
            	    }
            	}
            ?>
        </table>

    </body>
</html>
