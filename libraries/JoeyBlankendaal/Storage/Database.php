<?php
/**
 * JoeyBlankendaal/Storage/Database
 * All functions to work with the database.
 *
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class Database
{
    private static $connection = null;
    
    public static $user = null;
    public static $queries = 0;
    public static $queers = array();
    public static $settings = array(true, false);
    public static $parameters = array();
    public static $parametersOperator = '@';
    
    public static function connect(array $data, array $settings = Array(true, false))
    {
        self::$settings = $settings;
        
        if (!self::$connection = @mysqli_connect($data['host'], $data['user'], $data['password'], $data['database']))
        {
            throw new Exception('While connecting to host, using incorrect data.');
        }
        else
        {
            if (!@mysqli_select_db(self::$connection, $data['database']))
            {
                throw new Exception('While connecting to database, using incorrect data.');
            }
            else
            {
                self::$user = $data['user'];
	    }
        }
    }
    
    public static function addParameter($key, $value)
    {
        self::$parameters[$key] = ((is_string($value)) ? "'" . $value . "'" : $value);
    }
    
    public static function query($query, $isSelect = false)
    {
        self::$queries++;
        
        if (self::$settings[0])
        {
            self::saveQuery($query);
        }
        
        foreach (self::$parameters as $key => $value)
        {
            $query = str_replace(self::$parametersOperator . $key, $value, $query);
        }
        
        $queer = mysqli_query(self::$connection, $query);
        
        if (mysqli_error(self::$connection))
        {
            throw new Exception('While executing query, incorrect syntax.');
        } 
        else 
        {
            return $queer;
        }
    }
    
    public static function getDataArray($query)
    {
        $queer = self::query($query);
        $return = array();
        
        while($data = self::fetch($queer))
        {
            $return[$data['user']] = $data['value'];
        }
        
        return $return;
    }
    
    public static function getTable($query)
    {
        $queer = self::query($query);
        $return = array();
        
        while($data = self::fetch($queer))
        {
            $retutn[] = $data;
        }
        
        return $return;
    }
    
    public static function getRow($query)
    {
        $data = self::query($query);
        
        if (self::numRows($data) >= 2)
        {
            throw new Exception('While getting row, there is more than one row.');
	}
        else
        {
            return self::fetch($data);
        }
    }
    
    public static function numRows($resource) 
    {
        return mysqli_num_rows($resource);
    }
    
    public static function InsertID()
    {
        return mysqli_insert_id(self::$connection);
    }
    
    public static function numRowsQuery($query)
    {
        $data = self::query($query);
        
        return self::numRows($data);
    }
    
    public static function runQuery($query)
    {
        self::query($query);
    }
    
    public static function escape($string)
    {
        return mysqli_real_escape_string(self::$connection, $string);
    }
    
    public static function fetch($resource)
    {
        return @mysqli_fetch_assoc($resource);
    }
	
    public static function fetchObject($resource)
    {
        return @mysqli_fetch_object($resource);
    }
    
    public static function fetchArray($resource, $array)
    {
        return @mysqli_fetch_array($resource, $array);
    }
    
    public static function info() 
    {
        return mysqli_get_client_info(self::$connection);
    }
    
    public static function insertedID()
    {
        return mysqli_insert_id(self::$connection);
    }
    
    public static function saveQuery($query)
    {
        self::$queers[] = $query;
    }
    
    public static function close()
    {
        return mysqli_close(self::$connection);
    }
}