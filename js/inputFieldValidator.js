function InputFieldValidator(name)
{
    this.name = name;
    
    /**
     * Return values: 
     * 0 when length is the same.
     * 1 when length is higher.
     * 2 when length is lower.
     */
    this.validateLength = function(length,inputId,errorMessage,errorOn)
    {
        var currentLength = parseInt($('#'+inputId).val().length,10);          
        if(currentLength==length)
        {            
            if(errorOn==0 && errorMessage != null)
            {
                $('#' + inputId + '_errorbox').html(errorMessage);
            }else
            {
                $('#' + inputId + '_errorbox').html('');
            }
            return 0;
        }else if(currentLength > length)
        {
            if(errorOn==1 && errorMessage != null)
            {
                $('#' + inputId + '_errorbox').html(errorMessage);
            }else
            {
                $('#' + inputId + '_errorbox').html('');
            }
            return 1;
        }else
        {
            if(errorOn==2 && errorMessage != null)
            {
                $('#' + inputId + '_errorbox').html(errorMessage);
            }else
            {
                $('#' + inputId + '_errorbox').html('');
            }
            return 2;
        }
    };
    
    /**
     *Return values:
     *True if is an integer
     *False if isnt an integer
     */
    this.validateIsInteger = function(inputId,errorMessage)
    {
        var value = $('#'+inputId).val();
        if(value==parseInt(value, 10))
        {            
            $('#' + inputId + '_errorbox').html('');
            return true;
        }else 
        {
            if(errorMessage!=null)
            {                
                $('#' + inputId + '_errorbox').html(errorMessage);                
            }
            return false;
        }
    };
    
    /**
     *Return values:
     *True if is a decimal
     *False if isnt a decimal
     */
    this.validateIsFloat = function(inputId,errorMessage)
    {
        var value = $('#'+inputId).val();        
        if(value==parseFloat(value))
        {
            $('#' + inputId + '_errorbox').html('');
            return true;
        }else 
        {
            if(errorMessage!=null)
            {
                $('#' + inputId + '_errorbox').html(errorMessage);
            }
            return false;
        }
    };
    
    this.validateStringFormat = function(regularExpression,inputId)
    {
        
    };
}
