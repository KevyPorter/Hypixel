<?php
/**
 * Library
 * JoeyBlankendaal/Core/DeepData
 * 
 * Gets and saves deeper arrays.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class DeepData
{
    private $data = array();
    
    public function __construct($data)
    {
        if (is_array($data))
        {
            $this->data = $data;
        }
        else
        {
            throw new Exception('The construct array isn\'t a array.');
        }
    }
    
    public function exist($deep)
    {
        $explodedDeep = $this->_stripDeep($deep);
        $data = &$this->data;
        
        foreach ($explodedDeep as $deepPart)
        {
            if (is_array($data) && isset($data[$deepPart]))
            {
                $data = &$data[$deepPart];
            }
            else
            {
                return false;
            }
        }
        
        return true;
    }
    
    public function get($deep = false)
    {
        if ($deep == false)
        {
            return $this->data;
        }
        
        $explodedDeep = $this->_stripDeep($deep);
        $data = &$this->data;
        
        if (!$this->exist($deep))
        {
            throw new Exception('We couldn\'t find something with the deepstring "' . htmlspecialchars($deep) . '".');
        }
        
        foreach($explodedDeep as $deepPart)
        {
            $data = &$data[$deepPart];
        }
        
        return $data;
    }
    
    public function set($deep, $value)
    {
        $explodedDeep = $this->_stripDeep($deep);
        $data = &$this->data;
        
        foreach ($explodedDeep as $deepPart)
        {
            if (!is_array($data) || !isset($data[$deepPart]))
            {
                $data[$deepPart] = array();
            }
            
            $data = &$data[$deepPart];
        }
        
        $data = $value;
        return $data;
    }
    
    public function delete($deep)
    {
        $explodedDeep = $this->_stripDeep($deep);
        $data = &$this->data;
        
        if (!$this->exist($deep))
        {
            throw new Exception('We couldn\'t found something with the deepstring "' . htmlspecialchars($deep) . '".');
        }
        
        $last = array_pop($explodedDeep);
        
        foreach ($explodedDeep as $deepPart)
        {
            $data = &$data[$deepPart];
        }
        
        unset($data[$last]);
    }
    
    public function withFunction($deep, $function, $exist = false, $data = array())
    {
        if (!is_callable($function))
        {
            throw new Exception('The function isn\'t callable.');
        }
        
        if (!$this->exist($deep))
        {
            if ($exist == false)
            {
                $this->set($deep, array());
            }
            else
            {
                throw new Exception('We couldn\'t found something with the deepstring "' . htmlspecialchars($deep) . '".');
            }
        }
        
        $toFunction = array();
        $toFunction['this'] = $this;
        $toFunction['deep'] = $deep;
        
        $deepData = $this->get($deep);
        $returnData = call_user_func($function, $deepData, $data, $toFunction);
        
        if ($this->exist($deep))
        {
            $this->set($deep, $returnData);
        }
        
        return $returnData;
    }
    
    protected function _stripDeep($deep)
    {
        if (is_string($deep))
        {
            $explodedDeep = explode('.', $deep);
            return $explodedDeep;
        }
        else
        {
            throw new Exception('The deepstring isn\'t a string.');
        }
    }
    
    public function append($deep, $data)
    {
        $this->withFunction($deep, function($deepData, $data, $toFunction)
        {
            array_push($deepData, $data);
            
            return $deepData;
        }, false, $data);
    }
}