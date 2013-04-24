<?php

class User
{
    public $id_user = null;
    public $tx_firstname = null;
    public $tx_lastname = null;
    public $tx_login = null;
    public $tx_password = null;
    public $vi_faillogin = null;
    public $dt_joined = null;
    public $bl_active = null;
    public $id_role = null;
    private $_dbConnector;
        
    function setDBConnector()
    {
        global $dbConnector;
        $this->_dbConnector = $dbConnector;
    }
    
    public function getUser($userID=null,$userLogin=null,$userSessionID=null)
    {   try{
            $sqlWhere="";
            if($userID!=null)
            {
                $sqlWhere = "id_user = " . intval($userID);
            }else if($userLogin!=null)
            {
                $sqlWhere = "tx_login = '" . dbStr($userLogin) . "'";
            }
            $sqlQuery = "select id_user,tx_firstname,tx_lastname,tx_login,tx_password,
                vi_faillogin,dt_joined,bl_active,id_role from t_user where " . $sqlWhere;
            if($userSessionID!=null)
            {
                $sqlQuery = "select u.id_user,u.tx_firstname,u.tx_lastname,u.tx_login,u.tx_password,
                u.vi_faillogin,u.dt_joined,u.bl_active,u.id_role from t_user u 
                inner join t_usersession us on us.id_user = u.id_user 
                where us.id_usersession='" . $userSessionID . "' and us.bl_active=1;";
            }            
            $qResult = $this->_dbConnector->dbQuery($sqlQuery);
            if(@mysql_num_rows($qResult)==0)
            {
                return false;
            }
            $result = @mysql_fetch_assoc($qResult);
            $this->id_user = $result['id_user'];
            $this->tx_firstname = $result['tx_firstname'];
            $this->tx_lastname = $result['tx_lastname'];
            $this->tx_login = $result['tx_login'];
            $this->tx_password = $result['tx_password'];
            $this->vi_faillogin = $result['vi_faillogin'];
            $this->dt_joined = $result['dt_joined'];
            $this->bl_active = $result['bl_active'];
            $this->id_role = $result['id_role'];
         }catch(Exception $e)
         {
             throw $e;
         }
    }    
    
    public function isAllowed($strPointer)
    {        
        try{
            $slqQuery = "select count(*) result from tx_role_pointer txrp 
                    inner join t_pointer p on p.id_pointer=txrp.id_pointer 
                    where id_role=".intval($this->id_role)." and p.tx_name='". dbStr($strPointer) ."';";
            $qResult = $this->_dbConnector->dbQuery($slqQuery);
            $result = @mysql_fetch_assoc($qResult);

            if(intval($result["result"])==1)        
                return true;
            else
                return false;
        }catch(Exception $e)
        {
            throw $e;
        }
    }
    
    public function validateLogin($strUsername,$strPassword)
    {   try{  
            $pwdHash = md5($strPassword);
            $sqlQuery = "call sp_validatelogin('". dbStr($strUsername) ."','". dbStr($pwdHash) ."');";
            $qResult = $this->_dbConnector->dbQuery($sqlQuery);           
            //$qResult = $this->_dbConnector->dbQuery("select @res res");            
            $result = mysql_fetch_row($qResult);
            
            if($result[0] > 0)
            {
               $this->getUser($result[0]);
               $this->beginSession();
               return true;
            }else if($result[0]==0)
            {
                return false;
            }else if($result[0]==-1)
            {
                throw new Exception("Your account is blocked, please contact an administrador");
            }
        }catch(Exception $e)
        {
            throw $e;
        }
    }
    
    function beginSession()
    {
        try{
            $sessionId="";
            if(!isset ($_SESSION))
            {         
                session_start();            
            }
            session_regenerate_id(true);
            $sessionId = session_id();
            $sqlQuery = "call sp_beginsession('$sessionId'," . $this->id_user . ",'" . $_SERVER['REMOTE_ADDR'] . "');";
            $this->_dbConnector->dbQuery($sqlQuery);
        }catch(Exception $e)
        {
            throw $e;
        }
    }
    
    function closeSession()
    {
        try{
            session_destroy();
            $sqlQuery = "update t_usersession set bl_active = 0 where id_user=". $this->id_user ." and bl_active = 1;";
            $this->_dbConnector->dbQuery($sqlQuery);
        }catch(Exception $e)
        {
            throw $e;
        }
    }
}
?>
