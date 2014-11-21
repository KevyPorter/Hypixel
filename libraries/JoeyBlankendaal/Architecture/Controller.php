<?php
/**
 * JoeyBlankendaal/Architecture/Controller
 * Does the controller part of the MVC architecture.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }
    
    public function loadModel($name)
    {
        $modelPath = 'applications/' . APPLICATION . '/Models/' . $name . '.php';
        
        if (file_exists($modelPath))
        {
            require $modelPath;
        }
        else
        {
            throw new Exception($modelPath . ' not found');
        }
    }
}