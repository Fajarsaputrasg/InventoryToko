$(function(){

    var base_url = 'http://localhost/kuis_website_bpjs_intan/'; // Ganti dengan BASE URL APLIKASI KUIS WEBSITE INI di server QC (Referensi app/App.php)
    var base_url_api_web_admin = 'http://localhost/bpjsintanv4/'; // Ganti dengan BASE URL QC BPJS INTAN Web Adminnya
    var index = 0;
    var num = 1;
    var qdata;
    var totalperq;
    var now = 0;
    var start = false;
    var answers = [];
    var totalquestion;
    var startquiz;
    var typekpp;
    var testid;
    var currscore = 0;
    var answersString;

    $.ajax({
        url: base_url + 'index.php/quiz/getquizdata',
        type: 'post'
    }).done(function(resp){
        // console.log(resp);
        parseJson = JSON.parse(resp);
        testid = parseJson.testid;
        qdata = parseJson;
        start = true;
        totalperq = Math.ceil(100/qdata.nquestion);
        totalquestion = qdata.nquestion;
        var d = new Date();
        startquiz = d.getTime() / 1000;
        if(start == true){
            var minutes = 60 * qdata.duration;
            var display = $('#time');
            startTimer(minutes, display);
        }
        template(qdata, 0); 
    });

    function checkSession(index, num, answers){
        $.ajax({
            url: base_url + 'index.php/quiz/set_session',
            type: 'post'
        }).done(function(resp){
            // console.log(resp);
            parseJson = JSON.parse(resp);
            testid = parseJson.testid;
            qdata = parseJson;
            start = true;
            totalperq = Math.ceil(100/qdata.nquestion);
            totalquestion = qdata.nquestion;
            var d = new Date();
            startquiz = d.getTime() / 1000;
            if(start == true){
                var minutes = 60 * qdata.duration;
                var display = $('#time');
                startTimer(minutes, display);
            }
            template(qdata, 0); 
        });
    }

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            // setSession(timer);
            if (--timer < 0) {
                endQuiz();
            }

        }, 1000);
    }

    $("#onlanjut").on('click', function(){
        now = totalperq * num;
        var currans = $('input[name=checked]:checked').val();
        var astr = qdata.quiz[index].id + '-' + currans;
        if(currans == qdata.quiz[index].benar){
            currscore += 100 / totalquestion;
        }

        // console.log(currscore);
        index += 1;
        num += 1;
        
        answers.push(astr);
        answersString = answers.toString();
        if(index != totalquestion){
            template(qdata, index);
        }else{
            endQuiz();
        }

    });

    function endQuiz(){
        var d = new Date();
        var endquiz = d.getTime() / 1000;
        endquiz = parseInt(endquiz);
        startquiz = parseInt(startquiz);
        npp = qdata.npp;
        typekpp = qdata.kpptype;

        $.ajax({
            url: base_url_api_web_admin + 'index.php/link/postkpp',
            type: 'post',
            data: {
                'startquiz': startquiz,
                'endquiz': endquiz,
                'npp': npp,
                'testid': testid,
                'token': "",
                'answers': answersString,
                'nquestion': totalquestion,
                'type': typekpp
            }
        }).done(function(resp){
            templateScore();
        });
    }

    function templateScore(){
        $("#cf1").empty();
        if(Math.round(currscore) > 50){
            // Senang
            $("#cf1").html(
                '<div class="card shadow mb-4">' +
                    '<div class="card-header py-3" style="text-align: center;">' +
                        '<h6 class="m-0 font-weight-bold text-success">HASIL ANDA</h6>' +
                    '</div>' +
                    '<div class="card-body" style="text-align: center;">' +
                        '<p>Anda telah menyelesaikan kuis ini <br> dengan nilai <br><br> <img src="' + base_url + 'img/senang1.png" width="70" height="160">' + 
                        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: 100px;">' + 
                            Math.round(currscore) + 
                        '</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="' + base_url + 'img/senang2.png" width="70" height="160"></img></p><br><br>' +
                        '<br>' +
                        '<a href="' + base_url + 'index.php/quiz" class="btn btn-success"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>' +
                    '</div>' +
                '</div>'
            );
        }else{
            // Sedih
            $("#cf1").html(
                '<div class="card shadow mb-4">' +
                    '<div class="card-header py-3" style="text-align: center;">' +
                        '<h6 class="m-0 font-weight-bold text-success">HASIL ANDA</h6>' +
                    '</div>' +
                    '<div class="card-body" style="text-align: center;">' +
                    '<p>Anda telah menyelesaikan kuis ini <br> dengan nilai <br><br> <img src="' + base_url + 'img/sedih1.png" width="70" height="160">' + 
                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: 100px;">' + 
                        Math.round(currscore) + 
                    '</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="' + base_url + 'img/sedih2.png" width="70" height="160"></img></p><br><br>' +
                        '<a href="' + base_url + 'index.php/quiz" class="btn btn-success"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>' +
                    '</div>' +
                '</div>'
            );
        }
    }

    function template(qdata, ind){
        $("#show_quiz").empty();

        $("#pgb").html('<div class="progress-bar bg-success" role="progressbar" style="width: ' + now + '%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>');

        $("#num_info").html(
            '<h6 class="m-0 font-weight-bold text-primary">Pertanyaan ' + num + ' dari ' + qdata.nquestion + '</h6>'
        );

        $("#show_quiz").html(
            '<p>' + qdata.quiz[ind].pertanyaan + '</p>' +
            '<div class="table-responsive">' +
                '<table class="table table-borderless">' +
                    '<thead style="display: none;">' +
                        '<th></th>' +
                        '<th style="text-align: center;"></th>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr>' +
                            '<td><input type="radio" name="checked" id="" value="a"></td>' +
                            '<td width="95%" class="wrapping-choice">' + qdata.quiz[ind].a + '</td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td><input type="radio" name="checked" id="" value="b"></td>' +
                            '<td width="60%" class="wrapping-choice">' + qdata.quiz[ind].b + '</td>' +
                        '</tr>' +
                        '<tr>' + 
                            '<td><input type="radio" name="checked" id="" value="c"></td>' +
                            '<td width="60%" class="wrapping-choice">' + qdata.quiz[ind].c + '</td>' +
                        '</tr>' + 
                        '<tr>' +
                            '<td><input type="radio" name="checked" id="" value="d"></td>' +
                            '<td width="60%" class="wrapping-choice">' + qdata.quiz[ind].d + '</td>' +
                        '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</div>' 
        );
    }
 
});