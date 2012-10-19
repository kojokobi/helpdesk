function PermissionsController ($scope, $http,Securable, Role, SecurablePermissions,MSG){
	
	var _default = {
		roleId : "",
		securableId : "",
		permissions : []
	}

	$scope.roles = [];
	$scope.securables = []
	$scope.securablePermission = {};
	$scope.securablePermissions = [];

	var rawList;

	function getRoles () {
		Role.get(function (res){
			$scope.roles = res.data;
		});
	}

	function getSecurables () {
		Securable.query(function (res){
			$scope.securables = res.data;
		});
	}

	function getSecurablePermissionsList(callback){
		$http.get("permissions/securables").success(function(res){
			$scope.permissions = res.data.data;
			if(callback)
				callback(rawList);
		});
	}

	/**
	 * This is the start function. It loads roles and securables and fetches 
	 * the role and securable for the first record
	 * @return {void}
	 */
	function start() {
		//This chaining of callbacks is not good. It needs to be changed.
		$http.get("roles").then(function (res1){
			$scope.roles = res1.data.data;
			$scope.securablePermission.role = $scope.roles[0];
			
			$http.get("securables").then(function (res2) {
				$scope.securables = res2.data.data;
				$scope.securablePermission.securable  = $scope.securables[0];
				
				getSecurablePermissionsList(function (inData){
					//var test = [{canView : 1}]
					//$scope.modulePermissions = processRawPermissions(inData, inData[0]);
					//fetch the first record
					var roleId = $scope.securablePermission.role.id ;
					var securableId = $scope.securablePermission.securable.id;
					fetchPermissionsFor(securableId, roleId);
				});
			})
		})
		
	}

	function clearPermissions () {

	}

	function processRawPermissions (inData){
		var outData = [];
		if (values){
			for(var i= 0; i<inData.length; i++){
				for(var x in inData[i]){
					var obj = {
						key : x,
						label : inData[i][x]
					}
					if(values[x]){
						obj["val"] = values[x].toString() || "0"
					}else {
						obj["val"] = "0";	
					}
					
					outData.push(obj);	
				}
			}
		}
		
		return outData;
	}

	function extractPermissions (){
		var data = [];
		$scope.securablePermissions.forEach(function (permission){

			var out = { };
			out[ permission["key"] ] =  permission["val"] ;
			data.push( out);
		});

		return data;
	}

	$scope.savePermissions =  function () {
		var msg = "";
		var out = OBJ.rectify(angular.copy($scope.securablePermission),_default);
		
		var data = {
			roleId : out.role.id,
			securableId : out.securable.id,
		}

		data["permissions"] = extractPermissions()	
		
		$http.post("securablepermissions",data).success(function (res){
			console.log(res)
			if(res.success){
				msg = res.message || "Record Saved successfully";
				MSG.show(msg, "success");
			}else {
				msg = res.message || "Sorry, errors were ecountered";
				MSG.show(msg);
			}
		});
	}

	$scope.reload =  function (type){
		switch(type){
			case  "roles":
				getRoles();
			break;
			case "securables":
				getSecurables();
			break;
		}
	}

	$scope.changePermissions = function (){
		var roleId  = $scope.securablePermission.role.id;
		var securableId = $scope.securablePermission.securable.id;
		fetchPermissionsFor(securableId, roleId);
	}


	function fetchPermissionsFor(securableId, roleId){
		SecurablePermissions.query({
			roleId : roleId , 
			securableId : securableId }, function (res){
				$scope.securablepermissions = processRawPermissions(rawList, res.data[0]);
			}
		);
	}

	//make initial calls
	start();
}