function ProjectController ($scope,$http,Project,Group,MSG) {
	$scope.formTitle = "Add Project";
	$scope.projects = [];

	/**
	 * Gets all projects
	 * @return void
	 */
	function getProjects (){
		Project.query(function (res){
			$scope.projects = angular.copy(res.data);
		})
	}


	$scope.addProject =  function (newProject){
		if (newProject["id"]){
			Project.update(newProject, function (res){
				if (res.success){
					getProjects();
					$scope.clear();
				}else {

				}
			});
			
		} else {
			var project =  angular.copy(newProject);
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
	}

	$scope.addGroup = function (currentProject){
		var group =  new Group(angular.copy(currentProject));
		group.$save(function (res){
			if (res.success){
				var msg = res.message || "Group created"; 
				MSG.show(msg,"success");
			} else {
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