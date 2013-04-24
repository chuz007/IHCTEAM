$.extend({
    template : function(tmplElem,objData,appendElem){
        var sub = $(tmplElem).html()
        $.map(objData,function(obj,index){     
            var regex = new RegExp("{"+index+"}", 'g');
                sub = sub.replace(regex, obj);            
        });
        $(sub).appendTo(appendElem);
    }
});
