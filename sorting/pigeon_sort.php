<?php

function pigeon_sort($arr)
{
    //search min and max
    $min = $max = $arr[0];
    foreach ($arr as $num) {
        if ($num < $min)
            $min = $num;
        if ($num > $max)
            $max = $num;
    }

    $d = [];
    foreach ($arr as $num)
        $d[$num - $min]++;

    for ($i = 0; $i <= $max - $min; $i++)
        while ($d[$i + $min]-- > 0) $res[] = $i + $min;
    return $res;
}
