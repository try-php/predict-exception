<?php
require_once __DIR__ . '/vendor/autoload.php';

use TryPhp\PredictExceptionTrait;

$executionClass = new class() {
	use PredictExceptionTrait;
};

try {
	$executionClass->predictException(function () {
	}, \Exception::class);
	trigger_error('test failed', E_USER_ERROR);
} catch (\Exception $ex) {
	if ($ex->getMessage() !== "Capture was expected to throw 'Exception' but did not.") {
		trigger_error('test failed', E_USER_ERROR);
	}
}

try {
	$executionClass->predictException(function () {
		throw new Exception('something happened');
	}, \Exception::class);	
} catch (\Exception $ex) {
	trigger_error('test failed', E_USER_ERROR);
}

try {
	$executionClass->predictException(function () {
		throw new Exception('something happened');
	}, \RuntimeException::class);	
} catch (\Exception $ex) {
	if ($ex->getMessage() !== "Capture threw an Exception. Expected 'RuntimeException', but got 'Exception'.") {
		trigger_error('test failed', E_USER_ERROR);
	}
}