<?php

class ErrorHandler
{
    function processError(Exception $exception = null)
    {         
        global $errorList;
        $error = new Error("","");
        $error->code = $exception->getCode();
        $error->description = $exception->getMessage();
        $errorList[] = $error;
    }    
}

class Error
{
    public $code;
    public $description;
    public $isLogged;
    public $isInternal;
    
    public function __construct($pCode, $pdescription, $pIsLogged = false, $pIsInternal = false)
    {
        $this->code = $pCode;
        $this->description = $pdescription;
        $this->isLogged = $pIsLogged;
        $this->isInternal = $pIsInternal;
    }
    public function toHtml()
    {
        $errorHtml='<div class="error">Error:'. $this->code .'. '. $this->description .'</div>';
        return $errorHtml;
    }
}

?>
