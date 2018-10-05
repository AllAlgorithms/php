#!/usr/local/bin/php
<?php
// This works on non associative arrays.
function largest_sums_of_two( $arr ) {
	// Sorts the array so that it is highest to lowest.
	rsort( $arr );

	// Return the sum of the first two elements.
	return $arr[0] + $arr[1];
}

echo largest_sums_of_two( array( 86, 6, 1, 10, 20, 9 ) );
