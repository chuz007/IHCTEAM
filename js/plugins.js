/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ErrorHandler()
{    
    var errorList;//to be implemented
    var errorBox;
    var timer;
    var self;
    this.initialize = function()
    {
        errorBox = $('#ErrorBox');
        errorList = new Array();
        $('#ErrorBox .closeTag').on('click',this.onErrorBoxClose);
        self = this;
    };        
    
    this.displayMessages = function()
    {        
        if($('.error').size() > 0)
        {
            $(errorBox).css("visibility","visible");
            $(errorBox).show();
            console.log("displayed");
        }               
    };
    
    this.onErrorBoxClose = function()
    {
        $('#ErrorBoxMessage').empty();
        timer = setTimeout(self.displayMessages,"5000");
    };    
}


