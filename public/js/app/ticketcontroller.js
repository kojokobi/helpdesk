function TicketController ($scope, $http, Ticket, MSG, UserGroup,ARR,OBJ){
	/**
	 * reference to the ticket form
	 * @type {[type]}
	 */
	var ticketsForm = $("#tickets_form");

	var ticketDefaults = {
		title : "",
		message : "",
		ticketTypeId : "",
		priorityId : "",
		assignedId : ""
	}
	
	$scope.currentProject = {};

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
	$scope.tickets = [];

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
		var params = OBJ.rectify( angular.copy(newTicket),ticketDefaults);
		var ticket = new Ticket(params);
		ticket.$save(function (res){
			var msg = "";
			if(res.success){
				msg = res.message || "Ticket saved succefully"; 
				MSG.show(msg,"success");
				getTickets();
				newTicket = {}
				ticketsForm.modal("hide");
			} else {
				msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg); 
			}
		});
	}


	function getUserProjects () {
		$http.get("usergroups").then(function (res){
			$scope.userProjects = ARR.sort(res.data.data,"projectName");

			//make initial call
			$scope.currentProject = $scope.userProjects[0]
			$scope.loadTickets();
		});
	}

	
	/**
	 * Makes a few ajax call to populate dropdown and loads data as well
	 * @return {void} 
	 */
	$scope.showForm = function (){
		//todo: set the first project to the first item in the projects list
		getTicketTypes();
		getProirities();
		if(!$scope.currentProject){
			MSG.show("Please Select a Project first.");
			return;
		}
		$scope.newTicket = {};
		
		ticketsForm.modal();
		$scope.newTicket.projectId = $scope.currentProject.projectId;
		
		getProjectUsers($scope.currentProject.projectId);
	}

	

	$scope.loadTickets = function (){
		getTickets();		
	}

	/**
	 * Retrieves all ticket for a particular project. Default is ie the current project
	 * @return {[type]} [description]
	 */
	var getTickets =  function (id) {
		var _id = id || $scope.currentProject.projectId;
		Ticket.query(
			{ projectId: _id},function (res){
			$scope.tickets = res.data;
			//$scope.currentProjectName = 
		});
	}

	//$currentProjectId = 
	getUserProjects();

}