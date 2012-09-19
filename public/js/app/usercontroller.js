function UserController ($scope, User,$http,MSG){
	$scope.formTitle = "Add User";
	$scope.users = [];

	
	
	function getUsers(){
		User.query(function (res){
			$scope.users = angular.copy(res.data);
		});	
	}

	function getRoles(){
		$http.get('roles').success(function (res){
			$scope.roles = res.data;
		});
	}

	function getJobTitles(){
		$http.get('jobtitles').success(function (res){
			$scope.jobTitles = res.data;
		});
	}

	$scope.addUser =  function (newUser){
		if (newUser["id"]){
			User.update(newUser, function (res){
				if (res.success){
					getUsers();
					$scope.clear();
				}else {

				}
				
			});
			
		}else {
			var user =  angular.copy(newUser);
			var theUser = new User(user);
			window.xx = newUser;
			theUser.$save(function (res){
				//fetch fresh items
				if(res.success){
					getUsers();
					$scope.clear();	
				}else {
					var msg = res.message || "Sorry errors were ecountered"; 
					MSG.show(msg);
				}
				
			});
		}
	}

	$scope.clear =  function (){
		$scope.newUser = {};
		//$scope.title = "Add New User";
		//$scope.statusText = "Add User";
	}


	//make calls here
	getUsers();
	getRoles();
	getJobTitles();
}