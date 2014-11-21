<?php
/**
 * JoeyBlankendaal/API/Hypixel
 * Gets data from the Hypixel Public API.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class Hypixel
{
    public $apiKey;
    
    public function __construct($key)
    {
        $this->apiKey = $key;
    }
    
    public static function get()
    {
    
    }
}