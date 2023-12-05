<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

//$seeds = [79, 14, 55, 13];
$seeds = [
  432986705, 28073546, 1364097901, 88338513, 2733524843, 234912494, 3151642679, 224376393,
  485709676, 344068331, 1560394266, 911616092, 3819746175, 87998136, 892394515, 435690182,
  4218056486, 23868437, 848725444, 8940450,
];

$maps = extractMaps($lines);

$locations = [];
$steps = [
  'seed-to-soil',
  'soil-to-fertilizer',
  'fertilizer-to-water',
  'water-to-light',
  'light-to-temperature',
  'temperature-to-humidity',
  'humidity-to-location'
];

foreach ($seeds as $seed) {
  $current = $seed;
  echo "\n\n";
  echo "Seed: $seed\n";
  foreach ($steps as $currentStep) {
    $currentMap = $maps[$currentStep];
    $found = false;
    foreach($currentMap as [$destination, $source, $length]) {
      if ($source <= $current and $source + $length >= $current) {
        $found = true;
        $current = $destination + $current - $source;
        //echo "$currentStep : $current\n";
        break;
      }
    }
  }
  $locations[] = $current;
}
asort($locations);
var_dump($locations);