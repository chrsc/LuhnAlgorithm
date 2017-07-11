# Luhn Algorithm
I created this as a utility class that will be used to validate card numbers, this works for credit card numbers, bank accounts, loyalty card numbers, and all other card numbers that follow the modulus 10 formula.

Other uses: Validate Canadian SIN / Greek SSN / Israel ID numbers, NPI numbers for American health care, IMEI numbers.

This could not have been created without [Hans Peter Luhn's](https://en.wikipedia.org/wiki/Luhn_algorithm) Algorithm.

## Validate numbers
```php
<?php
	$number = 123456;
	$luhn = new LuhnAlgorithm;
	if($luhn->validate($number)) {
		// number passes validation
	} else {
		// number does not pass validation
	}
```

## Create numbers
```php
<?php
	$luhn = new LuhnAlgorithm;
	$length = 16;
	$startswith = 4444;
	$cardnumber = $luhn->create($length, $startswith);
	// $cardnumber is now a valid card number that can be used or assigned
```
