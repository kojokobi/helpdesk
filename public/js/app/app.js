'use strict';
angular.module('helpdesk',["helpdeskServices","myHelpers"]).config(["$routeProvider" , function ($routeProvider,$locationProvider){
	$routeProvider.
	when("/tickets/all", {templateUrl : 'tickets_main' , controller : TicketController}).
	when("/tickets/:id",{templateUrl : 'single_ticket_view' , controller : TicketDetailsController}).
	otherwise({redirectTo: '/tickets/all'});

}]);