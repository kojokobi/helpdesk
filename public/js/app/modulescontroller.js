function ModulesController($scope,$http,Module,OBJ,MSG, Role) {
		
	var _default = {
		id : "",
		name : "",
		description : "",
		listOrder : ""
	}

	var moduleForm = $("#module_form");

	/**
	 * the modules list
	 * @type {Array}
	 */			
	$scope.modules = [];
	$scope.roles = [];

	$scope.formTitle = "Add Module";

	$scope.reload = function (){
		getModules();
	}

	function getModules(){
		Module.get(function (res){
			$scope.modules  = res.data;
		});
	}

	function getRoles() {
		Role.get(function (res){
			$scope.roles = res.data;
		})
	}
	

	/**
	 * Add or Edit a module 
	 * @param {object} newModule the object
	 */
	$scope.addModule = function (newModule){
		//retrieve the model from the client and extend the object with the defaults
		var theModule = OBJ.rectify(angular.copy(newModule),_default);
		if(theModule["id"] || theModule["id"] !=="") { //this is an update
			Module.update(theModule, function (res){
				afterSave(res);
			});
		}else {
			//we are creating a new module
			var module = new Module(theModule);
			module.$save(function (res){
				afterSave(res);
			})	
		}
	}

	/**
	 * Method to be run after saving /updating a record
	 * @param  {object}   res      the response from the server
	 * @param  {object}   obj      an object containing extra info to be used id no response is sent
	 * @param  {Function} callback an additional callback function that we might want to run
	 * @return {[void]}     
	 */
	function afterSave(res,obj,callback){
		var msg = "";
		if(res.success){
			//reload data into grid
			getModules();
			msg = res.message || obj.message || "Module Saved";
			MSG.show(msg,"success");
			$scope.clear();
			moduleForm.modal("hide");
			
			//any other business
			if(callback)
				callback();
		}else {
			msg = res.message || obj.message || "Sorry, errors were ecountered";
			MSG.show(msg);
		}
	}

	$scope.showNewModule = function () {
		getRoles();
	}

	/**
	 * Show's the form for editing a module
	 * @param  {objecy} module the module object
	 * @return {void}        
	 */
	$scope.editModule = function (module){
		$scope.newModule = angular.copy(module);
		moduleForm.modal("show");
	}

	/**
	 * Deletes a module object
	 * @param  {object} module the module object
	 * @return {void}        
	 */
	$scope.deleteModule =  function (module){

	}

	/**
	 * Clean up Method
	 * @return {void} 
	 */
	$scope.clear = function (){
		$scope.newModule = {};
	}

	//make initial calls
	getModules();
	
}