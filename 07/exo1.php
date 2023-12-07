<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$results = [];
$allHandsAndBids = [];
$allHands = [];

foreach($lines as $line) {
  [$hand, $bid] = extractHandAndBid($line);
  $allHandsAndBids[$hand] = $bid;
  $allHands[] = $hand;
}

usort($allHands, 'sortHands');
$result = [];
foreach($allHands as $index => $hand) {
  $results[] = $allHandsAndBids[$hand] * ($index + 1);
}

var_dump(array_sum($results));
