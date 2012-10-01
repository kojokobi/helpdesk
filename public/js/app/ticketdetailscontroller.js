function TicketDetailsController($scope,MSG,$http, $resource,$route, $routeParams, $location){

	// $scope.$route = $route;
	// $scope.$routeParams = $routeParams;
	// $scope.location = $location;

	var url = 'tickets/' +$routeParams.id ;
	$scope.originalTicket = {};
	$scope.currentTicketId = $routeParams.id;
	
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
			//console.log(data)
			$scope.originalTicket.title = data.title;
			$scope.originalTicket.createdAt = data.createdAt;
			$scope.originalTicket.message = data.thread.pop()["message"];
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
		newReply["ticketId"] = $scope.currentTicketId;
		newReply["ticketStatusId"] = newReply.status.id;
		delete newReply["status"];
		$http.post(url, newReply).success(function (res){
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

