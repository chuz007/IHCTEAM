<?php 
    global $threads;
?>

<div class="ForumThreadList">        
            <?php                
                foreach ($threads as $thread)
                {
                    echo template('<a class="ForumThreadAnchor" data-threadid="{id_thread}" href="?pointer=forum&threadid={id_thread}"><div class="ForumThread">
                                    <h3>{tx_title}</h3>
                                    <p>{tx_description}</p>
                                    <h5>Created by {username} on {dt_created}</h5>
                                </div></a>', $thread);
                }
            ?>
</div>