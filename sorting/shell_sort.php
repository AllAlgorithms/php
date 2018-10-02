<?php
// PHP implementation of shell sort

function shellSort($array)
{
  $x = round(count($array) / 2);
  while ($x > 0)
  {
    for ($i = $x; $i < count($array);$i++) {
      $temp = $array[$i];
      $j = $i;
      while ($j >= $x && $array[$j - $x] > $temp)
      {
        $array[$j] = $array[$j - $x];
        $j -= $x;
      }
      $array[$j] = $temp;
    }
    $x = round($x / 2.2);
  }
  return $array;
}

$testArray = [3, 0, 2, 5, -1, 4, 1];

echo "Original array:\n";
echo implode(', ', $testArray);
echo "\nSorted array:\n";
echo implode(', ', shellSort($testArray)). PHP_EOL;
