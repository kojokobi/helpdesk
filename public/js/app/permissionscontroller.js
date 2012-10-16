function PermissionsController ($scope, $http,Securable, Role){
	
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
		alert("saving")
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