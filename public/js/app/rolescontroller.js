function RolesController ($scope, Role, MSG,OBJ){
	var _default = {
		id : "",
		name : "",
		description : ""
	}

	$scope.roles = [];

	$scope.formTitle = "Add Role";
	$scope.reload = function (){
		getRoles();
	}

	function getRoles(){
		Role.get(function (res){
			$scope.roles = res.data;
		});
	}
	
	/**
	 * Add or Edit a role 
	 * @param {object} newRole the object
	 */
	$scope.addRole = function (newRole){
		//retrieve the model from the client and extend the object with the defaults
		var theRole = OBJ.rectify(angular.copy(newRole),_default);
		if(theRole["id"] || theRole["id"] !=="") { //this is an update
			Role.update(theRole, function (res){
				afterSave(res);
			});
		}else {
			//we are creating a new role
			var role = new Role(theRole);
			role.$save(function (res){
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
			getRoles();
			msg = res.message || "Role Created";
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
	 * Clean up Method
	 * @return {void} 
	 */
	$scope.clear = function (){
		$scope.newRole = {};
	}

	//make initial calls
	getRoles();
}