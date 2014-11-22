<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Controllers/Index
 * 
 * Controller for Index, also known as Home.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Index extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    
    public function index()
    {   
        $index = new View();
        $index->render('Index/Index');
    }
}