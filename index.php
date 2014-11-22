<?php
/**
 * Index
 * 
 * The primary file.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */

define('APPLICATION', 'JoeyBlankendaal_Hypixel');
define('TEMPLATE', 'Hypixel');
define('HYPIXEL_API_KEY', '93e81d6c-772a-459b-8c84-73b955356adc');

require('libraries/JoeyBlankendaal/Core/Bootstrap.php');
require('libraries/JoeyBlankendaal/Core/DeepData.php');
require('libraries/JoeyBlankendaal/Core/Language.php');
require('libraries/JoeyBlankendaal/Storage/Configuration.php');
require('libraries/JoeyBlankendaal/Storage/Database.php');
require('libraries/JoeyBlankendaal/Storage/Session.php');
require('libraries/JoeyBlankendaal/Architecture/Model.php');
require('libraries/JoeyBlankendaal/Architecture/View.php');
require('libraries/JoeyBlankendaal/Architecture/Controller.php');
require('libraries/JoeyBlankendaal/Architecture/Form.php');
require('libraries/JoeyBlankendaal/API/Hypixel.php');

error_reporting(E_ALL);
session_start();

Configuration::manualLoad('applications/' . APPLICATION . '/Configuration/Configuration.php');
Database::connect(Configuration::get('database'));

$bootstrap = new Bootstrap();