<?php
namespace chrsc\LuhnAlgorithm;

class LuhnAlgorithm {
	protected $checksum, $odd, $even, $orig;
	protected $debug = true;

	public function __construct(){
		// everything removed out of construct
		// echo "created Luhn\n";
	}

	public function create($length=16, $startswith='604646') {
		// keep the numbers from ever being duplicated
		$startdigits = $startswith;
		// next four represent time of day in mmss
		for( $i=1; $i < ($length-strlen($startswith)-4); $i++ ) {
			$middledigits = rand(1,9);
		}
		// then add a random 4 digits if not in session already;
		$lastdigits = rand(1000, 9999);
		$numbers = $startdigits . $middledigits . $lastdigits;
		while(!$this->validate($numbers)) {
			$lastdigits++;
			$numbers = $startdigits . $middledigits . $lastdigits;
		}
		return $numbers;
	}

	public function validate($numbers) {
		$this->odd = $this->even = [];
		$this->orig = $numbers;
		$numbers = $this->to_array($numbers);
		$this->sort_odd_even($numbers);
		$this->create_checksum($numbers);
		return $this->is_valid();
	}

	public function is_valid() {
		return ($this->checksum % 10 == 0);
	}

	protected function create_checksum($numbers) {
		$this->checksum = array_sum($this->even);
		foreach($this->odd as $odd) {
			$odd = $this->to_array($odd*2);
			$this->checksum += array_sum($odd);
		}
	}

	protected function sort_odd_even($numbers) {
		for ($i = 0; $i < count($numbers); $i++) {
			if ($i % 2 == 0) {
				$this->even[] = $numbers[$i];
			} else {
				$this->odd[] = $numbers[$i];
			}
		}
	}

	protected function to_array($numbers) {
		$arr = [];
		// prepare the data to check - convert to string
		$numbers = (string)$numbers;
		for($i=0;$i<strlen($numbers);$i++) {
			$arr[] = $numbers{$i};
		}
		// reverse array to calculate checksum from tail end
		return array_reverse($arr);
	}

	protected function luhn_print($str) {
		($this->debug) ? print( $str ) : '';
	}
}
