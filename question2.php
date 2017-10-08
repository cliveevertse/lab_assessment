<?php

//Checks for valid timestamp
function isValidTimeStamp($timestamp){
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

//Function to validate CSV and return Sum of all Values 
 function validateCSV($filePath){
 	//Check if path or file exists
 	if(file_exists($filePath)){
 		//Open file for reading
 		$file = fopen($filePath, 'r');
 		//Array to store Values
		$data = array();
		//Pattern for First Column
		$pattern = '#[A-Za-z]{3,5}-[0-9]+?$#';
		while (($line = fgetcsv($file)) !== FALSE) {
			//Checks format of first Column
			if(preg_match($pattern, $line[0])){
				//Check if valid timestamp
				if(isValidTimeStamp($line[1])){
					//Check if valid number
					if(is_numeric($line[2])){
						$data[] = $line[2];
					}
				}
			}
		}
		//Close File
		fclose($file);
		//Prints our Sum of Values
		echo array_sum($data);	
 	}

}

validateCSV('test.csv');