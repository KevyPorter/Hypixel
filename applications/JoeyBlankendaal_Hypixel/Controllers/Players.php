<?php
class Players extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $playerList = new View();
        $playerList->render('Players/PlayerList');
    }
}