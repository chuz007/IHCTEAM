<?php
global $posts;
global $threads;
?>

<div class="MainContent">
        <?= renderFile('content/forum/gui_forumThreads.php'); ?>
        <?= renderFile('content/forum/gui_forumPosts.php'); ?>        
</div>
<script type="text/javascript" language="javascript">
    (function(){           
        var forumThread = $(".ForumThreadAnchor");        
        forumThread.on("click",function(event){
            event.preventDefault();
            var forumList = $(".ForumPostList");
            var postTmpl = $("#postTemplate");
            $(forumList).slideUp(500);
            $.getJSON("index.php","pointer=forum/posts&json=1&threadid="+$(this).data("threadid"), function(data){
                $(forumList).empty();
                $.map(data, function(post,index){                    
                    $.template(postTmpl,post,forumList);                    
                });
                
            }).done(function(){
                $(forumList).slideDown(500);
                $(".ForumPost a").on("click",function(event){
                    event.preventDefault();                                       
                    var commentList = $("#fpcl"+$(this).data("postid"));
                    if($(commentList).is(":visible")){
                        $(commentList).slideUp(500,function(){
                            $(".ForumPostComment").remove();
                        });  
                    }else{
                        var commentTmpl = $("#postCommentTemplate");
                        $.getJSON("index.php", "pointer=forum/posts&json=1&comments=1&postid="+$(this).data("postid"), function(data){
                            $.map(data, function(comment,index){                            
                                $.template(commentTmpl,comment,commentList);                    
                            });
                        }).done(function(){
                            commentList.slideDown(500);
                        });
                    }
                 });
            });            
        });
    })();
</script>