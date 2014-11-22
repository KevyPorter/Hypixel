<?php
define('APPLICATION', 'JoeyBlankendaal_Hypixel');
define('TEMPLATE', 'Hypixel');
define('HYPIXEL_API_KEY', '93e81d6c-772a-459b-8c84-73b955356adc');

require('libraries/JoeyBlankendaal/Core/Bootstrap.php');
require('libraries/JoeyBlankendaal/Core/Configuration.php');
require('libraries/JoeyBlankendaal/Core/DeepData.php');
require('libraries/JoeyBlankendaal/Core/Language.php');
require('libraries/JoeyBlankendaal/Storage/Database.php');
require('libraries/JoeyBlankendaal/Storage/Session.php');
require('libraries/JoeyBlankendaal/Architecture/Model.php');
require('libraries/JoeyBlankendaal/Architecture/View.php');
require('libraries/JoeyBlankendaal/Architecture/Controller.php');
require('libraries/JoeyBlankendaal/Architecture/Form.php');
require('libraries/JoeyBlankendaal/API/Hypixel.php');

error_reporting(E_ALL);
session_start();

$bootstrap = new Bootstrap();