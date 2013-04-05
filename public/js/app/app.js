'use strict';
var mainMod = angular.module('helpdesk',
	[
		"helpdeskServices",
		"myHelpers",
		"statusservicemod"
	]);

mainMod.config(["$routeProvider" , function ($routeProvider,$locationProvider){
	$routeProvider.
	when("/projects/:id", {templateUrl : 'tickets_main' , controller : TicketController}).
	when("/projects/:id/tickets/:id",{templateUrl : 'single_ticket_view' , controller : TicketDetailsController}).
	otherwise({redirectTo: '/projects/:id'});

}]);