<?php
$time_start = microtime_float();
echo "hi";

function convert($size) {
	$unit=array('b','kb','mb','gb','tb','pb');
	return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

echo "<div>" . convert(memory_get_usage(false)) . "</div>\n";

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "<div>$time seconds</div>\n";