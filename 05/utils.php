<?php

function extractSeedToSoil(array $lines): array {
  $seedToSoil = [];
  $saveSeedToSoil = false;
  foreach($lines as $line) {
    if ($line === 'seed-to-soil map:') {
      $saveSeedToSoil = true;
      continue;
    }
    if (strlen($line) === 0) {
      $saveSeedToSoil = false;
      continue;
    }
    if ($saveSeedToSoil) {
      $seedToSoil[] = explode(' ', $line);
    }
  }
  return $seedToSoil;
}

function extractMaps(array $lines): array {
  $map = [];
  $mapSaving = '';
  foreach($lines as $line) {
    if(strpos($line, 'map:') !== false) {
      $mapSaving = substr($line, 0, strpos($line, 'map:') - 1);
      $map[$mapSaving] = [];
      continue;
    }
    $map[$mapSaving][] = array_map('intval', explode(' ', $line));
  }
  return $map;
}