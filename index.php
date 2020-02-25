<?php

/*$ch = curl_init("https://www.dell.com/csbapi/de-de/catalog/get?s=dhs");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

curl_close($ch);

var_dump($response);*/
$itemFeed =  file_get_contents('https://www.dell.com/csbapi/de-de/catalog/get?s=dhs');

$arr1 = json_decode($itemFeed, true);

//var_dump($itemFeed);
$itemCount = count($arr1["Items"]);
$results = $arr1["Items"];
//var_dump($arr1["Items"][0]["ItemIdentifier"]); //<====== Good

$idList = "";
foreach ($results as $result){
    // echo $result["ItemIdentifier"] . ',';
    $idList.= '<li>'.$result["ItemIdentifier"].'</li>';
}
//$idList = strval(trim(strip_tags($idList)));

//echo "<h1>This is the ID List</h1>";
echo '<ol>';
echo $idList;
echo '</ol>';

/* ========= End Getting Product ID's ===============*/

/*$productFeed = file_get_contents('https://www.dell.com/csbapi/de-de/catalog/getdetail?s=dhs&itemIdentifiers=' . substr($idList,0,-1000));

$arr2 = json_decode($productFeed, true);
$productResults = $arr2["Items"];

var_dump($productFeed)


echo $productFeed;
//var_dump($productResults);
/*
$f = fopen('output.csv', 'w');

$firstLineKeys = false;
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
        array_push($line_array,$value);
    }
    array_push($line_array);
    fputcsv($f, $line_array);

}*/