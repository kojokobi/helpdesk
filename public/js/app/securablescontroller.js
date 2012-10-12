function SecurablesController ($scope,Securable,OBJ,MSG) {
	
	var _default = {
		id : "",
		name : "",
		displayName : "",
		moduleId : ""
	};

	var secForm = $("#securable_form");
	$scope.securables  = [];	

	$scope.formTitle = "Add A Securable Unit";

	$scope.reload = function (){
		getSecurables();
	}

	function getSecurables () {
		Securable.query(function (res){
			$scope.securables = res.data;
		});
	}

	/**
	 * Add or Edit a securable unit
	 * @param {object} newSec the object
	 */
	$scope.addSecurable = function (newSec){
		//retrieve the model from the client and extend the object with the defaults
		var theSec = OBJ.rectify(angular.copy(newSec),_default);
		if(theSec["id"] || theSec["id"] !=="") { //this is an update
			Securable.update(theSec, function (res){
				afterSave(res);
			});
		}else {
			//we are creating a new securable
			var sec = new Securable(theSec);
			sec.$save(function (res){
				afterSave(res);
			})	
		}
	}

	/**
	 * Method to be run after saving /updating a record
	 * @param  {object}   res      the response from the server
	 * @param  {Function} callback an additional callback function that we might want to run
	 * @return {[type]}            [description]
	 */
	function afterSave(res,callback){
		var msg = "";
		if(res.success){
			//reload data into grid
			getSecurables();
			msg = res.message || "Securable Unit Created";
			MSG.show(msg,"success");
			$scope.clear();
			secForm.modal("hide");
			
			//any other business
			if(callback)
				callback();
		}else {
			msg = res.message || "Sorry, errors were ecountered";
			MSG.show(msg);
		}
	}

	/**
	 * Shows the form for edting the securable
	 * @param  {object} securable the securable object
	 * @return {void}  
	 */
	$scope.editSecurable = function (securable){
		$scope.newSec = angular.copy(securable);
		secForm.modal("show");
	}

	/**
	 * Delete the securable object
	 * @param  {object} securable the securable object
	 * @return {void}           
	 */
	$scope.deleteSecurable = function(securable){

	}


	/**
	 * Clean up Method
	 * @return {void} 
	 */
	$scope.clear = function (){
		$scope.newSec = {};
	}

	//make initial calls
	getSecurables();
}