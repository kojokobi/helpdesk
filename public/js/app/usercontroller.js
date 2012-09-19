function UserController ($scope, User){
	$scope.formTitle = "Add User";
	$scope.users = [];

	function getUsers(){
		User.query(function (res){
			$scope.users = angular.copy(res.data);
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
			
			theUser.$save(function (){
				//fetch fresh items
				getUsers();
				$scope.clear();
			});
		}
	}

	$scope.clear =  function (){
		//$scope.newUser = {};
		//$scope.title = "Add New User";
		//$scope.statusText = "Add User";
	}


	//make calls here
	getUsers();
}