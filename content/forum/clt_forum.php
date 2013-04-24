<?php
include_once 'logic/forum/forum.php';
global $forumController;
$forumController = new ForumController();

function processForumRequests_permissionValidation()
{
    global $user;
    global $pointer;
    if($pointer->bl_allowanonimous)
        return true;
    else 
        return $user->isAllowed($pointer->id_pointer);
}

function processForumRequests_hasMenu()
{
    if(isset ($_GET["json"]))
    {
        return false;
    }else
        return true;
}

function processForumRequests_hasHeader()
{
    if(isset ($_GET["json"]))
    {
        return false;
    }else
        return true;
}

function processForumRequests_content()
{   
    global $user;
    global $threads;
    global $posts;
    global $forumController;
    global $comments;
    $threads = Array();
    $posts = Array();
    if($_GET["pointer"]=="forum/posts")
    {
        if(isset($_POST["post"]))
        {
            if($_GET['postid'])
            {
                $tempComment = new ForumPostComment();
                $tempComment->id_createdbyuser = $user->id_user;
                $tempComment->tx_content = $_POST["tx_comment"];
                $tempComment->id_post = $_GET['postid'];
                $forumController->submitComment($tempComment);                
            }
        }
        if(isset($_GET['threadid']))
        {
            $posts = $forumController->getPosts($_GET['threadid']);
        }
        if(isset($_GET['postid']))
        {
            $posts = array($forumController->getPost($_GET['postid']));
            $comments = $forumController->getComments($_GET['postid']);
        }
        
        if(isset($_GET['json']))
        {
            $wrapper=null;
        }else
        {
            $wrapper=array('<div class="MainContent">','</div>');            
        }            
        return renderFile('content/forum/gui_forumPosts.php',$wrapper);
    }
    if($_GET["pointer"]=="forum")
    {
        if(isset($_GET['threadid']))
        {
            $posts = $forumController->getPosts($_GET['threadid']);
        }
        $threads = $forumController->getThreads();
        return renderFile('content/forum/gui_forum.php');    
    }    
}

?>
