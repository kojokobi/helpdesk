function SecurablesController ($scope,$http,Securable,OBJ,MSG, Role,Module) {
	
	$scope.modules = [];
	

	
	var _default = {
		id : "",
		name : "",
		displayName : "",
		moduleId : ""
	};

	var secForm = $("#securable_form");
	$scope.securables  = [];	

	

	$scope.reload = function (){
		getSecurables();
	}

	function getSecurables () {
		Securable.query(function (res){
			$scope.securables = res.data;
		});
	}


	function getModules(){
		Module.get(function (res){
			$scope.modules  = res.data;
		});
	}



	/**
	 * Add or Edit a securable unit
	 * @param {object} newSec the object
	 */
	$scope.addSecurable = function (newSec){
		//retrieve the model from the client and extend the object with the defaults
		var theSec = OBJ.rectify(angular.copy(newSec),_default);
		//theSec["permissions"] = extractPermissions();
		if(theSec["id"] || theSec["id"] !=="") { //this is an update
			Securable.update(theSec, function (res){
				afterSave(res);
			});
		}else {
			//we are creating a new securable
			var sec = new Securable(theSec);
			sec.$save(function (res){
				afterSave(res);
			});	
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
	 * This show a new form to enter the securable
	 * @return {[type]} [description]
	 */
	$scope.newSecurable = function (){
		getModules();
		$scope.clear();
		$scope.formTitle = "Add A Securable Unit";
		
	}
	/**
	 * Shows the form for edting the securable
	 * @param  {object} securable the securable object
	 * @return {void}  
	 */
	$scope.editSecurable = function (securable){
		$scope.formTitle = "Edit the Securable Unit";
		$scope.newSec = angular.copy(securable);
		secForm.modal("show");
		getModules();
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

	getSecurables();
	

}