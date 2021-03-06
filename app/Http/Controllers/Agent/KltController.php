<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

use Log;

use App\Http\Lib\Functions;

/**
 * 开联通快捷支付
 */
class KltController extends Controller
{

	private $ident = 'klt-quick';

	public function __construct()
	{

	}


	public function callback()
	{
		//env('OURSPAY_ADDRESS').config('agent.kltkj.notifyurl');
	}

	public function notify()
	{
		$url = env('OURSPAY_ADDRESS').config('agent.kltkj.notifyurl');
		$content = Functions::curlForm($url, $_POST);
		
		Functions::agentNotifyLog($this->ident);	
		return $content;
	}

	public function query()
	{
		$url = config('agent.kltkj.query');
		$res = Functions::curlJson($url, file_get_contents("php://input"));
		
		Functions::agentNotifyLog($this->ident);
		return $res;
	}

}
