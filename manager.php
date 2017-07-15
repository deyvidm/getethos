<?php

$window = 1000;
$workerCounter = 0;

for($i = 0; $i < 1000000; $i += $window)
{
	$execString = "php worker.php $i " . ($i + $window) . " output/results_$workerCounter";
	echo "$i: $execString\n";
	exec($execString . " &");
	$workerCounter++;
}
