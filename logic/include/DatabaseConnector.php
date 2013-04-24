<?php

class DatabaseConnector
{    
    private $dbConnection=NULL;    
       
    function openDBConnection()
    {
        try
        {
            global $dbServer;
            global $dbUser;
            global $dbPassword;
            global $dbDatabase;   
            if($this->dbConnection!==null || $this->dbConnection!== false)
                $this->dbConnection=@mysql_connect($dbServer, $dbUser, $dbPassword,false,131072);     
            if(!$this->dbConnection)
                throw new Exception ("Error when trying to connect to DB: " . mysql_error());
            @mysql_select_db($dbDatabase);
            //mysql_db_query($this->dbConnection,"use " . $dbDatabase);
        }catch(Exception $e)
        {
            throw $e;
        }
        
    }
    
    function closeDBConnection()
    {
        if($this->dbConnection)
        {
            @mysql_close($this->dbConnection);
            $this->dbConnection=null;
        }
        
    }
    
    function dbQuery($query)
    {
        global $dbDatabase;
        try
        {            
            $this->openDBConnection();            
            $result=mysql_query($query);
            $this->closeDBConnection();
            return $result;
        }catch(Exception $e)
        {
            throw new Exception("Error executing query:" . $e->getMessage());
        }        
    }
}
?>
