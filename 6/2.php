<?php

$contents = file_get_contents(filename: '1.txt');

$map = [];

foreach (explode(separator: "\n", string: $contents) as $line) {
    $map[] = str_split(string: $line);
}

$startingCoordinates = [0, 0];

foreach ($map as $y => $row) {
    foreach ($row as $x => $cell) {
        if ($cell === '^') {
            $startingCoordinates = [$y, $x];
            break 2;
        }
    }
}

function moveUp($currentY, $currentX, $map)
{
    if (!isset($map[$currentY - 1][$currentX])) {
        return [null, [$currentY - 1, $currentX]];
    }
    $nextMove = $map[$currentY - 1][$currentX];
    return [$nextMove, [$currentY - 1, $currentX]];
}

function moveRight($currentY, $currentX, $map)
{
    if (!isset($map[$currentY][$currentX + 1])) {
        return [null, [$currentY, $currentX + 1]];
    }
    $nextMove = $map[$currentY][$currentX + 1];
    return [$nextMove, [$currentY, $currentX + 1]];
}

function moveDown($currentY, $currentX, $map)
{
    if (!isset($map[$currentY + 1][$currentX])) {
        return [null, [$currentY + 1, $currentX]];
    }
    $nextMove = $map[$currentY + 1][$currentX];
    return [$nextMove, [$currentY + 1, $currentX]];
}

function moveLeft($currentY, $currentX, $map)
{
    if (!isset($map[$currentY][$currentX - 1])) {
        return [null, [$currentY, $currentX - 1]];
    }
    $nextMove = $map[$currentY][$currentX - 1];
    return [$nextMove, [$currentY, $currentX - 1]];
}

$steps = 1;
$direction = 0; // 0: up, 1: right, 2: down, 3: left
$currentCoordinates = $startingCoordinates;
$visited = [$currentCoordinates[0] . ',' . $currentCoordinates[1] => true];
$outputMap = $map;

while (true) {
    $nextCell = null;

    switch ($direction) {
        case 0: // up
            $nextCell = moveUp($currentCoordinates[0], $currentCoordinates[1], $map);
            break;
        case 1: // right
            $nextCell = moveRight($currentCoordinates[0], $currentCoordinates[1], $map);
            break;
        case 2: // down
            $nextCell = moveDown($currentCoordinates[0], $currentCoordinates[1], $map);
            break;
        case 3: // left
            $nextCell = moveLeft($currentCoordinates[0], $currentCoordinates[1], $map);
            break;
    }

    if ($nextCell[0] === '#') {
        // Hit obstacle, turn right
        $direction = ($direction + 1) % 4;
        continue;
    }

    if ($nextCell[0] === null) {
        // Left the map
        break;
    }

    // Move to next position
    $currentCoordinates = $nextCell[1];
    $key = $currentCoordinates[0] . ',' . $currentCoordinates[1];

    if (!isset($visited[$key])) {
        $steps++;
        $visited[$key] = true;
        if ($outputMap[$currentCoordinates[0]][$currentCoordinates[1]] === '.') {
            $outputMap[$currentCoordinates[0]][$currentCoordinates[1]] = 'X';
        }
    }
}

$output = '';
foreach ($outputMap as $row) {
    $output .= implode('', $row) . "\n";
}
file_put_contents('output.txt', $output);

echo $steps;
