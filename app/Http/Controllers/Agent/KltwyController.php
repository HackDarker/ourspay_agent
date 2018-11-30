<?php

namespace App\Http\Controllers\Agent;

use App\Http\Lib\Functions;

use App\Http\Controllers\Controller;

class KltwyController extends Controller 
{
	private $ident = 'klt-wy';

	private $conf;

	public function __construct()
	{
		$this->conf = config('agent.kltwy');
	}

	public function callback()
	{
		//env('OURSPAY_ADDRESS').config('agent.kltkj.notifyurl');
	}

	public function notify()
	{
		$url = Functions::fullPayUrl($this->conf['notifyurl']);
		$content = Functions::curlForm($url, $_POST);
		
		Functions::agentNotifyLog($this->ident);	
		return $content;
	}

	public function query()
	{
		$url = $this->conf['query'];
		$res = Functions::curlJson($url, file_get_contents("php://input"));
		
		Functions::agentNotifyLog($this->ident);
		return $res;
	}
}