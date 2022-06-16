<?php

 $servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";

$conn = new mysqli($servername, $username, $password,$database_name);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$orderno=$_GET['orderNo'];
$amount=$_GET['amount'];


$sql = "INSERT INTO `xxxx`.`order` (`id`, `email`, `order_name`, `order_num`, `order_price`, `order_product_id`, `address`, `date`, `status`) VALUES ($orderno, '2949027426@qq.com', 'realmeGT 大师探索版', 1, $amount, 1, '刘宇 15375984932 福建省莆田市涵江区', '2022-06-15 19:03:24', 'no');";
 $result = mysqli_query($conn,$sql);
 











$merchantNum = '131152427314708480'; // 商户号, 商户后台的商户信息页面查看
$secret = "26e267dcdd6397772fd938ce6cf09156"; //密钥
/**
 * md5(付款成功状态state的值+商户号merchantNum的值+商户订单号orderNo的值+订单金额amount的值+商户秘钥)
 * +表示字符串拼接
 */





write_log ( http_build_query($_GET));
$sign = sign ( array (
		$_GET ['state'],
		$merchantNum,
		$_GET ['orderNo'],
		$_GET ['amount'],
		$secret
) );

// 对比签名
// write_log('sign'.$sign);
if ($merchantNum == $_GET ['merchantNum'] && $sign == $_GET ['sign']) {
    
    
    
    
	write_log ( '我要返回success啦' );
	echo 'success';
} else {
	write_log ( '我签名没通过啊' );
	echo 'fail';
	exit ();
}
;
function sign($data_arr) {
	write_log ( join ( '+', $data_arr ) . "== MD5sign ==> " . md5 ( join ( '', $data_arr ) ) );
	return md5 ( join ( '', $data_arr ) );
}
;
/**
 * write_log 写入日志,调试或者记录用,上线后可以删除也可以按需保留部分
 * Class中调用方式 $this->write_log(...)
 * @param [type] $data    	[写入的数据]
 * @return [type] [description]
 */
function write_log($data) {
	$years = date ( 'Y-m' );
	// 设置路径目录信息
	$url = './zhifufm/' . $years . '/' . date ( 'Ymd' ) . '_request_log.txt';
	$dir_name = dirname ( $url );
	// 目录不存在就创建
	if (! file_exists ( $dir_name )) {
		// iconv防止中文名乱码
		$res = mkdir ( iconv ( "UTF-8", "GBK", $dir_name ), 0777, true );
	}
	$fp = fopen ( $url, "a" ); // 打开文件资源通道 不存在则自动创建
	fwrite ( $fp, date ( "[Y-m-d H:i:s] " ) . var_export ( $data, true ) . "\r\n" ); // 写入文件
	fclose ( $fp ); // 关闭资源通道
}

?>
