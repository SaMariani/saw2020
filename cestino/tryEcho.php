<?php
function sendLines(string $success, string $error)
{
    $comunicateResults = array();
    $ok=['success' => $success, 'error' => $error];
    array_push($comunicateResults, $ok);
    array_push($comunicateResults, $ok);
    $myJSON = json_encode($comunicateResults);
    echo $myJSON;
}
sendLines("ciao","ok");
/*$row=null;
$product=[
    'codice' => $row["codice"],
    'nomeprodotto' => $row["nomeprodotto"],
    'descrizione' => $row["descrizione"],
    'prezzo' => $row["prezzo"]
];*/