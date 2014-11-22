<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Views/Leaderboards/Leaderboards
 * 
 * View for Leaderboards, under the controller for Leaderboards.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */
?>
        <h1>Information</h1>
        <p>
            This page is very similar to the Players page, however, the Leaderboards aren't organized by date.<br />
            
            <?php
            if (isset($_POST['submit']))
            {
                $matchQuery = Database::query("SELECT * FROM players WHERE name = '" . Database::escape($_POST['name']) . "'");
                
                if (Database::numRows($matchQuery) > 0)
                {
                    echo '<div class="error">Your Minecraft name is already added.</div>';
                }
                else
                {
                    if (strlen($_POST['name']) > 16)
                    {
                        echo '<div class="error">Your Minecraft name can\'t be longer than 16 characters.</div>';
                    }
                    else
                    {
                        if (strlen($_POST['name']) < 3)
                        {
                            echo '<div class="error">Your Minecraft name can\'t be shorter than 3 characters.</div>';
                        }
                        else
                        {
                            if (!preg_match('/^[A-Za-z0-9_]+$/', $_POST['name']))
                            {
                                echo '<div class="error">You are using invalid characters.</div>';
                            }
                            else
                            {
                                $name = Database::escape($_POST['name']);
                                $uuid = $hypixel->get('player', $name, 'uuid');
                                
                                Database::query("INSERT INTO players VALUES (NULL, '" . $name . "', '" . $uuid . "', NOW(), '" . $_SERVER['REMOTE_ADDR'] . "');");
                                
                                echo '<div class="success">Your Minecraft name has been added.</div>';
                            }
                        }
                    }
                }
            }
            ?>
            <form method="POST" action="players">
                <strong>Your Minecraft name: </strong>
                <input type="text" name="name" />
                <input type="submit" name="submit" value="Add" />
            </form>
        </p><br /><br />
        
        <h1>Leaderboards</h1>
        <p>Work in progress.</p>