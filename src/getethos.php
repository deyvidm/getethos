<?php

class GetEthos
{
	/**
	 * Determine if an integer is a cool number or not.
	 *
	 * @param int $base  Need an integer to perform the opertion.
	 * @param bool $verbose Do I echo out all the steps? Caution: will get insane with large numbers
	 *
	 * @return bool Returns True if integer is a cool number, false otherwise.
	 */
	public function isCoolNumber($base, $verbose = false)
	{
		if($base === 1)
		{
			return true;
		}
		if($base === 4)
		{
			return false;
		}

		$numbers = array_map('intval', str_split($base));
		$sum = 0;
		foreach($numbers as $number)
		{
			$sum += $number * $number;
		}

		if ($verbose) echo "$base -> $sum\n";

		return $this->isCoolNumber($sum, $verbose);
	}

	public function solve()
	{
		$sum = 0;
		foreach(range(1, 1000000) as $num)
		{
			if($this->isCoolNumber($num))
			{
				$sum += $num;
			}
		}
		$curl = $this->getCh();

		foreach(range(1, 100) as $num)
		{
			$response = $this->makeRequest($curl, $num, $sum);
			if($response !== "Not Found")
			{
				echo $num . " : " . $response . "\n";
			}
		}
	}

	private function makeRequest($ch, $num, $sum)
	{
		curl_setopt_array($ch, [
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_URL           => "http://dev.getethos.com/code$num",
			CURLOPT_HTTPHEADER    => [
				"x-cool-sum: $sum",
			]
		]);

		return curl_exec($ch);
	}

	private function getCh()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL            => "http://dev.getethos.com/code1",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
		));

		return $curl;
	}
}
