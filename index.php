<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>jjh talk</title>
    <script src='jquery-3.2.1.min.js'></script>
    <style>
        *{margin:0; padding:0; box-sizing: border-box; color:#333; font-family: sans-serif;}
        #wrap{text-align:center; background-color: #fff; width:304px; margin: 0 auto; height:600px;}
        #list{width:300px; height:400px; margin: 20px auto 0; border: 1px solid black; padding:5px; overflow:auto; border:none;}
        #list li{list-style:none; text-align:left; background-color: yellow; margin-bottom:10px; word-break: break-all;}
        #text{width:240px; height:50px;}
        #send{height:50px;}
        #user{float:left; text-align: left; margin-left:5px;}
        #con{float:right; text-align:left; margin-right:5px;}
        #con li{list-style:none;}
        body{ background: url("bgi.jpeg") no-repeat center center fixed; background-size: cover; width:100%; height:100%;}
    </style>
</head>
<body>
    <div id="wrap">
        <audio src="ring.mp3" id='ring'>ring</audio>
        <ul id="list">
        </ul>
        <input type="text" name="text" id="text">
        <button id="send" type="submit">보내기</button>
        <div id="user">
            <div class="name"></div>
            <input type="checkbox" id="ringc" checked="checked"> 카톡알람<br>
        </div>
        <div id="con">
            <h4>접속자 명단</h4>
            <ul>
                <li></li>
            </ul>
        </div>
    </div>
</body>
<script type="text/javascript">
    var name = "";
    var final = "2000-01-01 01:01:01";
    while(true){
        if(name==""){
            name = prompt("너의(제발 니 이름) 이름은?").trim();
        }else{
            break;
        }
    }
    $(".name").text("당신의 이름은 : "+name);
    $(document).keypress(function(e) {
        if(e.which == 13){
            send();
        }
    });
    $("#send").click(function(){
        send();
    });
    function send(){
        $.ajax({
            url : "send.php",
            type : "post",
            data : {
                "text" : $("#text").val(),
                "name" : name
            },
            dataType : "text",
            success : function(data){
                console.log("메세지 전송 완료"+data);
                $("#text").val("");
            },
            error : function(){
                console.log("메세지 전송 실패");
            }
        });
    }
    show();
    var list = $('#list');
    function show(){
        $.ajax({
            url : "show.php?final="+final,
            dataType : "json",
            success : function(re){
                console.log('불러오기 성공');
                var name = re['name'];
                var text = re['text'];
                final = re['wdate'];
                $(list).append("<li>"+name+" : "+text+"<br>"+re['wdate']+"</li>");
                list.scrollTop(list.prop("scrollHeight"));
                ring();
            },
            error : function(){
                console.log('불러오기 실패');
            },
            complete  : function(){
                show();
            }
        });
    }
    function ring() {
        if (!$("#ringc").prop("checked")) return;
        var audio = document.getElementById("ring");
        if (audio.paused) {
            audio.play();
        }else{
            audio.currentTime = 0;
        }
    }
    function cuser(){ //check user
        $.ajax({
            url : "connect.php",
            dataType : "text",
            data : {
                "user" : name
            },
            type : "post",
            success : function(user){
                console.log('접속자 리스트 갱신 성공');
                $("#con ul").html(user)
            },
            error : function(){
                console.log('접속자 리스트 갱신 실패');
            }
        });
    }
    var userc = setInterval(cuser,1000);
</script>
</html>