var main = angular.module('helpdesk',["helpdeskServices","myHelpers"]).config(["$routeProvider", function ($routeProvider){
	$routeProvider.when("/tickets/all", {templateUrl : 'tickets_main' , controller : TicketController}).
	when("/ticket/:id",{templateUrl : 'single_ticket_view' , controller : TicketController})
	.otherwise({redirectTo: '/tickets/all'});
}]);