<?php
/**
 * Application
 * JoeyBlankendaal/Hypixel/Views/Players/PlayerList
 * 
 * View for Players, under the controller for Players.
 * 
 * @author Joey Blankendaal <joeyblankendaal@gmail.com>
 * @copyright (c) Joey Blankendaal 2014
 * @date 22 November 2014
 * @version 1.0.2
 */
?>
        <?php
        $hypixel = new Hypixel(HYPIXEL_API_KEY);
        ?>
        <h1>Information</h1>
        <p>
            This is a list of all the players who have entered their name. Feel free to enter your own username! There is also a leaderboards for all entered usernames, so that you can compare yourself to other visitors of this website.<br />
            
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
        
        <h1>Players</h1>
        <p>
        <?php
        $playerQuery = Database::query("SELECT * FROM players ORDER BY id");
        
        while ($playerFetch = Database::fetch($playerQuery))
        {
        ?>
        <strong>#<?php echo $playerFetch['id']; ?>: <?php echo $hypixel->get('player', $playerFetch['name'], 'displayname'); ?></strong><br />
            UUID: <?php echo $hypixel->get('player', $playerFetch['name'], 'uuid'); ?><br />
            Hypixel ID: <?php echo $hypixel->get('player', $playerFetch['name'], '_id'); ?><br /><br />
        </p>
        <?php
        }