<?php

function factorialRecursiosn($n)
{
  return $n ? $n * factorialRecursiosn($n-1) : 1;
}


function factorial($n)
{
  $result = 1;

  for ($i=2; $i<=$n; $i++)
    $result *= $i;

  return $result;
}
