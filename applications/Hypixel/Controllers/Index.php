<?php
/**
 * Hypixel/Controllers/Index
 * Index Controller
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 21 November 2014
 * @version 1.0.0
 */

class Index extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $template = new View();
        $template->render('Index/Index');
    }
}