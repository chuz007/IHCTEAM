<?php
    include_once 'logic/include/utilities.php';
    
    class forum {
        //put your code here
    }

    class ForumThread
    {        
        public $id_thread;
	public $tx_title; 
	public $tx_description;
	public $dt_created;	
	public $id_createdbyuser;
        public $username;
        
        public function __construct() {
            $this->id_thread=0;
            $this->tx_title="";
            $this->tx_description="";
            $this->dt_created=null;            
            $this->id_createdbyuser=0;
            $this->username = "";
        }
        
        public function fillThread($dbrow)
        {
            $this->id_thread = $dbrow["id_thread"];
            $this->tx_title = $dbrow["tx_title"];
            $this->tx_description = $dbrow["tx_description"];
            $this->dt_created = $dbrow["dt_created"];            
            $this->id_createdbyuser = $dbrow["id_createdbyuser"];
            $this->username = $dbrow["username"];
        }
    }
    
    class ForumPost
    {
        public $id_post;
	public $tx_title; 
	public $tx_content;
	public $dt_created;
	public $id_thread;
	public $id_createdbyuser;
        public $username;
        public $thumbnail;
        
        public function __construct() {
            $this->id_post=0;
            $this->tx_title="";
            $this->tx_content="";
            $this->dt_created=null;
            $this->id_thread = 0;
            $this->id_createdbyuser=0;
            $this->username = "";
            $this->thumbnail = "";
        }
        
        public function fillPost($dbrow)
        {            
            $this->id_post = $dbrow["id_post"];
            $this->tx_title = $dbrow["tx_title"];
            $this->tx_content = $dbrow["tx_content"];
            $this->dt_created = $dbrow["dt_created"];
            $this->id_thread = $dbrow["id_thread"];
            $this->id_createdbyuser = $dbrow["id_createdbyuser"]; 
            $this->username = $dbrow["username"];
            $this->setThumbnail($dbrow["tx_path"]);
        }
        
        public function setThumbnail($path)
        {
            global $imagesPath;
            if($path!==null || strlen(trim($path))>0)
            {
                $this->thumbnail = $path;
            }else
            {
                $this->thumbnail = $imagesPath . "avatars/default.gif";
            }
        }
    }
    
    class ForumPostComment
    {
        public $id_comment;	
	public $tx_content;
	public $dt_created;
	public $id_post;
	public $id_createdbyuser;
        public $username;
        
        public function __construct() {
            $this->id_comment=0;            
            $this->tx_content="";
            $this->dt_created=null;
            $this->id_post = 0;
            $this->id_createdbyuser=0;
            $this->username = "";            
        }
        
        public function fillComment($dbrow)
        {            
            $this->id_comment = $dbrow["id_comment"];            
            $this->tx_content = $dbrow["tx_content"];
            $this->dt_created = $dbrow["dt_created"];
            $this->id_post = $dbrow["id_post"];
            $this->id_createdbyuser = $dbrow["id_createdbyuser"]; 
            $this->username = $dbrow["username"];            
        }
    }
    
    class ForumController extends ControllerClass
    {       
        private $_user;
        public function __construct() {
            parent::__construct();
            global $user;
            $this->_user = $user;
        }
        
        //POSTS
        public function submitPost(ForumPost $post)
        {
            $sqlQuery = "call sp_submitpost('{$post->tx_title}','{$post->tx_content}',{$post->id_thread},{$post->id_createdbyuser});";
            $this->_dbConnector->dbQuery($sqlQuery);
            
        }
        
        public function getPost($postId)
        {
            $post = new ForumPost();
            $sqlQuery = 'call sp_getpost('. $postId .');';
            $dbres = $this->_dbConnector->dbQuery($sqlQuery);
            if(mysql_num_rows($dbres)>0)
            {                
                $post->fillPost(mysql_fetch_assoc($dbres));
            }            
            return $post;
        }
        
        public function getPosts($threadId)
        {
            $posts = Array();
            $sqlQuery = 'call sp_getposts('. $threadId .');';
            $dbRes = $this->_dbConnector->dbQuery($sqlQuery);
            if(mysql_num_rows($dbRes)>0)
            {
                while($r=mysql_fetch_assoc($dbRes))
                {                    
                    $tempPost = new ForumPost();      
                    $tempPost->fillPost($r);
                    $posts[]=$tempPost;                    
                }                
            }
            return $posts;
        }
        
        //COMMENTS
        public function submitComment(ForumPostComment $comment)
        {
            $sqlQuery = "call sp_submitcomment('{$comment->tx_content}',{$comment->id_post},{$comment->id_createdbyuser});";            
            $this->_dbConnector->dbQuery($sqlQuery);            
        }
        
        public function getComments($postId)
        {
            $comments = Array();
            $sqlQuery = 'call sp_getcomments('. $postId .');';            
            $dbRes = $this->_dbConnector->dbQuery($sqlQuery);
            if(mysql_num_rows($dbRes)>0)
            {
                while($r = mysql_fetch_assoc($dbRes))
                {
                    $tempComment = new ForumPostComment();
                    $tempComment->fillComment($r);
                    $comments[] = $tempComment;
                } 
            }            
            return $comments;
        }
        
        //THREADS
        
        public function createThread(ForumThread $thread)
        {
            $sqlQuery = "call sp_createthread('{$thread->tx_title}','{$thread->tx_description}',{$tread->id_createdbyuser});";
            $this->_dbConnector->dbQuery($sqlQuery);
            
        }
        
        public function getThreads()
        {
            $threads = Array();
            $sqlQuery = 'call sp_getthreads();';
            $dbRes = $this->_dbConnector->dbQuery($sqlQuery);
            if(mysql_num_rows($dbRes)>0)
            {
                while($r = mysql_fetch_assoc($dbRes))
                {
                    $tempThread = new ForumThread();
                    $tempThread->fillThread($r);
                    $threads[] = $tempThread;
                } 
            }
            return $threads;
        }
        
    }
?>
