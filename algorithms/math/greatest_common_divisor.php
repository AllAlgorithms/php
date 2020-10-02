<?php

function gcd ($a, $b) {
    while ($a <> 0 && $b <> 0) {
        if ($a > $b)
            $a = $a % $b;
        else
            $b = $b % $a;
    }
    return abs($a + $b);
}

echo gcd(5, 3);
