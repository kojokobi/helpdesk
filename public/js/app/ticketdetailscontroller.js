function TicketDetailsController($scope,MSG,$http, $resource,$route, $routeParams, $location,OBJ){

	// $scope.$route = $route;
	// $scope.$routeParams = $routeParams;
	// $scope.location = $location;

	var url = 'tickets/' +$routeParams.id ;
	$scope.originalTicket = {};
	$scope.currentTicketId = $routeParams.id;
	
	var defaultReply = {
	 	message : ""
	}

	$scope.projectClosed = 0;

	//move this to a service instead
	var TicketStatus = $resource('ticketstatuses');
	/**
	 * The various ticket status. This is required so that every reply can be sent with a status
	 * @type {Array}
	 */
	$scope.ticketStatuses = [];
	/**
	 * The thread for a particular ticket
	 * @type {Array}
	 */
	$scope.ticketThread = [];
	
	$scope.newReply = {}

	/**
	 * Gets thread of the current ticket
	 * @return {void} 
	 */
	var getThread =  function (){
		$http.get(url).success(function (res){
			var data =  res.data[0];
			$scope.originalTicket.title = data.title;
			$scope.originalTicket.createdAt = data.createdAt;
			
			var firstMessage = data.thread.pop();
			$scope.originalTicket.message = firstMessage["message"];
			$scope.originalTicket.ticketStatus  = data["ticketStatus"];
			if(data["ticketStatus"].toLowerCase() === "closed")
				$scope.projectClosed = 1;
			$scope.ticketThread = data.thread;
			//delete data.thread;
		});
	}

	var getStatuses = function (){
		TicketStatus.get({ticketId : $scope.currentTicketId} , function (res) {
			$scope.ticketStatuses = res.data ;
			$scope.newReply.status = $scope.ticketStatuses[0];
		});
	}
	
	/**
	 * Submit the reply
	 * @param  {object} newReply the reply to be sent
	 * @return {void}    
	 */
	$scope.submitReply =  function (newReply) {
		var reply = OBJ.rectify(angular.copy(newReply),defaultReply);
		reply["ticketId"] = $scope.currentTicketId;
		reply["ticketStatusId"] = reply.status.id;
		delete reply["status"];
		$http.post(url, reply).success(function (res){
			if(res.success){
				var msg = res.message || "Reply Sent";
				MSG.show(msg, "success");
				getThread();
				newReply.message = "";
			}
			else {
				var msg = res.message || "An Error was encountered. Please try again";
				MSG.show(msg);
			}
		});
	}

	/**
	 * make Initial to get thread
	 */
	getStatuses();
	getThread();	
}

