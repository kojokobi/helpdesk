function ProfileController ($scope,$http, MSG, User){

	$user = {}

	$scope.updateProfile = function (user){
		var theUser = angular.copy(user);
		$http.post("users/updateprofile",theUser).success(function (res){
			if(res.success){
				var msg = res.message || "Profile Updated Successfully";
				MSG.show(msg, "success");
			}
		})
		
	}

	$scope.changePassword = function (password){
		var thePass = angular.copy(password);
		$http.post("users/changepassword",thePass).success(function (res){
			if(res.success){
				var msg = res.message || "Password changed Successfully";
				MSG.show(msg, "success");
			}
		})
	}
}