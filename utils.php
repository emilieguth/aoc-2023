<?php
function extractFileToArray($filename) {
  $lines = [];
  $fp = @fopen($filename, "r");
  if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
      $lines[] = trim($buffer);
    }
    if (!feof($fp)) {
      echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
  }

  return $lines;
}

?>
