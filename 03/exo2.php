<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$input2DimArray = convertInputTo2DimArray($lines);

$xSurrendingNumbers = [];
$partNumbers = [];
$isPartNumber = false;
$xPositions = [];

foreach ($input2DimArray as $line => $cells) {
  $currentNumber = '';

  foreach ($cells as $row => $cell) {
    if ($cell === '*') {
      $xPositions[] = "$line;$row";
      $xSurrendingNumbers[$line][$row] = [];
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurrendingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
    }
  }
}

$numbers = [];
foreach($xSurrendingNumbers as $line => $xSurrendingNumbersByLine) {
  foreach($xSurrendingNumbersByLine as $row => $xSurrendingNumbersByRow) {
    if(count($xSurrendingNumbersByRow) === 2) {
      $numbers[] = array_product($xSurrendingNumbersByRow);
    }
  }
}

var_dump($numbers, array_sum($numbers));
