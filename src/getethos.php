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

    public function cheat()
    {
        $curl = $this->getCh();

        foreach(range(1000000, 1) as $sum)
        {
            if ($sum % 100 === 0)
                echo "at $sum\n";
            $response = $this->makeRequest($curl, 10 , $sum);
            if ($response !== "Not Found") {
                if ($response !== "That's not a cool sum.") {
                    echo $num . " : " . $response."\n";

                    break;
                }
            }
        }
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
                $sum += $num;
            }
        }
        file_put_contents(__DIR__."/sumTo1Mil", $sum);
    }
        //what is security? 
        $sum = file_get_contents($filename);
        $curl = $this->getCh(); 

        foreach (range(1, 100) as $num)
        {

            $response = $this->makeRequest($curl, $num, $sum);
            if ($response !== "Not Found") {
                echo $num . " : " . $response."\n";
            }
        }
    }

    private function makeRequest($ch, $num, $sum)
    {
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_URL => "http://dev.getethos.com/code$num",
            CURLOPT_HTTPHEADER => [
            "x-cool-sum: $sum"
            ]
            ]);
        return curl_exec($ch);
    }

    private function getCh()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://dev.getethos.com/code1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));

        return $curl;
    }
}
