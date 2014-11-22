<?php
/**
 * Library
 * JoeyBlankendaal/API/Hypixel
 * 
 * Gets data from the Hypixel Public API.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Hypixel
{
    public $apiKey;
    
    public function __construct($key)
    {
        $this->apiKey = $key;
    }
    
    public function get($category, $who, $what)
    {
        $default = false;

        if ($category == 'key')
        {
            return $this->apiKey;
        }
        if ($category == 'player')
        {
            if ($who > 16)
            {
                json_decode('https://api.hypixel.net/player?key=' . $this->apiKey . '&uuid=' . $who, true);
            }
            else
            {
                $jsonURL = 'https://api.hypixel.net/player?key=' . $this->apiKey . '&name=' . $who;
                $jsonGet = file_get_contents($jsonURL, 0, null, null);
                $jsonStrip = strip_tags($jsonGet);
                $jsonOutput = json_decode($jsonStrip, true);
                
                foreach ($jsonOutput as $output)
                {
                    if (isset($output[$what]))
                    {
                        $return = $output[$what];
                    }
                }
                
                return $return;
            }
        }
    }
}