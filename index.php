<?php

#echo "Start: " . convert(memory_get_usage());

include_once("app/system/bootstrap.php");


function convert($size) {
	$unit=array('b','kb','mb','gb','tb','pb');
	return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

#echo "Finish: " . convert(memory_get_usage());