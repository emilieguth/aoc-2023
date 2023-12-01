<?php
$fp = @fopen("input-exo.txt", "r");
$total = 0;
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        echo $buffer;
        $first = null;
        $last = null;
        for($i = 0; $i < strlen($buffer); $i++) {
            if (is_numeric($buffer[$i])) {
                if($first === null){
                    $first = (int)$buffer[$i];
                } else {
                    $last = (int)$buffer[$i];
                }
            }
        }
        if ($last === null) {
            $last = $first;
        }

        $value = (int)($first.$last);
        $total += $value;
    }
    if (!feof($fp)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
}

var_dump($total);
?>
