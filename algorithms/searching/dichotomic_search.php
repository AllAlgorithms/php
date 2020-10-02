#!/usr/local/bin/php
<?php

// PHP implementation of dichtomic search
// work on already sorted array
//

function dichotomicSearch( $needle , array $haystack ) : bool 
{
    $arraySize = count($haystack);

    if ($arraySize === 0) {
        return false;
    }
    if ($arraySize === 1) {
        return current($haystack) === $needle;
    }


    // we divide the haystack into two pieces
    list($array1, $array2) = array_chunk($haystack, ceil($arraySize / 2));

    // if the researched value is lower than the first of the second pieces
    // the value could be only present in the first pieces
    if ($needle < current($array2)) {
        return dichotomicSearch($needle, $array1);
    }

    return dichotomicSearch($needle, $array2);
}

function printArray(array $array){
	for ($i = 0; $i < count($array); ++$i) {
        print $array[$i] . " ";
  }
	print "\n";
}


// Test
$array = array(1,5,10,15,25,26,27,29,30,42,50,66,153,175,186);
print "array\n";
printArray($array);
print "Is 27 in array ?\n";
var_dump(dichotomicSearch(27, $array));

print "Is 900 in array ?\n";
var_dump(dichotomicSearch(900, $array));
?>
