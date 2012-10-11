function ProfileController ($scope,$http, MSG, User){

	$user = {}
	$scope.updatingProfile = 0;
	$scope.changingPassword = 0;
	$scope.updateProfile = function (user){
		var theUser = angular.copy(user);
		$scope.updatingProfile = 1;
		$http.post("users/updateprofile",theUser).success(function (res){
			var msg = "";
			if(res.success){
				msg = res.message || "Profile Updated Successfully";
				MSG.show(msg, "success");
				$scope.updatingProfile = 0;
			}else {
				msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);
				$scope.updatingProfile = 0;
			}
		});
		
	}

	$scope.changePassword = function (password){
		var thePass = angular.copy(password);
		$scope.changingPassword = 1;
		$http.post("users/changepassword",thePass).success(function (res){
			var msg = "";
			if(res.success){
				msg = res.message || "Password changed Successfully";
				MSG.show(msg, "success");
				$scope.changingPassword = 0;
			}else {
				msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);
				$scope.changingPassword = 0;
			}
		})
	}
}