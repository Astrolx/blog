<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>登录</title>
<link href="./public/login/style_log.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./public/login/style.css">
<link rel="stylesheet" type="text/css" href="./public/login/userpanel.css">
<link rel="stylesheet" type="text/css" href="./public/login/jquery.ui.all.css">

</head>
<form action='index.php?c=user&a=loginHandle' method='post'  style="height:600px;">
<body class="login" mycollectionplug="bind"  style="height:600px;">
<div class="login_m"  style="height:600px;">
<div class="login_logo" ><img src="./public/login/logo.png" width="196" height="46"></div>
<div class="login_boder"  style="height:600px;">

<div class="login_padding" id="login_model" style="height:600px;">

  <h2>账号</h2>
  <label>
    <input type="text" id="username" class="txt_input txt_input2" onfocus="if (value ==&#39;Your name&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;Your name&#39;}" value="Your name" name="name">
  </label>
  <h2>密码</h2>
  <label>
    <input type="password" id="userpwd" class="txt_input" onfocus="if (value ==&#39;123456&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;123456&#39;}" value="123456" name="password">
  </label>
  <!-- <h2>邮箱</h2>
  <label>
    <input type="text" id="mobile" class="txt_input" onfocus="if (value ==&#39;Email&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;Email&#39;}" value="Email" name="email" style="width:205px;">
  </label> 
 <label>
      <input type="submit"  id="sendmsg" value="发验证码" style="opacity: 0.7;background-color: ;width:80px;height:32px;margin-left:5px; ">
 </label>-->
 

 
  <p class="forgot"><a id="iforget" href="javascript:void(0);"></a></p>
  <div class="rem_sub">
  <div class="rem_sub_l">
  <input type="checkbox" name="checkbox" id="save_me">
   <label for="checkbox">记住我</label>
   </div>
    <label>
      <input type="submit" class="sub_button" name="button" id="button" value="登录" style="opacity: 0.7;">
    </label>
  </div>
</div>
</form>
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>

<div id="forget_model" class="login_padding" style="display:none">
<br>

   <h1>Forgot password</h1>
   <br>
   <div class="forget_model_h2">(Please enter your registered email below and the system will automatically reset users’ password and send it to user’s registered email address.)</div>
    <label>
    <input type="text" id="usrmail" class="txt_input txt_input2">
   </label>

 
  <div class="rem_sub">
  <div class="rem_sub_l">
   </div>
    <label>
     <input type="submit" class="sub_buttons" name="button" id="Retrievenow" value="Retrieve now" style="opacity: 0.7;">
     　　　
     <input type="submit" class="sub_button" name="button" id="denglou" value="Return" style="opacity: 0.7;">　　
    
    </label>
  </div>
</div>






<!--login_padding  Sign up end-->
</div><!--login_boder end-->
</div><!--login_m end-->
 <br> <br>
<p align="center"><a href="http://www.cssmoban.com/" target="_blank" title="模板之家"></a><a href="http://www.cssmoban.com/" title="网页模板" target="_blank"></a></p>



</body>
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
</html>