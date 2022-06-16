<?php
// php json方式接收接口返回支付链接后 自行跳转
// 开发手册：http://docs.nephalem.cn/read/zhifufm/step

//本地化内容
$payType = $_POST ['order_name'];
$payType = $_POST ['order_num'];

$payType = $_POST ['address'];
$payType = $_POST ['date'];

$a = "chache/order/$mailto.txt";

$b= fopen($a, "w");

$c = fwrite($b, $code);

//END



$amount = $_GET ['amount']; // 获取充值金额
$orderNo = '101'; // 自己创建的本地订单号
$merchantNum = '131152427314708480'; // 商户号, 商户后台的用户中心页面查看
$secret = '26e267dcdd6397772fd938ce6cf09156'; // 商户密钥, 商户后台的用户中心页面查看
$api_url = 'http://api-zvdnlfeq0ow.zhifu.fm.it88168.com/api/startOrder'; // 接口地址， 商户后台的用户中心页面查看
$payType = $_GET ['payType']; // 查看支付接口文档说明payType的取值
$notifyUrl = 'http:///42.193.16.80/pay/zhifu_callback_demo.php'; // xxxx修改为您自己用来接收支付成功的公网地址
$returnUrl = 'http://42.193.16.80/success.html'; // 'http://xxxx/return_url.php'; # 支付成功您想展示给顾客看到的页面地址
$returnType = "json"; // 接口返回方式 page为直接跳转到支付页面，不传返回json
$sign = sign ( array (
		$merchantNum,
		$orderNo,
		$amount,
		$notifyUrl,
		$secret
) );
$native = array (
		"merchantNum" => $merchantNum,
		"payType" => $payType,
		"amount" => $amount,
		"orderNo" => $orderNo,
		"notifyUrl" => $notifyUrl,
		"returnUrl" => $returnUrl,
		"sign" => $sign,
		"returnType" => $returnType
);

$param = http_build_query ( $native );
$return = http_request ( $api_url, $param, 'application/x-www-form-urlencoded;charset=utf-8' );
if (strpos ( $return, '{' ) === 0) {
	$return = json_decode ( $return, true );
	if ($return ['success']) {
		// json方式展示支付链接有如下几种
		header ( "location:" . $return ['data'] ['payUrl'] );
		exit();
		// header("Refresh:0.1;url=" . $return['data']['payUrl']); //会在0.1秒后执行跳转
	} else {
		exit($return ['msg']);
	}
} else {
	exit( "请求异常");
}



/**
 * 签名函数，Class中调用方式 $this->sign(...)
 * @param unknown $data_arr
 * @return unknown
 */
function sign($data_arr) {
	return md5 ( join ( '', $data_arr ) );
}

// 发送请求
function http_request($url, $post_data = array(), $header = 'Content-Type: application/json') {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// 返回最后的Location
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 60 );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			$header,
			'Content-Length: ' . strlen ( $post_data )
	) );
	$contents = curl_exec ( $ch );
	curl_close ( $ch );
	return $contents;
}

?>