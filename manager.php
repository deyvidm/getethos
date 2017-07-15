<?php

$window = 1000;
$workerCounter = 0;

for($i = 0; $i < 1000000; $i += $window)
{
	$execString = "php worker.php $i " . ($i + $window) . " output/results_$workerCounter";
	echo "$i: $execString\n";
	exec($execString . " > /dev/null 2>/dev/null &");
	$workerCounter++;

	if ($workerCounter % 200 == 0)
	{
		while(getWorkerCount() >= 200)
		{
			sleep(3);
		}
	}
}

function getWorkerCount()
{
	exec("ps aux | grep php | grep worker | wc -l", $output);
	return $output[0];
}
