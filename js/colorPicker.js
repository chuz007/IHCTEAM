function ColorPicker(divID)
{
    this.targetFieldId = "";
    this.pickerDivId = divID;
    
    this.setTargetField = function(targetId)
    {
        this.targetFieldId = targetId;
    };
    
    this.getColor  = function(id)
    {
        var hexColor = id.replace("_", "#", "gi")
        $('#' + this.targetFieldId).val(hexColor);
    };
    
    this.showColorPicker = function()
    {
        $('#' + this.pickerDivId).show();
    };
    
    this.hideColorPicker = function(){
        $('#' + this.pickerDivId).hide();
    };
}

