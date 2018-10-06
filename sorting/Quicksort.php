 <?php

$_Code = array(43,21,2,1,9,24,2,99,23,8,7,114,92,5);
$highVal = $lowVal = array();

for ($i=1; $i < count($_Code); $i++)
{
    if ($_Code[$i] <= $_Code[0]) 
        $lowVal [] = $_Code[$i];
    else
        $highVal [] = $_Code[$i];
}

return array_merge($lowVal, $highVal, array($_Code[0]));
