<?php
/*
 * --- Day 1: Not Quite Lisp ---
 * Santa is trying to deliver presents in a large apartment building, but he can't find the right floor - the directions
 * he got are a little confusing. He starts on the ground floor (floor 0) and then follows the instructions one
 * character at a time.
 *
 * An opening parenthesis, (, means he should go up one floor, and a closing parenthesis, ), means he should go down one
 * floor.
 *
 * The apartment building is very tall, and the basement is very deep; he will never find the top or bottom floors.
 *
 * For example:
 * (()) and ()() both result in floor 0.
 * ((( and (()(()( both result in floor 3.
 * ))((((( also results in floor 3.
 * ()) and ))( both result in floor -1 (the first basement level).
 * ))) and )())()) both result in floor -3.
 * To what floor do the instructions take Santa?
 *
 * --- Part Two ---
 *  Now, given the same instructions, find the position of the first character that causes him to enter the basement
 * (floor -1). The first character in the instructions has position 1, the second character has position 2, and so on.
 *
 * For example:
 * ) causes him to enter the basement at character position 1.
 * ()()) causes him to enter the basement at character position 5.
 * What is the position of the character that causes Santa to first enter the basement?
 *
 * --- Answers ---
 * Part One: 138
 * Part Two: 1771
 */

$input = new SplFileObject('input/day1input.txt');
$data = $input->fgets();

$floor = function () use ($data) {
    return substr_count($data, '(') - substr_count($data, ')');
};

$basement = function () use ($data) {
    $strlen = strlen($data);
    $j = 0;
    for ($i = 0; $i <= $strlen; $i++) {
        $substr = substr($data, $i, 1);
        $floor = ($substr == '(') ? $j++ : $j--;
        if ($floor == -1) {
            return $i;
        }
    }
};
echo 'Floor to visit: ' . $floor() . PHP_EOL . 'Basement first reached at step: ' . $basement();