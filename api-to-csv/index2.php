<?php
$itemFeed =  file_get_contents('https://www.dell.com/csbapi/de-de/catalog/get?s=dhs');

$arr1 = json_decode($itemFeed, true);

$itemCount = count($arr1["Items"]);
$results = $arr1["Items"];
//var_dump($arr1["Items"][0]["ItemIdentifier"]); //<====== Good

$idList = "";

$f = fopen('output.csv', 'w');


$firstLineKeys = false;

if(!ini_get('safe_mode')){
	set_time_limit('10000');
}else{
die('using safemode');
}
$count = 0;
foreach ($results as $result){
    //echo $count . '<br />';
    // echo $result["ItemIdentifier"] . ',';
    $idList.= '<li><a href="https://www.dell.com/csbapi/de-de/catalog/getdetail?s=dhs&itemIdentifiers=' . $result["ItemIdentifier"].'">https://www.dell.com/csbapi/de-de/catalog/getdetail?s=dhs&itemIdentifiers=' . $result["ItemIdentifier"].'</a></li>';

    $productFeed = file_get_contents('https://www.dell.com/csbapi/de-de/catalog/getdetail?s=dhs&itemIdentifiers=' . $result["ItemIdentifier"]);
    $arr2 = json_decode($productFeed, true);
    $productResults = $arr2["Items"];
    //var_dump($productResults[0]);

    foreach ($productResults as $line)
    {
        if (empty($firstLineKeys))
        {
            $firstLineKeys = array_keys($line);
            fputcsv($f, $firstLineKeys);
            $firstLineKeys = array_flip($firstLineKeys);
        }
        $line_array = $line;
        foreach ($line['Components'] as $value)
        {
            /**
             * Monitors - General
             */
            array_push($line_array, $value['Specs']['Display-Typ']);
            array_push($line_array, $value['Specs']['Energie Effizienzklasse']);
            array_push($line_array, $value['Specs']['Energieverbrauch pro Jahr']);
            array_push($line_array, $value['Specs']['Leistungsaufnahme im Ein-Zustand']);
            array_push($line_array, $value['Specs']['Diagonalabmessung']);
            array_push($line_array, $value['Specs']['Sichtbare Bildfläche']);
            array_push($line_array, $value['Specs']['Geschwungener Bildschirm']);
            array_push($line_array, $value['Specs']['Integrierte Peripheriegeräte']);
            array_push($line_array, $value['Specs']['Bildschirmtyp']);
            array_push($line_array, $value['Specs']['Seitenverhältnis']);
            array_push($line_array, $value['Specs']['Native Auflösung']);
            array_push($line_array, $value['Specs']['Pixelpitch']);
            array_push($line_array, $value['Specs']['Helligkeit']);
            array_push($line_array, $value['Specs']['Kontrast']);
            array_push($line_array, $value['Specs']['Farbunterstützung']);
            array_push($line_array, $value['Specs']['Reaktionszeit']);
            array_push($line_array, $value['Specs']['Vertikale Bildwiederholrate']);
            array_push($line_array, $value['Specs']['Horizontale Bildwiederholrate']);
            array_push($line_array, $value['Specs']['Videobandbreite']);
            array_push($line_array, $value['Specs']['Horizontaler Betrachtungswinkel']);
            array_push($line_array, $value['Specs']['Vertikaler Betrachtungswinkel']);
            array_push($line_array, $value['Specs']['Bildschirmbeschichtung']);
            array_push($line_array, $value['Specs']['Hintergrundbeleuchtungs-Technologie']);
            array_push($line_array, $value['Specs']['Farbtemperatur']);
            array_push($line_array, $value['Specs']['Steuerelemente und Einstellungen']);
            array_push($line_array, $value['Specs']['OSD-Sprachen']);
            array_push($line_array, $value['Specs']['Besonderheiten']);
            array_push($line_array, $value['Specs']['Farbe']);
            array_push($line_array, $value['Specs']['Abmessungen (Breite x Tiefe x Höhe)']);
            array_push($line_array, $value['Specs']['Gewicht']);
            array_push($line_array, $value['Specs']['Kombiniert mit']);
            /**
             * Monitors - Audio
             */
            array_push($line_array, $value['Specs']['Typ']);
            array_push($line_array, $value['Specs']['Ausgangsleistung/Kanal']);

            /**
             * Monitors - Connectivity
             */
            array_push($line_array, $value['Specs']['Schnittstellen']);

            /**
             * Monitors - Mechanical
             */
            array_push($line_array, $value['Specs']['Einstellungen der Anzeigeposition']);
            array_push($line_array, $value['Specs']['Neigungswinkel']);
            array_push($line_array, $value['Specs']['Schwenkwinkel']);
            array_push($line_array, $value['Specs']['Höheneinstellung']);
            array_push($line_array, $value['Specs']['VESA-Halterung']);

            /**
             * Monitors - Miscellaneous
             */
            array_push($line_array, $value['Specs']['Leistungsmerkmale']);
            array_push($line_array, $value['Specs']['Zubehör im Lieferumfang']);
            array_push($line_array, $value['Specs']['Enthaltene Kabel']);
            array_push($line_array, $value['Specs']['Compatible with Windows 7']);
            array_push($line_array, $value['Specs']['Kennzeichnung']);
            array_push($line_array, $value['Specs']['Schlosstyp zur Diebstahlsicherung']);

            /**
             * Monitors - Power Supply
             */
            array_push($line_array, $value['Specs']['Spannungsversorgung']);
            array_push($line_array, $value['Specs']['Erforderliche Netzspannung']);
            array_push($line_array, $value['Specs']['Leistungsaufnahme im Betrieb']);
            array_push($line_array, $value['Specs']['Stromverbrauch im Standby-Modus']);
            array_push($line_array, $value['Specs']['Energierverbrauch Sleep']);
            array_push($line_array, $value['Specs']['Ein-/Aus-Schalter']);

            /**
             * Monitors - Software & System Requirements
             */
            array_push($line_array, $value['Specs']['Mitgelieferte Software']);

            /**
             * Monitors - Dimensions & Weight
             */
            array_push($line_array, $value['Specs']['Details zu Abmessungen & Gewicht']);

            /**
             * Monitors - Manufacturers Warranty
             */
            array_push($line_array, $value['Specs']['Service & Support']);

            /**
             * Monitors - Ambient Conditions
             */
            array_push($line_array, $value['Specs']['Min Betriebstemperatur']);
            array_push($line_array, $value['Specs']['Max. Betriebstemperatur']);
            array_push($line_array, $value['Specs']['Zulässige Luftfeuchtigkeit im Betrieb']);

            //var_dump($value);
            /*var_dump($value);
            if($count < $itemCount){
                echo '<br /><br />';
                echo '=======================================================';
                echo '<br /> <br />';
            }*/
            
            
        }
        echo $count . '<br />';
        array_push($line_array);
        fputcsv($f, $line_array);

    }
    $count++;
}

/*echo '<h1>Try 2</h1><ol>';
echo $idList;
echo '</ol>';*/