function ProfileController ($scope,$http, $timeout, MSG, User, Photo){

	$scope.user = {}
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

	var url = 'photos';
	var leftSide = new qq.FineUploader({
        element: $('#left_side')[0],
        //autoUpload: false,
        request: {
            endpoint: url,
            inputName : "fileName",
        },
        callbacks: {
            //onError: errorHandler,
            onSubmit :function(event, id, filename) {
                this.setParams(
                    {
                    	userId : $scope.user.id
                    }
                );
            },
            onComplete : function(id, filename, res){
                if(res.success){
                    $scope.image = res.data.image;
                    $scope.$apply();
                }
               
            }
        }
    });
	
    function  getPhoto(id){
    	console.log(id)
    	Photo.get( {id :id}, function (res){
    		$scope.image = res.data.image;
    	});
    }

    //start
    $timeout (function (){
    	getPhoto($scope.user.id);	
    }, 300);
    

	//image stuffs
}