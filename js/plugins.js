/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ErrorHandler(cssClass)
{    
    this.errorList = new Array();
    $('#ErrorBox .closeTag').on('click',this.onErrorBoxClose);
    
    this.displayMessages = function()
    {        
        if($('.error').size() > 0)
        {
            $('#ErrorBox').css("visibility","visible");
        }
    };
    
    this.onErrorBoxClose = function()
    {
        $('#ErrorBoxMessage').empty();
    };
}


