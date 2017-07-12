<?php

require_once(__DIR__ . "/../src/getethos.php");

function assertHandler($file, $line, $code, $desc = null)
{
	echo "Assertion failed at $file:$line: $code";
	if ($desc) {
		echo ": $desc";
	}
	echo "\n";
}

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
assert_options(ASSERT_CALLBACK, 'assertHandler');


$ethos = new GetEthos();
echo "starting testing for cool numbers\n";
echo "=================================\n";
testGetCoolNumber($ethos, 23, 1);
testGetCoolNumber($ethos, 3, 3);
testGetCoolNumber($ethos, 2.3, false);
testGetCoolNumber($ethos, "adsf", false);
testGetCoolNumber($ethos, 423, 4);

function testGetCoolNumber($ethos, $input, $expected)
{
    echo "testing $input...";
    assert($ethos->generateCoolNumber($input) === $expected,
            "\nin:   $input\n" . 
            "got:  ". $ethos->generateCoolNumber($input) . "\n" .
            "want: $expected\n");
    echo "pass\n";
}
