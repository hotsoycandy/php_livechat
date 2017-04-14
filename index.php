<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>ajax</title>
    <script src='jquery-3.2.1.min.js'></script>
    <style>
        *{margin:0; padding:0; box-sizing: border-box; color:#333; font-family: sans-serif;}
        #wrap{text-align:center;}
        #list{width:300px; height:400px; margin: 20px auto 0; border: 1px solid black; padding:5px; overflow:auto;}
        #list li{list-style:none; text-align:left; background-color: yellow; margin-bottom:10px; word-break: break-all;}
    </style>
</head>
<body>
    <div id="wrap">
        <ul id="list">
        </ul>
        <input type="text" name="text" id="text">
        <button id="send" type="submit">보내기</button>
        <div class="name"></div>
    </div>
</body>
<script type="text/javascript">
    var name = "";
    var final = "2000-01-01 01:01:01";
    while(true){
        if(name==""){
            name = prompt("너의 이름은?").trim();
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
    function show(){
        $.ajax({
            url : "show.php?final="+final,
            dataType : "json",
            success : function(re){
                console.log('불러오기 성공');
                console.log(re);
                var name = re['name'];
                var text = re['text'];
                final = re['wdate'];
                $("#list").append("<li>"+name+" : "+text+"</li>");
                var d = $('#list');
                d.scrollTop(d.prop("scrollHeight"));
                show();
            },
            error : function(){
                console.log('불러오기 실패');
                show();
            }
        });
    }
</script>
</html>