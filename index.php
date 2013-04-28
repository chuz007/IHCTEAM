<?php    
    require_once 'logic/include/include.php';
    global $errorHandler;    
      
    global $user;
    $user->setDBConnector();
    session_start();
    //Verify session id
    if(strlen(session_id()) == 0)
    {   
        if(session_regenerate_id())
        {
            $_SESSION['ID'] = session_id() ;
        }               
    }else
    {
        try
        {            
            $user->getUser(null,null,  session_id());
        }  catch (Exception $e)
        {
            echo $errorHandler->processError($e);
        }
        
    }

    try{
        if(isset($_GET['json']))
        {
            header("content-type: application/json");
        }        
        echo processPagePointer();
    }catch(Exception $e){
        $_POST['pointer']="home";
        $_GET['pointer']="home";
        echo processPagePointer();
        echo $errorHandler->processError($e);
    }
?>        

