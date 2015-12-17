<?php
/**
 * --- Day 3: Perfectly Spherical Houses in a Vacuum ---
 * Santa is delivering presents to an infinite two-dimensional grid of houses.
 *
 * He begins by delivering a present to the house at his starting location, and then an elf at the North Pole calls him
 * via radio and tells him where to move next. Moves are always exactly one house to the north (^), south (v), east (>),
 * or west (<). After each move, he delivers another present to the house at his new location.
 *
 * However, the elf back at the north pole has had a little too much eggnog, and so his directions are a little off, and
 * Santa ends up visiting some houses more than once.
 *
 * How many houses receive at least one present?
 *
 * For example:
 * > delivers presents to 2 houses: one at the starting location, and one to the east.
 * ^>v< delivers presents to 4 houses in a square, including twice to the house at his starting/ending location.
 * ^v^v^v^v^v delivers a bunch of presents to some very lucky children at only 2 houses.
 *
 * --- Part Two ---
 * The next year, to speed up the process, Santa creates a robot version of himself, Robo-Santa, to deliver presents
 * with him.
 *
 * Santa and Robo-Santa start at the same location (delivering two presents to the same starting house), then take turns
 * moving based on instructions from the elf, who is eggnoggedly reading from the same script as the previous year.
 *
 * This year, how many houses receive at least one present?
 *
 * For example:
 * ^v delivers presents to 3 houses, because Santa goes north, and then Robo-Santa goes south.
 * ^>v< now delivers presents to 3 houses, and Santa and Robo-Santa end up back where they started.
 * ^v^v^v^v^v now delivers presents to 11 houses, with Santa going one direction and Robo-Santa going the other.
 *
 * --- Answers ---
 * Part One: 2565
 * Part Two: 2639
 */

$input = new SplFileObject("input/day3input.txt");
$data = $input->fgets();

$partOne = function () use ($data) {
    $move = str_split($data);
    $visited = ["0,0"];
    $santa_presents = 1;

    //starting coords
    $sx = 0;
    $sy = 0;

    foreach ($move as $k => $v) {
        switch ($v) {
            case "^":
                $sy++;
                break;
            case "v":
                $sy--;
                break;
            case ">":
                $sx++;
                break;
            case "<":
                $sx--;
                break;
        }

        if (!in_array("$sx,$sy", $visited)) {
            array_push($visited, "$sx,$sy");
            $santa_presents++;
        }
    }

    return $santa_presents;
};

$partTwo = function () use ($data) {
    $move = str_split($data);
    $visited = ["0,0"];
    $santa_presents = 1;
    $robo_presents = 0;

    //starting coords
    $sx = 0;
    $sy = 0;

    $rx = 0;
    $ry = 0;

    foreach ($move as $k => $v) {
        if ($k % 2 == 0) {
            switch ($v) {
                case "^":
                    $sy++;
                    break;
                case "v":
                    $sy--;
                    break;
                case ">":
                    $sx++;
                    break;
                case "<":
                    $sx--;
                    break;
            }

            if (!in_array("$sx,$sy", $visited)) {
                array_push($visited, "$sx,$sy");
                $santa_presents++;
            }
        } else {
            switch ($v) {
                case "^":
                    $ry++;
                    break;
                case "v":
                    $ry--;
                    break;
                case ">":
                    $rx++;
                    break;
                case "<":
                    $rx--;
                    break;
            }
            if (!in_array("$rx,$ry", $visited)) {
                array_push($visited, "$rx,$ry");
                $robo_presents++;
            }
        }
    }
    $total = (int)$santa_presents + (int)$robo_presents;
    $presents = [
        'santa' => $santa_presents,
        'robo'  => $robo_presents,
        'total' => $total,
    ];

    return $presents;
};

$part_one_results = '--- Part One ---' . PHP_EOL
    . 'Santa delivered at least one present to '
    . $partOne()
    . ' houses.' . PHP_EOL . PHP_EOL;
echo $part_one_results;

$part_two_results = '--- Part Two ---' . PHP_EOL
    . 'Santa:      ' . $partTwo()['santa'] . PHP_EOL
    . 'Robo-Santa: ' . $partTwo()['robo'] . PHP_EOL
    . 'Total:      ' . $partTwo()['total'];
echo $part_two_results;