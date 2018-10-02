#!/usr/local/bin/php
<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-10-02 12:42:05 
 * @Email: fer@dika.web.id 
 */
function fibo($number){
	if($number===1){
		return 0;
	}else if($number===2){
		return 1;
	}else{
		return fibo((int)$number -1)+fibo((int) $number-2);
	}
}

function fibonacci($n){
	for($i=1;$i<=$n;$i++){
		if($i>1){
			echo(" ");
		}
		echo(fibo($i));
	}
}

// Test
fibonacci(12);