function ProjectController ($scope,$http,Project,ProjectGroup,UserGroup,User,MSG,OBJ) {

	var projectDefault= {
		id : "",
		name : "",
		description : ""
	};

	$scope.formTitle = "Add Project";
	$scope.projects = [];
	$scope.userGroups = [];
	$scope.projectGroups = [];

	$scope.users = [];
	$scope.projectUsers = [];

	$scope._currentProjectId ;
	/**
	 * Gets all projects
	 * @return void
	 */
	function getProjects (){
		Project.query(function (res){
			$scope.projects = angular.copy(res.data);
		})
	}


	$scope.addProject = function (newProject){
		var project = OBJ.rectify(angular.copy(newProject),projectDefault);
		if (project["id"]){
			Project.update(project, function (res){
				if (res.success){
					getProjects();
					$scope.clear();
				}else {

				}
			});
			
		} else {
		
			var theProject = new Project(project);
			theProject.$save(function (res){
				//fetch fresh items
				if(res.success){
					getProjects();
					$scope.clear();	
					var msg = res.message || "Record saved succefully"; 
					MSG.show(msg,"success");
				} else {
					var msg = res.message || "Sorry errors were ecountered"; 
					MSG.show(msg);
				}
			});
		}
	}

	function getUsers(){
		User.query(function (res){
			$scope.users = res.data;
		});
		// User.get().then(function (res){
		// 	$scope.users = res.data;
		// });
	}

	function getProjectGroups(id){
		ProjectGroup.query({projectId : id },function (res){
			$scope.projectGroups =  res.data;
		});
	}

	function getUserGroups (id){
		UserGroup.query({projectId : id }, function (res){
			$scope.userGroups =  res.data;
		});
	}

	/**
	 * Brings the form which allows us to add a user  to a group
	 * @param  {object} project to be updated
	 * @return {void}   
	 */
	$scope.updateProjectDetails = function(project){
		//console.log(project);
		var form = $("#projectDetails");
		form.modal();
		$scope.currentProject = {}
		$scope.currentProject.name = project.name;
		$scope.currentProject.projectId = project.id;
		getUsers();
		getProjectGroups(project.id);
		getUserGroups(project.id);
	}

	$scope.addProjectGroup = function (currentProject){
		var group =  new ProjectGroup(angular.copy(currentProject));
		group["name"] = group["newGroup"];
		group["description"] = "";
		
		//todo add description later
		group.$save(function (res){
			if (res.success){
				var msg = res.message || "Project Group created"; 
				MSG.show(msg,"success");
				getProjectGroups(currentProject.projectId);
			} else {
				var msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);
			}
		});
	}

	$scope.addUserToGroup =  function (userGroup){
		console.log(userGroup)
		var projectUserGroup = new UserGroup(userGroup);
		$scope._currentProjectId = $scope.currentProject.projectId
		projectUserGroup.$save(function (res){
			if(res.success){
				var msg = res.message || "User added to group created"; 
				MSG.show(msg,"success");
				//load the user
				getUserGroups($scope._currentProjectId);
			}else {
				var msg = res.message || "Sorry errors were ecountered"; 
				MSG.show(msg);

				
			}
		});
	}

	$scope.clear =  function (){
		$scope.newProject = {};
		//$scope.title = "Add New User";
		//$scope.statusText = "Add User";
	}


	//make calls here
	getProjects();

}