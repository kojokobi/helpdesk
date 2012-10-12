function ModulesController($scope,Module,OBJ,MSG) {
		
	var _default = {
		id : "",
		name : "",
		description : "",
		listOrder : ""
	}

	var moduleForm = $("#module_form");

	$scope.modules = [];

	$scope.formTitle = "Add Module";

	$scope.reload = function (){
		getModules();
	}

	function getModules(){
		Module.get(function (res){
			$scope.modules  = res.data;
		});
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
	 * @param  {Function} callback an additional callback function that we might want to run
	 * @return {[void]}     
	 */
	function afterSave(res,callback){
		var msg = "";
		if(res.success){
			//reload data into grid
			getModules();
			msg = res.message || "Module Created";
			MSG.show(msg,"success");
			$scope.clear();
			moduleForm.modal("hide");
			
			//any other business
			if(callback)
				callback();
		}else {
			msg = res.message || "Sorry, errors were ecountered";
			MSG.show(msg);
		}
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