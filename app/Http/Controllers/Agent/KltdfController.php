<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

use Log;

use App\Http\Lib\Functions;

/**
 * 开联通快捷支付
 */
class KltdfController extends Controller
{

	private $ident = 'klt-df';
	private $config;

	public function __construct()
	{
		$this->config =config('agent.kltdf');
	}

	public function callback()
	{
		echo "callback";
	}

	public function notify()
	{
		$url = Functions::fullPayUrl($this->config['notifyurl']);
		$content = Functions::curlForm($url, $_POST);
		Functions::agentNotifyLog($this->ident);

		return $content;
	}

	public function payment()
	{
		$post = file_get_contents("php://input");
		$res = Functions::curlJson($this->config['submit'], $post);
		Functions::agentNotifyLog($this->ident);
		return $res;
	}

	public function query()
	{
		$post = file_get_contents("php://input");
		$res = Functions::curlJson($this->config['query'], $post);

		Functions::agentNotifyLog($this->ident);
		return $res;
	}

	public function balance()
	{
		$post = file_get_contents("php://input");
		$res = Functions::curlJson($this->config['balance'], $post);
		Functions::agentNotifyLog($this->ident);
		return $res;
	}

}
