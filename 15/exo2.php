<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$line = extractFileToString('input.txt');

$steps = explode(',', $line);

$boxes = [];

foreach($steps as $index => $step) {
  $boxNumber = extractBoxNumber($step);
  $operation = extractOperation($step);
  if (isset($boxes[$boxNumber]) === false) {
    $boxes[$boxNumber] = [];
  }
  if ($operation['operation'] === '=') {
    $replaced = false;
    foreach($boxes[$boxNumber] as $key => $value) {
      if (str_starts_with($value, $operation['label'])) {
        $boxes[$boxNumber][$key] = $operation['label'] . ' ' . $operation['focalLength'];
        $replaced = true;
      }
    }
    if ($replaced === false) {
      $boxes[$boxNumber][] = $operation['label'].' '.$operation['focalLength'];
    }
  } else {
    foreach($boxes[$boxNumber] as $key => $value) {
      if (str_starts_with($value, $operation['label'])) {
        unset($boxes[$boxNumber][$key]);
      }
    }
  }
}

$focusingPower = computeFocusingPower($boxes);

var_dump($focusingPower);

function computeFocusingPower(array $boxes): int {
  $total = 0;
  foreach($boxes as $boxNumber => $lenses) {
    foreach(array_values($lenses) as $index => $lens) {
      $focalLength = (int)explode(' ', $lens)[1];
      $currentFocusingPower = ($boxNumber + 1) * ($index + 1) * $focalLength;
      $total += $currentFocusingPower;
    }

  }
  return $total;
}

function extractOperation (string $step): array {
  if (strpos($step, '-')) {
    $separator = '-';
  } else {
    $separator = '=';
  }
  [$label, $focalLength] = explode($separator, $step);
  return [
    'label' => $label,
    'operation' => $separator,
    'focalLength' => $focalLength ?? null
  ];
}