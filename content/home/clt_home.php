<?php

function getHomePage_permissionValidation()
{
    global $user;
    global $pointer;
    if($pointer->bl_allowanonimous)
        return true;
    else 
        return $user->isAllowed($pointer->id_pointer);
}

function getHomePage_hasMenu()
{
    return true;
}

function getHomePage_hasHeader()
{
    return true;
}

function getHomePage_content()
{
    return renderFile('content/home/gui_home.php');
}

?>
