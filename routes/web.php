<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return 'agent_pay';
});

$router->group(['namespace' => 'Agent'], function () use ($router) {
	//redirect to ourspay after pay complete
	$router->get('klt/callback', 'KltController@callback');

	//klt server notice ourspay after pay complete
	$router->post('klt/notify', 'KltController@notify');

	//query klt order status for ourspay
	$router->post('klt/query', 'KltController@query');


	$router->post('kltwy/notify', 'KltwyController@notify');
	$router->post('kltwy/query', 'KltwyController@query');

	//kltdf submit
	$router->get('kltdf/callback', 'KltdfController@callback');
	$router->post('kltdf/payment', 'KltdfController@payment');
	$router->post('kltdf/query', 'KltdfController@query');
	$router->post('kltdf/notify', 'KltdfController@notify');
	$router->post('kltdf/balance', 'KltdfController@balance');

});
