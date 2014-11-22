<?php
/**
 * Library
 * JoeyBlankendaal/Core/Language
 * 
 * Gives the ability to change languages with arrays.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Language
{
    private static $languageArray;
    
    public static function __callStatic($stringKey, $stringArguments)
    { 
        return self::getText($stringKey, $stringArguments);
    }
    
    public static function loadLanguage($arrayLanguage)
    {    
        self::$languageArray = $arrayLanguage;            
    }
    
    private static function getText($stringKey, $arrayArguments)
    {
        if (array_key_exists($stringKey, self::$languageArray) === true)
        {
            if (isset($arrayArguments))
            {
                return vsprintf(self::$languageArray[$stringKey], $arrayArguments); 
            }
            else
            {
                return self::$languageArray[$stringKey];
            }
        }
        else
        {
            throw new Exception('While getting text: String ' . $stringKey . ' not found.');
        }             
    }    
}