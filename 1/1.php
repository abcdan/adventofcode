<?php
$contents = file_get_contents(filename: '1.txt');

$left  = [];
$right = [];

foreach (explode(separator: "\n", string: $contents) as $line) {
    list($left[], $right[]) = explode(separator: '   ', string: $line);
}

sort(array:$left);
sort(array:$right);

$diff = 0;

foreach ($left as $index => $l) {
    $diff = $diff + abs(num: $l - $right[$index]);
}

echo $diff;
