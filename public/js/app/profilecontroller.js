function ProfileController ($scope, MSG, User){

	$user = {}

	$scope.updateProfile = function (user){
		var theUser = angular.copy(user);
		
		User.update(theUser, function (){

		});
	}

	$scope.changePassword = function (password){
		var thePass = angular.copy(password);
		
	}
}