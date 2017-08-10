<?php

namespace index\controller;
use index\model\UserModel;
use vendor\alidayu\TopClient;
use vendor\alidayu\AlibabaAliqinFcSmsNumSendRequest;
use vendor\email\PHPMailer;
use vendor\email\SMTP;

class UserController extends Controller
{
	function register()
	{
		$this->display();
	}
	
	function login()
	{
		$this->display();
	}
	
	function loginHandle()
	{
		$name = $_POST['name'];
		$pwd = $_POST['password'];
		$user = new UserModel();
		//var_dump($_POST);die;
		$result = $user->getByName($name);
		$res = $user->checklogin($result,$pwd,$name);
		if ($res[0]) {
		 	$this->notice($res[1], 'index.php');
		 } else {
		 	$this->notice($res[1]);
		 }
		
	}

	function sendSS($title = '邮箱验证')
	{
		$to = $_POST['email'];
		$number = rand(100000,999999);
    	$content = '欢迎注册本网站，验证码为' . $number;

	    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
	    //require_once("vendor/email/PHPMailer.php"); 
	    //require_once("vendor/email/SMTP.php");
	    //实例化PHPMailer核心类
	    $mail = new PHPMailer();

	    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
	    $mail->SMTPDebug = 1;

	    //使用smtp鉴权方式发送邮件
	    $mail->isSMTP();

	    //smtp需要鉴权 这个必须是true
	    $mail->SMTPAuth=true;

	    //链接qq域名邮箱的服务器地址
	    $mail->Host = 'smtp.qq.com';

	    //设置使用ssl加密方式登录鉴权
	    $mail->SMTPSecure = 'ssl';

	    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
	    $mail->Port = 465;

	    //设置smtp的helo消息头 这个可有可无 内容任意
	    // $mail->Helo = 'Hello smtp.qq.com Server';

	    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
	    $mail->Hostname = 'http://www.xiexiaoliang.top';

	    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
	    $mail->CharSet = 'UTF-8';

	    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
	    $mail->FromName = '宇宙小帅哥';

	    //smtp登录的账号 这里填入字符串格式的qq号即可
	    $mail->Username ='1130059292@qq.com';

	    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
	    $mail->Password = 'eqnkfgpmcqrjhjcb';

	    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
	    $mail->From = '1130059292@qq.com';

	    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
	    $mail->isHTML(true); 

	    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
	    $mail->addAddress($to,'lsgo在线通知');

	    //添加多个收件人 则多次调用方法即可
	    // $mail->addAddress('xxx@163.com','lsgo在线通知');

	    //添加该邮件的主题
	    $mail->Subject = $title;

	    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
	    $mail->Body = $content;

	    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
	    // $mail->addAttachment('./d.jpg','mm.jpg');
	    //同样该方法可以多次调用 上传多个附件
	    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

	    $status = $mail->send();

	    //简单的判断与提示信息
	    if($status) {
	        return true;
	    }else{
	        return false;
	    }
	}
	
	function logout()
	{
		unset($_SESSION['name']);
		unset($_SESSION['type']);
		$this->notice('退出成功', 'index.php');
	}
	
	//注册判断
	function registerHandle()
	{
		$user = new UserModel;
		
		if ($_POST['code'] != $_SESSION['smscode']) {
			$this->notice('验证码不正确');
			die;
		}
		$res = $user->getByName($_POST['name']);
		if ($res) {
			$this->notice('用户名已存在');
			die;
		}

		if ($_POST['password'] != $_POST['repassword']) {
			$this->notice('两次密码不一致');
			die;
		}
		
		$result = $user->add($_POST);
		if ($result) {
			$this->notice('注册成功', 'index.php');
			$_SESSION['name'] = $_POST['name'];
		} else {
			$this->notice('注册失败');
		}
	}

	public function sendSMS()
	{
		$tel = $_POST['mobile'];//手机号
		          
		$c = new TopClient;//大于客户端   
		$c->format = 'json';//设置返回值得类型

		$c->appkey = "24460488";//阿里大于注册应用的key

	    $c->secretKey = "be14fc22013a2abb99b954f4c1670339";//注册的secretkey
	                                                       
	    //请求对象，需要配置请求的参数   
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setExtend("123456");//公共回传参数，可以不传
		$req->setSmsType("normal");//短信类型，传入值请填写normal
		
		//签名，阿里大于-控制中心-验证码--配置签名 中配置的签名，必须填
		$req->setSmsFreeSignName("解晓亮");
		
		//你在短信中显示的验证码，这个要保存下来用于验证
		$num = rand(100000,999999);
		$_SESSION['smscode'] = $num;

		//短信模板变量，传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，传参时需传入{"code":"1234","product":"alidayu"}
		$req->setSmsParam("{\"number\":\"$num\"}");//模板参数
		                                           
		//短信接收号码。
	     $req->setRecNum($tel);

		//短信模板ID。阿里大于-控制中心-验证码--配置短信模板 必须填
		$req->setSmsTemplateCode("SMS_71300905");
		$resp = $c->execute($req);//发送请求
		return $resp;
		
	}
}