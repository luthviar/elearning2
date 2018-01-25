$(document).ready(function() {   

    // disable right click
    document.addEventListener('contextmenu', event => event.preventDefault());   

    // prompt when leave site
    // window.addEventListener('beforeunload', function (e) {
    //     (e || window.event).returnValue = 'Are you sure?';
    //     return null;
    // });
    // window.addEventListener('onbeforeunload ', function (e) {
    //     (e || window.event).returnValue = 'Are you sure?';
    //     return null;
    // });
    // window.onbeforeunload = function () {
    //     return "Do you really want to close?";
    // };
    
    var ctrlKeyDown = false;
    var shiftKeyDown = false;
    var altKeyDown = false;

    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);    

    function keydown(e) 
    { 
        if ((e.which || e.keyCode) == 116 || 
            (ctrlKeyDown && (e.which || e.keyCode) == 82) || 
            (ctrlKeyDown && shiftKeyDown && (e.which || e.keyCode) == 67) ||
            (ctrlKeyDown && (e.which || e.keyCode) == 85) ||
            (altKeyDown && (e.which || e.keyCode) == 37)
        ) 
        {
            // Pressing F5 or Ctrl+R or Ctrl+Shift+C or Ctrl+U or Alt+LeftArrow
            e.preventDefault();            
        } 
        else if ((e.which || e.keyCode) == 16)
        {
            // Pressing only Shift
            shiftKeyDown = true;
        }
        else if ((e.which || e.keyCode) == 17) 
        {
            // Pressing only Ctrl
            ctrlKeyDown = true;
        }
        else if ((e.which || e.keyCode) == 18)
        {
            // Pressing only Alt
            altKeyDown = true;   
        }
    };

    function keyup(e)
    {
        // Key up Ctrl or Shift
        if ((e.which || e.keyCode) == 17) 
            ctrlKeyDown = false;
        else if ((e.which || e.keyCode) == 16) 
            shiftKeyDown = false;
    };
});