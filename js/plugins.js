/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ErrorHandler(cssClass)
{    
    this.errorList = new Array();
     
    
    this.displayMessages = function()
    {        
        if($('.error').size() > 0)
        {
            $('#ErrorBox').css("visibility","visible");
        }
    };
}


