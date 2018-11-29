<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

/**
 * 开联通快捷支付
 */
class KltdfController extends Controller
{

	public function __construct()
	{

	}

	public function notify()
	{
		$url = env('OURSPAY_ADDRESS').config('agent.kltdf.notifyurl');
		$content = self::send_post_curl($url, $_POST);

		return $content;
	}

	public function payment()
	{
		$post = file_get_contents("php://input");
		$url = config('agent.kltdf.submit');

		$res = send_post_curl($url, $post);
		return $res;
	}

	public function query()
	{
		$post = file_get_contents("php://input");
		$url = config('agent.kltdf.query');
		
		$res = send_post_curl($url, $post);

		return $res;
	}

	public function balance()
	{
		$post = file_get_contents("php://input");
		$url = config('agent.kltdf.balance');

		$res = send_post_curl($url, $post);
		return $res;
	}

	private static function send_post_curl($url,$data = array()){
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json;charset=UTF-8','Content-Length: ' . strlen($data)));
        curl_setopt($ch,CURLOPT_TIMEOUT,5);
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        //执行并获取url地址的内容
        $output = curl_exec($ch);
        $header = curl_getinfo($ch);
        $http_code = $header['http_code'];
        //释放curl句柄
        curl_close($ch);
        if(200 != $http_code) {
            $log['output'] = $output;
            $log['requestData'] = $data;
            $log['curl_header'] = $header;
            //记日志哈
            return null;
        }
        return $output;
        //"{"responseCode":"000000","responseMsg":"短信发送成功！","requestId":"0d6f13ffcf95418fb08b47f8549d9a1d","mchtId":"903110153110001","signMsg":"01304476E4E3EB0BB68259A924445ADE","signType":"1","orderNo":"wx201808161629"}"
    }

}
