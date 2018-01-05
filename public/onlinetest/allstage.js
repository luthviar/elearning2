$(document).ready(function() {
    var q = null;
    var answers = [];
    var state = 1;

    // timer
    $('#timer').timer({
        duration: timelimit,
        countdown: true,
        format: '%M:%S',
        callback: function(){
            registerAnswer(state);
            submitAnswer();
        }
    });

    // get question in stage
    $.ajax({
        url: 'getStage',
        type: 'GET',
        dataType: 'json',
    })
    .done(function(r) {
        q = JSON.parse(JSON.stringify(r));
        console.log(q);
        // alert(q);

        for (var i = 0; i < q.length; i++)
        {
            if (q[i]['type_id'] == 1) {
                var choices = JSON.parse(q[i]['choices']);
                var hash = q[i]['question_id'];

                var type = q[i]['type_id'];
                // var className = (type == '1')? 'easy' : (type == '2') 'medium' : 'hard';
                var numbering = q[i]['number'];

                $('.question-list').append(
                    '<div class="question-list-item"><div><h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">'+numbering+'</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize">'+q[i]['subject']+'</span></b></h3><input type="hidden" name="question_id" value="'+q[i]['question_id']+'"/><div class="question">'
                    +q[i]['question']+
                    '</div><br><ol type="A" style="list-style:none"><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_a')+'" value="a"><label for="'+(hash+'_a')+'">'
                    +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;'+(choices['a'])+
                    '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_b')+'" value="b"><label for="'+(hash+'_b')+'">'
                    +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;'+(choices['b'])+
                    '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_c')+'" value="c"><label for="'+(hash+'_c')+'">'
                    +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;'+(choices['c'])+
                    '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_d')+'" value="d"><label for="'+(hash+'_d')+'">'
                    +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;'+(choices['d'])+
                    '</label><br></li></ol></div></div><hr />'
                );
            }
        };
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });

    // next slide button
    $(document).on('click', '#next-slide', function(e){

        // register question's answer
        registerAnswer(state);
        console.log(answers);

        if (state == 3)
        {
            // pause the timer
            $('#timer').timer('pause');

            // submit question and change the session stage
            submitAnswer();
        }
        else if (state == 2)
        {
            $('#slide-info').text('Finish Test');
            $('#next-slide').removeClass('bg-yellow');
            $('#next-slide').addClass('bg-red');
        }

        state += 1;

        if (state == 2)
        {
            $('#level-label').text('MEDIUM');

            $('.question-list').empty();

            for (var i = 0; i < q.length; i++)
            {
                if (q[i]['type_id'] == 2) {
                    var choices = JSON.parse(q[i]['choices']);
                    var hash = q[i]['question_id'];

                    var type = q[i]['type_id'];
                    // var className = (type == '1')? 'easy' : (type == '2') 'medium' : 'hard';
                    var numbering = q[i]['number'];

                    $('.question-list').append(
                        '<div class="question-list-item"><div><h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">'+numbering+'</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize">'+q[i]['subject']+'</span></b></h3><input type="hidden" name="question_id" value="'+q[i]['question_id']+'"/><div class="question">'
                        +q[i]['question']+
                        '</div><br><ol type="A" style="list-style:none"><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_a')+'" value="a"><label for="'+(hash+'_a')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;'+(choices['a'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_b')+'" value="b"><label for="'+(hash+'_b')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;'+(choices['b'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_c')+'" value="c"><label for="'+(hash+'_c')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;'+(choices['c'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_d')+'" value="d"><label for="'+(hash+'_d')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;'+(choices['d'])+
                        '</label><br></li></ol></div></div><hr />'
                    );
                }
            };

            $('body').scrollTop(0);
        } else if (state == 3) {
            $('#level-label').text('HARD');
            $('.question-list').empty();

            for (var i = 0; i < q.length; i++)
            {
                if (q[i]['type_id'] == 3) {
                    var choices = JSON.parse(q[i]['choices']);
                    var hash = q[i]['question_id'];

                    var type = q[i]['type_id'];
                    // var className = (type == '1')? 'easy' : (type == '2') 'medium' : 'hard';
                    var numbering = q[i]['number'];

                    $('.question-list').append(
                        '<div class="question-list-item"><div><h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">'+numbering+'</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize">'+q[i]['subject']+'</span></b></h3><input type="hidden" name="question_id" value="'+q[i]['question_id']+'"/><div class="question">'
                        +q[i]['question']+
                        '</div><br><ol type="A" style="list-style:none"><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_a')+'" value="a"><label for="'+(hash+'_a')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;'+(choices['a'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_b')+'" value="b"><label for="'+(hash+'_b')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;'+(choices['b'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_c')+'" value="c"><label for="'+(hash+'_c')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;'+(choices['c'])+
                        '</label><br></li><li><input type="checkbox" name="'+hash+'[]'+'" id="'+(hash+'_d')+'" value="d"><label for="'+(hash+'_d')+'">'
                        +'<div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;'+(choices['d'])+
                        '</label><br></li></ol></div></div><hr />'
                    );
                }
            };

            $('body').scrollTop(0);
        }
    });

    function registerAnswer(state)
    {
        for (var i = 0; i < q.length; i++)
        {
            if (q[i]['type_id'] == state) {
                var answer = ($('input[type=checkbox][name*='+q[i]['question_id']+']:checked').val() === undefined) ? 'x' : $('input[type=checkbox][name*='+q[i]['question_id']+']:checked').val();

                answers.push({
                    user_id: $('input[name=user_id]').val(),
                    question_id: q[i]['question_id'],
                    bet: 0,
                    answer: answer
                });
            }
        }
    }

    function submitAnswer()
    {
        swal({
            imageUrl: '../img/loading.gif',
            title: 'Submitting answer...',
            text: 'Please wait while we submit your answer',
            showConfirmButton: false,
            allowEscapeKey: false,
            allowOutsideClick: false
        });

        $.ajax({
            url: 'postStage',
            type: 'POST',
            data: {'answers': answers},
        })
        .done(function() {
            // swal({
            //     title: '',
            //     text: '',
            //     timer: 1,
            //     showConfirmButton: false
            // });
            // // redirect to next stage, stage 2
            // console.log(stage2link);
            window.location.href = finish;
        })
        .fail(function() {
            // $.ajax(this);
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
});
