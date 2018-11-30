<?php

namespace App\Http\Lib;

//公共函数库
class Functions {

	private static $error;

	public static function curlForm($url,$data = []){

        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded;charset=UTF-8'));
        curl_setopt($ch,CURLOPT_TIMEOUT,5);
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

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

            self::$error = $log;
            return null;
        }
        return $output;
    }
  
    public static function curlJson($url,$data){
    	is_array($data) && $data = json_encode($data);

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

            self::$error = $log;
            return null;
        }
        return $output;
    }

    /**
     * 填充完成的ourspay地址
     * @param  string $path ourspay路径
     * @return string     http[s]://domain/path 
     */
    public static function fullPayUrl($path)
    {
    	return env('OURSPAY_ADDRESS').$path;
    }


   	public static function agentNotifyLog($ident, $other = '')
   	{
   		$main = sprintf('%s notify: [post]%s;', $ident, file_get_contents('php://input'));
   		$other and $main.= sprintf(' [other]%s', $other);
      	\Log::info($main);
   	} 

    //会返回最近出错的灵气，返回后会立即reset
    public static function geterror()
    {
    	$info = self::$error;
    	self::$error = null;

    	return $info;
    }

    public static function test()
    {
    	return 'jack';
    }
}
