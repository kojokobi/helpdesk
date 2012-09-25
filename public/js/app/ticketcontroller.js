function TicketController ($scope){
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


	$scope.addTicket =  function (ticket){
		console.log(ticket);
		return false;
	}
}