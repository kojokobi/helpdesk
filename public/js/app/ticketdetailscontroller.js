function TicketDetailsController($scope,MSG,$routeParams,$http){
	var url = 'tickets/' +$routeParams.id ;
	$scope.originalTicket = {};
	$scope.currentTicketId = $routeParams.id;
	
	/**
	 * The thread for a particular ticket
	 * @type {Array}
	 */
	$scope.ticketThread = [];
	
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
	
	/**
	 * Submit the reply
	 * @param  {object} newReply the reply to be sent
	 * @return {void}    
	 */
	$scope.submitReply =  function (newReply) {
		newReply["ticketId"] = $scope.currentTicketId;
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
	getThread();	
}

