<?php

class CoinChange
{
    const LENGTH = 15;

    function __construct($coins)
    {
        $this->coins = $coins;
        $this->memos = [];

        // Prepare Array
        for ($i = 0; $i < self::LENGTH; $i++)
        {
            array_push($this->memos, array());
            for ($j = 0; $j < self::LENGTH; $j++)
            {
                array_push($this->memos[$i], array());
    
                $this->memos[$i][$j] = -1;
            }   
        }
    }

    function coin_change($current_index, $current_value)
    {
        if ($current_index >= count($this->coins) || $current_value < 0)
            return 0;
        
        if ($current_value == 0)
            return 1;
        
        if ($this->memos[$current_index][$current_value] != -1)
            return $this->memos[$current_index][$current_value];
        
        $total_ways = 0;
        $total_ways += $this->coin_change($current_index, $current_value - $this->coins[$current_index]);
        $total_ways += $this->coin_change($current_index + 1, $current_value);
        $this->memos[$current_index][$current_value] = $total_ways;
        return $total_ways;
    }
}

$coin_change_calculator = new CoinChange([2, 3, 5]);
$total_ways = $coin_change_calculator->coin_change(0, 7);
echo sprintf("Total Ways To Return %d is %d", 7, $total_ways);
