function UserController ($scope, User,$http,MSG){
	$scope.formTitle = "Add User";
	$scope.users = [];

	
	
	function getUsers(){
		User.query(function (res){
			$scope.users = angular.copy(res.data);
			MSG.show('Users loaded succesfully', "success");
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
			User.update(newUser, function (){
				getUsers();
				$scope.clear();
			});
			
		}else {
			var user =  angular.copy(newUser);
			var theUser = new User(user);
			window.xx = newUser;
			theUser.$save(function (res){
				//fetch fresh items
				window.xxx = res;
				if(res.success){
					getUsers();
					$scope.clear();	
				}else {
					MSG.show("errors were ecountered");
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