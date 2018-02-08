<?php
namespace TryPhp;

trait PredictExceptionTrait
{
	/**
	 * Method to assure that a piece of code executed inside of a capture 
	 * throws an exception and compare the type of it with a given class name
	 * @param callable $capture
	 * @param string $exceptionClass
	 * @throws PredictExceptionFailure
	 */
	public function predictException(callable $capture, string $exceptionClass) 
	{
		try {
			call_user_func($capture);
			throw new PredictExceptionFailure("Capture was expected to throw '$exceptionClass' but did not.");
		} catch (\Throwable $ex) {	
			$actualExceptionClass = get_class($ex);

			if ($actualExceptionClass === PredictExceptionFailure::class) {
				throw $ex;
			}

			if ($actualExceptionClass !== $exceptionClass) {
				throw new PredictExceptionFailure("Capture threw an Exception. Expected '$exceptionClass', but got '$actualExceptionClass'.");
			}
		}
	}
}