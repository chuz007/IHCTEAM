<?php

class ErrorHandler
{
    function processError(Exception $exception = null)
    {         
        global $errorList;
        $error = new Error();
        $error->code = $exception->getCode();
        $error->description = $exception->getMessage();
        if($error->code == 1)
        {
            error_log($error->description);
        }else if($error->code == 2){
             $errorList[] = $error;
        }
    }    
}

/**
 * Class that holds a description of an error, when the error handler catches an exception,
 * the exception will be translated to an Error.
 * Properties:
 * Code - 01 for intelnal logged errors, 02 for displaying errors. Default 2.
 * Description of the error.
 * isLogged : unused.
 */
class Error
{
    public $code;//0: invalid, 1:internal(logged), 2:show to user
    public $description;
    public $isLogged;    
    
    public function __construct($pdescription = "",$pCode = 2, $pIsLogged = false)
    {
        $this->code = $pCode;
        $this->description = $pdescription;
        $this->isLogged = $pIsLogged;        
    }
    public function toHtml()
    {
        $errorHtml='<div class="error">Error:'. $this->code .'. '. $this->description .'</div>';
        return $errorHtml;
    }
}

?>
