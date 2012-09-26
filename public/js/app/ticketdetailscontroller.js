function TicketDetailsController($scope,MSG,$routeParams,$http){
	var url = '/tickets/' +$routeParams.id ;
	$scope.originalTicket = {};
	$scope.currentTicketId = $routeParams.id;
	/**
	 * The thread for a particular ticket
	 * @type {Array}
	 */
	$scope.ticketThread = [
		{
			createdAt : (new Date()).toDateString(),
			message : "some message"
		}
	];

	/**
	 * Gets thread of the current ticket
	 * @return {void} 
	 */
	$scope.getThread =  function (){
		$http.get(url).success(function (res){
			var data = res.data.data;
			$scope.originalTicket = data.pop()
			$scope.ticketThread = data;
		})
	}
	
	/**
	 * Submit the reply
	 * @param  {object} newReply the reply to be sent
	 * @return {void}    
	 */
	$scope.submitReply =  function (newReply) {
		newReply["ticketId"] = $scope.currentTicketId;
		$http.post(url, newReply).success(function (res){
			MSG.show("Error Encountered");
		});
	}

	/**
	 * make Initial to get thread
	 */
	getThread();	
}