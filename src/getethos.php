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
}
