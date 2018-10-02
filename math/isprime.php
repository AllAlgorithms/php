#!/usr/local/bin/php
<?php
/*
* An efficient algorithm to check whether a given number is prime
* Author: Muzaffar Auhammud <muzaffar@cyberstorm.mu>
* Date: October 2, 2018
*/

function isPrime($num)
{
    $prime = true;

    if ($num <= 1)
    {
        $prime = false;
    }
    else if ($num == 2)
    {
        $prime = true;
    }
    else
    {
        for ($i = 2; $i * $i <= $num; $i++)
        {
            if (($num % $i) == 0)
            {
                $prime = false;
                break;
            }
        }
    }

    return $prime;
}

// Test (print all primes between 0 and 100 inclusive)
for ($i = 0; $i <= 100; $i++)
{
    if (isPrime($i))
    {
        print $i . "\r\n";
    }
}
?>