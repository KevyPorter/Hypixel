<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Controllers/Leaderboards
 * 
 * Controller for Leaderboards.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

class Leaderboards extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $leaderboards = new View();
        $leaderboards->render('Leaderboards/Leaderboards');
    }
}