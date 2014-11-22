<?php
class Leaderboards extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $template = new View();
        $template->render('Leaderboards/Index');
    }
}