<?php

// curl iterator v1

// takes any curl cmd (encoded as base64)
// where e.g pageNumber is replace with {{iterator}}
// and then encode as base64
// downloads as iterated .json files

$name = isset($argv[1]) ? $argv[1] : false;
$min  = isset($argv[2]) ? $argv[2] : false;
$max  = isset($argv[3]) ? $argv[3] : false;
$curl = isset($argv[4]) ? $argv[4] : false;

$iterator = (int) $min;

if ($name && $min == 0 || $min && $max && $curl) {
	$curlRaw = base64_decode($curl);
	while($iterator < $max+1) {
		$curlGenerate = str_ireplace('{{iterator}}', $iterator, $curlRaw);
		echo exec($curlGenerate.' > '.$name.$iterator.'.json');
		echo PHP_EOL.'>> ITERATION: '.$iterator.'/'.$max.PHP_EOL;
		echo PHP_EOL.'>> SAVED: '.$name.$iterator.'.json'.PHP_EOL;
		die;
		$iterator++;
	}
} else {
	echo('>> Usage: <filename> <min> <max> <base64Curl>'.PHP_EOL);
	echo('>> base64Curl: raw string variables {{iterator}}'.PHP_EOL);
	echo('>> Author: Liquid44'.PHP_EOL);
}
