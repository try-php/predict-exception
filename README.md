# predict-exception

> Simplified predictions if a piece of codes throws an Exception

[![Build Status](https://travis-ci.org/try-php/predict-exception.svg?branch=master)](https://travis-ci.org/try-php/predict-exception)

## Install

```bash
$ composer require try/predict-exception
```

## Usage

```php
<?php
require_once '/path/to/autoload.php';

use TryPhp\PredictExeptionTrait;

$assertions = new class() {
	use PredictExeptionTrait();
} 

$assertions->predictException(function () {
	throw new \RuntimeException('Oooops. Something broke.')
}, \RuntimeException::class); // won't throw an exception

$assertions->predictException(function () {
}, \Exception::class); // will throw an exception

$assertions->predictException(function () {
	throw new \RuntimeException('something else happened.');
}, \Exception::class); // will throw an exception
```

## API

### Methods

#### `predictException($capture, $exceptionClass)`

Method to check if a given piece of code throws an Exception of the expected type.

##### Arguments

| Arguments | Type | Description |
|---|---|---|
| $capture | `callable` | Closure in which the Exception shall be thrown. |
| $exceptionClass | `string` | Class of the Exception that is expected to be thrown. |

## License

GPL-2.0 © Willi Eßer