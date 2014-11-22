<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Controllers/Players
 * 
 * Controller for Players.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Players extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $players = new View();
        $players->render('Players/Players');
    }
}