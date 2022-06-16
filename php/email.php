<?php
require 'email.class.php';



$mailto=$_POST["email"]; //收件人
$subject="茶茶商城修改密码"; //邮件主题
$code = rand(100000,999999); 
$body="您的一次性验证码为:$code"; //邮件内容


$servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";


$conn = new mysqli($servername, $username, $password,$database_name);

// 检测连接
$sql = "SELECT email FROM user WHERE email='$mailto'"; //SQL语句
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result); //统计执行结果影响的行数
if($num)    //如果已经存在该用户
{
  $a = "chache/$mailto.txt";

$b= fopen($a, "w");

$c = fwrite($b, $code);

fclose($b);
sendmailto($mailto,$subject,$body);
// fclose($file);
echo("发送成功");


}
else    //不存在当前注册用户名称
{
    echo "账号不存在";
}




function sendmailto($mailto, $mailsub, $mailbd)
{
  //require_once ('email.class.php');
  //##########################################
  $smtpserver   = "smtp.163.com"; //SMTP服务器
  $smtpserverport = 25; //SMTP服务器端口
  $smtpusermail  = "liuyu2949027426@163.com"; //SMTP服务器的用户邮箱
  $smtpemailto  = $mailto;
  $smtpuser    = "liuyu2949027426@163.com"; //SMTP服务器的用户帐号
  $smtppass    = "UZXLUPWYDASPLWKO"; //SMTP服务器的用户密码
  $mailsubject  = $mailsub; //邮件主题
  $mailsubject  = "=?UTF-8?B?" . base64_encode($mailsubject) . "?="; //防止乱码
  $mailbody    = $mailbd; //邮件内容
  //$mailbody = "=?UTF-8?B?".base64_encode($mailbody)."?="; //防止乱码
  $mailtype    = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件. 139邮箱的短信提醒要设置为HTML才正常
  ##########################################
  $smtp      = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
  $smtp->debug  = False; //是否显示发送的调试信息
  $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);


}
?>
