<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Templates/Hypixel/Header
 * 
 * Header for Template 'Hypixel'.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hypixel</title>
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Joey Blankendaal" />
    <meta name="keywords" content="hypixel, hypixel api, hypixel public api" />
    <meta name="description" content="A script using the Hypixel Public API." />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 day" />
    <meta name="content-language" content="en-US" />
    <meta name="copyright" content="(c) Joey Blankendaal <?php echo date('Y'); ?>" />
    
    <link rel="stylesheet" type="text/css" href="applications/<?php echo APPLICATION; ?>/Templates/<?php echo TEMPLATE; ?>/Stylesheets/Main.css" />
    
    <script type="text/javascript" src="applications/<?php echo APPLICATION; ?>/Templates/<?php echo TEMPLATE; ?>/Scripts/Main.js"></script>
    <script type="text/javascript" src="applications/<?php echo APPLICATION; ?>/Templates/<?php echo TEMPLATE; ?>/Scripts/Cookies.js"></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img class="image" src="applications/<?php echo APPLICATION; ?>/Templates/<?php echo TEMPLATE; ?>/Images/Logo.png" />
        </div>
        
        <div class="menu">
            <a href="/"><div class="first item"><br class="small" />Index</div></a>
            <a href="/players"><div class="item"><br class="small" />Players</div></a>
            <a href="/leaderboards"><div class="item"><br class="small" />Leaderboards</div></a>
        </div>

