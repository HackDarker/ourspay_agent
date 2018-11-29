<?php

return [
	'kltkj' => [
		'query' => 'https://ipay.chinasmartpay.cn/openapi/merchantPayment/orderQuery',
		'notifyurl' => '/Pay_Kltkj_notifyurl.html',	//ourspay address
	],

	'kltwy' => [
		'query' => 'https://ipay.chinasmartpay.cn/openapi/merchantPayment/orderQuery',
		'notifyurl' => '/Pay_Kltwy_notifyurl.html',
	],
	'kltdf' => [
		'submit' => 'http://180.168.61.86:27380/hpayTransGatewayWeb/trans/df/transdf.htm',
		'query' => 'http://180.168.61.86:27380/hpayTransGatewayWeb/trans/query.htm',
		'notifyurl' => '/Payment_Kltdf_notifyurl.html',
		'balance' => 'http://180.168.61.86:27380/hpayTransGatewayWeb/trans/df/queryAccount.htm',
	],
];