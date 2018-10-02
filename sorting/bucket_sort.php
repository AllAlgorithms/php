<?php

function lists(array $lists = [])
{
    if (!$lists || count($lists) < 2) {
        return [];
    }

    $min = $lists[0];
    $max = $lists[0];

    $lCnt = count($lists);
    for ($i = 1; $i < $lCnt; $i++) {
        if ($lists[$i] > $max) {
            $max = $lists[$i];
        }

        if ($lists[$i] < $min) {
            $min = $lists[$i];
        }
    }

    $newLists = range(0, $max - $min + 1);


    $nlCnt = count($newLists);
    for ($i = 0; $i < $nlCnt; $i++) {
        $newLists[$i] = [];
    }

    $llCnt = count($lists);

    for ($i = 0; $i < $llCnt; $i++) {
        $newLists[$lists[$i] - $min][] = $lists[$i];
    }

    $position = 0;

    $nllCnt = count($newLists);
    for ($i = 0; $i < $nllCnt; $i++) {
        if (count($newLists[$i]) > 0) {
            for ($j = 0; $j < count($newLists[$i]); $j++) {
                $lists[$position++] = $newLists[$i][$j];
            }
        }
    }

    return $lists;
}
