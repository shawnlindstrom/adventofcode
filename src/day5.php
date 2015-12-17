<?php
/**
 * --- Day 5: Doesn't He Have Intern-Elves For This? ---
 * Santa needs help figuring out which strings in his text file are naughty or nice.
 *
 * A nice string is one with all of the following properties:
 *
 * It contains at least three vowels (aeiou only), like aei, xazegov, or aeiouaeiouaeiou.
 * It contains at least one letter that appears twice in a row, like xx, abcdde (dd), or aabbccdd (aa, bb, cc, or dd).
 * It does not contain the strings ab, cd, pq, or xy, even if they are part of one of the other requirements.
 *
 * For example:
 * ugknbfddgicrmopn is nice because it has at least three vowels (u...i...o...), a double letter (...dd...), and none
 * of the disallowed substrings.
 * aaa is nice because it has at least three vowels and a double letter, even though the letters used by different rules
 * overlap.
 * jchzalrnumimnmhp is naughty because it has no double letter.
 * haegwjzuvuyypxyu is naughty because it contains the string xy.
 * dvszwmarrgswjxmb is naughty because it contains only one vowel.
 *
 * How many strings are nice?
 *
 * --- Part Two ---
 * Realizing the error of his ways, Santa has switched to a better model of determining whether a string is naughty or
 * nice. None of the old rules apply, as they are all clearly ridiculous.
 *
 * Now, a nice string is one with all of the following properties:
 *
 * It contains a pair of any two letters that appears at least twice in the string without overlapping, like xyxy (xy)
 * or aabcdefgaa (aa), but not like aaa (aa, but it overlaps).
 * It contains at least one letter which repeats with exactly one letter between them, like xyx, abcdefeghi (efe), or
 * even aaa.
 *
 * For example:
 *
 * qjhvhtzxzqqjkmpb is nice because is has a pair that appears twice (qj) and a letter that repeats with exactly one
 * letter between them (zxz).
 * xxyxx is nice because it has a pair that appears twice and a letter that repeats with one between, even though the
 * letters used by each rule overlap.
 * uurcxstgmygtbstg is naughty because it has a pair (tg) but no repeat with a single letter between them.
 * ieodomkazucvgmuy is naughty because it has a repeating letter with one between (odo), but no pair that appears twice.
 *
 * How many strings are nice under these new rules?
 *
 * --- Answers ---
 * With no small thanks to: https://regex101.com/
 * Note: Since we are working with strings per the instructions we can use the \D meta character rather than . or \w
 * Part One: 236
 * Part Two: 51
 */

$data = file('input/day5input.txt');

$partOne = function () use ($data) {
    $vowels = "/([aeiou]\\D*){3}/"; // find any defined character in the capture group that occurs 3 times
    $repeat = "/(\\D)\\1{1}/"; // find a single non-digit character that repeats itself once
    $exclude = "/(ab|cd|pq|xy)/"; //  find any of the defined pairs in the capture group

    $count = 0;
    foreach ($data as $v) {
        if (preg_match($vowels, $v) && preg_match($repeat, $v) && !preg_match($exclude, $v)) $count++;
    }

    return $count;
};

$partTwo = function () use ($data) {
    $split_repeat = "/(\\D{2})\\D*?\\1/"; // find any two non-digit chars that repeats itself separated by any character
    $pair_repeat = "/(\\D)\\D\\1/"; // find any repetition of characters that repeat separated by any character

    $count = 0;
    foreach ($data as $v) {
        if (preg_match($split_repeat, $v) && preg_match($pair_repeat, $v)) $count++;
    }

    return $count;
};

echo 'Part One: ' . $partOne() . PHP_EOL;
echo 'Part Two: ' . $partTwo() . PHP_EOL;
