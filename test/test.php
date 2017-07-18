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
testGetCoolNumber($ethos, 23, true);
testGetCoolNumber($ethos, 100, true);
testGetCoolNumber($ethos, 3, false);
testGetCoolNumber($ethos, 423, false);

function testGetCoolNumber($ethos, $input, $expected)
{
    echo "testing $input\n";
    $result = $ethos->isCoolNumber($input);
    assert( $result === $expected,
            "\nin:   $input\n" . 
            "got:  ". $result . "\n" .
            "want: $expected\n");
}
