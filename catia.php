<?php include_once 'yla.php';
    //Muokkaa tähän hevosesi VH-tunnus
    $vh = 'VH18-018-1458';
    $url = 'http://virtuaalihevoset.net/rajapinta/porrastetut/'.$vh;
    $obj = json_decode(file_get_contents($url), true);
    
    if(isset($obj['error']) && $obj['error'] == 0){        
        $data = $obj['porrastetut'];
        $info = $data['info'];
        $hevonen = $data['hevonen'];
    }
?>
<div class="teksti">
        <h3>Tervetuloa!</h3>

            <table align="center" border="0" cellpadding="10" cellspacing="0" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="text-align: center;" width="50%"><img class="heppakuva" src="./img/esimerkki_kuva.jpg" width="50%" style="margin-top: 7px; margin-bottom: 7px;"><br />
                    <img class="heppakuva" src="./img/esimerkki_kuva.jpg" width="15%" style="margin-right: 10px;"> <img class="heppakuva" src="./img/esimerkki_kuva.jpg" width="15%"  style="margin-right: 10px;"> <img class="heppakuva" src="./img/esimerkki_kuva.jpg" width="15%">
                    <p class="copy">Kuvat &copy; Karhumetsä<br />
                        this is a virtual horse - tämä on virtuaalihevonen</p>
                </td>
                <td>
                <table id="perustieto">
                    <tr>
                        <td class="tieto">Nimi</td><td> Heppa Heppanen</td>
                    </tr>
                    <tr>
                        <td class="tieto">Rotu, skp </td><td> Suomenhevonen, ori</td>
                    </tr>
                    <tr>
                        <td class="tieto">Syntymäaika</td><td> 14.02.2018, 5v </td>
                    </tr>
                    <tr>
                        <td class="tieto">Rekisterinumero</td><td> <a href="http://www.virtuaalihevoset.net/?hevoset/hevosrekisteri/hevonen.html?vh=VH18-121-0036">VH18-121-0036</a></td>
                    </tr>
                    <tr>
                        <td class="tieto">Väri, säkä</td><td> rautias, 171cm</td>
                    </tr>
                    <tr>
                        <td class="tieto">Kasvattaja</td><td> Suomi Suominen</td>
                    </tr>
                    <tr>
                        <td class="tieto">Painotus, taso</td><td> Kouluratsastus, Hellpo A </td>
                    </tr>
                    <tr>
                        <td class="tieto">Omistaja</td><td> Catia (VRL-00801), Karhumetsä</td>
                    </tr>
                    </table>
            </tr>
        </tbody>
    </table>
<p>Tähän tulee luonne</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<section class="grey">
<table width="100%" cellpadding="5" cellspacing="0">

    <tr>
    <td rowSpan=4 style="border-bottom:1px dotted #369b17" width="31%">i: isukki <br /> <small><em>rt, 171cm</em></small></td>
    
    <td rowSpan=2 style="border-bottom:1px dotted #369b17" width="35%">ii: isukinisukki <small><em>rn, 172cm</em></td>
    
    <td style="border-bottom:1px dotted #369b17" width="33%">iii: isukinisukinisukki </td>
    </tr>
    
    <tr>
    <td style="border-bottom:1px dotted #369b17">iie: isukinisukinmama</td>
    </tr>
    
    <tr>
    <td rowSpan=2 style="border-bottom:1px dotted #369b17">ie: isukinmama <small><em>prt, 162cm</em></small></td>
    
    <td style="border-bottom:1px dotted #369b17">iei: isukinmamanisukki/td>
    </tr>
    
    <tr>
    <td style="border-bottom:1px dotted #369b17">iee: isukinmamanmama</td>
    </tr>
    <tr>
    <td rowSpan=4 class="suku_2polv">e: mama <br /> <small><em>trn, 167cm </em></small></td>
    
    <td rowSpan=2 style="border-bottom:1px dotted #369b17" >ei: mamanisukki <small><em>rn, 166cm</em></small></td>
    
    <td style="border-bottom:1px dotted #369b17">eii: mamanisukinisukki</td>
    </tr>
    
    <tr>
    <td style="border-bottom:1px dotted #369b17">eie: 	mamanisukinmama</td>
    </tr>
    
    <tr>
    <td rowSpan=2>ee: mamanmama <small><em>rtkm, 166cm</em></small></td>
    
    <td style="border-bottom:1px dotted #369b17">eei: mamanmamanisukki</td>
    </tr>
    
    <tr>
    <td>eee: 	mamanmamanmama</td>
    </tr>
    
    </table>
