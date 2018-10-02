<?php
function binarySearch(Array $arr, $start, $end, $x){ 
    if ($end < $start) 
        return false; 
   
    $mid = floor(($end + $start)/2); 
    if ($arr[$mid] == $x)  
        return true; 
  
    elseif ($arr[$mid] > $x) { 
  
        // call binarySearch on [start, mid - 1] 
        return binarySearch($arr, $start, $mid - 1, $x); 
    } 
    else { 
  
        // call binarySearch on [mid + 1, end] 
        return binarySearch($arr, $mid + 1, $end, $x); 
    } 
} 
  
// Driver code 
$arr = array(1, 2, 3, 4, 5); 
$value = 5; 
if(binarySearch($arr, 0, count($arr) - 1, $value) == true) { 
    echo $value." Exists"; 
} 
else { 
    echo $value." Doesnt Exist"; 
} 
?>
