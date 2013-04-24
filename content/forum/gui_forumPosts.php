<?php 
global $posts; 
global $comments;
global $user;
if(isset ($_GET["json"])) //IF json
{    
    if(isset($_GET["comments"]))
    {
        echo json_encode($comments);
    }else
    {
        echo json_encode($posts);
    }
    
}else{
?>
<script type="template" id="postTemplate">
        <div class="ForumPost">
            <div  class="ForumPostUserInfo">
                <img src="{thumbnail}" width="100px" />
                <h5>{username}</h5>
                <h5>{dt_created}</h5>
            </div>
            <div class="ForumPostContent">                
                <h3>{tx_title}</h3>
                <p>{tx_content}</p>                
            </div>
            <div class="ForumPostBottom">
                <a data-postid="{id_post}" href="">View Comments</a>
            </div>            
        </div>
        <div id="fpcl{id_post}" class="ForumPostCommentList" style="display:none;">
            <form method="post" action="?pointer=forum/posts&postid={id_post}">
                        <label for="tx_comment">Add a comment:</label></br>
                        <textarea name="tx_comment" cols="50" rows="5"></textarea>
                        <input type="submit" value="Add" />
            </form>
        </div>
</script>
<script type="template" id="postCommentTemplate">    
    <div class="ForumPostComment">
        <h3>{username} says:</h3>
        <p>{tx_content}</p>
        <h5>Posted on {dt_created}</h5>
    </div>
</script>
<div class="ForumPostList">
    <?php        
            
        if($comments===null)
        {
            $comments=array();
        }
        foreach($posts as $cPost)
        {
            echo template('<div class="ForumPost">
                        <div  class="ForumPostUserInfo">
                            <img src="{thumbnail}" width="100px" />
                            <h5>{username}</h5>
                            <h5>{dt_created}</h5>
                        </div>
                        <div class="ForumPostContent">                
                            <h3>{tx_title}</h3>
                            <p>{tx_content}</p>                
                        </div>
                        <div class="ForumPostBottom">
                            <a href="?pointer=forum/posts&postid={id_post}">View Comments</a>
                        </div>            
                    </div>    
                    ', $cPost);
            echo '<div class="ForumPostCommentList">';
            if(!($_GET["pointer"]=="forum")&& $user->id_user!==null)
            {
                echo '<div class="ForumPostComment">
                    <form method="post" action="">
                        <label for="tx_comment">Add a comment:</label></br>
                        <textarea name="tx_comment" cols="50" rows="5"></textarea>                        
                        <input type="submit" value="Add" />
                        <input type="hidden" name="post" value="1" />
                    </form></div>';    
            }                    
            foreach ($comments as $cComment)
            {
                echo template('<div class="ForumPostComment">
                                        <h3>{username} says:</h3>
                                        <p>{tx_content}</p>
                                        <h5>Posted on {dt_created}</h5>
                                    </div>',$cComment);
            }
            echo '</div>';  
        }        
    ?>
</div>
<?php }?>