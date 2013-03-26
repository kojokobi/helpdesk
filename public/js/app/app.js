'use strict';
var mainMod = angular.module('helpdesk',
	[
		"helpdeskServices",
		"myHelpers",
		"statusservicemod"
	]);

mainMod.config(["$routeProvider" , function ($routeProvider,$locationProvider){
	$routeProvider.
	when("/tickets/all", {templateUrl : 'tickets_main' , controller : TicketController}).
	when("/tickets/:id",{templateUrl : 'single_ticket_view' , controller : TicketDetailsController}).
	otherwise({redirectTo: '/tickets/all'});

}]);