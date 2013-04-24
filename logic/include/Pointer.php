<?php

class Pointer
{
    public $id_pointer = null;
    public $bl_allowanonimous = null;
    public $tx_name = null;    
    public $tx_controllerpath = null;    
    public $tx_function = null;
    public $tx_description = null;    
    
    public function getPointer($strName)
    {
        global $dbConnector;
        try{        
            $slqQuery="select id_pointer,bl_allowanonimous,tx_name,tx_controllerpath,tx_function,tx_description
                 from t_pointer where tx_name='".dbStr($strName)."';";
            //exit($slqQuery);
            $qResult = $dbConnector->dbQuery($slqQuery);
            //if($qResult===false)die("false".$strName."  query:".$slqQuery);
            $result = mysql_fetch_assoc($qResult);
            $this->id_pointer = $result['id_pointer'];
            $this->bl_allowanonimous = $result['bl_allowanonimous'];
            $this->tx_name = $result['tx_name'];
            $this->tx_controllerpath = $result['tx_controllerpath'];
            $this->tx_function = $result['tx_function'];
            $this->tx_description = $result['tx_description'];
        }  catch (Exception $e)
        {
            throw  $e;
        }
    }
}
?>
