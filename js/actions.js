function closeDivByID(id)
{
    $('#'+id).hide();
}

function processError(header,errorDescription)
{
    $('#ErrorBoxHeaderContent').html(header);
    $('#ErrorBoxMessage').html(errorDescription);
    //$('#ErrorBox').show("normal");    
    $('#ErrorBox').css("visibility", "visible");
}

