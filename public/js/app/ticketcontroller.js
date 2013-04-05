function TicketController ($scope, $http, Ticket, MSG, UserGroup,ARR,OBJ, StatusService, $routeParams,$location){
	
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
	$scope.rawTickets = [];
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

	$scope.selectedTicketStatus = "all";
	

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
	

	$scope.checkStatus =  function (status){
		return StatusService.checkStatus(status);
	}

	$scope.changeTicketClass = function (klass){
		var outKlass = "";
		if($scope.selectedTicketStatus === klass){
			switch(klass){
				case "open":
					outKlass = "btn-danger";
				break;
				case "pending":
					outKlass = "btn-warning";
				break;
				case "resolved":
					outKlass = "btn-info";
				break;
				case "unresolved":
					outKlass = "btn-inverse";
				break;
				case "closed":
					outKlass = "btn-success";
				break;
				case "all":
					outKlass = "btn-primary";
				break;
			}	
		}
			
		return outKlass;
	}

	$scope.selectTicketStatus = function (ticketStatus){
		$scope.selectedTicketStatus = ticketStatus;
		filterTickets($scope.selectedTicketStatus);
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


	function getUserProjects (callback) {
		$http.get("usergroups").then(function (res){
			$scope.userProjects = ARR.sort(res.data.data,"projectName");

			if(callback)
				callback();
			
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
		var id = $scope.currentProject.projectId;
		$location.path("/projects/" + id);			
	}

	/**
	 * Retrieves all ticket for a particular project. Default is ie the current project
	 * @return {[type]} [description]
	 */
	var getTickets =  function (id) {
		var _id = id || $scope.currentProject.projectId;
		Ticket.query(
			{ projectId: _id},function (res){
			$scope.rawTickets = res.data;
			$scope.selectedTicketStatus = "all";

			filterTickets($scope.selectedTicketStatus);
		});
	}

	$scope.count = function(ticketStatus){
		var count = 0;
		if(ticketStatus === "all"){
			count = $scope.rawTickets.length;
		}else {
			tickets = $scope.rawTickets.filter(function (ticket){
				return  ticketStatus === ticket.ticketStatus.toLowerCase();
			});	
			count = tickets.length;
		}

		return count;
	}

	function filterTickets(ticketStatus){
		if(ticketStatus === "all"){
			$scope.tickets = $scope.rawTickets;
		}else {
			$scope.tickets = $scope.rawTickets.filter(function (ticket){
				return  ticketStatus === ticket.ticketStatus.toLowerCase();
			});	
		}
	}

	//initial call to fetch the current users projects
	getUserProjects(function(){
		var id = $routeParams.id;
		if(id){
			getTickets(id);
			var out = $scope.userProjects.filter(function (n){
				return n.projectId === id;
			});

			//set the value in th combo box
			out = out[0];
			var idx = $scope.userProjects.indexOf(out);
			$scope.currentProject = $scope.userProjects[idx];
		}else {
			//lets just default to the very first
			$scope.currentProject = $scope.userProjects[0];
			getTickets();
		}
	});
	
}