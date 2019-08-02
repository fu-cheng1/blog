<?php 
require dirname(__FILE__).'/../../../../init.php';
ini_set("display_errors", "On");

error_reporting(E_ALL | E_STRICT);
$is_kl_sendmail = is_file(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail.php') ? true : false;
$email = addslashes(trim($_POST['email']));
$CACHE->updateCache('options');
if($is_kl_sendmail){
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail_config.php');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.smtp.php');
require_once(EMLOG_ROOT.'/content/plugins/kl_sendmail/class/class.phpmailer.php');
if (isEmailExist($email)!=true) {
	print_r(json_encode(array('error'=>0, 'status'=>'1')));
	exit;
}else{
	$blogname = Option::get('blogname');
	$row = getOneUser($email);
	$uid = $row['uid']; 
	$token = md5($uid.$row['username'].$row['password']);
	$url = BLOG_URL."?reset=reset&email=".$email."&token=".$token;
	$time = date('Y-m-d H:i');

    $from = $blogname;
    $headers = 'From: '.$from . "\r\n";  
    $subject = '密码找回-'.$blogname;  
    $msg = '您与'.$time.'提交了找回密码请求。请点击下面的链接重置密码<br/><a href='.$url.' target="_blank">'.$url.'</a>';
    if(kl_sendmail_do(KL_MAIL_SMTP,KL_MAIL_PORT,KL_MAIL_SENDEMAIL,KL_MAIL_PASSWORD, $email,$subject, $msg, $blogname)){
        print_r(json_encode(array('error'=>0, 'msg'=>'系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时重置您的密码')));  
    }else{
        print_r(json_encode(array('error'=>1, 'msg'=>'密码邮件发送失败，请联系网站管理员'))); 
    }
}
function kl_sendmail_do1($mailserver, $port, $mailuser, $mailpass, $mailto, $subject,  $content, $fromname)
{
	$mail = new KL_SENDMAIL_PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->Encoding = "base64";
	$mail->Port = $port;
	$mail->IsSMTP();
	//$mail->IsMail();
	$mail->Host = $mailserver;
	$mail->SMTPAuth = true;
	$mail->Username = $mailuser;
	$mail->Password = $mailpass;
	 
	$mail->From = $mailuser;
	$mail->FromName = $fromname;
	 
	$mail->AddAddress($mailto);
	$mail->WordWrap = 500;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $content;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if($mail->Host == 'smtp.gmail.com') $mail->SMTPSecure = "ssl";
	if(!$mail->Send())
	{
	echo $mail->ErrorInfo;
	return false;
	}else{
	return true;
	}
}
}else{
if (Option::EMLOG_VERSION == '6.0.1'){
require_once(EMLOG_ROOT.'/include/lib/phpmailer.php');
require_once(EMLOG_ROOT.'/include/lib/smtp.php');
if (isEmailExist($email)!=true) {
	print_r(json_encode(array('error'=>0, 'status'=>'1')));
	exit;
}else{
    $blogname = Option::get('blogname');
	$row = getOneUser($email);
	$uid = $row['uid']; 
	$token = md5($uid.$row['username'].$row['password']);
	$url = BLOG_URL."?reset=reset&email=".$email."&token=".$token;
	$time = date('Y-m-d H:i');

    $from = $blogname;
    $headers = 'From: '.$from . "\r\n";  
    $subject = '密码找回-'.$blogname;  
    $msg = '您与'.$time.'提交了找回密码请求。请点击下面的链接重置密码<br/><a href='.$url.' target="_blank">'.$url.'</a>';
    if(sendmail_do(MAIL_SMTP,MAIL_PORT,MAIL_SENDEMAIL,MAIL_PASSWORD, $email,$subject, $msg, $blogname)){
        print_r(json_encode(array('error'=>0, 'msg'=>'系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时重置您的密码')));  
    }else{
        print_r(json_encode(array('error'=>1, 'msg'=>'密码邮件发送失败，请联系网站管理员'))); 
    }
}
}
}

function isEmailExist($email) {
	$db = Database::getInstance();
    $data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."user WHERE email='$email'");
    if ($data['total'] > 0) {
        return true;
    }else {
        return false;
    }
}

function getOneUser($email){
	$db = Database::getInstance();
    $row = $db->once_fetch_array("select * from ".DB_PREFIX."user where email='$email'");
    $userData = array();
    if($row) {
        $userData = array(
        	'uid' => htmlspecialchars($row['uid']),
            'username' => htmlspecialchars($row['username']),
            'password' => htmlspecialchars($row['password'])
        );
    }
    return $userData;
}
?>
