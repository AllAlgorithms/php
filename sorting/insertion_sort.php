<?php

//insertion sort implementation in PHP by Neville Antony

function insertion_Sort($arr_input)
{
	for($i=0;$i<count($arr_input);$i++){
		$tmp = $arr_input[$i];
		$j = $i-1;
		while($j>=0 && $arr_input[$j] > $tmp){
			$arr_input[$j+1] = $arr_input[$j];
			$j--;
		}
		$arr_input[$j+1] = $tmp;
	}
return $arr_input;
}

$array = array(21, 30, 82, 41, -34, 89, 26);
echo "Given Array :\n";
echo implode(', ',$array );
echo "\nThe sorted Array is :\n";
print_r(insertion_Sort($array));

?>
