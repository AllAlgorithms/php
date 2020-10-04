#!/usr/local/bin/php
<?php
/* 
 * @Author: Menaka S.
 * @Email: menakas.menakas@gmail.com
 *
 * For a detailed explanation of the lucky numbers that we are trying to generate,
 * check here: https://github.com/AllAlgorithms/algorithms/tree/master/math/lucky-numbers
 *
 */

$integers = array();

print "Enter a max number upto which lucky numbers will be generated:";

trim(fscanf(STDIN, "%d\n", $numeric_input)); // Generate lucky numbers less than or equal to $numeric_input

for( $i = 1 ; $i <= $numeric_input; $i++ ) {
	$integers[$i] = $i; // Initialize to index
}
// print_r( $integers );


for( $n = 2; $n <= $numeric_input/2; $n++) { // Start with every second, then every third and so on
$index = 1;
	do {
		$next_index = get_next_nth_value( $index, $n, $integers, $numeric_input ); // Get the next index that needs to be removed
		if($next_index <= $numeric_input) {
			$integers[$next_index] = 0;
			$index = $next_index + 1;
		}
	} while ( $next_index <= $numeric_input ); // Ensure that we are not going beyong the max
// print_r( $integers );
}


print "\nLucky numbers are:\n";
for( $i = 1 ; $i <= $numeric_input; $i++ ) {
		if( $integers[$i] ) {
				print $i ." ";
			}
}

function get_next_nth_value( $start, $n, $integers, $numeric_input ) {
		$count = 0; // Keep track of the nth integer
		$index = $start-1; // Small adjustment so that we count the starting integer as well.
		while ( $count < $n ) {
				$index++;
				if( $index <= $numeric_input ) { // Are we within max ?
					   	if( $integers[ $index ] !== 0 ) { // Count as nth only if it is not already removed
								$count++;
						}
				}
				else {
						return $numeric_input + 1; // Gone beyond limits
				}
		}
		return $index;
}

?>
