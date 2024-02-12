<?php

Route::get('login', array('as'=>'login', 'uses'=>'users@login'));
Route::post('login', array('uses'=>'users@login'));
Route::get('logout', array('as'=>'logout', 'uses'=>'users@logout'));

// Webhooks
Route::post('/webhook/messages', array('uses'=> 'webhooks@messages'));
Route::post('/webhook/contacts', array('uses'=> 'webhooks@contacts'));
Route::post('/webhook/channelsUpdates', array('uses'=> 'webhooks@channelsUpdates'));

Route::post('/webhook/all', array('uses'=> 'webhooks@getall'));

Route::group(array('before' => 'auth'), function () {
	Route::get('/', array('as'=>'kanban','uses'=>'kanban@index'));

	Route::post('/changestatus', array('uses' => 'kanban@changestatus'));
	Route::get('/chatiframe', array('uses' => 'client@chatiframe'));

	Route::get('/client/table', array('uses'=>'table@index'));
	Route::get('/client/(:num)', array('uses' => 'client@index'));

	Route::post('/setprice', array('uses'=>'client@setprice'));

	Route::get('/wazzup/all', array('uses' => 'wazzupall@all'));

	Route::get('/register', array('uses' => 'users@register'));
	Route::post('/register', array('uses' => 'users@register'));
	
	Route::get('/users', array('uses' => 'users@users'));
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function () {
	return Response::error('404');
});

Event::listen('500', function () {
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function () {
	// Do stuff before every request to your application...
});

Route::filter('after', function ($response) {
	// Do stuff after every request to your application...
});

Route::filter('csrf', function () {
	if (Request::forged())
		return Response::error('500');
});

Route::filter('auth', function () {
	if (Auth::guest())
		return Redirect::to('login');
});
