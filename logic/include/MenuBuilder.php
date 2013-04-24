<?php

class MenuBuilder
{
    private $menuContent;
    private $menuTaps;
    function MenuBuilder()
    {
        $this->menuContent="";
        $this->menuTaps = array();        
    }
    
    
    function createMenu()
    {        
        $this->menuContent.='<div class="Menu">';
        $this->insertMenuTap("Home", "Home","home");
        $this->insertMenuTap("Forum", "Forum", "forum");
        //$this->insertSubMenu($this->menuTaps['Other'], "Products", "Products");
        foreach ($this->menuTaps as $key => $value)
        {
            $this->menuContent.= $value->getTabHtml();
        }
        
        $this->menuContent.='</div>';
        return $this->menuContent;
    }
    
    function insertMenuTap($key,$value,$pointer=null)
    {
        $tap = new MenuTap($key,$value,$pointer);
        $this->menuTaps[$key]=$tap;
    }
    
    //TODO: Fix sub menu insertion
    function insertSubMenu(&$menuTap,$key,$value)
    {
        $menutap[$key]=$value;
    }
}

class MenuTap
{
    private $key;
    private $displayText;
    private $pointer;
    private $subMenu;
    
    public function __construct($key,$displayText,$pointer=null)    
    {
        $this->key=$key;
        $this->displayText=$displayText;
        if($pointer!=null)
            $this->pointer=$pointer;
    }
    
    public function getTabHtml()
    {
        return '<div class="MenuTap" onclick="window.location=\'?pointer=' . $this->pointer .'\'">' . $this->displayText . '</div>';
    }
    
    function getSubMenuHtml()
    {
        
    }
}
?>
