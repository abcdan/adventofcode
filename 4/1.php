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
        if($char === 'X') {
            // Check for "XMAS" pattern above the current 'X'
            if($rows[$index - 1][$indexChar] === 'M' && $rows[$index - 2][$indexChar] === 'A' && $rows[$index - 3][$indexChar] === 'S'){
                $count++;
            }
            
            // Check for "XMAS" pattern below the current 'X'
            if($rows[$index + 1][$indexChar] === 'M' && $rows[$index + 2][$indexChar] === 'A' && $rows[$index + 3][$indexChar] === 'S'){
                $count++;
            }

            // Check for "XMAS" pattern to the left of the current 'X'
            if($rows[$index][$indexChar - 1] === 'M' && $rows[$index][$indexChar - 2] === 'A' && $rows[$index][$indexChar - 3] === 'S'){
                $count++;
            }
            
            // Check for "XMAS" pattern to the right of the current 'X'
            if($rows[$index][$indexChar + 1] === 'M' && $rows[$index][$indexChar + 2] === 'A' && $rows[$index][$indexChar + 3] === 'S'){
                $count++;
            }

            // Check for "XMAS" pattern diagonally to the top-left of the current 'X'
            if($rows[$index - 1][$indexChar - 1] === 'M' && $rows[$index - 2][$indexChar - 2] === 'A' && $rows[$index - 3][$indexChar - 3] === 'S'){
                $count++;
            }

            // Check for "XMAS" pattern diagonally to the top-right of the current 'X'
            if($rows[$index - 1][$indexChar + 1] === 'M' && $rows[$index - 2][$indexChar + 2] === 'A' && $rows[$index - 3][$indexChar + 3] === 'S'){
                $count++;
            }

            // Check for "XMAS" pattern diagonally to the bottom-left of the current 'X'
            if($rows[$index + 1][$indexChar - 1] === 'M' && $rows[$index + 2][$indexChar - 2] === 'A' && $rows[$index + 3][$indexChar - 3] === 'S'){
                $count++;
            }

            // Check for "XMAS" pattern diagonally to the bottom-right of the current 'X'
            if($rows[$index + 1][$indexChar + 1] === 'M' && $rows[$index + 2][$indexChar + 2] === 'A' && $rows[$index + 3][$indexChar + 3] === 'S'){
                $count++;
            }
        }
    }
}

echo $count;