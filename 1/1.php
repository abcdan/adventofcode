<?php
$contents = file_get_contents(filename: '1.txt');

$left  = [];
$right = [];

foreach (explode("\n", $contents) as $line) {
    list($left[], $right[]) = explode('   ', $line);
}

sort(array:$left);
sort(array:$right);

$diff = 0;

foreach ($left as $index => $l) {
    $diff = $diff + abs($l - $right[$index]);
}

echo $diff;
