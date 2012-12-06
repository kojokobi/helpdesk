function ModulePermissionsController($scope, $http, Role, Module, MSG, OBJ,ModulePermissions){

	var _default = {
		roleId : "",
		moduleId : "",
		permissions : [],
	};

	var rawList ;

	$scope.modulePermission = {};
	$scope.roles = [];	
	$scope.modules = [];
	$scope.modulePermissions = [];
	function getRoles () {
		Role.get(function (res){
			$scope.roles = res.data;
			//$scope.modulePermission.role = $scope.roles[0];
		});
	}

	$scope.reload =  function (type){
		switch(type){
			case  "roles":
				getRoles();
			break;
			case "modules":
				getModules();
			break;
		}
	}
	
	function getModules () {
		Module.get(function (res){
			$scope.modules = res.data;
		});
	}

	function getModulePermissionsList(callback){
		$http.get("permissions/modules").then(function (res){
			rawList = res.data.data
			if(callback)
				callback(rawList);
		});
	}

	/**
	 * This is the start function. It loads roles and modules and fetches 
	 * the role and module for the first record
	 * @return {void}
	 */
	function start() {
		//This chaining of callbacks is not good. It needs to be changed.
		$http.get("roles").then(function (res1){
			$scope.roles = res1.data.data;
			$scope.modulePermission.role = $scope.roles[0];
			
			$http.get("modules").then(function (res2) {
				$scope.modules = res2.data.data;
				$scope.modulePermission.module  = $scope.modules[0];
				
				getModulePermissionsList(function (inData){
					//var test = [{canView : 1}]
					//$scope.modulePermissions = processRawPermissions(inData, inData[0]);
					//fetch the first record
					var roleId = $scope.modulePermission.role.id ;
					var moduleId = $scope.modulePermission.module.id;
					fetchPermissionsFor(moduleId, roleId);
				});
			})
		})
		
	}

	/**
	 * The possible permissions that can be set on a module
	 * @type {Array}
	 */
	


	function processRawPermissions (inData, values){
		var outData = [];
		
		for(var i= 0; i<inData.length; i++){
			for(var x in inData[i]){
				var obj = {
					key : x,
					label : inData[i][x]
				}
				if(values && values[x]){
					obj["val"] = values[x].toString() || "0"
				}else {
					obj["val"] = "0";	
				}
				
				outData.push(obj);	
			}
		}
	
		return outData;
	}


	function extractPermissions() {
		var data = [];
		$scope.modulePermissions.forEach(function (permission){
			var out = { };
			out[ permission["key"] ] =  permission["val"] ;
			data.push(out);
		});

		return data;
	}


	$scope.savePermissions = function(){
		var msg = "";
		var out = OBJ.rectify(angular.copy($scope.modulePermission),_default);
		
		var data = {
			roleId : out.role.id,
			moduleId : out.module.id,
		}

		data["permissions"] = extractPermissions()	
		
		$http.post("modulepermissions",data).success(function (res){
			if(res.success){
				msg = res.message || "Record Saved successfully";
				MSG.show(msg, "success");
			}else {
				msg = res.message || "Sorry, errors were ecountered";
				MSG.show(msg);
			}
		});
	}

	$scope.changePermissions = function (){
		var roleId  = $scope.modulePermission.role.id;
		var moduleId = $scope.modulePermission.module.id;
		fetchPermissionsFor(moduleId, roleId);
	}


	function fetchPermissionsFor(moduleId, roleId){
		ModulePermissions.query({
			roleId : roleId , 
			moduleId : moduleId }, function (res){
				$scope.modulePermissions = processRawPermissions(rawList, res.data[0]);
			}
		);
	}

	//make initial call here
	start();
}
