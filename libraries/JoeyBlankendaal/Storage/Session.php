<?php
/**
 * Library
 * JoeyBlankendaal/Storage/Session
 * 
 * All functions to work with sessions.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class Session
{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        return $_SESSION[$key];
    }
    
    public static function destroy($key)
    {
        unset($_SESSION[$key]);
    }
    
    public static function update($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function exists($key)
    {
        return isset($_SESSION[$key]);
    }
    
    public static function setFlashMessage($message)
    {
        $_SESSION['flashmessage'] = $message;
    }
}