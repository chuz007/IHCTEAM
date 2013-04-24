<?php

class ErrorHandler
{
    function processError(Exception $exception)
    {           
        return '<script type="text/javascript" language="javascript">processError("System Error","'. $exception->getMessage() .'");</script>';
    }    
}

?>
