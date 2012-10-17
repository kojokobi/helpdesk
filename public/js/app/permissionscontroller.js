function PermissionsController ($scope, $http,Securable, Role, Permission,MSG){
	$scope.secPerm = {};
	$scope.roles = [];
	$scope.permissions = [];
	$scope.securables = []

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

	function getSecurablePermissionsList(){
		$http.get("permissions/securables").success(function(res){
			$scope.permissions = processRawPermissions(res.data);
		});
	}


	function clearPermissions () {

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

	$scope.savePermissions =  function () {
		var msg = "";
		var data = {};
		data = angular.copy($scope.secPerm);
		data["permissions"] = extractPermissions();
		var perm =  new Permission(data);
		perm.$save(function (res){
			if(res.success){
				msg = res.message || "Permissions Updated"
				MSG.show(msg,"success")
			}else {
				msg = res.message || "Errors were encountered";
				MSG.show(msg)
			}	
		});	
		console.log()
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

	//make initial calls
	getSecurables();
	getSecurablePermissionsList();
	getRoles();
}