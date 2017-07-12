<?php

class GetEthos
{
	public function generateCoolNumber($base)
    {
		try 
		{
			$clean = intval($base);
			if ((string)$clean !== (string)$base)
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
        
        if (strlen($base) == 1)
        {
            return $base;
        } 

        $numbers = array_map('intval', str_split($base));
        $sum = 0;
        foreach($numbers as $number)
        {
            $sum += $number*$number; 
        }

		return $this->generateCoolNumber($sum);
    }
    
    public function solve()
    {
        $filename = __DIR__."/sumTo1Mil";
        //if (!file_exists($filename)) 
        {
            $sum = 0;
            foreach(range(1,1000000) as $num)
            {
                if (($result = $this->generateCoolNumber($num)) === 1)
                {
                    $sum += $result;
                }
            }
            file_put_contents(__DIR__."/sumTo1Mil", $sum);
        }
        //what is security? 
        $sum = file_get_contents($filename);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://dev.getethos.com/code1",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => array(
            "x-cool-sum: 3745182"
          ),
        ));

        foreach (range(1, 100) as $num)
        {
            curl_setopt_array($curl, [
                CURLOPT_URL => "http://dev.getethos.com/code$num",
                CURLOPT_HTTPHEADER => [
                    "x-cool-sum: $sum"
                ]
                ]);
            $response = curl_exec($curl);
            if ($response !== "Not Found") {
                echo $response."\n";
            }
        }
    }
}
