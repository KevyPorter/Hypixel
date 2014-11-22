        <?php
        $hypixel = new Hypixel(HYPIXEL_API_KEY);
        ?>
        <h1>Player List</h1>
        <p>This is a list of all the players who have entered their username/UUID. Feel free to enter your own username! There is also a leaderboards for all entered usernames, so that you can compare yourself to other visitors of this website.</p><br />
        
        <p>
            <strong><?php echo $hypixel->get('player', 'Serventor', 'displayname'); ?></strong><br />
            UUID: <?php echo $hypixel->get('player', 'Serventor', 'uuid'); ?><br />
            Hypixel ID: <?php echo $hypixel->get('player', 'Serventor', '_id'); ?><br /><br />
            
            <strong><?php echo $hypixel->get('player', 'Oli_Gig', 'displayname'); ?></strong><br />
            UUID: <?php echo $hypixel->get('player', 'Oli_Gig', 'uuid'); ?><br />
            Hypixel ID: <?php echo $hypixel->get('player', 'Oli_Gig', '_id'); ?><br /><br />
        </p>