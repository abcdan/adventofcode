<?php

$contents = file_get_contents(filename: 'short.txt');
$count    = 0;

// Too high -> 661
foreach (explode(separator: "\n", string: $contents) as $line) {
    echo $line;
    $numbers = explode(separator: ' ', string: $line);
    $numbers = array_map(callback: function ($num): int {
        return intval(value: $num);
    }, array:$numbers);

    $safe  = true;
    $index = 0;

    $consecutive = areElementsConsecutive($numbers);

    if ($consecutive) {
        echo ' safe
        ';
        $count++;
    } else {

        echo ' unsafe
        ';
    }
}

echo ' ' . $count . '
';

function areElementsConsecutive($array)
{
    $issueCount = 0;
    // This checks if  they are the same;
    for ($i = 0; $i < count($array) - 1; $i++) {
        if ($array[$i] == $array[$i + 1]) {
            echo 'X';
            $issueCount++;
        }
    }

    $a = $array;
    $b = $array;

    sort($a);
    rsort($b);

    // This checks if not sorted
    if ($array != $a && $array != $b) {
        $issueCount++;
    }

    // This checks the difference between issues
    $isPositive = ($array[0] - $array[1]) < 0;
    if ($isPositive) {
        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] - $array[$i - 1] > 3) {
                $issueCount++;
            }
        }
    } else {
        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] - $array[$i - 1] < -3 || $array[$i] - $array[$i - 1] > 0) {
                $issueCount++;
            }
        }
    }
    echo '      ' . $issueCount;

    if ($issueCount >= 2) {
        return false;
    }

    return true;
}
