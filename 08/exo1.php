<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

//$lines = extractFileToArray('input-example.txt');
//$sequence = 'RL';

$lines = extractFileToArray('input.txt');
$sequence = 'LRLRLLRRLLRRLRRLRRRLLRLRLRLRLRRLRRRLRLRRLRLLRRLLRLRRLRLRRLLRRRLRLRLRRRLRLLRRRLLLLLLRRRLRRLLLRRLRLRRLRRLRLRRLRRLLRRLRRRLRRRLLRLRLLLRRLLLRRLLRRLRLLRRRLRRRLRRRLRLRRLRRLLLRRRLRRLLRRLRRRLRLRLRRLRRLRRRLRRRLRLLLLRRRLRLRRRLRRRLLRLRRLRRLLRLLLRRLRLRRLRRRLRRRLRRRLLRRRLRLLRRRLRRRLRRRLRRRLRRLRRRLLRRLLRLRLRRRLRRRLRLRRRR';

$nodes = formatInput($lines);

$steps = 0;
$found = false;
echo date('H:i:s') . "\n";
$nextStep = 'AAA';
while($found === false) {
  $direction = $sequence[$steps % strlen($sequence)];
  echo "$nextStep -> $direction ($steps)\n";
  $nextStep = $nodes[$nextStep][$direction];
  $steps++;
  if ($nextStep === 'ZZZ') {
    $found = true;
  }
}
echo date('H:i:s') . "\n";
var_dump($steps);