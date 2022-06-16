<?php

// php form表单page方式自动跳转
// 开发手册：http://docs.nephalem.cn/read/zhifufm/step
$amount = $_GET ['amount']; // 获取充值金额
$orderNo = '101'; // 自己创建的本地订单号
$merchantNum = 'XXXXXX'; // 商户号, 商户后台的用户中心页面查看
$secret = 'XXXXXX'; // 商户密钥, 商户后台的用户中心页面查看
$api_url = 'XXXXXX'; // 付款请求接口， 商户后台的用户中心页面查看
$payType = $_GET ['payType']; // 前端传入的支付方式值，查看支付接口文档说明payType的取值
$notifyUrl = 'https://XXXX/zhifu_callback_demo.php'; // XXXX修改为您自己用来接收支付成功的公网地址
$returnUrl = ''; // 'http://xxxx/return_url.php'; # 支付成功您想让页面跳转的地址
$returnType = "page"; // 接口返回方式 page为直接跳转到支付页面，不传返回json

$sign = sign ( array (
		$merchantNum,
		$orderNo,
		$amount,
		$notifyUrl,
		$secret
) );

echo '<html>
      <head><title>redirect...</title></head>
      <body>
          <form id="post_data" action="' . $api_url . '" method="post">
              <input type="hidden" name="merchantNum" value="' . $merchantNum . '"/>
              <input type="hidden" name="payType" value="' . $payType . '"/>
              <input type="hidden" name="amount" value="' . $amount . '"/>
              <input type="hidden" name="orderNo" value="' . $orderNo . '"/>
              <input type="hidden" name="notifyUrl" value="' . $notifyUrl . '"/>
              <input type="hidden" name="returnUrl" value="' . $returnUrl . '"/>
              <input type="hidden" name="sign" value="' . $sign . '"/>
			   <input type="hidden" name="returnType" value="' . $returnType . '"/>
          </form>
          <script>document.getElementById("post_data").submit();</script>
      </body>
      </html>';

/**
 * 签名函数，Class中调用方式 $this->sign(...)
 * @param unknown $data_arr
 * @return unknown
 */
function sign($data_arr) {
	return md5 ( join ( '', $data_arr ) );
}
?>