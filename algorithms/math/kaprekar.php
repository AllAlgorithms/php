#!/usr/local/bin/php
<?php

/**
* PHP Implementation of Kaprekar numbers
*
* A Kaprekar number is a number whose square when divided into two parts
* and such that sum of parts is equal to the original number and none of 
* the parts has value 0. 
*
* @author Asfo Zavala
* @function isKaprekar
* @param (int) $n
*/
function isKaprekar($number) {
    $exp = pow($number, 2);
    $exp_str = (string) $exp;
    if (strlen($exp_str) <= 9) {
        $exp_str = '0' + $exp_str;
    }
    $mid = (int) (strlen($exp_str) / 2);
    $left = (int) substr($exp_str, 0, $mid);
    $right = (int) substr($exp_str, $mid);
    return $left + $right === $number;
}

/** Test */

var_dump(isKaprekar(45)); // Returns true since 45 is kaprekar
var_dump(isKaprekar(13)); // Returns false since 13 is not kaprekar

/** Explanation about the examples */
// 45^2 = 2025 and 20 + 25 is 45, so 45 = 45. Is kaprekar.
// 13^2 = 169 and 16 + 9 nor 1 + 69 is not equal to 13. Is not kaprekar.
