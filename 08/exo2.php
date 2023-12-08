<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

//$lines = extractFileToArray('input-example-2.txt');
//$sequence = 'LR';

$lines = extractFileToArray('input.txt');
$sequence = 'LRLRLLRRLLRRLRRLRRRLLRLRLRLRLRRLRRRLRLRRLRLLRRLLRLRRLRLRRLLRRRLRLRLRRRLRLLRRRLLLLLLRRRLRRLLLRRLRLRRLRRLRLRRLRRLLRRLRRRLRRRLLRLRLLLRRLLLRRLLRRLRLLRRRLRRRLRRRLRLRRLRRLLLRRRLRRLLRRLRRRLRLRLRRLRRLRRRLRRRLRLLLLRRRLRLRRRLRRRLLRLRRLRRLLRLLLRRLRLRRLRRRLRRRLRRRLLRRRLRLLRRRLRRRLRRRLRRRLRRLRRRLLRRLLRLRLRRRLRRRLRLRRRR';

$nodes = formatInput($lines);

$endingWithANodes = [];
foreach(array_keys($nodes) as $node) {
  if (str_ends_with($node, 'A')) {
    $endingWithANodes[] = $node;
  }
}

$allValues = [];
foreach($endingWithANodes as $index => $nextStep) {
  $steps = 0;
  $found = false;
  while($found === false) {
    $direction = $sequence[$steps % strlen($sequence)];
    $nextStep = $nodes[$nextStep][$direction];
    $steps++;
    if (str_ends_with($nextStep, 'Z')) {
      $found = true;
    }
  }
  $allValues[] = $steps;
}

$firstValue = array_pop($allValues);
$ppcm = null;
foreach($allValues as $value) {
  $ppcm = gmp_lcm($firstValue, $value);
  $firstValue = $ppcm;
}
var_dump($ppcm);
