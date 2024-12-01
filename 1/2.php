<?php
$contents = file_get_contents(filename: '2.txt');

$left  = [];
$right = [];

foreach (explode(separator: "\n", string: $contents) as $line) {
    list($left[], $right[]) = explode(separator: '   ', string: $line);
}

$total = 0;
foreach ($left as $index => $l) {
    $count = array_count_values(array:$right)[$l] ?? 0;
    $total = $total + $l * $count;
}

echo $total;
