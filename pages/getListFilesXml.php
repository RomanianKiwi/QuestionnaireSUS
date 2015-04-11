<?php

$dir = '../questionnaires';
$files = scandir($dir);

$sizeArray = count($files) - 1;

$data = array();

for ($i = 2; $i <= $sizeArray; $i++) {
    array_push($data, $files[$i]);
}

echo json_encode($data);
?>
