<?php

function userLogin_content()
{
    global $user;
    
    if(isset($_POST['username']))
    {        
	    if(strlen(trim($_POST['username'])) > 12) // User name format allowed max 11 char long
        {
            throw new exception("Invalid Username Format");
        }
        if(strlen(trim($_POST['password'])) > 12)	// User pasword format allowed max 11 char long 
        {
            throw new exception("Invalid Password Format");
        }
        try
        {
            if(!$user->validateLogin($_POST['username'],$_POST['password']))
            {
                throw new Exception("Invalid Username or Password",2);
            }
        }catch(Exception $e)
        {
            throw $e;
        }        
    }
    return header("Location: ?pointer=home");
}

function userLogout_permissionValidation()
{
    global $user;
    global $pointer;
    if($pointer->bl_allowanonimous)
        return true;
    else 
        return $user->isAllowed($pointer->id_pointer);
}

function userLogout_hasMenu()
{
    return true;
}

function userLogout_isPage()
{
    return true;
}

function userLogout_content()
{
    global $user;
    $user->closeSession();
    return header("Location: ?pointer=home");    
}
?>
