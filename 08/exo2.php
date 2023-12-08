<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$lines = extractFileToArray('input.txt');
$sequence = 'LRLRLLRRLLRRLRRLRRRLLRLRLRLRLRRLRRRLRLRRLRLLRRLLRLRRLRLRRLLRRRLRLRLRRRLRLLRRRLLLLLLRRRLRRLLLRRLRLRRLRRLRLRRLRRLLRRLRRRLRRRLLRLRLLLRRLLLRRLLRRLRLLRRRLRRRLRRRLRLRRLRRLLLRRRLRRLLRRLRRRLRLRLRRLRRLRRRLRRRLRLLLLRRRLRLRRRLRRRLLRLRRLRRLLRLLLRRLRLRRLRRRLRRRLRRRLLRRRLRLLRRRLRRRLRRRLRRRLRRLRRRLLRRLLRLRLRRRLRRRLRLRRRR';

$nodes = formatInput($lines);

$endingWithANodes = [];
foreach(array_keys($nodes) as $node) {
  if (str_ends_with($node, 'A')) {
    $endingWithANodes[] = $node;
  }
}

$allSteps = [];
foreach($endingWithANodes as $index => $nextStep) {
  $allSteps[] = extractSteps($sequence, $nodes, $nextStep);
}

$currentValue = array_pop($allSteps);
$ppcm = null;
foreach($allSteps as $step) {
  $ppcm = gmp_lcm($currentValue, $step);
  $currentValue = $ppcm;
}
var_dump($ppcm);
