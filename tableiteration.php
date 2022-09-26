<html>
<head>
    <style>
        .tammatd {background-color:lightcoral;}
        .oritd {background-color:skyblue;}
    </style>
</head>
<body>
    
<h1>Jassun taulukkogeneraattori</h1>
    
<p>Vaihda url:sta polvet-parametri haluamaksesi numeroksi, niin sivu generoi tyhjän taulukkopohjan.</p>

<p>Voit kopioida taulukkopohjan lähdekoodista. Orille ja tammalle on oritd- ja tammatd-classit, joiden avulla voit tyylitellä taulukkoa haluamasi mukaan.</p>
    
<?php


if (!isset($_GET['polvet'])) {
    die("Anna URL:n loppuun parametrinä polvien määrä, esim ?polvet=3");
}
// iterointi
echo "<table>\n    <tr>\n";

function iteroi($vanhat = "", $rowspan) {
    
    for ($n = 0; $n < 2; $n++) {
        if ($n === 0) { ////////////////////// JOS ON ORI
            
            echo "        <td class=\"oritd\" rowspan=\"$rowspan\">". $vanhat . ". </td>\n";
            
        } else { ////////////////////// JOS ON TAMMA
        
            // jos ollaan ekassa solussa
            if($rowspan == 2**$_GET['polvet'] / 2) {
                $vanhat = "e";
            }
        
            echo "    <tr>\n        <td class=\"tammatd\" rowspan=\"$rowspan\">". substr($vanhat, 0, -1) . "e. </td>\n";
            
        }
        

        ////////////////////// TÄMÄ TEHDÄÄN MOLEMMISSA TAPAUKSISSA:
        if($rowspan === 1) { // viimeinen solu sulkeutuu
            echo "    </tr>\n";
        } else if ($n === 0) { // orisolusta seuraavan looppauksen käynnistys
            iteroi($vanhat. "i", $rowspan/2);
        } else { // tammasolusta seuraavan looppauksen käynnistys
            iteroi(substr($vanhat, 0, -1). "ei", $rowspan/2);
        }
    }
    
}

$rows = 2**$_GET['polvet'] / 2;

iteroi("i", $rows);
    
echo "</table>\n";
?>

</body>
</html>
