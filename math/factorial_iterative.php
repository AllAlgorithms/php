#!/usr/local/bin/php
<?php

// PHP implementation Factorial of n (iterative implementation)

function factorial($n) {
    $r = 1;
    while ($n > 0) {
        $r *= $n;
        $n -= 1;
    }

    return $r;
}


// Test
$number = 110;

echo "$number! = " . factorial($number);