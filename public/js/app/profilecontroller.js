function ProfileController ($scope,$http, MSG, User){

	$user = {}

	$scope.updateProfile = function (user){
		var theUser = angular.copy(user);
		$http.post("users/updateprofile",theUser).success(function (res){
			var msg = "";
			if(res.success){
				msg = res.message || "Profile Updated Successfully";
				MSG.show(msg, "success");
			}else {
				msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);
			}
		})
		
	}

	$scope.changePassword = function (password){
		var thePass = angular.copy(password);
		$http.post("users/changepassword",thePass).success(function (res){
			var msg = "";
			if(res.success){
				msg = res.message || "Password changed Successfully";
				MSG.show(msg, "success");
			}else {
				msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);
			}
		})
	}
}