<?php
class Leaderboards extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $hypixel = new Hypixel('db693320-43b9-41c1-aae0-5557edbcbaec');
    }
    
    public function index()
    {
        $template = new View();
        $template->render('Leaderboards/Index');
    }
}