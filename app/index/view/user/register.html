
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>注册</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="public/register/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/register/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>


        <div class="register-container container">
            <div class="row">
                <div class="iphone span5">
                    <img src="public/register/img/timg.jpg" alt="">
                </div>
                <div class="register span6" class="ppx">
                    <form action='index.php?c=user&a=registerHandle' method='post'>
                        <h2>注册<span class="red"><strong></strong></span></h2>
                        <label for="username">注册账号</label>
                        <input type="text" id="username" name="name" placeholder="输入用户名">
                        <label for="email">密码</label>
                        <input type="password" id="email" name="password" placeholder="输入密码">
                        <label for="password">密码确认</label>
                        <input type="password" id="password" name="repassword" placeholder="再次输入密码">
                        <label for="password">手机号验证</label>
                        <input type="text" id="mobile" name="mobile" placeholder="输入正确的手机号" style="width:350px; margin-left:-100px;">
                        <button id='sendmsg' style="width:90px; clear:left;margin-left:377px;margin-top:-84px; ">发送验证码</button>
                        <input type="text" name="code" class='code' placeholder="验证码" style="width:350px; margin-left:-100px;"> 
                        <button type="submit">提交</button>
                    </form>
                </div>
            </div>
        </div>
		<div align="center"><a href="http://www.cssmoban.com/" target="_blank" title="模板之家"></a></div>
        <!-- Javascript -->
        <script src="public/register/js/jquery-1.8.2.min.js"></script>
        <script src="public/register/bootstrap/js/bootstrap.min.js"></script>
        <script src="public/register/js/jquery.backstretch.min.js"></script>
        <script src="public/register/js/scripts.js"></script>
        <script type="text/javascript">
            //验证手机号
            $("#mobile").blur(function(){
                var value = $(this).val();
                //console.log(value,typeof value);
                if ( 0 == value.lenght || "" == value) {
                    //alert("手机号不能为空！")
                    $(this).focus();
                } else {
                    // $.post('index.php?c=user&a=sendSMS',{phone:value},function(data){
                    //     if (data) {
                    //         alert("手机号重复！");
                    //     }
                    // });
                }
                 
            });
         
            var InterValObj; //timer变量，控制时间
            var count = 60; //间隔函数，1秒执行
            var curCount;//当前剩余秒数
            var code = ""; //验证码
            var codeLength = 6;//验证码长度
         
            $('#sendmsg').click(function () {
                var phone = $("#mobile").val();
                console.log(phone);
                $.post('index.php?c=user&a=sendSMS',{mobile:phone},function(data){
                    if(data){
                                console.log(data);
                                curCount = count;
                               //设置button效果，开始计时
                               $("#sendmsg").css("background-color", "LightSkyBlue");
                               $("#sendmsg").attr("disabled", "true");
                               $("#sendmsg").html("获取" + curCount + "秒");
                               InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                              // alert("验证码发送成功，请查收!");
                          }
                });
               
                return false;
            })
         
            function SetRemainTime() {
                if (curCount == 0) {
                    window.clearInterval(InterValObj);//停止计时器
                    $("#sendmsg").removeAttr("disabled");//启用按钮
                    $("#sendmsg").css("background-color", "");
                    $("#sendmsg").html("重发验证码");
                    code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
                }
                else {
                    curCount--;
                    $("#sendmsg").html("获取" + curCount + "秒");
                }
            }
        </script>

    </body>

</html>

