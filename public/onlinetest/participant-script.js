$(document).ready(function() {       

    // setup ajax header
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });  
    
    // treat checkbox like radio button
    $(document).on('click', 'input:checkbox', function(name, e){
        var checkbox_arr = [];

        //count answer
        var total_question = document.getElementById('total_question').value;

        for (var i = answered.length - 1; i >= 0; i--) {
            if ( answered[i] == name) {
                in_answered = true;
            }
        }
        if (!in_answered) {
            answered.push(name);
            total += 1;
        }
        if (in_answered) {
            in_answered = false;
        }
        var total_answered = document.getElementById('total_answered');
        total_answered.innerHTML= 'Total Answered : '+ total;
        var not_answered = document.getElementById('not_answered');
        not_answered.innerHTML= 'Total Empty Answer : '+ (total_question-total);
        //end of count answer

        // push all checkbox id from specific group to checkbox_arr
        $.each($('input:checkbox[name="'+$(this).prop('name')+'"]'), function(i, v) { 
            checkbox_arr.push(v.id);
        });

        // remove current selected checkbox from checkbox_arr        
        for(var j = 0; j < checkbox_arr.length; j++)
            if(checkbox_arr[j] === $(this)[0].id) checkbox_arr.splice(j, 1);

        // set the rest checkbox to false
        $.each(checkbox_arr, function(i, v) {
            $('#'+v).prop('checked', false);             
        });
    });    
    
});
