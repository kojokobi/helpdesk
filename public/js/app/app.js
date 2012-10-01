var main = angular.module('helpdesk',["helpdeskServices","myHelpers"]).config(["$routeProvider" , function ($routeProvider){
	$routeProvider.when("/tickets/all", {templateUrl : 'tickets_main' , controller : TicketController}).
	when("/ticket/:id",{templateUrl : 'single_ticket_view' , controller : TicketDetailsController})
	.otherwise({redirectTo: '/tickets/all'});

	// $route.onChange(function () {
 //        self.params = $route.current.params;
 //    });
 
	//$locationProvider.html5Mode(true);
}]);