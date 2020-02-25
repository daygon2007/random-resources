<?php
$itemFeed =  file_get_contents('https://www.dell.com/csbapi/de-de/catalog/get?s=dhs');

$arr1 = json_decode($itemFeed, true);

$itemCount = count($arr1["Items"]);
$results = $arr1["Items"];
//var_dump($arr1["Items"][0]["ItemIdentifier"]); //<====== Good

$idList = "";

$f = fopen('output-laptops.csv', 'w');


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
        /*foreach ($line['Components'] as $value)
        {

            array_push($line_array, $value['Specs']['Display-Typ']);
            
            
        }*/
        if($line['CategoryName'] === "Laptops & 2-in-1-PCs"){
            foreach ($line['Components'] as $value)
            {
                array_push($line_array, $value['Name']);
                array_push($line_array, $value['DisplayText']);
                //array_push($line_array, $value);
                foreach($value['Specs'] as $spec){
                    array_push($line_array, $spec);
                }
                var_dump($value);
                echo '<br /><br /><br /><br /><br />'.$count.' - End: '. $value['Name'] .'=================================================================================================================================<br /><br /><br /><br /><br />';
            }
            array_push($line_array);
            
        }
            
        

        
        
        // array_push($line_array);
        fputcsv($f, $line_array);

    }
    $count++;
}

/*echo '<h1>Try 2</h1><ol>';
echo $idList;
echo '</ol>';*/