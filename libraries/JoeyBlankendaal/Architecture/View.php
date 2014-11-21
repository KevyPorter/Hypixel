<?php
/**
 * JoeyBlankendaal/Architecture/View
 * Does the view part of the MVC architecture.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class View
{
    private $renderTemplate = true;
    private $templateName = TEMPLATE;
    
    public function __construct()
    {
        
    }
    
    public function getTemplate()
    {
        return $this->templateName;
    }
    
    public function setTemplate($templateName)
    {
        $this->templateName = $templateName;
    }
    
    public function getRenderTemplate()
    {
        return $this->renderTemplate;
    }
	
    public function setRenderTemplate($bool)
    {
        $this->renderTemplate = $bool;
    }
    
    public function render($name)
    {
        require('applications/' . APPLICATION . '/Views/' . $name . '.php');
    }
}