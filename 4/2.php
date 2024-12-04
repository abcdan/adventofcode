<?php


$contents = file_get_contents(filename: '1.txt');

$rows = [];


foreach (explode(separator: "\n", string: $contents) as $line) {
    $rows[] = str_split($line);
}

// Too low -> 2239
$count = 0;

foreach ($rows as $index => $row) {
    foreach ($row as $indexChar => $char) {
        if($char === 'A') {
            $topLeftM = isset($rows[$index - 1][$indexChar - 1]) && $rows[$index - 1][$indexChar - 1] === 'M';
            $topRightS = isset($rows[$index - 1][$indexChar + 1]) && $rows[$index - 1][$indexChar + 1] === 'S';
            $bottomLeftM = isset($rows[$index + 1][$indexChar - 1]) && $rows[$index + 1][$indexChar - 1] === 'M';
            $bottomRightS = isset($rows[$index + 1][$indexChar + 1]) && $rows[$index + 1][$indexChar + 1] === 'S';

            if($topLeftM && $topRightS && $bottomLeftM && $bottomRightS) {
                $count++;
            }


            $topLeftM = isset($rows[$index - 1][$indexChar - 1]) && $rows[$index - 1][$indexChar - 1] === 'S';
            $topRightS = isset($rows[$index - 1][$indexChar + 1]) && $rows[$index - 1][$indexChar + 1] === 'M';
            $bottomLeftM = isset($rows[$index + 1][$indexChar - 1]) && $rows[$index + 1][$indexChar - 1] === 'S';
            $bottomRightS = isset($rows[$index + 1][$indexChar + 1]) && $rows[$index + 1][$indexChar + 1] === 'M';


            if($topLeftM && $topRightS && $bottomLeftM && $bottomRightS) {
                $count++;
            }


            $topLeftM = isset($rows[$index - 1][$indexChar - 1]) && $rows[$index - 1][$indexChar - 1] === 'M';
            $topRightS = isset($rows[$index - 1][$indexChar + 1]) && $rows[$index - 1][$indexChar + 1] === 'M';
            $bottomLeftM = isset($rows[$index + 1][$indexChar - 1]) && $rows[$index + 1][$indexChar - 1] === 'S';
            $bottomRightS = isset($rows[$index + 1][$indexChar + 1]) && $rows[$index + 1][$indexChar + 1] === 'S';


            if($topLeftM && $topRightS && $bottomLeftM && $bottomRightS) {
                $count++;
            }



            $topLeftM = isset($rows[$index - 1][$indexChar - 1]) && $rows[$index - 1][$indexChar - 1] === 'S';
            $topRightS = isset($rows[$index - 1][$indexChar + 1]) && $rows[$index - 1][$indexChar + 1] === 'S';
            $bottomLeftM = isset($rows[$index + 1][$indexChar - 1]) && $rows[$index + 1][$indexChar - 1] === 'M';
            $bottomRightS = isset($rows[$index + 1][$indexChar + 1]) && $rows[$index + 1][$indexChar + 1] === 'M';


            if($topLeftM && $topRightS && $bottomLeftM && $bottomRightS) {
                $count++;
            }
        }
    }
}

echo $count;