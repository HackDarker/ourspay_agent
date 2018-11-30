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
		'submit' => 'https://ipay.chinasmartpay.cn/openapi/singlePayment/payment',
		'query' => 'https://ipay.chinasmartpay.cn/openapi/singlePayment/query',
		'notifyurl' => '/Payment_Kltdf_notifyurl.html',
		'balance' => 'https://ipay.chinasmartpay.cn/openapi/singlePayment/queryAccountInfo',
	],
];