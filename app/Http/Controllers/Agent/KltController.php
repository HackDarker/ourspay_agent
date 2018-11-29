<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

/**
 * 开联通快捷支付
 */
class KltController extends Controller
{

	public function __construct()
	{

	}


	public function callback()
	{
		echo env('OURSPAY_ADDRESS').config('agent.kltkj.notifyurl');
	}

	public function notify()
	{
		$url = env('OURSPAY_ADDRESS').config('agent.kltkj.notifyurl');
		$content = self::send_post_curl($url, $_POST);

		return $content;
	}

	public function query()
	{
		$post = $_POST;
		$url = config('agent.kltkj.query');

		$res = send_post_curl($url, $post);
		return $res;
	}

	private static function send_post_curl($url,$data = []){
        $data = json_encode($data);

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
    }

}
