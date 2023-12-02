<?php

function extractGameId($line) {
  $gameSize = strlen('Game ');
  $id = substr($line, $gameSize, strpos($line, ':') - $gameSize);
  return (int)$id;
}

function extractDraws($line) {
  $colors = ['red', 'blue', 'green'];
  $drawsString = substr($line, strpos($line, ':') + 2);
  $drawsElements = explode(';', $drawsString);
  $draws = [];
  foreach ($drawsElements as $elements) {
    $cubesDraws = explode(',', $elements);
    $draw = [0, 0, 0];
    foreach ($cubesDraws as $cubeDraw) {
      foreach ($colors as $index => $color) {
        if (strpos($cubeDraw, $color) !== false) {
          $number = (int)str_replace($color, '', $cubeDraw);
          $draw[$index] = $number;
        }
      }
    }
    $draws[] = $draw;
  }
  return $draws;
}
