function SecurablesController ($scope,$http,Securable,OBJ,MSG, Role,Module) {
	
	$scope.permissions = [];
	$scope.modules = [];
	$scope.roles = [];

	
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

	function getRoles () {
		Role.get(function (res){
			$scope.roles = res.data;
		});
	}

	function getModules(){
		Module.get(function (res){
			$scope.modules  = res.data;
		});
	}

	function getSecurablePermissionsList(){
		$http.get("permissions/securables").success(function(res){
			$scope.permissions = processRawPermissions(res.data);
		});
	}

	function processRawPermissions (inData){
		var outData = [];
		for(var i= 0; i<inData.length; i++){
			for(var x in inData[i]){
				var obj = {
					key : x,
					label : inData[i][x],
					val : "0"			
				}
				outData.push(obj);	
			}
		}
		return outData;
	}

	function extractPermissions (){
		var data = [];
		$scope.permissions.forEach(function (permission){

			var out = { };
			out[ permission["key"] ] =  permission["val"] ;
			data.push( out);
		});

		return data;
	}

	function clearPermissions () {

	}

	/**
	 * Add or Edit a securable unit
	 * @param {object} newSec the object
	 */
	$scope.addSecurable = function (newSec){
		//retrieve the model from the client and extend the object with the defaults
		var theSec = OBJ.rectify(angular.copy(newSec),_default);
		theSec["permissions"] = extractPermissions();
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
		getRoles();
		getModules();
		//$secForm.modal("show");
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
	getSecurablePermissionsList();

}