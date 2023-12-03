<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$input2DimArray = convertInputTo2DimArray($lines);

$xSurroundingNumbers = [];
$partNumbers = [];
$isPartNumber = false;

foreach ($input2DimArray as $line => $cells) {
  $currentNumber = '';

  foreach ($cells as $row => $cell) {
    if ($cell === '*') {
      $xSurroundingNumbers[$line][$row] = [];
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line - 1, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row - 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
      [$i, $j, $value] = getNumber($input2DimArray, $line + 1, $row + 1);
      if ($i !== null and $j !== null) {
        $xSurroundingNumbers[$line][$row]["$i;$j"] = (int)$value;
      }
    }
  }
}

$numbers = [];
foreach($xSurroundingNumbers as $line => $xSurroundingNumbersByLine) {
  foreach($xSurroundingNumbersByLine as $row => $xSurroundingNumbersByRow) {
    if(count($xSurroundingNumbersByRow) === 2) {
      $numbers[] = array_product($xSurroundingNumbersByRow);
    }
  }
}

var_dump($numbers, array_sum($numbers));
