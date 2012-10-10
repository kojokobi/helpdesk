<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Route::get('/', function()
// {
// 	return View::make('home.index');
// });
//Route::get('/',array('uses' => 'Security@index'));
Route::put('jobtitles',array('uses' => 'home@jobtitle'));
Route::post('jobtitles',array('uses' => 'home@jobtitle'));
Route::get('jobtitles',array('uses' => 'home@jobtitles'));
Route::get('jobtitles',array('uses' => 'home@jobtitles'));
/*
 *Roles routes
 */
Route::post('roles',array('uses' => 'home@role'));
Route::put('roles',array('uses' => 'home@role'));
Route::get('roles',array('uses' => 'home@roles'));
Route::delete('roles',array('uses' => 'home@role'));
/*
 *projet routes
 */
Route::post('projects',array('uses' => 'home@create_project'));
Route::put('projects',array('uses' => 'home@update_project'));
Route::get('projects',array('uses' => 'home@projects'));
Route::delete('projects',array('uses' => 'home@project'));
/*
 *user routes
 */
Route::post('users',array('uses' => 'security@user'));
Route::put('users',array('uses' => 'security@user'));
Route::get('users',array('uses' => 'security@users'));
Route::delete('users',array('uses' => 'security@user'));
Route::post('users/changepassword',array('uses' => 'security@change_password'));
Route::post('users/updateprofile',array('uses' => 'security@update_user_profile'));
/*
 *Project Groups routes
 */
Route::post('projectgroups',array('uses' => 'home@create_project_group'));
Route::put('projectgroups',array('uses' => 'home@update_project_group'));
Route::get('projectgroups',array('uses' => 'home@project_groups'));
Route::delete('projectgroups',array('uses' => 'home@project_group'));
/*
 *Ticket Statuses
 */
Route::post('ticketstatuses',array('uses'=>'ticket@ticket_status'));
Route::put('ticketstatuses',array('uses'=>'ticket@ticket_status'));
Route::delete('ticketstatuses',array('uses'=>'ticket@ticket_type'));
Route::get('ticketstatuses',array('uses'=>'ticket@ticket_statuses'));
Route::get('ticketstatuses/(:num)',array('uses'=>'ticket@statuses_by_user'));
/*
 *Priority routes
 */
Route::post('priorities',array('uses'=>'home@create_priority'));
Route::put('priorities',array('uses'=>'home@update_priority'));
Route::delete('priorities',array('uses'=>'home@priority'));
Route::get('priorities',array('uses'=>'home@priorities'));
/*
 *Ticket Types
 */
Route::post('tickettypes',array('uses'=>'ticket@create_ticket_type'));
Route::put('tickettypes',array('uses'=>'ticket@ticket_type'));
Route::delete('tickettypes',array('uses'=>'ticket@ticket_type'));
Route::get('tickettypes',array('uses'=>'ticket@ticket_types'));
/*
 *Tickets routes
 */
Route::post('tickets',array('uses'=>'ticket@ticket'));
Route::post('tickets/(:num)',array('uses'=>'ticket@ticket_details'));
Route::put('tickets',array('uses'=>'ticket@update_ticket'));
Route::delete('tickets',array('uses'=>'ticket@ticket'));
Route::get('tickets',array('uses'=>'ticket@tickets'));
Route::get('tickets/(:num)',array('uses'=>'ticket@ticket_details'));
Route::get('tickets_main',array('uses'=>'ticket@ticket_main'));
Route::get('tickets_view',array('uses'=>'ticket@tickets_view'));
Route::get('single_ticket_view',array('uses'=>'ticket@single_ticket_view'));
/*
 *Project User Groups routes
 */
Route::post('usergroups',array('uses'=>'home@create_project_user_group'));
Route::put('usergroups',array('uses'=>'home@update_project_user_group'));
Route::delete('usergroups',array('uses'=>'home@project_user_group'));
Route::get('usergroups',array('uses'=>'home@project_user_groups'));

/*
 *security routes
 */
Route::post('login',array('uses' => 'security@login'));
Route::get("logout", array("uses" => "security@logout"));
Route::get('login',array('uses'=> 'security@login'));
/*
 *Applcation View routes go here
 */
Route::get("admin_view", array("as"=> "admin", "uses"=> "admin@index"));
Route::get("dashboard_view", array("uses"=> "home@dash_board"));

Route::get("summaries",array('uses'=>"summary@counts"));
Route::get("summaries/tickets/incoming",array('uses'=>"summary@incoming_tickets"));
Route::get("summaries/tickets/outgoing",array('uses'=>"summary@outgoing_tickets"));


Route::get("profile_view", function(){
	return View::make("profile.index");
});

// Route::get("tickets_view", function (){
// 	return View::make("tickets.index");
// });

// Route::get("dashboard_view", function (){
// 	return View::make("dashboard.index");
// });
// Route::get("tickets_main",function (){
// 	echo View::make("tickets.main"); 
// });

//these view are submitted via ajax there do not need any aunthen
// Route::get("single_ticket_view",function (){
// 	echo View::make("tickets.single_ticket"); 
// });

// Route::get('login', function()
// {
// 	return View::make('login.index');
// });
Route::get('number',array('uses' => 'home@number'));
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

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
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
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});
