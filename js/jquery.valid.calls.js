jQuery(function(){
    jQuery("#title").validate({
        expression: "if (VAL.match(/([^\s])/)) return true; else return false;",
        message: "Enter a title"
    });
    jQuery("#time").validate({
        expression: "if (VAL.match(/^[0-9]+$/)) return true; else return false;",
        message: "Enter time as a number"
    });
    jQuery("#embed").validate({
        expression: "if (VAL.match(/(<iframe.+?[<\/iframe>])$/)) return true; else return false;",
        message: "Enter correct embed code"
    });
    jQuery("#thumb").validate({
        expression: "if (VAL.match(/(.*?)[^w{3}\.]([a-zA-Z0-9]([a-zA-Z0-9\-]{0,65}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}(.*?.jpg)$/)) return true; else return false;",
        message: "Enter thumbnail URL code"
    });
       
     jQuery("th input").change(function(){
            var option=jQuery(this).val(); 
    
            if(option=='url')
            {
                jQuery('.url').removeAttr('disabled');
                jQuery('.upload').hide();
                jQuery('.upload').attr('disabled','disabled');
                jQuery('.url').show();
            }
            if(option=='upload')
            {
                jQuery('.upload').removeAttr('disabled');
                jQuery('.url').hide();
                jQuery('.url').attr('disabled','disabled');
                jQuery('.upload').show();
            }
    
        })            
});