</section>
<p>Tähän tulee sukuselvitys</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
<section class="grey">
<table width="100%">
    <tr>
        <td width="10%"  style="border-bottom:1px dotted #369b17">s. 00.00.2018</td>
        <td width="5%"  style="border-bottom:1px dotted #369b17"><img src="fi.png"></td>
        <td width="7%"  style="border-bottom:1px dotted #369b17">sh</td>
        <td width="3%"  style="border-bottom:1px dotted #369b17">t/o</td>
        <td width="50%"  style="border-bottom:1px dotted #369b17"><a href="http://">varsa</a></td>
        <td width="25%"  style="border-bottom:1px dotted #369b17">tammasta <a href="http://">nimi</a></td>
    </tr>
  </table>
</section>
<section class="grey">
<table class="tg">
  <tr>
    <th class="tg-031e" colspan="4"><center><font color="#369b17"><b>Ominaisuuspisteet ja kilpailutasot</b></font></center></th>
  </tr>
   <tr>
    <td class="points" rowspan="4">
<?php 
    foreach ($hevonen['ominaisuudet'] as $id=>$ominaisuus){
        $ominaisuusnimi = $info['ominaisuudet'][$id];
        $ominaisuuspisteet = $ominaisuus ['pisteet'];
        
        //Tulostus
        echo $ominaisuusnimi . ": " . $ominaisuuspisteet . "<br>";
		if($obj['error'] == 1){
			echo $obj['error_description'];
		} else {
			echo "Tapahtui odottamaton virhe!";
		}
    }
?>
    </td>
        <td class="points" rowspan="4">
<?php
    if($hevonen['error'] == 1){
        echo $hevonen['error_message'];
    } else {
        foreach ($hevonen['tasot'] as $jaos=>$tasoinfo){
            $jaosnimi = $info['jaokset'][$jaos]['jaos_nimi'];
            $jaoslyhenne = $info['jaokset'][$jaos]['jaos_lyhenne'];
            $taso = $tasoinfo['taso'];
            $max_taso_per_ika = $hevonen['info']['max_taso_per_ika'];
            $max_taso_per_pisteet = $tasoinfo['max_taso_per_pisteet'];
            $max_taso_rajoitus = $tasoinfo['taso_rajoitus'];
            
            //Tulostus
            echo $jaosnimi . " (". $jaoslyhenne.") : ";
            echo "Taso: " . $taso;
            echo " (Maksimi iän perusteella: " . $max_taso_per_ika . ", maksimi pisteiden perusteella: " . $max_taso_per_pisteet . ", valittu maksimitaso: " . $max_taso_rajoitus . ")";
            echo "<br>";
        }
    }
    if($obj['error'] == 1){
        echo $obj['error_description'];
    } else {
        echo "Tapahtui odottamaton virhe!";
    }
?>
	<br>
	Hevonen kilpailee vain porrastetuissa kilpailuissa painoituslajissaan aina maximitasolleen asti. Tämän jälkeen se siirtyy pelkästään jalostuskäyttöön.
</td>
  </tr>

</table>
</section>
<p>Valmennuksia tänne ja päiväkirjamerkintöjä</p>
<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Possimus enim sint ullam quas eveniet quaerat alias ea excepturi expedita velit. Excepturi, modi unde. Aspernatur, quod. Architecto odit voluptatem harum dicta!
</p>
</main>
<footer id="footer">
<?php include_once 'ala.php';?>
