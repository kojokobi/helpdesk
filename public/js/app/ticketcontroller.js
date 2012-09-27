function TicketController ($scope, $http, Ticket, MSG, UserGroup){
	/**
	 * reference to the ticket form
	 * @type {[type]}
	 */
	var ticketsForm = $("#tickets_form");

	/**
	 * ticket Types
	 * @type {Array}
	 */
	$scope.ticketTypes = [];

	/**
	 * ticket priorities
	 * @type {Array}
	 */
	$scope.priorityTypes = [];

	/**
	 * ticket for a particular project
	 * @type {Array}
	 */
	$scope.tickets = [
		// {
		// 	id : 1,
		// 	title : "some title",
			

		// }
	];

	/**
	 * All users in  the current project
	 * @type {Array}
	 */
	$scope.projectUsers = [];

	/**
	 * refers to all the projets that the user belongs to
	 * @type {Array}
	 */
	$scope.userProjects = [];

	

	function getProirities(){
		$http.get("priorities").then(function (res){
			$scope.priorityTypes = res.data.data;
		});
	}

	function getTicketTypes (){
		$http.get("tickettypes").then(function (res){
			$scope.ticketTypes = res.data.data;
		});
	}

	function getProjectUsers(id) {
		UserGroup.query({projectId : id }, function (res){
			$scope.projectUsers =  res.data;
		});
	}
	
	/**
	 * create a new ticket
	 * @param {object} newTicket the content of th new ticket to be created
	 */
	$scope.addTicket =  function (newTicket){
		var ticket = new Ticket(newTicket);
		ticket.$save(function (res){
			if(res.success){
				var msg = res.message || "Ticket saved succefully"; 
				MSG.show(msg,"success");
				getTickets();
			} else {
				var msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg); 
			}
		});
	}


	function getUserProjects () {
		$http.get("usergroups").then(function (res){
			$scope.userProjects = res.data.data;
			var obj = $scope.userProjects[0];

			$scope.currentProjectId = {projectId : obj["projectId"] , projectName : obj["projectName"] }
		});
	}

	getUserProjects();

	/**
	 * Makes a few ajax call to populate dropdown and loads data as well
	 * @return {void} 
	 */
	$scope.showForm = function (){
		//todo: set the first project to the first item in the projects list
		getTicketTypes();
		getProirities();
		if(!$scope.currentProjectId){
			MSG.show("Please Select a Project first.");
			return;
		}
		$scope.newTicket = {};
		
		ticketsForm.modal();
		$scope.newTicket.projectId = $scope.currentProjectId;
		
		getProjectUsers($scope.currentProjectId);
	}

	

	$scope.loadTickets = function (){
		getTickets();		
	}

	/**
	 * Retrieves all ticket for a particular project. Default is ie the current project
	 * @return {[type]} [description]
	 */
	var getTickets =  function (id) {
		var _id = id || $scope.currentProjectId;
		Ticket.query(
			{ projectId: _id},function (res){
			$scope.tickets = res.data;
		});
	}

	//$currentProjectId = 

}