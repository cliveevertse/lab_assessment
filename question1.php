<?php

	//Fibonacci series and try to get index
	function getFibonicciIndex($number){
	    $log_base = (1+sqrt(5))/2;
	    $index = log(($number*sqrt(5)-(1/2)), $log_base);
	    return floor($index)+1;
	}

	//Calculate the Fibonacci number with given index
	function getFibonicciNumber($term){
	    $a = (1+sqrt(5))/2;
	    $b = (1-sqrt(5))/2;
	    $fibonicci_number = (pow($a, $term)-pow($b, $term))/sqrt(5);
	    return $fibonicci_number;
	}

	$number = 1;
	$index = getFibonicciIndex($number);
	$index_value = getFibonicciNumber($index);
	echo ($number == $index_value) ? true : false;