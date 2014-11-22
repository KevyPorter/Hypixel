<?php
/**
 * Library
 * JoeyBlankendaal/Storage/Configuration
 * 
 * Sets and manages configuration variables.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Configuration
{
    private static $config = array();
    
    public static function get($string = false)
    {
        if (empty($string))
        {
            return self::$config;
        }
    
        if (!self::exist($string))
        {
            throw new Exception('The search variable doesn\'t exist.');
        }
        
        $current = self::$config;
        
        foreach(self::_stripSearch($string) as $part)
        {
            $current = $current[$part];
        }
        
        return $current;
    }
    
    public static function set($string, $value)
    {
        if (!is_string($string))
        {
            throw new Exception('The search variable isn\'t a string.');
        }
            
        $current = &self::$config;
        
        foreach(self::_stripSearch($string) as $part)
        {
        
            if (!isset($current[$part]) || !is_array($current[$part]))
            {
                $current[$part] = array();
            }
            
            $current = &$current[$part];
        
        }
        
        $current = $value;
    }
    
    public static function exist($string)
    {
        if (!is_string($string))
        {
            throw new Exception('The search variable isn\'t a string.');
        }
        
        $current = self::$config;
        
        foreach(self::_stripSearch($string) as $part)
        {
            if (is_array($current) && isset($current[$part]))
            {
                $current = $current[$part];
            }
            else
            {
                return false;
            }
        }
        
        return true;
    }
    
    public static function remove($string)
    {
        if (!self::exist($string))
        {
            throw new Exception('The search variable doesn\'t exist.');
        }
        
        $current = self::$config;
        
        foreach(self::_stripSearch($string) as $part)
        {
            $current = &$current[$part];
        }
        
        unset($current);
    }
    
    public static function manualLoad($file, $variable = false)
    {
        if (!is_string($file) || !file_exists($file))
        {
            throw new Exception('The config file doesn\'t exist. (' . $file . ')');
        }
        
        $content = require($file);
        
        if (!empty($variable) && !is_string($variable))
        {
            throw new Exception('The config variable isn\'t a string.');
        }
            
        if (!empty($variable))
        {
            self::set($variable, $content);
        }
        else
        {
            self::$config = array_merge(self::get(), $content);
        }
        
        return $content;
    }
    
    public static function load($file)
    {
        if (!is_string($file) || !file_exists($file))
        {
            throw new Exception('The config file doesn\'t exist.');
        }
        
        $fileName = basename($file, '.php');
        $configDirectory = 'applications/' . APPLICATION . '/Configuration/';
        
        return self::manualLoad($configDirectory . $file, $fileName);
    }
    
    protected static function _stripSearch($string)
    {
        $parts = explode('.', $string);
        return $parts;
    }
}