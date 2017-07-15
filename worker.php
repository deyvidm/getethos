<?php

require_once(__DIR__."/src/getethos.php");

$ethos = new GetEthos();
$ethos->cheat($argv[1], $argv[2], $argv[3]);

