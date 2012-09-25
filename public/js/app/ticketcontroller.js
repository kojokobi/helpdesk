function TicketController ($scope, $http, Ticket, MSG){
	$scope.ticketTypes = [
		{id : 1 , name : "Bug"},
		{id : 2 , name : "Problem"},
		{id : 3 , name : "Question"},
		{id : 4 , name : "Todo"}
	];

	$scope.priorityTypes = [
		{id : 1, name : 'Low'},
		{id : 1, name : 'High'}
	];

	$scope.tickets = [
		{
			id : 1,
			status : "open",
			title : "A very big problem",
			assignedTo : 'Kofi Poku',
			issuedDate : (new Date()).toDateString(),
			priority : "High"
		},

	];

	$scope.projectUsers = [
		{id : 1, name : "Kojo Kumah"}
	];

	$scope._currentProjectId = 1;
	$scope.userProjects = [];

	
	$scope.addTicket =  function (newTicket){
		var ticket = new Ticket(newTicket);
		ticket.$save(function (res){
			if(res.success){
				var msg = res.message || "Ticket saved succefully"; 
				MSG.show(msg,"success");
			} else {
				var msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg); 
			}
		});
	}

	function getUserProjects () {
		$http.get("usergroups").then(function (res){
			$scope.userProjects = res.data.data;
		})
	}

	getUserProjects();

	$scope.showForm = function (){
		$scope.newTicket = {};
		var ticketsForm = $("#tickets_form");
		ticketsForm.modal();
		$scope.newTicket.projectId = $scope._currentProjectId;
	}

	$scope.$watch("currentProjectId",function (newValue){
		alert("");
		loadTickets()
	})

	var loadTickets = function (){
		MSG.show("Loading New tickets")
		
	}


}